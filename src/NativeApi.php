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
    private static $instance = null;
    /**
     * @var Client
     */
    private $oClient;

    /**
     * NativeApi constructor.
     *
     * @param \mrcnpdlk\Regon\Client $oClient
     *
     * @throws \mrcnpdlk\Regon\Exception
     */
    private function __construct(Client $oClient)
    {
        $this->oClient = $oClient;
        $this->oClient->login();
    }

    /**
     * @param \mrcnpdlk\Regon\Client $oClient
     *
     * @return \mrcnpdlk\Regon\NativeApi
     * @throws \mrcnpdlk\Regon\Exception
     */
    public static function create(Client $oClient): NativeApi
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
    public static function getInstance(): NativeApi
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
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function DanePobierzPelnyRaport(string $regon, string $reportName): array
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
     * @throws \mrcnpdlk\Regon\Exception\InvalidResponse
     * @throws \Exception
     */
    public function DaneSzukaj(
        string $regon = null,
        string $nip = null,
        string $krs = null,
        array $tRegon = [],
        array $tNip = [],
        array $tKrs = []
    ): array {
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
     * @throws \Exception
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
     * @throws \Exception
     */
    public function Wyloguj(): self
    {
        $this->oClient->logout();

        return $this;
    }

    /**
     * Login
     *
     * @return $this
     * @throws \mrcnpdlk\Regon\Exception
     */
    public function Zaloguj(): self
    {
        $this->oClient->login();

        return $this;
    }

    /**
     * @throws \mrcnpdlk\Regon\Exception
     */
    public function __wakeup()
    {
        throw new Exception('Cannot unserialize singleton');
    }

    private function __clone()
    {
        //Me not like clones! Me smash clones!
    }

    /**
     * @param string $response xml string
     *
     * @return \stdClass[]
     * @throws Exception\InvalidResponse
     * @throws \Exception
     */
    private function decodeResponse(string $response): array
    {
        $answer = [];
        $code   = (int)$this->GetValue(Connection::PARAM_GETVALUE_MESSAGE_CODE);
        if ($code) {
            throw new NotFound($this->GetValue(Connection::PARAM_GETVALUE_MESSAGE), $code);
        }

        if ($code) {
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
            unset($value);
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
     * @throws \Psr\SimpleCache\InvalidArgumentException
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
