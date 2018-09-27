<?php

namespace Ups\Entity\Pickup;

class ShipmentDetail extends NodeEntity
{
    /**
     * Indicates hazardous materials
     *
     * @var string
     */
    private $hazmatIndicator;

    /**
     * Pallet Details.
     *
     * @var PalletInformation
     */
    private $palletInformation;

    /**
     * @return string
     */
    public function getHazmatIndicator()
    {
        return $this->hazmatIndicator;
    }

    /**
     * @param string $hazmatIndicator
     *
     * @return ShipmentDetail
     */
    public function setHazmatIndicator($hazmatIndicator)
    {
        $this->hazmatIndicator = $hazmatIndicator;

        return $this;
    }

    /**
     * @return PalletInformation
     */
    public function getPalletInformation()
    {
        return $this->palletInformation;
    }

    /**
     * @param PalletInformation $palletInformation
     *
     * @return ShipmentDetail
     */
    public function setPalletInformation($palletInformation)
    {
        $this->palletInformation = $palletInformation;

        return $this;
    }
}
