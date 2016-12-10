<?php

namespace T3ko\Inpost\Api;

use Sabre\Xml\ParseException;
use Sabre\Xml\Reader;
use Sabre\Xml\Service;
use T3ko\Inpost\Api\SerializationAdapters\Package as PackageAdapter;

class Serializer
{
    private $xmlService;

    public function __construct()
    {
        $this->xmlService = new Service();
    }

    public function deserializeErrors($xml)
    {
        try {
            $response = $this->xmlService->parse($xml);
            $possibleError = array_shift($response);
            if ($possibleError['name'] == '{}error') {
                return [
                    'code' => $possibleError['attributes']['key'],
                    'description' => $possibleError['value'],
                ];
            }
        } catch (ParseException $e) {
            return false;
        }

        return false;
    }

    public function serializeCreateDeliveryPacksRequest($autoLabels, $selfSend, array $packages)
    {
        $request = [
            'autoLabels' => $autoLabels ? '1' : '0',
            'selfSend' => $selfSend ? '1' : '0',
        ];
        if (!empty($packages)) {
            foreach ($packages as $package) {
                $request[] = [
                    'name' => 'pack',
                    'value' => new PackageAdapter($package),
                ];
            }
        }

        return $this->xmlService->write('paczkomaty', $request);
    }

    public function deserializeCreateDeliveryPacksResponse($xml)
    {
        $this->xmlService->elementMap = [
            '{}pack' => function (Reader $reader) {
                return \Sabre\Xml\Deserializer\keyValue($reader, '');
            },
            '{}paczkomaty' => function (Reader $reader) {
                return \Sabre\Xml\Deserializer\repeatingElements($reader, '{}pack');
            },
        ];
        $response = $this->xmlService->parse($xml);
        $this->xmlService->elementMap = [];
        $packageCodes = [];
        if (!empty($response)) {
            foreach ($response as $pack) {
                $packageCodes[$pack['id']] = [
                    'packcode' => $pack['packcode'],
                    'calculatedcharge' => $pack['calculatedcharge'],
                    ];
            }
        }

        return $packageCodes;
    }
}
