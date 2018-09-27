<?php

namespace Ups\Entity\Pickup;

class FreightOptions extends NodeEntity
{
    /**
     * Supports various optional indicators
     *
     * @var ShipmentServiceOptions
     */
    private $shipmentServiceOptions;

    /**
     * Origin SLIC. This will be obtained from submitting a pickup service center request.
     * See PickupGetFacilitiesServiceCenterRequest.
     *
     * @var string
     */
    private $originServiceCenterCode;

    /**
     * Country or territory of Service Center SLIC chosen to drop off.
     *
     * @var string
     */
    private $originServiceCountryCode;

    /**
     * Destination Address Container.
     *
     * @var DestinationAddress
     */
    private $destinationAddress;

    /**
     * Refers to the ShipmentDetail Container under Freight Options
     *
     * @var ShipmentDetail
     */
    private $shipmentDetail;

    /**
     * @param ShipmentDetail $shipmentDetail
     */
    public function __construct(ShipmentDetail $shipmentDetail)
    {
        $this->shipmentDetail = $shipmentDetail;
    }

    /**
     * @return ShipmentServiceOptions
     */
    public function getShipmentServiceOptions()
    {
        return $this->shipmentServiceOptions;
    }

    /**
     * @param ShipmentServiceOptions $shipmentServiceOptions
     *
     * @return FreightOptions
     */
    public function setShipmentServiceOptions($shipmentServiceOptions)
    {
        $this->shipmentServiceOptions = $shipmentServiceOptions;

        return $this;
    }

    /**
     * @return string
     */
    public function getOriginServiceCenterCode()
    {
        return $this->originServiceCenterCode;
    }

    /**
     * @param string $originServiceCenterCode
     *
     * @return FreightOptions
     */
    public function setOriginServiceCenterCode($originServiceCenterCode)
    {
        $this->originServiceCenterCode = $originServiceCenterCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getOriginServiceCountryCode()
    {
        return $this->originServiceCountryCode;
    }

    /**
     * @param string $originServiceCountryCode
     *
     * @return FreightOptions
     */
    public function setOriginServiceCountryCode($originServiceCountryCode)
    {
        $this->originServiceCountryCode = $originServiceCountryCode;

        return $this;
    }

    /**
     * @return DestinationAddress
     */
    public function getDestinationAddress()
    {
        return $this->destinationAddress;
    }

    /**
     * @param DestinationAddress $destinationAddress
     *
     * @return FreightOptions
     */
    public function setDestinationAddress($destinationAddress)
    {
        $this->destinationAddress = $destinationAddress;

        return $this;
    }

    /**
     * @return ShipmentDetail
     */
    public function getShipmentDetail()
    {
        return $this->shipmentDetail;
    }
}
