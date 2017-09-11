<?php
/**
 * Created by Marcin Pudełek <marcin@pudelek.org.pl>
 * Date: 11.09.2017
 * Time: 11:45
 */

namespace mrcnpdlk\Regon;


use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Psr\SimpleCache\CacheInterface;

class Client
{
    /**
     * Client instance
     *
     * @var Client
     */
    protected static $classInstance;
    /**
     * SoapClient handler
     *
     * @var RegonSoapClient
     */
    private $soapClient;
    /**
     * Cache handler
     *
     * @var \Psr\SimpleCache\CacheInterface
     */
    private $oCache;
    /**
     * Logger handler
     *
     * @var \Psr\Log\LoggerInterface
     */
    private $oLogger;

    /**
     * Regon auth configuration
     *
     * @var array
     */
    private $tRegonConfig = [];
    /**
     * Default Teryt auth configuration
     *
     * @var array
     */
    private $tDefRegonConfig
        = [
            /**
             * Adres usługi
             */
            'url'  => 'https://wyszukiwarkaregontest.stat.gov.pl/wsBIR/UslugaBIRzewnPubl.svc',
            /**
             * Adres WSDL
             */
            'wsdl' => 'https://wyszukiwarkaregontest.stat.gov.pl/wsBIR/wsdl/UslugaBIRzewnPubl.xsd',
            /**
             * Klucz użytkownika (testowy)
             */
            'key'  => 'abcde12345abcde12345',
        ];

    /**
     * Session ID
     *
     * @var string
     */
    private $sid;

    /**
     * Client constructor.
     */
    protected function __construct()
    {
        $this->setRegonConfig();
        $this->setLoggerInstance();
        $this->setCacheInstance();
    }

    public function setRegonConfig(array $tConfig = [])
    {
        $this->tRegonConfig = $this->tDefRegonConfig;

        foreach ($tConfig as $k => $v) {
            if (array_key_exists($k, $this->tDefRegonConfig)) {
                $this->tRegonConfig[$k] = $v;
            }
        }

        return $this;

    }

    /**
     * Set Logger handler (PSR-3)
     *
     * @param LoggerInterface|null $oLogger
     *
     * @return $this
     */
    public function setLoggerInstance(LoggerInterface $oLogger = null)
    {
        $this->oLogger = $oLogger ?: new NullLogger();

        return $this;
    }

    /**
     * Set Cache handler (PSR-16)
     *
     * @param CacheInterface|null $oCache
     *
     * @return \mrcnpdlk\Regon\Client
     * @see https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-16-simple-cache.md PSR-16
     */
    public function setCacheInstance(CacheInterface $oCache = null)
    {
        $this->oCache = $oCache;

        return $this;
    }

    /**
     * Get Client class instance
     *
     * @return \mrcnpdlk\Regon\Client Instancja klasy
     * @throws \mrcnpdlk\Regon\Exception
     */
    public static function getInstance()
    {
        if (!static::$classInstance) {
            static::$classInstance = new static;
        }

        return static::$classInstance;
    }

    public function request(string $method, $args, $action)
    {
        $this->prepareSoapHeader($action, $this->tRegonConfig['url']);
        $res = $this->getSoap()->__soapCall($method, [$args]);

        return $res->{sprintf('%sResult', $method)};
    }

    /**
     * @param      $action
     * @param      $to
     * @param null $sid
     *
     * @return \mrcnpdlk\Regon\Client
     */
    private function prepareSoapHeader($action, $to)
    {
        $this->clearHeader();
        $header   = [];
        $header[] = $this->setHeader('http://www.w3.org/2005/08/addressing', 'Action', $action);
        $header[] = $this->setHeader('http://www.w3.org/2005/08/addressing', 'To', $to);
        $this->getSoap()->__setSoapHeaders($header);
        if ($this->sid) {
            $this->getSoap()->__setHttpHeader([
                'header' => sprintf('sid: %s', $this->sid),
            ])
            ;
        }

        return $this;
    }

    /**
     * @return \mrcnpdlk\Regon\Client
     */
    private function clearHeader()
    {
        $this->getSoap()->__setSoapHeaders(null);

        return $this;
    }

    /**
     * @return \mrcnpdlk\Regon\RegonSoapClient
     * @throws \Exception
     */
    private function getSoap()
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
     * Reinit Soap Client
     *
     * @return $this
     * @throws \Exception
     */
    private function reinitSoap()
    {
        try {
            $this->soapClient = new RegonSoapClient($this->tRegonConfig['wsdl'], $this->tRegonConfig['url'], [
                'soap_version' => SOAP_1_2,
                'trace'        => true,
                'style'        => SOAP_DOCUMENT,
            ]);
        } catch (\Exception $e) {
            throw $e;
        }

        return $this;
    }

    private function setHeader($namespace, $name, $data = null, $mustUnderstand = false)
    {
        return new \SoapHeader($namespace, $name, $data, $mustUnderstand);
    }
}