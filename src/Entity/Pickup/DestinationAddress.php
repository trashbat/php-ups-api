<?php

namespace Ups\Entity\Pickup;

class DestinationAddress extends NodeEntity
{
    /**
     * The city of pickup address if available.
     *
     * It is required for non-postal country Ireland (IE).
     *
     * @var string
     */
    private $city;

    /**
     * 1. It means district code for Hong Kong (HK)
     * 2. It means county for Ireland (IE)
     * 3. It means state or province for all the postal countries or territories.
     *
     * It is required for non-postal countries or territories including HK and IE.
     *
     * @var string
     */
    private $stateProvince;

    /**
     * Postal Code for postal countries or territories.
     *
     * It does not apply to non-postal countries or territories such as IE and HK
     *
     * @var string
     */
    private $postalCode;

    /**
     * The pickup country or territory code as defined by ISO-3166.
     * Refer to Country or Territory Codes in the Appendix for valid values.
     *
     * Upper-case two-letter string.
     *
     * @var string
     */
    private $countryCode;

    /**
     * @param string $countryCode
     */
    public function __construct($countryCode)
    {
        $this->countryCode = $countryCode;
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
     * @return DestinationAddress
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
     * @return DestinationAddress
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
     * @return DestinationAddress
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
}
