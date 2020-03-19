<?php
/**
 * REGON-API
 *
 * Copyright (c) 2020 pudelek.org.pl
 *
 * @license MIT License (MIT)
 *
 * For the full copyright and license information, please view source file
 * that is bundled with this package in the file LICENSE
 *
 * @author  Marcin Pudełek <marcin@pudelek.org.pl>
 */

/**
 * Created by Marcin.
 * Date: 19.03.2020
 * Time: 22:44
 */

declare (strict_types=1);

namespace Mrcnpdlk\Api\Regon;


use Mrcnpdlk\Api\Regon\Sdk\CompanyModel;
use Mrcnpdlk\Lib\Mapper;

class Api
{
    /**
     * @var \Mrcnpdlk\Lib\Mapper
     */
    private $mapper;
    /**
     * @var \Mrcnpdlk\Api\Regon\Config
     */
    private $config;
    /**
     * @var \Mrcnpdlk\Api\Regon\NativeApi
     */
    private $nativeApi;

    /**
     * Api constructor.
     *
     * @param \Mrcnpdlk\Api\Regon\Config $oConfig
     *
     */
    public function __construct(Config $oConfig)
    {
        $this->mapper    = new Mapper(null);
        $this->config    = $oConfig;
        $this->nativeApi = new NativeApi($oConfig);

    }

    /**
     * @param string $regon
     *
     * @throws \Mrcnpdlk\Api\Regon\Exception
     * @throws \Mrcnpdlk\Api\Regon\Exception\AuthException
     * @throws \Mrcnpdlk\Api\Regon\Exception\InvalidResponse
     * @throws \Mrcnpdlk\Lib\ModelMapException
     * @return \Mrcnpdlk\Api\Regon\Sdk\CompanyModel[]
     */
    public function searchByRegon(string $regon)
    {
        $res = $this->nativeApi->DaneSzukajPodmioty($regon);
        /** @var CompanyModel[] $tList */
        $tList = $this->mapper->jsonMapArray(CompanyModel::class, $res);

        return $tList;
    }

    /**
     * @param string $nip
     *
     * @throws \Mrcnpdlk\Api\Regon\Exception
     * @throws \Mrcnpdlk\Api\Regon\Exception\AuthException
     * @throws \Mrcnpdlk\Api\Regon\Exception\InvalidResponse
     * @throws \Mrcnpdlk\Lib\ModelMapException
     * @return \Mrcnpdlk\Api\Regon\Sdk\CompanyModel[]
     */
    public function searchByNip(string $nip)
    {
        $res = $this->nativeApi->DaneSzukajPodmioty(null, $nip);
        /** @var CompanyModel[] $tList */
        $tList = $this->mapper->jsonMapArray(CompanyModel::class, $res);

        return $tList;
    }

    /**
     * @param string $krs
     *
     * @throws \Mrcnpdlk\Api\Regon\Exception
     * @throws \Mrcnpdlk\Api\Regon\Exception\AuthException
     * @throws \Mrcnpdlk\Api\Regon\Exception\InvalidResponse
     * @throws \Mrcnpdlk\Lib\ModelMapException
     * @return \Mrcnpdlk\Api\Regon\Sdk\CompanyModel[]
     */
    public function searchByKrs(string $krs)
    {
        $res = $this->nativeApi->DaneSzukajPodmioty(null, null, $krs);
        /** @var CompanyModel[] $tList */
        $tList = $this->mapper->jsonMapArray(CompanyModel::class, $res);

        return $tList;
    }
}
