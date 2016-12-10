<?php

namespace T3ko\Inpost\Objects;

class PackageBuilder
{
    private $selfId;
    private $addresseeEmail;
    private $addresseePhoneNumber;
    private $addresseeMachineName;
    private $addresseeAlternativeMachineName;
    private $senderEmail;
    private $type;
    private $insuranceAmount;
    private $onDeliveryAmount;
    private $customerRef;

    /**
     * PackageBuilder constructor.
     *
     * @param string $senderEmail          Sender's email address
     * @param string $packageType          Inpost package type ('A', 'B' or 'C')
     * @param string $addresseeEmail       Addressee's email address
     * @param string $addresseePhoneNumber Addressee's phone number
     * @param string $addresseeMachineName Target package machine name
     */
    public function __construct($senderEmail, $packageType, $addresseeEmail, $addresseePhoneNumber, $addresseeMachineName)
    {
        $this->senderEmail = $senderEmail;
        $this->type = $packageType;
        $this->addresseeEmail = $addresseeEmail;
        $this->addresseePhoneNumber = $addresseePhoneNumber;
        $this->addresseeMachineName = $addresseeMachineName;
    }

    /**
     * @return mixed
     */
    public function getSelfId()
    {
        return $this->selfId;
    }

    /**
     * @param mixed $selfId
     *
     * @return PackageBuilder
     */
    public function setSelfId($selfId)
    {
        $this->selfId = $selfId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddresseeEmail()
    {
        return $this->addresseeEmail;
    }

    /**
     * @param mixed $addresseeEmail
     *
     * @return PackageBuilder
     */
    public function setAddresseeEmail($addresseeEmail)
    {
        $this->addresseeEmail = $addresseeEmail;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddresseePhoneNumber()
    {
        return $this->addresseePhoneNumber;
    }

    /**
     * @param mixed $addresseePhoneNumber
     *
     * @return PackageBuilder
     */
    public function setAddresseePhoneNumber($addresseePhoneNumber)
    {
        $this->addresseePhoneNumber = $addresseePhoneNumber;

        return $this;
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
    public function getSenderEmail()
    {
        return $this->senderEmail;
    }

    /**
     * @param mixed $senderEmail
     *
     * @return PackageBuilder
     */
    public function setSenderEmail($senderEmail)
    {
        $this->senderEmail = $senderEmail;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     *
     * @return PackageBuilder
     */
    public function setType($type)
    {
        $this->type = $type;

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
