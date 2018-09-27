<?php

namespace Ups\Entity\Pickup;

class PickupPiece extends NodeEntity
{
    /**
     * @var string
     */
    private $serviceCode;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var string
     */
    private $destinationCountryCode;

    /**
     * @var string
     */
    private $containerCode;

    /**
     * @param string $serviceCode
     * @param int $quantity
     * @param string $destinationCountryCode
     * @param string $containerCode
     */
    public function __construct($serviceCode, $quantity, $destinationCountryCode, $containerCode)
    {
        $this->serviceCode = $serviceCode;
        $this->quantity = $quantity;
        $this->destinationCountryCode = $destinationCountryCode;
        $this->containerCode = $containerCode;
    }

    /**
     * @return string
     */
    public function getServiceCode()
    {
        return $this->serviceCode;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return string
     */
    public function getDestinationCountryCode()
    {
        return $this->destinationCountryCode;
    }

    /**
     * @return string
     */
    public function getContainerCode()
    {
        return $this->containerCode;
    }
}
