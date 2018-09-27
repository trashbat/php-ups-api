<?php

namespace Ups\Entity\Pickup;

class TrackingDataWithReferenceNumber extends NodeEntity
{
    /**
     * @var string
     */
    private $trackingNumber;

    /**
     * @var string
     */
    private $referenceNumber;

    /**
     * @param string $trackingNumber
     */
    public function __construct($trackingNumber)
    {
        $this->trackingNumber = $trackingNumber;
    }

    /**
     * @return string
     */
    public function getTrackingNumber()
    {
        return $this->trackingNumber;
    }

    /**
     * @return string
     */
    public function getReferenceNumber()
    {
        return $this->referenceNumber;
    }

    /**
     * @param string $referenceNumber
     *
     * @return TrackingDataWithReferenceNumber
     */
    public function setReferenceNumber($referenceNumber)
    {
        $this->referenceNumber = $referenceNumber;

        return $this;
    }
}
