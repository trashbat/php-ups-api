<?php

namespace Ups\Entity\Pickup;

class Dimensions extends NodeEntity
{
    /**
     * The code representing the unit of measurement associated with the package.
     *
     * @var UnitOfMeasurement
     */
    private $unitOfMeasurement;

    /**
     * Dimension length of pallet.
     *
     * @var string
     */
    private $length;

    /**
     * Dimension width of pallet.
     *
     * @var string
     */
    private $width;

    /**
     * Dimension height of pallet.
     *
     * @var string
     */
    private $height;

    /**
     * @param UnitOfMeasurement $unitOfMeasurement
     * @param string $length
     * @param string $width
     * @param string $height
     */
    public function __construct(UnitOfMeasurement $unitOfMeasurement, $length, $width, $height)
    {
        $this->unitOfMeasurement = $unitOfMeasurement;
        $this->length = $length;
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * @return UnitOfMeasurement
     */
    public function getUnitOfMeasurement()
    {
        return $this->unitOfMeasurement;
    }

    /**
     * @return string
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @return string
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return string
     */
    public function getHeight()
    {
        return $this->height;
    }
}
