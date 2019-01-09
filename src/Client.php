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


use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Psr\SimpleCache\CacheInterface;

class Client
{
    /**
     * SoapClient handler
     *
     * @var RegonSoapClient
     */
    private $soapClient;
    /**
     * Cache handler
     *
     * @var \Psr\SimpleCache\CacheInterface|null
     */
    private $oCache;
    /**
     * Logger handler
     *
     * @var \Psr\Log\LoggerInterface
     */
    private $oLogger;
    /**
     * Session ID
     *
     * @var string
     */
    private $sid;
    /**
     * Adres Usługi (scv)
     *
     * @var string
     */
    private $wsdlSvc;
    /**
     * Adres WSDL (xsd)
     *
     * @var string
     */
    private $wsdlXsd;
    /**
     * Klucz użytkownika
     *
     * @var string
     */
    private $wsdlKey;

    /**
     * Client constructor.
     */
    public function __construct()
    {
        $this->setConfig();
        $this->setLoggerInstance();
        $this->setCacheInstance();
    }

    /**
     * Destructor
     * Closing session
     *
     * @throws \Exception
     */
    public function __destruct()
    {
        $this->logout();
    }

    /**
     * @return CacheInterface|null
     */
    public function getCache(): ?CacheInterface
    {
        return $this->oCache;
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger(): LoggerInterface
    {
        return $this->oLogger;
    }

    /**
     * Check if session exists
     *
     * @return boolean
     * @throws \Exception
     */
    public function isLogged(): bool
    {
        $res = $this->request('GetValue',
            [
                'pNazwaParametru' => 'StatusSesji',
            ],
            true);

        return $res === '1';
    }

    /**
     * @return $this
     * @throws Exception
     * @throws \Exception
     */
    public function login(): self
    {
        $res = $this->request('Zaloguj',
            [
                'pKluczUzytkownika' => $this->wsdlKey,
            ],
            false);
        if (empty($res)) {
            throw new Exception('Invalid UserKey');
        }
        $this->sid = $res;

        return $this;
    }

    /**
     * Logout from GUS
     *
     * @return $this
     * @throws \Exception
     */
    public function logout(): self
    {
        $res       = $this->request('Wyloguj',
            [
                'pIdentyfikatorSesji' => $this->sid,
            ],
            false);
        $this->sid = $res;

        return $this;
    }

    /**
     * Setting request
     *
     * @param string $methodName
     * @param array  $args
     * @param bool   $addSid
     *
     * @return mixed
     * @throws \Exception
     */
    public function request(string $methodName, array $args = [], bool $addSid = true)
    {
        $this->prepareSoapHeader($this->getActionUrl($methodName), $addSid);
        $this->oLogger->debug($methodName, $args);
        $res = $this->getSoap()->__soapCall($methodName, [$args]);

        return $res->{sprintf('%sResult', $methodName)};
    }

    /**
     * Set Cache handler (PSR-16)
     *
     * @param CacheInterface|null $oCache
     *
     * @return \mrcnpdlk\Regon\Client
     * @see https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-16-simple-cache.md PSR-16
     */
    public function setCacheInstance(CacheInterface $oCache = null): ?Client
    {
        $this->oCache = $oCache;

        return $this;
    }

    /**
     * Set Regon config
     *
     * @param string|null $key User key
     * @param bool        $isProduction
     *
     * @return $this
     */
    public function setConfig(string $key = null, bool $isProduction = false): self
    {
        $this->wsdlSvc = $isProduction ? Enum\Connection::BASE_WSDL_SVC : Enum\Connection::BASE_WSDL_SVC_TEST;
        $this->wsdlXsd = $isProduction ? Enum\Connection::BASE_WSDL_XSD : Enum\Connection::BASE_WSDL_XSD_TEST;
        $this->wsdlKey = $key ?? Enum\Connection::BASE_WSDL_TEST_KEY;

        return $this;

    }

    /**
     * Set Logger handler (PSR-3)
     *
     * @param LoggerInterface|null $oLogger
     *
     * @return $this
     */
    public function setLoggerInstance(LoggerInterface $oLogger = null): self
    {
        $this->oLogger = $oLogger ?: new NullLogger();

        return $this;
    }

    /**
     * @param string $methodName
     *
     * @return string Action Url
     */
    private function getActionUrl(string $methodName): string
    {
        switch ($methodName) {
            case 'GetValue':
            case 'PobierzCaptcha':
            case 'SprawdzCaptcha':
                $prefix = 'http://CIS/BIR/2014/07/IUslugaBIR';
                break;
            default:
                $prefix = 'http://CIS/BIR/PUBL/2014/07/IUslugaBIRzewnPubl';
                break;
        }

        return sprintf('%s/%s', $prefix, $methodName);
    }

    /**
     * @return \mrcnpdlk\Regon\RegonSoapClient
     * @throws \Exception
     */
    private function getSoap(): RegonSoapClient
    {
        try {
            if (!$this->soapClient) {
                $this->reinitSoap();
            }
        } catch (\Exception $e) {
            throw $e;
        }

        return $this->soapClient;
    }

    /**
     * @param      $action
     *
     * @param bool $addSid
     *
     * @return Client
     * @throws \Exception
     * @internal param null $sid
     */
    private function prepareSoapHeader($action, bool $addSid = true): Client
    {
        $header   = [];
        $header[] = new \SoapHeader('http://www.w3.org/2005/08/addressing', 'Action', $action);
        $header[] = new \SoapHeader('http://www.w3.org/2005/08/addressing', 'To', $this->wsdlSvc);
        $this->getSoap()->__setSoapHeaders($header);
        if ($this->sid && $addSid) {
            $this->getSoap()->__setHttpHeader([
                'header' => sprintf('sid: %s', $this->sid),
            ])
            ;
        }

        return $this;
    }

    /**
     * Reinit Soap Client
     *
     * @return $this
     * @throws \Exception
     */
    private function reinitSoap(): self
    {
        try {
            $this->soapClient = new RegonSoapClient($this->wsdlXsd, $this->wsdlSvc, [
                'soap_version' => \SOAP_1_2,
                'trace'        => true,
                'style'        => \SOAP_DOCUMENT,
            ]);
        } catch (\Exception $e) {
            throw $e;
        }

        return $this;
    }

}
