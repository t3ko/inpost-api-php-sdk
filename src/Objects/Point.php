<?php
/**
 * Copyright (c) 2017. Tomasz Konarski.
 */

namespace T3ko\Inpost\Objects;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

class Point
{
    /**
     * @Type("string")
     *
     * @var string
     */
    private $name;

    /**
     * @Type("array<string>")
     * @SerializedName("type")
     *
     * @var string[]
     */
    private $types;

    /**
     * @Type("string")
     *
     * @var string
     */
    private $status;

    /**
     * @Type("array<string>")
     *
     * @var string[]
     */
    private $services;

    /**
     * @Type("array<string, float>")
     * @SerializedName("location")
     *
     * @var array
     */
    private $locationCoordinates;

    /**
     * @Type("string")
     *
     * @var string
     */
    private $locationType;

    /**
     * @Type("string")
     *
     * @var string
     */
    private $locationDescription;

    /**
     * @Type("string")
     * @SerializedName("location_description_1")
     *
     * @var string
     */
    private $locationDescription1;

    /**
     * @Type("string")
     * @SerializedName("location_description_2")
     *
     * @var string
     */
    private $locationDescription2;

    /**
     * @Type("string")
     *
     * @var string
     */
    private $openingHours;

    /**
     * @Type("array<string, string>")
     *
     * @var array
     */
    private $address;

    /**
     * @Type("T3ko\Inpost\Objects\Address")
     *
     * @var Address
     */
    private $addressDetails;

    /**
     * @Type("string")
     *
     * @var string
     */
    private $phoneNumber;

    /**
     * @Type("string")
     * @SerializedName("payment_point_descr")
     *
     * @var string
     */
    private $paymentPointDescription;

    /**
     * @Type("array<string>")
     *
     * @var string[]
     */
    private $functions;

    /**
     * @Type("int")
     *
     * @var int
     */
    private $partnerId;

    /**
     * @Type("boolean")
     *
     * @var bool
     */
    private $isNext;

    /**
     * @Type("boolean")
     * @SerializedName("payment_available")
     *
     * @var bool
     */
    private $isPaymentAvailable;

    /**
     * @Type("array<integer, string>")
     *
     * @var array
     */
    private $paymentType;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string[]
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * @return float
     */
    public function getLocationLatitude()
    {
        if (isset($this->locationCoordinates['latitude'])) {
            return $this->locationCoordinates['latitude'];
        }
    }

    /**
     * @return float
     */
    public function getLocationLongitude()
    {
        if (isset($this->locationCoordinates['longitude'])) {
            return $this->locationCoordinates['longitude'];
        }
    }

    /**
     * @return string
     */
    public function getLocationType()
    {
        return $this->locationType;
    }

    /**
     * @return string
     */
    public function getLocationDescription()
    {
        return $this->locationDescription;
    }

    /**
     * @return string
     */
    public function getLocationDescription1()
    {
        return $this->locationDescription1;
    }

    /**
     * @return string
     */
    public function getLocationDescription2()
    {
        return $this->locationDescription2;
    }

    /**
     * @return string
     */
    public function getOpeningHours()
    {
        return $this->openingHours;
    }

    /**
     * @return string
     */
    public function getAddressLine1()
    {
        if (isset($this->address['line1'])) {
            return $this->address['line1'];
        }
    }

    /**
     * @return string
     */
    public function getAddressLine2()
    {
        if (isset($this->address['line2'])) {
            return $this->address['line2'];
        }
    }

    /**
     * @return Address
     */
    public function getAddressDetails()
    {
        return $this->addressDetails;
    }

    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @return string
     */
    public function getPaymentPointDescription()
    {
        return $this->paymentPointDescription;
    }

    /**
     * @return string[]
     */
    public function getFunctions()
    {
        return $this->functions;
    }

    /**
     * @return int
     */
    public function getPartnerId()
    {
        return $this->partnerId;
    }

    /**
     * @return bool
     */
    public function isNext()
    {
        return $this->isNext;
    }

    /**
     * @return bool
     */
    public function isPaymentAvailable()
    {
        return $this->isPaymentAvailable;
    }

    /**
     * @return int
     */
    public function getPaymentType()
    {
        reset($this->paymentType);
        list($type, ) = each($this->paymentType);
        return $type;
    }
}
