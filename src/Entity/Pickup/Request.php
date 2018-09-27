<?php

namespace Ups\Entity\Pickup;

class Request extends NodeEntity
{
    /**
     * When UPS introduces new elements in the response that are not associated with new request elements, Subversion
     * is used. This ensures backward compatibility.
     *
     * To get such elements you need to have the right Subversion. The value of the subversion is explained in the
     * Response element Description. Supported values: 1607, 1707
     *
     * Example: Itemized Charges are returned only when the Subversion element is present and greater than or equal to
     * '1601'.
     *
     * Format: YYMM = Year and month of the release.
     * Example: 1601 = 2016 January
     *
     * @var string
     */
    private $subVersion;

    /**
     * Transaction Reference Container
     *
     * @var TransactionReference
     */
    private $transactionReference;

    /**
     * @return string
     */
    public function getSubVersion()
    {
        return $this->subVersion;
    }

    /**
     * @param string $subVersion
     *
     * @return Request
     */
    public function setSubVersion($subVersion)
    {
        $this->subVersion = $subVersion;

        return $this;
    }

    /**
     * @return TransactionReference
     */
    public function getTransactionReference()
    {
        return $this->transactionReference;
    }

    /**
     * @param TransactionReference $transactionReference
     *
     * @return Request
     */
    public function setTransactionReference($transactionReference)
    {
        $this->transactionReference = $transactionReference;

        return $this;
    }
}
