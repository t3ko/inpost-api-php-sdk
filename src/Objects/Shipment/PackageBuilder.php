<?php

namespace T3ko\Inpost\Objects\Shipment;

class PackageBuilder extends ShipmentBuilder
{
    private $addresseeMachineName;
    private $addresseeAlternativeMachineName;
    private $size;
    private $insuranceAmount;
    private $onDeliveryAmount;
    private $customerRef;

    /**
     * PackageBuilder constructor.
     *
     * @param string $senderEmail          Sender's email address
     * @param string $size                 Inpost package size identifier ('A', 'B' or 'C')
     * @param string $addresseeEmail       Addressee's email address
     * @param string $addresseePhoneNumber Addressee's phone number
     * @param string $addresseeMachineName Target package machine name
     *
     * @see Size
     */
    public function __construct($senderEmail, $size, $addresseeEmail, $addresseePhoneNumber, $addresseeMachineName)
    {
        parent::__construct($senderEmail, $addresseeEmail, $addresseePhoneNumber);
        $this->size = $size;
        $this->addresseeMachineName = $addresseeMachineName;
    }

    /**
     * Builds a Package instance.
     *
     * @return Package
     */
    public function build()
    {
        return new Package($this);
    }

    /**
     * @return mixed
     */
    public function getAddresseeMachineName()
    {
        return $this->addresseeMachineName;
    }

    /**
     * @param mixed $addresseeMachineName
     *
     * @return PackageBuilder
     */
    public function setAddresseeMachineName($addresseeMachineName)
    {
        $this->addresseeMachineName = $addresseeMachineName;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddresseeAlternativeMachineName()
    {
        return $this->addresseeAlternativeMachineName;
    }

    /**
     * @param mixed $addresseeAlternativeMachineName
     *
     * @return PackageBuilder
     */
    public function setAddresseeAlternativeMachineName($addresseeAlternativeMachineName)
    {
        $this->addresseeAlternativeMachineName = $addresseeAlternativeMachineName;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     *
     * @return PackageBuilder
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getInsuranceAmount()
    {
        return $this->insuranceAmount;
    }

    /**
     * @param mixed $insuranceAmount
     *
     * @return PackageBuilder
     */
    public function setInsuranceAmount($insuranceAmount)
    {
        $this->insuranceAmount = $insuranceAmount;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOnDeliveryAmount()
    {
        return $this->onDeliveryAmount;
    }

    /**
     * @param mixed $onDeliveryAmount
     *
     * @return PackageBuilder
     */
    public function setOnDeliveryAmount($onDeliveryAmount)
    {
        $this->onDeliveryAmount = $onDeliveryAmount;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCustomerRef()
    {
        return $this->customerRef;
    }

    /**
     * @param mixed $customerRef
     *
     * @return PackageBuilder
     */
    public function setCustomerRef($customerRef)
    {
        $this->customerRef = $customerRef;

        return $this;
    }
}
