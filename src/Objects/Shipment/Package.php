<?php

namespace T3ko\Inpost\Objects\Shipment;

/**
 * Class Package.
 *
 * Represents a 'Paczkomaty' parcel sent to a machine or a POP, picked up by a courier.
 */
class Package extends Shipment
{
    private $addresseeMachineName;
    private $addresseeAlternativeMachineName;
    private $size;
    private $insuranceAmount;
    private $onDeliveryAmount;
    private $customerRef;

    /**
     * Package constructor.
     *
     * @param PackageBuilder $builder
     */
    public function __construct(PackageBuilder $builder)
    {
        parent::__construct($builder);
        $this->addresseeMachineName = $builder->getAddresseeMachineName();
        $this->addresseeAlternativeMachineName = $builder->getAddresseeAlternativeMachineName();
        $this->size = $builder->getSize();
        $this->insuranceAmount = $builder->getInsuranceAmount();
        $this->onDeliveryAmount = $builder->getOnDeliveryAmount();
        $this->customerRef = $builder->getCustomerRef();
    }

    /**
     * Returns target package machine name.
     *
     * @return mixed
     */
    public function getAddresseeMachineName()
    {
        return $this->addresseeMachineName;
    }

    /**
     * Returns alternative target package machine name if set. NULL otherwise.
     *
     * @return mixed
     */
    public function getAddresseeAlternativeMachineName()
    {
        return $this->addresseeAlternativeMachineName;
    }

    /**
     * Returns package's insurance amount, if any. NULL otherwise.
     *
     * @return mixed
     */
    public function getInsuranceAmount()
    {
        return $this->insuranceAmount;
    }

    /**
     * Returns cash amount for the COD request associated with the package. NULL if the package is not COD.
     *
     * @return mixed
     */
    public function getOnDeliveryAmount()
    {
        return $this->onDeliveryAmount;
    }

    /**
     * Returns additional custom string to be printed on the delivery slip, if any. NULL otherwise.
     *
     * @return mixed
     */
    public function getCustomerRef()
    {
        return $this->customerRef;
    }

    /**
     * Returns package size identifier.
     *
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

}
