<?php

namespace T3ko\Paczkomaty\Objects;

use Sabre\Xml\Reader;
use Sabre\Xml\Service;

class MachineFactory
{

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
            array_key_exists('type', $properties) ? $properties['type'] : Machine::TYPE_PACK_MACHINE,
            array_key_exists('postcode', $properties) ? $properties['postcode'] : '',
            array_key_exists('province', $properties) ? $properties['province'] : '',
            array_key_exists('street', $properties) ? $properties['street'] : '',
            array_key_exists('buildingnumber', $properties) ? $properties['buildingnumber'] : '',
            array_key_exists('town', $properties) ? $properties['town'] : '',
            array_key_exists('latitude', $properties) ? $properties['latitude'] : '',
            array_key_exists('longitude', $properties) ? $properties['longitude'] : '',
            array_key_exists('paymentavailable', $properties) ? strcasecmp($properties['paymentavailable'],'t')==0 : false,
            array_key_exists('operatinghours', $properties) ? $properties['operatinghours'] : '',
            array_key_exists('locationdescription', $properties) ? $properties['locationdescription'] : '',
            array_key_exists('paymentpointdescription', $properties) ? $properties['paymentpointdescription'] : '',
            array_key_exists('partnerid', $properties) ? $properties['partnerid'] : '',
            array_key_exists('paymenttype', $properties) ? $properties['paymenttype'] : ''
        );
    }

}
