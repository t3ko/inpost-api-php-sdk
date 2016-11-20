<?php

namespace T3ko\Paczkomaty\Api;

use Sabre\Xml\Service;
use T3ko\Paczkomaty\Api\SerializationAdapters\Package as PackageAdapter;

class Serializer
{
    private $xmlService;

    public function __construct()
    {
        $this->xmlService = new Service();
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
                    'value' => new PackageAdapter($package)
                ];
            }
        }
        return $this->xmlService->write('paczkomaty', $request);
    }
}
