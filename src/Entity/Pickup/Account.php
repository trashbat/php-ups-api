<?php

namespace Ups\Entity\Pickup;

class Account extends NodeEntity
{
    /**
     * UPS account number.
     *
     * Shipper's (requester of the pickup) UPS account number
     *
     * @var string
     */
    private $accountNumber;

    /**
     * Country or Territory code as defined by ISO-3166.
     * Refer to Country or Territory Codes in the Appendix for valid values.
     *
     * @var string
     */
    private $accountCountryCode;

    /**
     * @param string $accountNumber
     * @param string $accountCountryCode
     */
    public function __construct($accountNumber, $accountCountryCode)
    {
        $this->accountNumber = $accountNumber;
        $this->accountCountryCode = $accountCountryCode;
    }

    /**
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     * @return string
     */
    public function getAccountCountryCode()
    {
        return $this->accountCountryCode;
    }
}
