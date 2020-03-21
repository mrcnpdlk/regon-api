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
use Mrcnpdlk\Api\Regon\Enum\ReportFullEnum;
use Mrcnpdlk\Api\Regon\Enum\TypeEnum;
use Mrcnpdlk\Api\Regon\Enum\ValueEnum;
use Mrcnpdlk\Api\Regon\Exception\NotFoundException;
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
     */
    public function __construct(Config $oConfig)
    {
        $this->mapper    = new Mapper(null);
        $this->config    = $oConfig;
        $this->nativeApi = new NativeApi($oConfig);
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
     * @return \Mrcnpdlk\Api\Regon\Sdk\EntityModel
     */
    public function getReport(string $regon): Sdk\EntityModel
    {
        $tRes = $this->searchByRegon($regon);
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
     *
     * @throws \Mrcnpdlk\Api\Regon\Exception
     * @throws \Mrcnpdlk\Api\Regon\Exception\AuthException
     * @throws \Mrcnpdlk\Api\Regon\Exception\InvalidResponse
     * @throws \Mrcnpdlk\Lib\ModelMapException
     *
     * @return \Mrcnpdlk\Api\Regon\Sdk\CompanyModel[]
     */
    public function searchByKrs(string $krs)
    {
        $res = $this->nativeApi->DaneSzukajPodmioty(null, null, $krs);
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
     *
     * @return \Mrcnpdlk\Api\Regon\Sdk\CompanyModel[]
     */
    public function searchByNip(string $nip): array
    {
        $res = $this->nativeApi->DaneSzukajPodmioty(null, $nip);
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
     * @throws \Mrcnpdlk\Lib\ModelMapException
     *
     * @return \Mrcnpdlk\Api\Regon\Sdk\CompanyModel[]
     */
    public function searchByRegon(string $regon): array
    {
        $res = $this->nativeApi->DaneSzukajPodmioty($regon);
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
}
