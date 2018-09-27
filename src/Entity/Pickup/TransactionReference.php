<?php

namespace Ups\Entity\Pickup;

class TransactionReference extends NodeEntity
{
    /**
     * The client uses CustomerContext to synchronize request/response pairs.
     *
     * CustomerContext can contain any information the client requires. As long as it is valid XML it is echoed back by
     * the server.
     *
     * @var string
     */
    private $customerContext;

    /**
     * @return string
     */
    public function getCustomerContext()
    {
        return $this->customerContext;
    }

    /**
     * @param string $customerContext
     *
     * @return TransactionReference
     */
    public function setCustomerContext($customerContext)
    {
        $this->customerContext = $customerContext;

        return $this;
    }
}
