<?php

namespace Ups\Entity\Pickup;

class UnitOfMeasurement extends NodeEntity
{
    /**
     * IN = Inches
     * CM = Centimeters
     *
     * @var string
     */
    private $code;

    /**
     * See Code above.
     *
     * @var string
     */
    private $description;

    /**
     * @param string $code
     */
    public function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return UnitOfMeasurement
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }
}
