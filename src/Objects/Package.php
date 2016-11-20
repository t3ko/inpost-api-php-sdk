<?php

namespace T3ko\Inpost\Objects;

class Package
{
    const TYPE_A = 'A';
    const TYPE_B = 'B';
    const TYPE_C = 'C';

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
     * Package constructor.
     * @param PackageBuilder
     */
    public function __construct(PackageBuilder $builder)
    {
        $this->selfId = $builder->getSelfId();
        $this->addresseeEmail = $builder->getAddresseeEmail();
        $this->addresseePhoneNumber = $builder->getAddresseePhoneNumber();
        $this->addresseeMachineName = $builder->getAddresseeMachineName();
        $this->addresseeAlternativeMachineName = $builder->getAddresseeAlternativeMachineName();
        $this->senderEmail = $builder->getSenderEmail();
        $this->type = $builder->getType();
        $this->insuranceAmount = $builder->getInsuranceAmount();
        $this->onDeliveryAmount = $builder->getOnDeliveryAmount();
        $this->customerRef = $builder->getCustomerRef();
    }

    /**
     * @return mixed
     */
    public function getSelfId()
    {
        return $this->selfId;
    }

    /**
     * @return mixed
     */
    public function getAddresseeEmail()
    {
        return $this->addresseeEmail;
    }

    /**
     * @return mixed
     */
    public function getAddresseePhoneNumber()
    {
        return $this->addresseePhoneNumber;
    }

    /**
     * @return mixed
     */
    public function getAddresseeMachineName()
    {
        return $this->addresseeMachineName;
    }

    /**
     * @return mixed
     */
    public function getAddresseeAlternativeMachineName()
    {
        return $this->addresseeAlternativeMachineName;
    }

    /**
     * @return mixed
     */
    public function getSenderEmail()
    {
        return $this->senderEmail;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getInsuranceAmount()
    {
        return $this->insuranceAmount;
    }

    /**
     * @return mixed
     */
    public function getOnDeliveryAmount()
    {
        return $this->onDeliveryAmount;
    }

    /**
     * @return mixed
     */
    public function getCustomerRef()
    {
        return $this->customerRef;
    }



}
