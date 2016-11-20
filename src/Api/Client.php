<?php

namespace T3ko\Paczkomaty\Api;

use T3ko\Paczkomaty\Objects\MachineFactory;
use T3ko\Paczkomaty\Objects\Package;

class Client
{
    const PRODUCTION_API_ENDPOINT = 'https://api.paczkomaty.pl';
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

    public function __construct($apiLogin, $apiPassword, $apiEndpoint = self::PRODUCTION_API_ENDPOINT)
    {
        $this->apiLogin = $apiLogin;
        $this->apiPassword = $apiPassword;

        $this->apiClient = new \GuzzleHttp\Client([
            'base_uri' => $apiEndpoint,
        ]);

        $this->machineFactory = new MachineFactory();
        $this->serializer = new Serializer();
    }

    private function validateResponse($xml)
    {
        if (false !== $result = $this->serializer->deserializeErrors($xml)) {
            throw new \Exception(sprintf("%s: %s", $result['code'], $result['description']));
        }
        return true;
    }

    private function callEndpoint($path, $method, $body = [])
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

    public function registerPackage(Package $package)
    {
        $response = $this->registerPackages([$package]);
        if (is_array($response)) {
            return array_shift($response);
        }
        return $response;
    }

    public function registerPackages(array $packages)
    {
        $path = '?'.http_build_query([
                'do' => 'createdeliverypacks',
            ]);

        $requestBody = $this->serializer->serializeCreateDeliveryPacksRequest(false, false, $packages);

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

    public function payForPack($packageNumber)
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
            return (bool)($response == '1');
        }
        return false;
    }

    public function getSticker($packageNumber, $size = null, $fileFormat = null)
    {
        $path = '?'.http_build_query([
                'do' => 'getsticker',
            ]);

        $body = [
            'email' => $this->apiLogin,
            'password' => $this->apiPassword,
            'packcode' => $packageNumber,
            'labelType' => $size ? $size : self::LABEL_SIZE_A4,
            'labelFormat' => $fileFormat ? $fileFormat : self::LABEL_FILE_FORMAT_PDF
        ];

        $response = $this->postOnEndpoint($path, $body)->getContents();
        if ($this->validateResponse($response)) {
            return $response;
        }
    }
}
