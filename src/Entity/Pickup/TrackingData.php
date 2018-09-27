<?php

namespace Ups\Entity\Pickup;

class TrackingData extends NodeEntity
{
    /**
     * Tracking number for return shipment or forward shipment packages.
     *
     * @var string
     */
    private $trackingNumber;

    /**
     * @param string $trackingNumber
     *
     * @return TrackingData
     */
    public function setTrackingNumber($trackingNumber)
    {
        $this->trackingNumber = $trackingNumber;

        return $this;
    }
}
