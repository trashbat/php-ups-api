<?php

namespace Ups\Entity\Pickup;

class Shipper extends NodeEntity
{
    /**
     * Shipper account information.
     *
     * Must provide when choose to pay the pickup by shipper account number.
     *
     * @var Account
     */
    private $account;

    /**
     * Container for Charge Card payment method.
     *
     * Required if Payment method is 03. Credit/Charge card payment is valid for US, CA, PR and GB origin pickups.
     *
     * @var ChargeCard
     */
    private $chargeCard;

    /**
     * @return Account
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @param Account $account
     *
     * @return Shipper
     */
    public function setAccount($account)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * @return ChargeCard
     */
    public function getChargeCard()
    {
        return $this->chargeCard;
    }

    /**
     * @param ChargeCard $chargeCard
     *
     * @return Shipper
     */
    public function setChargeCard($chargeCard)
    {
        $this->chargeCard = $chargeCard;

        return $this;
    }
}
