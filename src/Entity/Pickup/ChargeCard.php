<?php

namespace Ups\Entity\Pickup;

class ChargeCard extends NodeEntity
{
    /**
     * Charge card holder name. If the name is not provided, defaults to "No Name Provided".
     *
     * @var string
     */
    private $cardHolderName;

    /**
     * Charge card type. Valid values:
     * 01 = American Express
     * 03 = Discover
     * 04 = Mastercard
     * 06 = VISA
     *
     * Discover card Pickup country US only.
     *
     * @var string
     */
    private $cardType;

    /**
     * Charge card number.
     *
     * For Privileged clients, this element must be tokenized card number.
     *
     * @var string
     */
    private $cardNumber;

    /**
     * Credit card expiration date.
     * Format: yyyyMM
     * yyyy = 4 digit year, valid value current year - 10 years.
     * MM = 2 digit month, valid values 01-12
     *
     * @var string
     */
    private $expirationDate;

    /**
     * Three or four digits that can be found either on top of credit card number or on the back of credit card.
     * Number of digits varies for different type of credit card.
     *
     * @var string
     */
    private $securityCode;

    /**
     * Container to hold the Charge card address.
     *
     * @var CardAddress
     */
    private $cardAddress;

    /**
     * @param string $cardType
     * @param string $cardNumber
     * @param string $expirationDate
     * @param string $securityCode
     * @param CardAddress $cardAddress
     */
    public function __construct($cardType, $cardNumber, $expirationDate, $securityCode, CardAddress $cardAddress)
    {
        $this->cardType = $cardType;
        $this->cardNumber = $cardNumber;
        $this->expirationDate = $expirationDate;
        $this->securityCode = $securityCode;
        $this->cardAddress = $cardAddress;
    }

    /**
     * @return string
     */
    public function getCardHolderName()
    {
        return $this->cardHolderName;
    }

    /**
     * @param string $cardHolderName
     *
     * @return ChargeCard
     */
    public function setCardHolderName($cardHolderName)
    {
        $this->cardHolderName = $cardHolderName;

        return $this;
    }

    /**
     * @return string
     */
    public function getCardType()
    {
        return $this->cardType;
    }

    /**
     * @return string
     */
    public function getCardNumber()
    {
        return $this->cardNumber;
    }

    /**
     * @return string
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    /**
     * @return string
     */
    public function getSecurityCode()
    {
        return $this->securityCode;
    }

    /**
     * @return CardAddress
     */
    public function getCardAddress()
    {
        return $this->cardAddress;
    }
}
