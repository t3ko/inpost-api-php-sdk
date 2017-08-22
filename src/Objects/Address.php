<?php
/**
 * Copyright (c) 2017. Tomasz Konarski.
 */

namespace T3ko\Inpost\Objects;

use JMS\Serializer\Annotation\Type;

class Address
{
    /**
     * @Type("integer")
     *
     * @var int
     */
    private $id;

    /**
     * @Type("string")
     *
     * @var string
     */
    private $street;

    /**
     * @Type("string")
     *
     * @var string
     */
    private $buildingNumber;

    /**
     * @Type("string")
     *
     * @var string
     */
    private $flatNumber;

    /**
     * @Type("string")
     *
     * @var string
     */
    private $postCode;

    /**
     * @Type("string")
     *
     * @var string
     */
    private $city;

    /**
     * @Type("string")
     *
     * @var string
     */
    private $province;

    /**
     * @Type("string")
     *
     * @var string
     */
    private $countryCode;

    /**
     * Address constructor.
     *
     * @param int    $id
     * @param string $street
     * @param string $buildingNumber
     * @param string $flatNumber
     * @param string $postCode
     * @param string $city
     * @param string $province
     * @param string $countryCode
     */
    public function __construct($id, $street, $buildingNumber, $flatNumber, $postCode,
                                $city, $province = null, $countryCode = null)
    {
        $this->id = $id;
        $this->street = $street;
        $this->buildingNumber = $buildingNumber;
        $this->flatNumber = $flatNumber;
        $this->postCode = $postCode;
        $this->city = $city;
        $this->province = $province;
        $this->countryCode = $countryCode;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getBuildingNumber()
    {
        return $this->buildingNumber;
    }

    /**
     * @return string
     */
    public function getFlatNumber()
    {
        return $this->flatNumber;
    }

    /**
     * @return string
     */
    public function getPostCode()
    {
        return $this->postCode;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }
}
