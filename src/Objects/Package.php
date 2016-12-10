<?php

namespace T3ko\Inpost\Objects;

class Package
{
    /**
     *  Inpost package type 'A'
     */
    const TYPE_A = 'A';
    /**
     *  Inpost package type 'B'
     */
    const TYPE_B = 'B';
    /**
     *  Inpost package type 'C'
     */
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
     *
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
     * Returns custom internal package ID
     * @return mixed
     */
    public function getSelfId()
    {
        return $this->selfId;
    }

    /**
     * Returns addressee's email address
     * @return mixed
     */
    public function getAddresseeEmail()
    {
        return $this->addresseeEmail;
    }

    /**
     * Returns addressee's phone number
     * @return mixed
     */
    public function getAddresseePhoneNumber()
    {
        return $this->addresseePhoneNumber;
    }

    /**
     * Returns target package machine name
     * @return mixed
     */
    public function getAddresseeMachineName()
    {
        return $this->addresseeMachineName;
    }

    /**
     * Returns alternative target package machine name if set. NULL otherwise.
     * @return mixed
     */
    public function getAddresseeAlternativeMachineName()
    {
        return $this->addresseeAlternativeMachineName;
    }

    /**
     * Returns sender's email
     * @return mixed
     */
    public function getSenderEmail()
    {
        return $this->senderEmail;
    }

    /**
     * Returns Inpost package type identifier ('A', 'B' or 'C')
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Returns package's insurance amount, if any. NULL otherwise.
     * @return mixed
     */
    public function getInsuranceAmount()
    {
        return $this->insuranceAmount;
    }

    /**
     * Returns cash amount for the COD request associated with the package. NULL if the package is not COD.
     * @return mixed
     */
    public function getOnDeliveryAmount()
    {
        return $this->onDeliveryAmount;
    }

    /**
     * Returns additional custom string to be printed on the delivery slip, if any. NULL otherwise.
     * @return mixed
     */
    public function getCustomerRef()
    {
        return $this->customerRef;
    }
}
