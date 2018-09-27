<?php

namespace Ups\Entity\Pickup;

class TotalWeight extends NodeEntity
{
    /**
     * @var float
     */
    private $weight;

    /**
     * @var string
     */
    private $unitOfMeasurement;

    /**
     * @param float $weight
     * @param string $unitOfMeasurement
     */
    public function __construct($weight, $unitOfMeasurement)
    {
        $this->weight = $weight;
        $this->unitOfMeasurement = $unitOfMeasurement;
    }

    /**
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @return string
     */
    public function getUnitOfMeasurement()
    {
        return $this->unitOfMeasurement;
    }
}
