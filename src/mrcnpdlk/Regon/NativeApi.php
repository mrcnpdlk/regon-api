<?php
/**
 * REGON-API
 *
 * Copyright (c) 2017 pudelek.org.pl
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


use mrcnpdlk\Regon\Enum\Connection;
use mrcnpdlk\Regon\Exception\InvalidResponse;
use mrcnpdlk\Regon\Exception\NotFound;

/**
 * Class NativeApi
 *
 * @package mrcnpdlk\Regon
 */
final class NativeApi
{
    /**
     * @var \mrcnpdlk\Regon\NativeApi
     */
    protected static $instance = null;
    /**
     * @var Client
     */
    private $oClient;

    protected function __construct(Client $oClient)
    {
        $this->oClient = $oClient;
        $this->oClient->login();
    }

    /**
     * @param \mrcnpdlk\Regon\Client $oClient
     *
     * @return \mrcnpdlk\Regon\NativeApi
     */
    public static function create(Client $oClient)
    {
        if (!isset(static::$instance)) {
            static::$instance = new static($oClient);
        }

        return static::$instance;
    }

    /**
     * @return \mrcnpdlk\Regon\NativeApi
     * @throws \mrcnpdlk\Regon\Exception
     */
    public static function getInstance()
    {
        if (!isset(static::$instance)) {
            throw new Exception(sprintf('First call CREATE method!'));
        }

        return static::$instance;
    }

    /**
     * @param string $regon
     * @param string $reportName
     *
     * @return \stdClass[]
     */
    public function DanePobierzPelnyRaport(string $regon, string $reportName)
    {
        $hashKey = md5(json_encode([__METHOD__, $regon, $reportName]));
        $self    = $this;

        return $this->useCache(function () use ($self, $regon, $reportName) {
            $res = $this->oClient->request('DanePobierzPelnyRaport',
                [
                    'pRegon'        => $regon,
                    'pNazwaRaportu' => $reportName,
                ]);

            return $this->decodeResponse($res);
        }
            , $hashKey);

    }

    /**
     * @param string|null $regon Regon
     * @param string|null $nip   NIP
     * @param string|null $krs   KRS
     * @param array       $tRegon
     * @param array       $tNip
     * @param array       $tKrs
     *
     * @return \stdClass[]
     */
    public function DaneSzukaj(
        string $regon = null,
        string $nip = null,
        string $krs = null,
        array $tRegon = [],
        array $tNip = [],
        array $tKrs = []
    ) {
        $sRegon9zn  = null;
        $sRegon14zn = null;
        $tRegon9zn  = [];
        $tRegon14zn = [];
        foreach ($tRegon as $r) {
            if (strlen($r) === 9) {
                $tRegon9zn[] = $r;
            } elseif (strlen($r) === 14) {
                $tRegon14zn[] = $r;
            }
        }


        $res = $this->oClient->request('DaneSzukaj',
            [
                'pParametryWyszukiwania' => [
                    'Krs'        => $krs,
                    'Krsy'       => !empty($tKrs) ? implode(' ', $tKrs) : null,
                    'Nip'        => $nip,
                    'Nipy'       => !empty($tNip) ? implode(' ', $tNip) : null,
                    'Regon'      => $regon,
                    'Regony9zn'  => !empty($tRegon9zn) ? implode(' ', $tRegon9zn) : null,
                    'Regony14zn' => !empty($tRegon14zn) ? implode(' ', $tRegon14zn) : null,


                ],
            ]
        );

        return $this->decodeResponse($res);

    }

    /**
     * @param string $valueName
     *
     * @return mixed
     */
    public function GetValue(string $valueName)
    {
        $res = $this->oClient->request('GetValue',
            [
                'pNazwaParametru' => $valueName,
            ],
            true
        );

        return $res;
    }

    /**
     * Logout
     *
     * @return $this
     */
    public function Wyloguj()
    {
        $this->oClient->logout();

        return $this;
    }

    /**
     * Login
     *
     * @return $this
     */
    public function Zaloguj()
    {
        $this->oClient->login();

        return $this;
    }

    protected function __clone()
    {
        //Me not like clones! Me smash clones!
    }

    public function __wakeup()
    {
        throw new Exception("Cannot unserialize singleton");
    }

    /**
     * @param string $response xml string
     *
     * @return \stdClass[]
     * @throws Exception\InvalidResponse
     */
    private function decodeResponse(string $response)
    {
        $answer = [];
        $code   = intval($this->GetValue(Connection::PARAM_GETVALUE_MESSAGE_CODE));
        if ($code) {
            throw new NotFound($this->GetValue(Connection::PARAM_GETVALUE_MESSAGE), $code);
        } elseif ($code) {
            throw new InvalidResponse($this->GetValue(Connection::PARAM_GETVALUE_MESSAGE), $code);
        }

        $res = new \SimpleXMLElement($response);

        foreach ($res->children() as $child) {
            $item = json_decode(json_encode($child));
            //clearing data - empty object as NULL
            foreach (get_object_vars($item) as $key => &$value) {
                $item->$key = empty((array)$value) ? null : (is_string($value) ? trim($value) : $value);
                //fix - czasem nip byl jako pusty \sdtClass
                if (is_object($item->$key)) {
                    $item->$key = null;
                }
            }
            $answer[] = $item;
        }

        return $answer;
    }

    /**
     * Caching things
     *
     * @param \Closure $closure Function calling wheen cache is empty or not valid
     * @param mixed    $hashKey Cache key of item
     * @param int|null $ttl     Time to live for item
     *
     * @return mixed
     */
    private function useCache(\Closure $closure, string $hashKey, int $ttl = null)
    {
        if ($this->oClient->getCache()) {
            if ($this->oClient->getCache()->has($hashKey)) {
                $answer = $this->oClient->getCache()->get($hashKey);
                $this->oClient->getLogger()->debug(sprintf('CACHE [%s]: geting from cache', $hashKey));
            } else {
                $answer = $closure();
                $this->oClient->getCache()->set($hashKey, $answer, $ttl);
                $this->oClient->getLogger()->debug(sprintf('CACHE [%s]: old, reset', $hashKey));
            }
        } else {
            $this->oClient->getLogger()->debug(sprintf('CACHE [%s]: no implemented', $hashKey));
            $answer = $closure();
        }

        return $answer;
    }

}
