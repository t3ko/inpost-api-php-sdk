<?php

namespace T3ko\Inpost\Objects\Shipment;

abstract class ShipmentBuilder
{
    private $selfId;
    private $addresseeEmail;
    private $addresseePhoneNumber;
    private $senderEmail;
    private $status;
    private $number;

    /**
     * ShipmentBuilder constructor.
     *
     * @param string $senderEmail          Sender's email address
     * @param string $addresseeEmail       Addressee's email address
     * @param string $addresseePhoneNumber Addressee's phone number
     */
    public function __construct($senderEmail, $addresseeEmail, $addresseePhoneNumber)
    {
        $this->senderEmail = $senderEmail;
        $this->addresseeEmail = $addresseeEmail;
        $this->addresseePhoneNumber = $addresseePhoneNumber;
    }

    abstract public function build();
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
     * @return ShipmentBuilder
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
     * @return ShipmentBuilder
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
     * @return ShipmentBuilder
     */
    public function setAddresseePhoneNumber($addresseePhoneNumber)
    {
        $this->addresseePhoneNumber = $addresseePhoneNumber;

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
     * @return ShipmentBuilder
     */
    public function setSenderEmail($senderEmail)
    {
        $this->senderEmail = $senderEmail;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     *
     * @return ShipmentBuilder
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     *
     * @return ShipmentBuilder
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }
}
