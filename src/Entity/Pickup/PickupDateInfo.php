<?php

namespace Ups\Entity\Pickup;

use DateTime;

class PickupDateInfo extends NodeEntity
{
    /**
     * Pickup location's local close time.
     *
     * - User provided Close Time must be later than the Earliest Allowed Customer Close Time.
     * - Earliest Allowed Customer Close Time is defined by UPS pickup operation system.
     * - CloseTime minus ReadyTime must be greater than the LeadTime.
     * - LeadTime is determined by UPS pickup operation system. LeadTime is the minimum amount of time UPS requires
     * between customer’s request for a pickup and driver arriving at the location for the pickup.
     *
     * Format: HHmm
     * Hour: 0-23 Minute: 0-59
     *
     * @var DateTime
     */
    private $closeTime;

    /**
     * Pickup location's local ready time.
     * ReadyTime means the time when your shipment(s) can be ready for UPS to pick up.
     *
     * - User provided ReadyTime must be earlier than CallByTime.
     * - CallByTime is determined by UPS pickup operation system. CallByTime is the Latest time a Customer can call UPS
     * or self-serve on UPS.com and complete a Pickup Request and UPS can still make the Pickup service request.
     * - If ReadyTime is earlier than current local time, UPS uses the current local time as the ReadyTime.
     *
     * Format: HHmm
     * Hour: 0-23 Minute: 0-59
     *
     * @var DateTime
     */
    private $readyTime;

    /**
     * Local pickup date of the location.
     *
     * Format: yyyyMMdd
     * yyyy = Year Appliable
     * MM = 01– 12
     * dd = 01–31
     *
     * @var DateTime
     */
    private $pickupDate;

    /**
     * @param DateTime $closeTime
     * @param DateTime $readyTime
     * @param DateTime $pickupDate
     */
    public function __construct(DateTime $closeTime, DateTime $readyTime, DateTime $pickupDate)
    {
        $this->closeTime = $closeTime;
        $this->readyTime = $readyTime;
        $this->pickupDate = $pickupDate;
    }

    /**
     * @return string
     */
    public function getCloseTime()
    {
        return $this->closeTime->format('Hi');
    }

    /**
     * @return string
     */
    public function getReadyTime()
    {
        return $this->readyTime->format('Hi');
    }

    /**
     * @return string
     */
    public function getPickupDate()
    {
        return $this->pickupDate->format('Ymd');
    }
}
