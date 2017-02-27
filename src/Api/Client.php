<?php

namespace T3ko\Inpost\Api;

use Psr\Http\Message\StreamInterface;
use T3ko\Inpost\Objects\MachineFactory;
use T3ko\Inpost\Objects\Shipment\Package;
use T3ko\Inpost\Objects\Shipment\SelfSentPackage;
use T3ko\Inpost\Objects\Shipment\Shipment;

class Client
{
    /**
     * URL to production API ednpoint.
     */
    const PRODUCTION_API_ENDPOINT = 'https://api.paczkomaty.pl';

    /**
     * URL to sandbox API endpoint.
     */
    const SANDBOX_API_ENDPOINT = 'https://sandbox-api.paczkomaty.pl';

    const LABEL_SIZE_A4 = 'A4';
    const LABEL_SIZE_A6 = 'A6P';
    const LABEL_FILE_FORMAT_PDF = 'Pdf';
    const LABEL_FILE_FORMAT_EPL2 = 'Epl2';

    private $apiLogin;
    private $apiPassword;
    private $apiClient;
    private $machineFactory;
    private $serializer;

    /**
     * Constructs the API client wrapper object.
     *
     * @param string $apiLogin               Your API email/login
     * @param string $apiPassword            Your API password
     * @param string $apiEndpoint            API endpoint base URL to use. May be a production (https://api.paczkomaty.pl) or a
     *                                       sandbox one (https://sandbox-api.paczkomaty.pl). Defaults to production
     * @param array  $additionalClientConfig Array of additional configuration options for the underlying Guzzle client in the specified format
     *                                       accepted by the Guzzle client (@see http://docs.guzzlephp.org/en/latest/request-options.html).
     *                                       Please note that the constructor's $apiEndpoint parameter has precedence over
     *                                       setting 'base_uri' within the configuration array
     */
    public function __construct($apiLogin, $apiPassword, $apiEndpoint = self::PRODUCTION_API_ENDPOINT, $additionalClientConfig = [])
    {
        $additionalClientConfig['base_uri'] = $apiEndpoint;

        $this->apiLogin = $apiLogin;
        $this->apiPassword = $apiPassword;
        $this->apiClient = new \GuzzleHttp\Client($additionalClientConfig);
        $this->machineFactory = new MachineFactory();
        $this->serializer = new Serializer();
    }

    /**
     * Validates the API call response contents by searching for a '<paczkomaty><error>...</error></paczkomaty>'
     * pattern in the passed string. If found - throws an exception based on the error description, returns TRUE otherwise.
     *
     * @param string $xml The response contents
     *
     * @return bool TRUE if the error was not found
     *
     * @throws \Exception
     */
    private function validateResponse($xml)
    {
        if (false !== $result = $this->serializer->deserializeErrors($xml)) {
            throw new \Exception(sprintf('%s: %s', $result['code'], $result['description']));
        }

        return true;
    }

    /**
     * Performs a call on a given API endpoint using $method method.
     * Encodes array passed in the $body parameter (if any) as form fields for the POST method.
     *
     * @param string $path   Path to the called API endpoint
     * @param string $method Http method to use
     * @param array  $body   Array to be encoded as form fields in the request body
     *
     * @return StreamInterface Stream for the call response body (if any)
     */
    private function callEndpoint($path, $method, array $body = [])
    {
        if (!empty($body)) {
            $body = ['form_params' => $body];
        }
        $response = $this->apiClient->request($method, $path, $body);

        return $response->getBody();
    }

    private function getFromEndpoint($path)
    {
        return $this->callEndpoint($path, 'GET');
    }

    private function postOnEndpoint($path, array $body = [])
    {
        return $this->callEndpoint($path, 'POST', $body);
    }

    /**
     * Gets the list of all machines and/or "points-of-pickup" (POP)
     * The list can be narrowed by passing TRUE as $paymentsEnabledOnly for the list of machines and/or "points-of-pickup"
     * that support payments on the spot for the "cash on delivery" option.
     * Passing TRUE as $machinesOnly will cause the list to be narrowed to show only package machines, excluding
     * "points-of-pickup".
     *
     * @param bool $paymentsEnabledOnly Should the list contain only payment enabled spots
     * @param bool $machinesOnly        Should the list contain only machines, and exclude "points-of-pickup"
     *
     * @throws \Exception If the API returned a bussiness logic error
     *
     * @return array
     */
    public function getMachinesList($paymentsEnabledOnly = false, $machinesOnly = false)
    {
        $path = '?'.http_build_query([
                'do' => 'listmachines_xml',
            ]);
        $responseXml = $this->getFromEndpoint($path);

        return $this->machineFactory->createMachinesList($responseXml);
    }

    public function getNearestMachines($postCode, $limit = 3, $paymentsEnabledOnly = false)
    {
        $path = '?'.http_build_query([
                'do' => 'findnearestmachines',
                'postcode' => $postCode,
                'limit' => $limit,
            ]);
        $responseXml = $this->getFromEndpoint($path);

        return $this->machineFactory->createMachinesList($responseXml);
    }

    /**
     * Registers multiple shipments, without committing the payment for them.
     * Returns associative array of Shipment objects with shipment number and status filled,
     * with shipment's selfId as the array key.
     *
     * @param Shipment[] $shipments
     *
     * @throws \Exception If the API returned a bussiness logic error
     *
     * @return Shipment[]
     */
    public function registerShipments(array $shipments)
    {
        //every shipment's type batch should be registered via a separate API call
        $registeredPackages = $this->registerPackages(
            array_filter($shipments, function ($v) {
                return ($v instanceof Package) && !is_subclass_of($v, '\T3ko\Inpost\Objects\Shipment\Package');
            }, ARRAY_FILTER_USE_BOTH),
            true, false);

        $registeredSelfSentPackages = $this->registerPackages(
            array_filter($shipments, function ($v) {
                return $v instanceof SelfSentPackage;
            }, ARRAY_FILTER_USE_BOTH),
            true, true);

        if (is_array($registeredPackages) && (is_array($registeredSelfSentPackages)) {
            $registeredShipments = array_merge(
                $registeredPackages,
                $registeredSelfSentPackages
            );
        }  elseif (is_array($registeredPackages)) {
            $registeredShipments = $registeredPackages;
        }  elseif {is_array($registeredSelfSentPackages)) {
            $registeredShipments = $registeredSelfSentPackages;
        }  else {
            $registeredShipments = [];
        }    
                   
        return $registeredShipments;
    }

    /**
     * Calls the 'createDevliveryPacks' endpoint for creating/registering packages.
     * Returns an array of packs' numbers and costs following the format below:
     * <pre>
     * Array (
     *      '<package id #1>' => Array (
     *          'packcode' => <package number>
     *          'calculatedcharge' => <package cost>
     *       ),
     *      '<package id #2>' => Array (
     *          'packcode' => <package number>
     *          'calculatedcharge' => <package cost>
     *       ),
     *      '<package id #3>' => Array (
     *          'packcode' => <package number>
     *          'calculatedcharge' => <package cost>
     *       ),
     *      ...
     * )
     * </pre>
     * Every Package object passed to this method should have a unique id (<package id>) set (PackageBuilder::setSelfId())
     * in order for it's package number and cost to be distinguishable on the list after the registering process.
     *
     * @param Package[] $packages     Array of Package objects to register
     * @param bool      $registerOnly TRUE if the packages should be registered only without committing to pay,
     *                                FALSE if the packages should be fully created and ready to send
     * @param bool      $selfSend     TRUE if the packages should be registered as a self-sent packages,
     *                                FALSE if the packages should be registered as a courier-pickup packages
     *
     * @throws \Exception If the API returned a business logic error
     *
     * @return array|bool List of all registered package numbers assigned to package id's or FALSE if there was an error
     */
    private function registerPackages(array $packages, $registerOnly = true, $selfSend = false)
    {
        if (!is_array($packages) || empty($packages)) {
            return false;
        }

        $path = '?'.http_build_query([
                'do' => 'createdeliverypacks',
            ]);

        $requestBody = $this->serializer->serializeCreateDeliveryPacksRequest(!$registerOnly, $selfSend, $packages);

        $body = [
            'email' => $this->apiLogin,
            'password' => $this->apiPassword,
            'content' => $requestBody,
        ];

        $responseXml = $this->postOnEndpoint($path, $body)->getContents();
        if ($this->validateResponse($responseXml)) {
            return $this->serializer->deserializeCreateDeliveryPacksResponse($responseXml);
        }

        return false;
    }

    /**
     * Commits the payment for the package. Deducts the package cost form the account balance.
     *
     * @param string $packageNumber Register package number for which the payment should be processed
     *
     * @throws \Exception If the API returned a business logic error
     *
     * @return bool TRUE if payment process succeeded
     */
    public function confirmShipment($packageNumber)
    {
        $path = '?'.http_build_query([
                'do' => 'payforpack',
            ]);

        $body = [
            'email' => $this->apiLogin,
            'password' => $this->apiPassword,
            'packcode' => $packageNumber,
        ];

        $response = $this->postOnEndpoint($path, $body)->getContents();
        if ($this->validateResponse($response)) {
            return (bool) ($response == '1');
        }

        return false;
    }

    /**
     * Prints the delivery slip for the package.
     *
     * @param string $packageNumber Package number for the delivery slip
     * @param string $size       Printout size. Can be 'self::LABEL_SIZE_A4' for 3 vertical slips on an A4 sheet,
     *                           or 'self::LABEL_SIZE_A6P' for a single A6 sized sheet
     * @param string $fileFormat Format of the file returned. Can be 'self::LABEL_FILE_FORMAT_PDF' for PDF,
     *                           or 'self::LABEL_FILE_FORMAT_EPL2' for Epl2
     *
     * @throws \Exception If the API returned a business logic error
     *
     * @return string
     */
    public function getSticker($packageNumber, $size = self::LABEL_SIZE_A4, $fileFormat = self::LABEL_FILE_FORMAT_PDF)
    {
        $path = '?'.http_build_query([
                'do' => 'getsticker',
            ]);

        $body = [
            'email' => $this->apiLogin,
            'password' => $this->apiPassword,
            'packcode' => $packageNumber,
            'labelType' => $size ?: self::LABEL_SIZE_A4,
            'labelFormat' => $fileFormat ?: self::LABEL_FILE_FORMAT_PDF,
        ];

        $response = $this->postOnEndpoint($path, $body)->getContents();
        if ($this->validateResponse($response)) {
            return $response;
        }
    }
}
