<?php

namespace Ups\Entity\Pickup;

use DOMDocument;
use ReflectionException;

class PickupCreationRequest extends NodeEntity
{
    /**
     * Common element for all services
     *
     * @var Request
     */
    private $request;

    /**
     * Indicates whether to rate the on-call pickup or not.
     *
     * @var bool
     */
    private $ratePickupIndicator;

    /**
     * Indicates whether to return detailed taxes for the on-call pickups.
     *
     * @var bool
     */
    private $taxInformationIndicator = false;

    /**
     * Indicates whether to return user level promo discount for the on-call pickups.
     *
     * @var bool
     */
    private $userLevelDiscountIndicator = false;

    /**
     * On-call pickup shipper or requestor information.
     *
     * Must provide when choose to pay the pickup by shipper account number.
     *
     * It is optional if the shipper chooses any other payment method. However, it is highly recommended to provide if
     * available.
     *
     * @var Shipper
     */
    private $shipper;

    /**
     * The container of desired pickup date
     *
     * @var PickupDateInfo
     */
    private $pickupDateInfo;

    /**
     * The container of pickup address.
     *
     * @var PickupAddress
     */
    private $pickupAddress;

    /**
     * Indicates if pickup address is a different address than that specified in a customer's profile.
     *
     * @var bool
     */
    private $alternateAddressIndicator;

    /**
     * The container providing the information about how many items should be picked up.
     * The total number of return and forwarding packages cannot exceed 9,999.
     *
     * @var PickupPiece
     */
    private $pickupPiece;

    /**
     * Container for the total weight of all the items.
     *
     * @var TotalWeight
     */
    private $totalWeight;

    /**
     * Indicates if at least any package is over 70 lbs or 32 kgs.
     *
     * @var bool
     */
    private $overweightIndicator = false;

    /**
     * Container for Return Service and Forward Tracking Numbers.
     *
     * Accept no more than 30 TrackingData.
     *
     * TrackingDataWithReferenceNumber and TrackingData container cannot be present at the same time.
     *
     * @var TrackingData[]
     */
    private $trackingData = [];

    /**
     * Container for Tracking Number with its associated reference numbers. This container should be populated to
     * provide visibility into shipment tied to pickup being scheduled.
     *
     * TrackingDataWithReferenceNumber and TrackingData container cannot be present at the same time.
     *
     * @var TrackingDataWithReferenceNumber
     */
    private $trackingDataWithReferenceNumber;

    /**
     * The payment method to pay for this on call pickup.
     *
     * 00 = No payment needed
     * 01 = Pay by shipper account
     * 03 = Pay by charge card
     * 04 = Pay by 1Z tracking number
     * 05 = Pay by check or money order
     * 06 = Cash(applicable only for these countries or territories - BE,FR,DE,IT,MX,NL,PL,ES,GB,CZ,HU,FI,NO)
     * 07 = Pay by PayPal
     *
     * @var string
     */
    private $paymentMethod;

    /**
     * Special handling instruction from the customer.
     *
     * @var string
     */
    private $specialInstruction;

    /**
     * Information entered by a customer for Privileged reference.
     *
     * @var string
     */
    private $referenceNumber;

    /**
     * Container will be used to indicate Service options, add optional Original service center, destination address
     * and shipment details related to the UPS Worldwide Express Freight and UPS Worldwide Express Freight Midday.
     *
     * @var FreightOptions
     */
    private $freightOptions;

    /**
     * Service Category.
     * Applicable to the following countries or territories:
     * BE, FR, DE, IT, MX, NL, PL, ES, GB
     * Valid values:
     * 01 - domestic (default)
     * 02 - international
     * 03 - transborder
     *
     * @var string
     */
    private $serviceCategory;

    /**
     * Describes the type of cash funds that the driver will collect.
     * Applicable to the following countries or territories:
     * BE,FR,DE,IT,MX,NL,PL,ES,GB,CZ,HU,FI,NO
     * Valid values:
     * 01 - Pickup only (default)
     * 02 - Transportation only
     * 03 - Pickup and Transportation
     *
     * @var string
     */
    private $cashType;

    /**
     * This element should be set to “Y” in the request to indicate that user has pre-printed shipping labels for all
     * the packages, otherwise this will be treated as false.
     *
     * @var bool
     */
    private $shippingLabelsAvailable;

    /**
     * @param Request $request
     * @param PickupDateInfo $pickupDateInfo
     * @param PickupAddress $pickupAddress
     * @param PickupPiece $pickupPiece
     * @param string $paymentMethod
     * @param bool $ratePickupIndicator
     * @param bool $alternateAddressIndicator
     */
    public function __construct(
        Request $request,
        PickupDateInfo $pickupDateInfo,
        PickupAddress $pickupAddress,
        PickupPiece $pickupPiece,
        $paymentMethod,
        $ratePickupIndicator = false,
        $alternateAddressIndicator = false
    ) {
        $this->request = $request;
        $this->pickupDateInfo = $pickupDateInfo;
        $this->pickupAddress = $pickupAddress;
        $this->pickupPiece = $pickupPiece;
        $this->paymentMethod = $paymentMethod;
        $this->ratePickupIndicator = $ratePickupIndicator;
        $this->alternateAddressIndicator = $alternateAddressIndicator;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return bool
     */
    public function getRatePickupIndicator()
    {
        return $this->ratePickupIndicator;
    }

    /**
     * @return bool
     */
    public function getTaxInformationIndicator()
    {
        return $this->taxInformationIndicator;
    }

    /**
     * @param bool $taxInformationIndicator
     *
     * @return PickupCreationRequest
     */
    public function setTaxInformationIndicator($taxInformationIndicator)
    {
        $this->taxInformationIndicator = $taxInformationIndicator;

        return $this;
    }

    /**
     * @return bool
     */
    public function getUserLevelDiscountIndicator()
    {
        return $this->userLevelDiscountIndicator;
    }

    /**
     * @param bool $userLevelDiscountIndicator
     *
     * @return PickupCreationRequest
     */
    public function setUserLevelDiscountIndicator($userLevelDiscountIndicator)
    {
        $this->userLevelDiscountIndicator = $userLevelDiscountIndicator;

        return $this;
    }

    /**
     * @return Shipper
     */
    public function getShipper()
    {
        return $this->shipper;
    }

    /**
     * @param Shipper $shipper
     *
     * @return PickupCreationRequest
     */
    public function setShipper(Shipper $shipper)
    {
        $this->shipper = $shipper;

        return $this;
    }

    /**
     * @return PickupDateInfo
     */
    public function getPickupDateInfo()
    {
        return $this->pickupDateInfo;
    }

    /**
     * @return PickupAddress
     */
    public function getPickupAddress()
    {
        return $this->pickupAddress;
    }

    /**
     * @return bool
     */
    public function getAlternateAddressIndicator()
    {
        return $this->alternateAddressIndicator;
    }

    /**
     * @return PickupPiece
     */
    public function getPickupPiece()
    {
        return $this->pickupPiece;
    }

    /**
     * @return TotalWeight
     */
    public function getTotalWeight()
    {
        return $this->totalWeight;
    }

    /**
     * @param TotalWeight $totalWeight
     *
     * @return PickupCreationRequest
     */
    public function setTotalWeight($totalWeight)
    {
        $this->totalWeight = $totalWeight;

        return $this;
    }

    /**
     * @return bool
     */
    public function getOverweightIndicator()
    {
        return $this->overweightIndicator;
    }

    /**
     * @param bool $overweightIndicator
     *
     * @return PickupCreationRequest
     */
    public function setOverweightIndicator($overweightIndicator)
    {
        $this->overweightIndicator = $overweightIndicator;

        return $this;
    }

    /**
     * @return TrackingData[]
     */
    public function getTrackingData()
    {
        return $this->trackingData;
    }

    /**
     * @param TrackingData[] $trackingData
     *
     * @return PickupCreationRequest
     */
    public function setTrackingData($trackingData)
    {
        $this->trackingData = $trackingData;

        return $this;
    }

    /**
     * @return TrackingDataWithReferenceNumber
     */
    public function getTrackingDataWithReferenceNumber()
    {
        return $this->trackingDataWithReferenceNumber;
    }

    /**
     * @param TrackingDataWithReferenceNumber $trackingDataWithReferenceNumber
     *
     * @return PickupCreationRequest
     */
    public function setTrackingDataWithReferenceNumber($trackingDataWithReferenceNumber)
    {
        $this->trackingDataWithReferenceNumber = $trackingDataWithReferenceNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getSpecialInstruction()
    {
        return $this->specialInstruction;
    }

    /**
     * @param string $specialInstruction
     *
     * @return PickupCreationRequest
     */
    public function setSpecialInstruction($specialInstruction)
    {
        $this->specialInstruction = $specialInstruction;

        return $this;
    }

    /**
     * @return string
     */
    public function getReferenceNumber()
    {
        return $this->referenceNumber;
    }

    /**
     * @param string $referenceNumber
     *
     * @return PickupCreationRequest
     */
    public function setReferenceNumber($referenceNumber)
    {
        $this->referenceNumber = $referenceNumber;

        return $this;
    }

    /**
     * @return FreightOptions
     */
    public function getFreightOptions()
    {
        return $this->freightOptions;
    }

    /**
     * @param FreightOptions $freightOptions
     *
     * @return PickupCreationRequest
     */
    public function setFreightOptions($freightOptions)
    {
        $this->freightOptions = $freightOptions;

        return $this;
    }

    /**
     * @return string
     */
    public function getServiceCategory()
    {
        return $this->serviceCategory;
    }

    /**
     * @param string $serviceCategory
     *
     * @return PickupCreationRequest
     */
    public function setServiceCategory($serviceCategory)
    {
        $this->serviceCategory = $serviceCategory;

        return $this;
    }

    /**
     * @return string
     */
    public function getCashType()
    {
        return $this->cashType;
    }

    /**
     * @param string $cashType
     *
     * @return PickupCreationRequest
     */
    public function setCashType($cashType)
    {
        $this->cashType = $cashType;

        return $this;
    }

    /**
     * @return bool
     */
    public function getShippingLabelsAvailable()
    {
        return $this->shippingLabelsAvailable;
    }

    /**
     * @param bool $shippingLabelsAvailable
     *
     * @return PickupCreationRequest
     */
    public function setShippingLabelsAvailable($shippingLabelsAvailable)
    {
        $this->shippingLabelsAvailable = $shippingLabelsAvailable;

        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * @return string
     * @throws ReflectionException
     */
    public function __toString()
    {
        $document = new DOMDocument();
        $document->formatOutput = true;

        $node = $this->toNode($document);
        $node->setAttribute('xml:lang', 'en-US');

        return $document->saveXML($node);
    }
}
