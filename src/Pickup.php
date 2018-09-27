<?php

namespace Ups;

use DOMDocument;
use Ups\Entity\Pickup\PickupCreationRequest;

class Pickup extends Ups
{
    /**
     * @var string
     */
    const PICKUP_ENDPOINT = '/Pickup';

    /**
     * {@inheritdoc}
     */
    protected $productionBaseUrl = 'https://www.ups.com/webservices';

    /**
     * {@inheritdoc}
     */
    protected $integrationBaseUrl = 'https://wwwcie.ups.com/webservices';

    public function createPickupRequest(PickupCreationRequest $request)
    {
        $requestHandler = new SoapRequest($this->getLogger());
        $endpointUrl = $this->compileEndpointUrl(self::PICKUP_ENDPOINT);

        $response = $requestHandler->request(
            $this->createAccess(),
            (string) $request,
            $endpointUrl,
            'ProcessPickupCreation',
            'Pickup'
        );

        $apiResponse = $response->getResponse()->Body->PickupCreationResponse;

        $code = (string) $apiResponse->Response->ResponseStatus->Code;

        if ($code !== '1') {
            throw new \Exception('Request failed.');
        }

        $prn = (string) $apiResponse->PRN;
        $rateStatus = (array) $apiResponse->RateStatus;

        return compact('prn', 'rateStatus');
    }

    protected function createAccess()
    {
        $xml = new DOMDocument('1.0', 'utf-8');
        $xml->formatOutput = true;

        $upsSecurity = $xml->appendChild($xml->createElement('UPSSecurity'));
        $upsSecurity->setAttribute('xml:lang', 'en-US');

        $usernameToken = $upsSecurity->appendChild($xml->createElement('UsernameToken'));

        $usernameToken->appendChild($xml->createElement('Username', $this->userId));
        $usernameToken->appendChild($xml->createElement('Password', $this->password));

        $serviceAccessToken = $upsSecurity->appendChild($xml->createElement('ServiceAccessToken'));

        $serviceAccessToken->appendChild($xml->createElement('AccessLicenseNumber', $this->accessKey));

        return $xml->saveXML();
    }
}
