<?php

namespace T3ko\Paczkomaty\Api;

use T3ko\Paczkomaty\Objects\MachineFactory;
use T3ko\Paczkomaty\Objects\Package;

class Client
{
    const PRODUCTION_API_ENDPOINT = 'https://api.paczkomaty.pl';
    const SANDBOX_API_ENDPOINT = 'https://sandbox-api.paczkomaty.pl';

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
        die($responseXml);

        return $this->machineFactory->createMachinesList($responseXml);
    }

    public function registerPackage(Package $package)
    {
        return $this->registerPackages([$package]);
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

        return $responseXml = $this->postOnEndpoint($path, $body);
    }
}
