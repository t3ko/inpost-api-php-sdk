<?php

namespace T3ko\Inpost\Objects;

class Machine
{
    const TYPE_POK = 'POK';
    const TYPE_PACK_MACHINE = 'Pack Machine';

    const PAYMENT_TYPE_NONE = 0;
    const PAYMENT_TYPE_CASH = 1;
    const PAYMENT_TYPE_CARD = 2;

    private $name;
    private $type;
    private $postcode;
    private $province;
    private $street;
    private $buildingNumber;
    private $town;
    private $latitude;
    private $longitude;
    private $paymentAvailable;
    private $operatingHours;
    private $locationDescription;
    private $paymentPointDescription;
    private $partnerId;
    private $paymentType;

    /**
     * Machine constructor.
     *
     * @param $name
     * @param $type
     * @param $postcode
     * @param $province
     * @param $street
     * @param $buildingNumber
     * @param $town
     * @param $latitude
     * @param $longitude
     * @param $paymentAvailable
     * @param $operatingHours
     * @param $locationDescription
     * @param $paymentPointDescription
     * @param $partnerId
     * @param $paymentType
     */
    public function __construct($name, $type, $postcode, $province, $street, $buildingNumber, $town, $latitude, $longitude, $paymentAvailable, $operatingHours, $locationDescription, $paymentPointDescription, $partnerId, $paymentType)
    {
        $this->name = $name;
        $this->type = $type;
        $this->postcode = $postcode;
        $this->province = $province;
        $this->street = $street;
        $this->buildingNumber = $buildingNumber;
        $this->town = $town;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->paymentAvailable = $paymentAvailable;
        $this->operatingHours = $operatingHours;
        $this->locationDescription = $locationDescription;
        $this->paymentPointDescription = $paymentPointDescription;
        $this->partnerId = $partnerId;
        $this->paymentType = $paymentType;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
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
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * @return mixed
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @return mixed
     */
    public function getBuildingNumber()
    {
        return $this->buildingNumber;
    }

    /**
     * @return mixed
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @return bool
     */
    public function isPaymentAvailable()
    {
        return $this->paymentAvailable;
    }

    /**
     * @return mixed
     */
    public function getOperatingHours()
    {
        return $this->operatingHours;
    }

    /**
     * @return mixed
     */
    public function getLocationDescription()
    {
        return $this->locationDescription;
    }

    /**
     * @return mixed
     */
    public function getPaymentPointDescription()
    {
        return $this->paymentPointDescription;
    }

    /**
     * @return mixed
     */
    public function getPartnerId()
    {
        return $this->partnerId;
    }

    /**
     * @return mixed
     */
    public function getPaymentType()
    {
        return $this->paymentType;
    }
}
