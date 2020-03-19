<?php
/**
 * REGON-API
 *
 * Copyright (c) 2019 pudelek.org.pl
 *
 * @license MIT License (MIT)
 *
 * For the full copyright and license information, please view source file
 * that is bundled with this package in the file LICENSE
 *
 * @author  Marcin Pudełek <marcin@pudelek.org.pl>
 */
declare (strict_types=1);

namespace mrcnpdlk\Regon;

/**
 * Class RegonSoapClient
 *
 * @package mrcnpdlk\Regon
 */
class RegonSoapClient extends \SoapClient
{
    /**
     * @var resource
     */
    protected $context;
    /**
     * @var string location
     */
    protected $location;

    /**
     * SoapClient constructor.
     *
     * @param string     $wsdl
     * @param string     $location
     * @param array|null $options
     *
     * @throws \SoapFault
     */
    public function __construct($wsdl, $location, array $options = null)
    {
        $this->setLocation($location);
        $this->context             = stream_context_create();
        $options['stream_context'] = $this->context;
        parent::__construct($wsdl, $options);
    }

    /**
     * Do request into regon server
     *
     * @param string $request  request
     * @param string $location location
     * @param string $action   action
     * @param int    $version  version
     * @param int    $oneWay   [optional] <p>
     *                         If one_way is set to 1, this method returns nothing.
     *                         Use this where a response is not expected.
     *                         </p>
     *
     * @return string response
     */
    public function __doRequest($request, $location, $action, $version, $oneWay = 0): string
    {
        $dom                     = new \DOMDocument('1.0', 'UTF-8');
        $dom->preserveWhiteSpace = false;
        $dom->loadXML($request);

        $hdr = $dom->createElement('env:Header');
        $hdr->appendChild(new \DOMElement('Action', $action, 'http://www.w3.org/2005/08/addressing'));
        $hdr->appendChild(new \DOMElement('To', $location, 'http://www.w3.org/2005/08/addressing'));
        $dom->documentElement->insertBefore($hdr, $dom->documentElement->firstChild);
        $request  = $dom->saveXML();
        $response = parent::__doRequest($request, $location, $action, $version, $oneWay);
        $response = stristr(stristr($response, '<s:'), '</s:Envelope>', true) . '</s:Envelope>';

        return $response;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * Set location
     *
     * @param string $location
     */
    public function setLocation($location): void
    {
        $this->location = $location;
    }

    /**
     * Set http header into soap request
     *
     * @param string $sid
     */
    public function setHttpSidHeader(string $sid): void
    {
        $this->setContextOption([
            'http' => ['header' => sprintf('sid: %s', $sid)],
        ]);
    }

    /**
     * Add option to http context
     *
     * @param array $option
     */
    private function setContextOption(array $option): void
    {
        stream_context_set_option($this->context, $option);
    }
}
