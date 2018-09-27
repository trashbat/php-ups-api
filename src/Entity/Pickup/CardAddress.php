<?php

namespace Ups\Entity\Pickup;

class CardAddress extends NodeEntity
{
    /**
     * Address Lines of the credit card billing address.
     *
     * Max of three address lines can be provided.
     *
     * @var array
     */
    private $addressLine = [];

    /**
     * Charge card billing city
     *
     * @var string
     */
    private $city;

    /**
     * Charge card billing State province code
     *
     * @var string
     */
    private $stateProvince;

    /**
     * Charge card billing address postal code.
     *
     * This is a required field for postal countries or territories.
     *
     * @var string
     */
    private $postalCode;

    /**
     * Charge card billing address country or territory code defined by ISO-3166.
     *
     * Upper-case two letter string. For Discover card it should be US.
     *
     * @var string
     */
    private $countryCode;

    /**
     * @return array
     */
    public function getAddressLine()
    {
        return $this->addressLine;
    }

    /**
     * @param array $addressLine
     *
     * @return CardAddress
     */
    public function setAddressLine(array $addressLine)
    {
        $this->addressLine = $addressLine;

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
     * @param string $city
     *
     * @return CardAddress
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
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
     * @return CardAddress
     */
    public function setStateProvince($stateProvince)
    {
        $this->stateProvince = $stateProvince;

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
     * @return CardAddress
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
     * @param string $countryCode
     *
     * @return CardAddress
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;

        return $this;
    }
}
