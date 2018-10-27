<?php

namespace Ups;

use DateTime;
use Exception;
use LogicException;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use SimpleXMLElement;
use SoapClient;
use SoapHeader;
use Ups\Exception\InvalidResponseException;

class SoapRequest implements RequestInterface, LoggerAwareInterface
{
    /**
     * @var string
     */
    protected $access;

    /**
     * @var string
     */
    protected $request;

    /**
     * @var string
     */
    protected $endpointUrl;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger = null)
    {
        if ($logger !== null) {
            $this->setLogger($logger);
        } else {
            $this->setLogger(new NullLogger);
        }
    }

    /**
     * Sets a logger instance on the object.
     *
     * @param LoggerInterface $logger
     *
     * @return null
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Send request to UPS.
     *
     * @param string $access The access request xml
     * @param string $request The request xml
     * @param string $endpointurl The UPS API Endpoint URL
     * @param string $operation Operation to perform on SOAP endpoint
     * @param string $wsdl Which WSDL file to use
     *
     * @throws Exception
     * @throws InvalidResponseException
     * @todo: make access, request and endpointurl nullable to make the testable
     *
     * @return ResponseInterface
     */
    public function request($access, $request, $endpointurl, $operation = null, $wsdl = null)
    {
        // Check for operation
        if (is_null($operation)) {
            throw new \Exception('Operation is required');
        }

        // Check for WSDL
        if (is_null($wsdl)) {
            throw new \Exception('WSDL is required');
        }

        // Set data
        $this->setAccess($access);
        $this->setRequest($request);
        $this->setEndpointUrl($endpointurl);

        // Settings based on UPS PHP Example
        $mode = array(
            'soap_version' => 'SOAP_1_1',
            'trace' => 1,
            'connection_timeout' => 2,
            'cache_wsdl' => WSDL_CACHE_BOTH,
        );

        // Initialize soap client
        $wsdlFile = sprintf('%s/WSDL/%s.wsdl', __DIR__, $wsdl);
        $client = new SoapClient($wsdlFile, $mode);

        // Set endpoint URL + auth & request data
        $client->__setLocation($endpointurl);
        $auth = (array)new SimpleXMLElement($access);
        $request = (array)new SimpleXMLElement($request);

        // Build auth header
        $header = $this->getAuthHeader($wsdlFile, $auth);
        $client->__setSoapHeaders($header);

        // Log request
        $date = new DateTime();
        $id = $date->format('YmdHisu');
        $endpointurl = $this->getEndpointUrl();

        $this->logger->info('Request To UPS API', compact('id', 'endpointurl'));
        $this->logger->debug('Request: '.$this->getRequest(), compact('id', 'endpointurl'));

        // Perform call and get response
        try {
            $request = json_decode(json_encode((array)$request), true);
            $client->__soapCall($operation, [$request]);
            $body = $client->__getLastResponse();

            $this->logger->info('Response from UPS API', compact('id', 'endpointurl'));
            $this->logger->debug('Response: '.$body, compact('id', 'endpointurl'));

            // Strip off namespaces and make XML
            $body = preg_replace('/(<\/*)[^>:]+:/', '$1', $body);
            $xml = new SimpleXMLElement($body);
            $responseInstance = new Response();
            return $responseInstance->setText($body)->setResponse($xml);
        } catch (\Exception $e) {
            // Parse error response
            $lastResponse = $client->__getLastResponse();
            $simpleXMLElement = new SimpleXMLElement(preg_replace('/(<\/*)[^>:]+:/', '$1', $lastResponse));
            $errors = $simpleXMLElement->xpath('//Description');

            if ($errors) {
                throw new InvalidResponseException((string) $errors[0]);
            }

            $xml = new SimpleXMLElement($lastResponse);

            $xml->registerXPathNamespace('err', 'http://www.ups.com/schema/xpci/1.0/error');
            $errorCode = $xml->xpath('//err:PrimaryErrorCode/err:Code');
            $errorMsg = $xml->xpath('//err:PrimaryErrorCode/err:Description');

            if (isset($errorCode[0], $errorMsg[0])) {
                $this->logger->alert($errorMsg[0], compact('id', 'endpointurl'));

                throw new InvalidResponseException('Failure: '.(string)$errorMsg[0].' ('.(string)$errorCode[0].')');
            }

            $this->logger->alert($e->getMessage(), compact('id', 'endpointurl'));

            throw new InvalidResponseException('Cannot parse error from UPS: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @return string
     */
    public function getEndpointUrl()
    {
        return $this->endpointUrl;
    }

    /**
     * @param $endpointUrl
     *
     * @return $this
     */
    public function setEndpointUrl($endpointUrl)
    {
        $this->endpointUrl = $endpointUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param $request
     *
     * @return $this
     */
    public function setRequest($request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * @return string
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * @param $access
     *
     * @return $this
     */
    public function setAccess($access)
    {
        $this->access = $access;

        return $this;
    }

    /**
     * Generates the relevant SOAP auth header, based on whether the WSDL file imports AccessRequestXPCI or UPSSecurity.
     *
     * @param string $wsdlFile
     * @param array $auth
     *
     * @return SoapHeader
     */
    private function getAuthHeader($wsdlFile, $auth)
    {
        $file = simplexml_load_file($wsdlFile);

        // Most APIs seem to use AccessRequest:
        if ($file->xpath('//xsd:import[@schemaLocation = "AccessRequestXPCI.xsd"]')) {
            return new SoapHeader('http://www.ups.com/schema/xpci/1.0/auth', 'AccessRequest', $auth);
        }

        // The Pickup API uses UPSSecurity:
        if ($file->xpath('//xsd:import[@schemaLocation = "UPSSecurity.xsd"]')) {
            return new SoapHeader('http://www.ups.com/XMLSchema/XOLTWS/UPSS/v1.0', 'UPSSecurity', $auth);
        }

        // If you're trying to implement an API that uses neither of the above, add the relevant lines here (or come up
        // with a nicer solution!)
        throw new LogicException(sprintf("Don't know how to create a SOAP auth header from WSDL file: %s", $wsdlFile));
    }
}
