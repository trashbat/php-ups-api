<?php

namespace Ups\Entity\Pickup;

class PalletInformation extends NodeEntity
{
    /**
     * Dimensions of largest pallet
     *
     * @var Dimensions
     */
    private $dimensions;

    /**
     * @return Dimensions
     */
    public function getDimensions()
    {
        return $this->dimensions;
    }

    /**
     * @param Dimensions $dimensions
     *
     * @return PalletInformation
     */
    public function setDimensions($dimensions)
    {
        $this->dimensions = $dimensions;

        return $this;
    }
}
