<?php

namespace Ups\Entity\Pickup;

class Phone extends NodeEntity
{
    /**
     * Phone number
     *
     * @var string
     */
    private $number;

    /**
     * Phone extension
     *
     * @var string
     */
    private $extension;

    /**
     * @param string $number
     */
    public function __construct($number)
    {
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param string $extension
     *
     * @return Phone
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;

        return $this;
    }
}
