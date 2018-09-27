<?php

namespace Ups\Entity\Pickup;

class ShipmentServiceOptions extends NodeEntity
{
    /**
     * Presence indicates OriginLiftGateRequiredIndicator is present.
     *
     * Conditionally requirements. Must not be present if DropOffAtUPSFacilityIndicator is true
     *
     * @var string
     */
    private $originLiftGateIndicator;

    /**
     * Identifies service center location information for Origin List of UPS Facilities.
     *
     * @var string
     */
    private $dropoffAtUPSFacilityIndicator;

    /**
     * Identifies service center location information for Destination of UPS Facilities.
     *
     * @var string
     */
    private $holdForPickupIndicator;

    /**
     * @return string
     */
    public function getOriginLiftGateIndicator()
    {
        return $this->originLiftGateIndicator;
    }

    /**
     * @param string $originLiftGateIndicator
     *
     * @return ShipmentServiceOptions
     */
    public function setOriginLiftGateIndicator($originLiftGateIndicator)
    {
        $this->originLiftGateIndicator = $originLiftGateIndicator;

        return $this;
    }

    /**
     * @return string
     */
    public function getDropoffAtUPSFacilityIndicator()
    {
        return $this->dropoffAtUPSFacilityIndicator;
    }

    /**
     * @param string $dropoffAtUPSFacilityIndicator
     *
     * @return ShipmentServiceOptions
     */
    public function setDropoffAtUPSFacilityIndicator($dropoffAtUPSFacilityIndicator)
    {
        $this->dropoffAtUPSFacilityIndicator = $dropoffAtUPSFacilityIndicator;

        return $this;
    }

    /**
     * @return string
     */
    public function getHoldForPickupIndicator()
    {
        return $this->holdForPickupIndicator;
    }

    /**
     * @param string $holdForPickupIndicator
     *
     * @return ShipmentServiceOptions
     */
    public function setHoldForPickupIndicator($holdForPickupIndicator)
    {
        $this->holdForPickupIndicator = $holdForPickupIndicator;

        return $this;
    }
}
