<?php

namespace T3ko\Paczkomaty\Objects;

use Sabre\Xml\Reader;
use Sabre\Xml\Service;

class Factory
{
    private $xmlParser;

    public function __construct()
    {
        $this->xmlParser = new Service();
    }

    public function createMachinesList($xml)
    {
        $this->xmlParser->elementMap = [
            '{}machine' => function (Reader $reader) {
                return \Sabre\Xml\Deserializer\keyValue($reader, '');
            },
            '{}paczkomaty' => function (Reader $reader) {
                return \Sabre\Xml\Deserializer\repeatingElements($reader, '{}machine');
            },
        ];
        $machines = [];
        foreach ($this->xmlParser->parse($xml) as $machine) {
            $machines[] = $this->createMachineFromArray($machine);
        }

        return $machines;
    }

    private function createMachineFromArray(array $properties)
    {
        return new Machine(
            $properties['name'],
            $properties['type'],
            $properties['postcode'],
            $properties['province'],
            $properties['street'],
            $properties['buildingnumber'],
            $properties['town'],
            $properties['latitude'],
            $properties['longitude'],
            $properties['paymentavailable'] == 't',
            $properties['operatinghours'],
            $properties['locationdescription'],
            $properties['paymentpointdescription'],
            $properties['partnerid'],
            $properties['paymenttype']
        );
    }

}
