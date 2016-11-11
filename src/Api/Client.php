<?php

namespace T3ko\Paczkomaty\Api;

use T3ko\Paczkomaty\Objects\Factory as ObjectFactory;

class Client
{
    const PRODUCTION_API_ENDPOINT = 'https://api.paczkomaty.pl';
    const SANDBOX_API_ENDPOINT = 'https://sandbox-api.paczkomaty.pl';

    private $apiLogin;
    private $apiPassword;
    private $apiClient;
    private $objectFactory;

    public function __construct($apiLogin, $apiPassword, $apiEndpoint = self::PRODUCTION_API_ENDPOINT)
    {
        $this->apiLogin = $apiLogin;
        $this->apiPassword = $apiPassword;

        $this->apiClient = new \GuzzleHttp\Client([
            'base_uri' => $apiEndpoint
        ]);

        $this->objectFactory = new ObjectFactory();
    }

    private function callEndpoint($path, $method, $body = [])
    {
        $response = $this->apiClient->request($method, $path, $body);
        return $response->getBody();
    }

    private function getOnEndpoint($path)
    {
        return $this->callEndpoint($path, 'GET');
    }

    public function getMachinesList($paymentsEnabledOnly = false, $machinesOnly = false)
    {
        $path = '?'.http_build_query([
            'do' => 'listmachines_xml'
        ]);
        $responseXml = $this->getOnEndpoint($path);
        return $this->objectFactory->createMachinesList($responseXml);
    }
}
