<?php

namespace mrcnpdlk\Regon;

use mrcnpdlk\Regon\Model\Entity;

/**
 * Class Api
 *
 * @package mrcnpdlk\Regon
 */
class Api
{
    /**
     * @var Client
     */
    private $oNativeApi;

    /**
     * Api constructor.
     *
     * @param Client $oClient
     */
    public function __construct(Client $oClient)
    {
        $this->oNativeApi = new NativeApi($oClient);
    }

    /**
     * @param string $nip
     *
     * @return Entity
     */
    public function getByNip(string $nip)
    {
        $tList = $this->oNativeApi->DaneSzukaj(null, $nip);

        return new Entity($tList[0]);
    }

    /**
     * @param string $regon
     *
     * @return Entity
     */
    public function getByRegon(string $regon)
    {
        $tList = $this->oNativeApi->DaneSzukaj($regon);

        return new Entity($tList[0]);
    }

    /**
     * @param string $krs
     *
     * @return Entity
     */
    public function getByKrs(string $krs)
    {
        $tList = $this->oNativeApi->DaneSzukaj(null, null, $krs);

        return new Entity($tList[0]);
    }
}
