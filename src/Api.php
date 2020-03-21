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
 * @author  Marcin Pudełek <marcin@pudelek.org.pl>
 */

/**
 * Created by Marcin.
 * Date: 19.03.2020
 * Time: 22:44
 */

declare(strict_types=1);

namespace Mrcnpdlk\Api\Regon;

use DateTime;
use Gregwar\Cache\Cache;
use Laminas\Json\Json;
use Mrcnpdlk\Api\Regon\Enum\ReportFullEnum;
use Mrcnpdlk\Api\Regon\Enum\TypeEnum;
use Mrcnpdlk\Api\Regon\Enum\ValueEnum;
use Mrcnpdlk\Api\Regon\Exception\NotFoundException;
use Mrcnpdlk\Api\Regon\Sdk\CompanyModel;
use Mrcnpdlk\Api\Regon\Sdk\PkdModel;
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
     * @var \Gregwar\Cache\Cache
     */
    private $cache;

    /**
     * Api constructor.
     *
     * @param \Mrcnpdlk\Api\Regon\Config $oConfig
     */
    public function __construct(Config $oConfig)
    {
        $this->mapper    = new Mapper(null);
        $this->config    = $oConfig;
        $this->nativeApi = new NativeApi($oConfig);

        $oCache = new Cache();
        $oCache
            ->setCacheDirectory($this->config->getCacheDir())
            ->setPrefixSize(0);
        $this->cache = $oCache;
    }

    /**
     * @throws \Mrcnpdlk\Api\Regon\Exception
     * @throws \Mrcnpdlk\Api\Regon\Exception\AuthException
     * @throws \Mrcnpdlk\Lib\ModelMapException
     *
     * @return \DateTime
     */
    public function getDatabaseState(): DateTime
    {
        $res = $this->nativeApi->GetValue(ValueEnum::StanDanych());

        return new DateTime($res);
    }

    /**
     * @param string $regon
     *
     * @throws \Mrcnpdlk\Api\Regon\Exception
     * @throws \Mrcnpdlk\Api\Regon\Exception\AuthException
     * @throws \Mrcnpdlk\Api\Regon\Exception\InvalidResponse
     * @throws \Mrcnpdlk\Api\Regon\Exception\NotFoundException
     * @throws \Mrcnpdlk\Lib\ModelMapException
     *
     * @return \Mrcnpdlk\Api\Regon\Sdk\PkdModel[]
     */
    public function getPKD(string $regon): array
    {
        $tRes = $this->searchByRegon($regon, true);
        if (0 === count($tRes)) {
            throw new NotFoundException(sprintf('Podmiot [regon=%s] nie został odnaleziony', $regon));
        }
        $company = $tRes[0];
        switch ($company->type->getValue()) {
            case TypeEnum::P:
                $report = ReportFullEnum::BIR11OsPrawnaPkd();
                break;
            case TypeEnum::F:
                $report = ReportFullEnum::BIR11OsFizycznaPkd();
                break;
            case TypeEnum::LF:
                $report = ReportFullEnum::BIR11JednLokalnaOsFizycznejPkd();
                break;
            case TypeEnum::LP:
                $report = ReportFullEnum::BIR11JednLokalnaOsPrawnejPkd();
                break;
            default:
                throw new Exception(sprintf('Niewspierany typ podmiotu [%s]', $company->type->getValue()));
        }
        $tList = Json::decode($this->cache->getOrCreate(
            sprintf('getPKD_%s.cache', $regon),
            ['max-age' => $this->config->getCacheTtl()],
            function () use ($regon,$report): string {
                return Json::encode($this->nativeApi->DanePobierzPelnyRaport($regon, $report));
            }
        ));

        /** @var PkdModel[] $tRes */
        $tRes = $this->mapper->jsonMapArray(PkdModel::class, $tList);

        return $tRes;
    }

    /**
     * @param string $regon
     *
     * @throws \Mrcnpdlk\Api\Regon\Exception
     * @throws \Mrcnpdlk\Api\Regon\Exception\AuthException
     * @throws \Mrcnpdlk\Api\Regon\Exception\InvalidResponse
     * @throws \Mrcnpdlk\Api\Regon\Exception\NotFoundException
     * @throws \Mrcnpdlk\Lib\ModelMapException
     *
     * @return \Mrcnpdlk\Api\Regon\Sdk\EntityModel
     */
    public function getReport(string $regon): Sdk\EntityModel
    {
        $tRes = $this->searchByRegon($regon, true);
        if (0 === count($tRes)) {
            throw new NotFoundException(sprintf('Podmiot [regon=%s] nie został odnaleziony', $regon));
        }
        $company = $tRes[0];
        switch ($company->type->getValue()) {
            case TypeEnum::P:
                $oEntity = $this->getReportForLaw($regon);
                break;
            case TypeEnum::F:
                $oEntity = $this->getReportForPhysics($regon);
                break;
            case TypeEnum::LF:
                $oEntity = $this->getReportForPhysicsLocal($regon);
                break;
            case TypeEnum::LP:
                $oEntity = $this->getReportForLawLocal($regon);
                break;
            default:
                throw new Exception(sprintf('Niewspierany typ podmiotu [%s]', $company->type->getValue()));
        }

        return $oEntity->validate();
    }

    /**
     * @param string $krs
     * @param bool   $useCache
     *
     * @throws \Mrcnpdlk\Api\Regon\Exception
     * @throws \Mrcnpdlk\Api\Regon\Exception\AuthException
     * @throws \Mrcnpdlk\Api\Regon\Exception\InvalidResponse
     * @throws \Mrcnpdlk\Lib\ModelMapException
     *
     * @return \Mrcnpdlk\Api\Regon\Sdk\CompanyModel[]
     */
    public function searchByKrs(string $krs, bool $useCache = true): array
    {
        if (true === $useCache) {
            $res = Json::decode($this->cache->getOrCreate(
                sprintf('searchByKrs_%s.cache', $krs),
                ['max-age' => $this->config->getCacheTtl()],
                function () use ($krs): string {
                    return Json::encode($this->nativeApi->DaneSzukajPodmioty(null, null, $krs));
                }
            ));
        } else {
            $res = $this->nativeApi->DaneSzukajPodmioty(null, null, $krs);
        }

        /** @var CompanyModel[] $tList */
        $tList = $this->mapper->jsonMapArray(CompanyModel::class, $res);

        return $tList;
    }

    /**
     * @param string $nip
     * @param bool   $useCache
     *
     * @throws \Mrcnpdlk\Api\Regon\Exception
     * @throws \Mrcnpdlk\Api\Regon\Exception\AuthException
     * @throws \Mrcnpdlk\Api\Regon\Exception\InvalidResponse
     * @throws \Mrcnpdlk\Lib\ModelMapException
     *
     * @return \Mrcnpdlk\Api\Regon\Sdk\CompanyModel[]
     */
    public function searchByNip(string $nip, bool $useCache = true): array
    {
        if (true === $useCache) {
            $res = Json::decode($this->cache->getOrCreate(
                sprintf('searchByNip_%s.cache', $nip),
                ['max-age' => $this->config->getCacheTtl()],
                function () use ($nip): string {
                    return Json::encode($this->nativeApi->DaneSzukajPodmioty(null, $nip));
                }
            ));
        } else {
            $res = $this->nativeApi->DaneSzukajPodmioty(null, $nip);
        }

        /** @var CompanyModel[] $tList */
        $tList = $this->mapper->jsonMapArray(CompanyModel::class, $res);

        return $tList;
    }

    /**
     * @param string $regon
     * @param bool   $useCache
     *
     * @throws \Mrcnpdlk\Api\Regon\Exception
     * @throws \Mrcnpdlk\Api\Regon\Exception\AuthException
     * @throws \Mrcnpdlk\Api\Regon\Exception\InvalidResponse
     * @throws \Mrcnpdlk\Lib\ModelMapException
     *
     * @return \Mrcnpdlk\Api\Regon\Sdk\CompanyModel[]
     */
    public function searchByRegon(string $regon, bool $useCache = true): array
    {
        if (true === $useCache) {
            $res = Json::decode($this->cache->getOrCreate(
                sprintf('searchByRegon_%s.cache', $regon),
                ['max-age' => $this->config->getCacheTtl()],
                function () use ($regon): string {
                    return Json::encode($this->nativeApi->DaneSzukajPodmioty($regon));
                }
            ));
        } else {
            $res = $this->nativeApi->DaneSzukajPodmioty($regon);
        }

        /** @var CompanyModel[] $tList */
        $tList = $this->mapper->jsonMapArray(CompanyModel::class, $res);

        return $tList;
    }

    /**
     * @param string $regon
     *
     * @throws \Mrcnpdlk\Api\Regon\Exception
     * @throws \Mrcnpdlk\Api\Regon\Exception\AuthException
     * @throws \Mrcnpdlk\Api\Regon\Exception\InvalidResponse
     * @throws \Mrcnpdlk\Api\Regon\Exception\NotFoundException
     * @throws \Mrcnpdlk\Lib\ModelMapException
     *
     * @return \Mrcnpdlk\Api\Regon\Sdk\EntityModel
     */
    private function getReportForLaw(string $regon): Sdk\EntityModel
    {
        $res = $this->nativeApi->DanePobierzPelnyRaport($regon, ReportFullEnum::BIR11OsPrawna());
        if (0 === count($res)) {
            throw new NotFoundException(sprintf('Raport [regon=%s] nie został odnaleziony', $regon));
        }
        /** @var \Mrcnpdlk\Api\Regon\Sdk\EntityModel $oEntity */
        $oEntity = $this->mapper->jsonMap(Sdk\EntityModel::class, $res[0]);

        return $oEntity;
    }

    /**
     * @param string $regon
     *
     * @throws \Mrcnpdlk\Api\Regon\Exception
     * @throws \Mrcnpdlk\Api\Regon\Exception\AuthException
     * @throws \Mrcnpdlk\Api\Regon\Exception\InvalidResponse
     * @throws \Mrcnpdlk\Api\Regon\Exception\NotFoundException
     * @throws \Mrcnpdlk\Lib\ModelMapException
     *
     * @return \Mrcnpdlk\Api\Regon\Sdk\EntityModel
     */
    private function getReportForLawLocal(string $regon): Sdk\EntityModel
    {
        $res = $this->nativeApi->DanePobierzPelnyRaport($regon, ReportFullEnum::BIR11JednLokalnaOsPrawnej());
        if (0 === count($res)) {
            throw new NotFoundException(sprintf('Raport [regon=%s] nie został odnaleziony', $regon));
        }
        /** @var \Mrcnpdlk\Api\Regon\Sdk\EntityModel $oEntity */
        $oEntity = $this->mapper->jsonMap(Sdk\EntityModel::class, $res[0]);

        return $oEntity;
    }

    /**
     * @param string $regon
     *
     * @throws \Mrcnpdlk\Api\Regon\Exception
     * @throws \Mrcnpdlk\Api\Regon\Exception\AuthException
     * @throws \Mrcnpdlk\Api\Regon\Exception\InvalidResponse
     * @throws \Mrcnpdlk\Api\Regon\Exception\NotFoundException
     * @throws \Mrcnpdlk\Lib\ModelMapException
     *
     * @return \Mrcnpdlk\Api\Regon\Sdk\EntityModel
     */
    private function getReportForPhysics(string $regon): Sdk\EntityModel
    {
        $res = $this->nativeApi->DanePobierzPelnyRaport($regon, ReportFullEnum::BIR11OsFizycznaDaneOgolne());
        if (0 === count($res)) {
            throw new NotFoundException(sprintf('Raport [regon=%s] nie został odnaleziony', $regon));
        }
        /** @var \Mrcnpdlk\Api\Regon\Sdk\EntityModel $oEntity */
        $oEntity = $this->mapper->jsonMap(Sdk\EntityModel::class, $res[0]);
        if ('1' === $res[0]->fiz_dzialalnoscCeidg) {
            $tCeidgRes = $this->nativeApi->DanePobierzPelnyRaport($regon, ReportFullEnum::BIR11OsFizycznaDzialalnoscCeidg());
            if (0 === count($tCeidgRes)) {
                throw new NotFoundException(sprintf('Raport CEIDG [regon=%s] nie został odnaleziony', $regon));
            }

            /** @var \Mrcnpdlk\Api\Regon\Sdk\EntityModel $oEntity */
            $oEntity = $this->mapper->jsonMap(Sdk\EntityModel::class, $res[0], $tCeidgRes[0]);
        }

        return $oEntity;
    }

    /**
     * @param string $regon
     *
     * @throws \Mrcnpdlk\Api\Regon\Exception
     * @throws \Mrcnpdlk\Api\Regon\Exception\AuthException
     * @throws \Mrcnpdlk\Api\Regon\Exception\InvalidResponse
     * @throws \Mrcnpdlk\Api\Regon\Exception\NotFoundException
     * @throws \Mrcnpdlk\Lib\ModelMapException
     *
     * @return \Mrcnpdlk\Api\Regon\Sdk\EntityModel
     */
    private function getReportForPhysicsLocal(string $regon): Sdk\EntityModel
    {
        $res = $this->nativeApi->DanePobierzPelnyRaport($regon, ReportFullEnum::BIR11JednLokalnaOsFizycznej());
        if (0 === count($res)) {
            throw new NotFoundException(sprintf('Raport [regon=%s] nie został odnaleziony', $regon));
        }

        /** @var \Mrcnpdlk\Api\Regon\Sdk\EntityModel $oEntity */
        $oEntity = $this->mapper->jsonMap(Sdk\EntityModel::class, $res[0]);

        return $oEntity;
    }
}
