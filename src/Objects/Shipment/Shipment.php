<?php

namespace T3ko\Inpost\Objects\Shipment;

abstract class Shipment
{
    private $selfId;
    private $addresseeEmail;
    private $addresseePhoneNumber;
    private $senderEmail;
    private $status;
    private $number;

    /**
     * Shipment constructor.
     *
     * @param ShipmentBuilder $builder
     */
    public function __construct(ShipmentBuilder $builder)
    {
        $this->selfId = $builder->getSelfId() ?: uniqid($builder->getAddresseePhoneNumber(), true);
        $this->addresseeEmail = $builder->getAddresseeEmail();
        $this->addresseePhoneNumber = $builder->getAddresseePhoneNumber();
        $this->senderEmail = $builder->getSenderEmail();
        $this->status = $builder->getStatus();
        $this->number = $builder->getNumber();
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
    public function getSenderEmail()
    {
        return $this->senderEmail;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }
}
