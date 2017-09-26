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

namespace mrcnpdlk\Regon;

use mrcnpdlk\Regon\Enum\Report;
use mrcnpdlk\Regon\Exception\InvalidResponse;
use mrcnpdlk\Regon\Exception\NotFound;
use mrcnpdlk\Regon\Model\Entity;
use mrcnpdlk\Regon\Model\Entity\Owner;
use mrcnpdlk\Regon\Model\SearchResult;

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
        $this->oNativeApi = NativeApi::create($oClient);
    }

    /**
     * @param string $nip
     *
     * @return SearchResult
     */
    public function getByNip(string $nip)
    {
        $tList = $this->oNativeApi->DaneSzukaj(null, $nip);

        return new SearchResult($tList[0]);
    }

    /**
     * @param string $krs
     *
     * @return SearchResult
     */
    public function getByKrs(string $krs)
    {
        $tList = $this->oNativeApi->DaneSzukaj(null, null, $krs);

        return new SearchResult($tList[0]);
    }

    /**
     * Getting current date of GUS database
     *
     * @return null|string Date in format YYYY-MM-DD
     */
    public function getServiceStatus()
    {
        $res = $this->oNativeApi->GetValue('StanDanych');

        if ($res) {
            return (new \DateTime($res))->format('Y-m-d');
        }

        return null;
    }

    /**
     * @param string $regon
     *
     * @return Entity|null
     */
    public function getReport(string $regon)
    {
        $oEntity       = null;
        $oSearchResult = $this->getByRegon($regon);
        switch ($oSearchResult->getTypeId()) {
            case 'P':
                $oEntity         = $this->getReportForLaw($regon);
                $oEntity->locals = $this->getLocalsLaw($regon);
                break;
            case 'F':
                $oEntity         = $this->getReportForPhysic($regon);
                $oEntity->locals = $this->getLocalsPhysic($regon);
                break;
            case 'LP':
                $oEntity             = $this->getReportForLawLocal($regon);
                $oEntity->mainEntity = $this->getReport($oEntity->regon9);
                if (!$oEntity->nip) {
                    $oEntity->nip = $oEntity->mainEntity->nip;
                }
                break;
            case 'LF':
                $oEntity             = $this->getReportForPhysicLocal($regon);
                $oEntity->mainEntity = $this->getReport($oEntity->regon9);
                if (!$oEntity->nip) {
                    $oEntity->nip = $oEntity->mainEntity->nip;
                }
                break;
        }

        return $oEntity;
    }

    /**
     * @param string $regon
     *
     * @return SearchResult
     */
    public function getByRegon(string $regon)
    {
        $tList = $this->oNativeApi->DaneSzukaj($regon);

        return new SearchResult($tList[0]);
    }

    /**
     * @param string $regon
     *
     * @return Entity
     */
    private function getReportForLaw(string $regon)
    {
        $searchedItems = $this->oNativeApi->DanePobierzPelnyRaport($regon, Report::REPORT_PUBLIC_LAW);
        $oData         = $searchedItems[0];
        $oEntity       = new Entity($oData);

        return $oEntity;
    }

    /**
     * @param string $regon
     *
     * @return string[]
     */
    private function getLocalsLaw(string $regon)
    {
        try {
            $answer  = [];
            $tLocals = $this->oNativeApi->DanePobierzPelnyRaport($regon, Report::REPORT_LOCALS_LAW);
            foreach ($tLocals as $local) {
                $answer[] = $local->lokpraw_regon14;
            }

            return $answer;
        } catch (NotFound $e) {
            return [];
        }
    }

    /**
     * @param string $regon
     *
     * @return Entity
     * @throws InvalidResponse
     */
    private function getReportForPhysic(string $regon)
    {
        $searchedItems = $this->oNativeApi->DanePobierzPelnyRaport($regon, Report::REPORT_ACTIVITY_PHYSIC_PERSON);
        $searchedItem  = $searchedItems[0];
        if ($searchedItem->fiz_dzialalnosciCeidg === '1') {
            $tReports = $this->oNativeApi->DanePobierzPelnyRaport($regon, Report::REPORT_ACTIVITY_PHYSIC_CEIDG);
            $oData    = $tReports[0];
        } elseif ($searchedItem->fiz_dzialalnosciRolniczych === '1') {
            $tReports = $this->oNativeApi->DanePobierzPelnyRaport($regon, Report::REPORT_ACTIVITY_PHYSIC_AGRO);
            $oData    = $tReports[0];
        } elseif ($searchedItem->fiz_dzialalnosciPozostalych === '1') {
            $tReports = $this->oNativeApi->DanePobierzPelnyRaport($regon, Report::REPORT_ACTIVITY_PHYSIC_OTHER);
            $oData    = $tReports[0];
        } elseif ($searchedItem->fiz_dzialalnosciZKrupgn === '1') {
            $tReports = $this->oNativeApi->DanePobierzPelnyRaport($regon, Report::REPORT_ACTIVITY_PHYSIC_KRUPGN);
            $oData    = $tReports[0];
        } else {
            throw new InvalidResponse(sprintf(''));
        }


        $oEntity                     = new Entity($oData);
        $oEntity->basicLegalFormId   = $searchedItem->fiz_podstawowaFormaPrawna_Symbol;
        $oEntity->basicLegalFormName = $searchedItem->fiz_podstawowaFormaPrawna_Nazwa;
        $oEntity->nip                = $searchedItem->fiz_nip;
        $oEntity->regon              = $searchedItem->fiz_regon9;
        $oEntity->owner              = new Owner($searchedItem->fiz_imie1, $searchedItem->fiz_nazwisko, $searchedItem->fiz_imie2);

        return $oEntity;

    }

    /**
     * @param string $regon
     *
     * @return string[]
     */
    private function getLocalsPhysic(string $regon)
    {
        try {
            $answer  = [];
            $tLocals = $this->oNativeApi->DanePobierzPelnyRaport($regon, Report::REPORT_LOCALS_PHYSIC);
            foreach ($tLocals as $local) {
                $answer[] = $local->lokfiz_regon14;
            }

            return $answer;
        } catch (NotFound $e) {
            return [];
        }
    }

    /**
     * @param string $regon
     *
     * @return Entity
     */
    private function getReportForLawLocal(string $regon)
    {
        $searchedItems = $this->oNativeApi->DanePobierzPelnyRaport($regon, Report::REPORT_LOCAL_LAW);
        $oData         = $searchedItems[0];
        $oEntity       = new Entity($oData);

        return $oEntity;
    }

    /**
     * @param string $regon
     *
     * @return Entity
     */
    private function getReportForPhysicLocal(string $regon)
    {
        $searchedItems = $this->oNativeApi->DanePobierzPelnyRaport($regon, Report::REPORT_LOCAL_PHYSIC);
        $oData         = $searchedItems[0];
        $oEntity       = new Entity($oData);

        return $oEntity;
    }


}
