<?php

namespace Ups\Entity\Pickup;

class PickupAddress extends NodeEntity
{
    /**
     * Company name
     *
     * @var string
     */
    private $companyName;

    /**
     * Name of contact person
     *
     * @var string
     */
    private $contactName;

    /**
     * Detailed street address. For Jan. 2010 release, only one AddressLine is allowed
     *
     * @var string
     */
    private $addressLine;

    /**
     * Room number
     *
     * @var string
     */
    private $room;

    /**
     * Floor number
     *
     * @var string
     */
    private $floor;

    /**
     * City or equivalent
     *
     * @var string
     */
    private $city;

    /**
     * State or province for postal countries or territories; county for Ireland (IE) and district code for Hong Kong
     * (HK)
     *
     * @var string
     */
    private $stateProvince;

    /**
     * Barrio for Mexico (MX)
     * Urbanization for Puerto Rico (PR)
     * Shire for United Kingdom (UK)
     *
     * @var string
     */
    private $urbanization;

    /**
     * Postal code or equivalent for postal countries or territories.
     *
     * @var string
     */
    private $postalCode;

    /**
     * The pickup country or territory code as defined by ISO-3166.
     * Refer to Country or Territory Codes in the Appendix for valid values.
     *
     * @var string
     */
    private $countryCode;

    /**
     * Indicates if the pickup address is commercial or residential.
     * Valid values:
     * Y = Residential address
     * N = Non-residential (Commercial) address (default)
     *
     * @var bool
     */
    private $residentialIndicator;

    /**
     * The specific spot to pickup at the address.
     *
     * @var string
     */
    private $pickupPoint;

    /**
     * Contact telephone number.
     *
     * @var Phone
     */
    private $phone;

    /**
     * @param string $companyName
     * @param string $contactName
     * @param string $addressLine
     * @param string $city
     * @param string $countryCode
     * @param Phone $phone
     * @param bool $residentialIndicator
     */
    public function __construct(
        $companyName,
        $contactName,
        $addressLine,
        $city,
        $countryCode,
        Phone $phone,
        $residentialIndicator = false
    ) {
        $this->companyName = $companyName;
        $this->contactName = $contactName;
        $this->addressLine = $addressLine;
        $this->city = $city;
        $this->countryCode = $countryCode;
        $this->residentialIndicator = $residentialIndicator;
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @return string
     */
    public function getContactName()
    {
        return $this->contactName;
    }

    /**
     * @return string
     */
    public function getAddressLine()
    {
        return $this->addressLine;
    }

    /**
     * @return string
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * @param string $room
     *
     * @return PickupAddress
     */
    public function setRoom($room)
    {
        $this->room = $room;

        return $this;
    }

    /**
     * @return string
     */
    public function getFloor()
    {
        return $this->floor;
    }

    /**
     * @param string $floor
     *
     * @return PickupAddress
     */
    public function setFloor($floor)
    {
        $this->floor = $floor;

        return $this;
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
    public function getStateProvince()
    {
        return $this->stateProvince;
    }

    /**
     * @param string $stateProvince
     *
     * @return PickupAddress
     */
    public function setStateProvince($stateProvince)
    {
        $this->stateProvince = $stateProvince;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrbanization()
    {
        return $this->urbanization;
    }

    /**
     * @param string $urbanization
     *
     * @return PickupAddress
     */
    public function setUrbanization($urbanization)
    {
        $this->urbanization = $urbanization;

        return $this;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     *
     * @return PickupAddress
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @return bool
     */
    public function getResidentialIndicator()
    {
        return $this->residentialIndicator;
    }

    /**
     * @return string
     */
    public function getPickupPoint()
    {
        return $this->pickupPoint;
    }

    /**
     * @param string $pickupPoint
     *
     * @return PickupAddress
     */
    public function setPickupPoint($pickupPoint)
    {
        $this->pickupPoint = $pickupPoint;

        return $this;
    }

    /**
     * @return Phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

}
