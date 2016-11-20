<?php

namespace T3ko\Inpost\Api\SerializationAdapters;

use Sabre\Xml\XmlSerializable;

class Package implements XmlSerializable
{
    private $package;

    /**
     * Package constructor.
     * @param \T3ko\Inpost\Objects\Package $package
     */
    public function __construct(\T3ko\Inpost\Objects\Package $package)
    {
        $this->package = $package;
    }

    function xmlSerialize(\Sabre\Xml\Writer $writer)
    {
        return $writer->write([
            'id' => $this->package->getSelfId(),
            'addresseeEmail' => $this->package->getAddresseeEmail(),
            'senderEmail' => $this->package->getSenderEmail(),
            'phoneNum' => $this->package->getAddresseePhoneNumber(),
            'boxMachineName' => $this->package->getAddresseeMachineName(),
            'alternativeBoxMachineName' => $this->package->getAddresseeAlternativeMachineName(),
            'packType' => $this->package->getType(),
            'insuranceAmount' => $this->package->getInsuranceAmount(),
            'onDeliveryAmount' => $this->package->getOnDeliveryAmount(),
            'customerRef' => $this->package->getCustomerRef(),

        ]);
    }

}