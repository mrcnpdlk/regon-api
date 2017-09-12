<?php

namespace mrcnpdlk\Regon;

use mrcnpdlk\Regon\Enum\Report;
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

    public function getReport(string $regon)
    {
        $res           = null;
        $oSearchResult = $this->getByRegon($regon);
        switch ($oSearchResult->getTypeId()) {
            case 'P':
                break;
            case 'F':
                switch ($oSearchResult->getSilosId()) {
                    case '1':
                        $res = $this->oNativeApi->DanePobierzPelnyRaport($regon, Report::REPORT_ACTIVITY_PHYSIC_CEIDG);
                        break;
                    case '2':
                        $res = $this->oNativeApi->DanePobierzPelnyRaport($regon, Report::REPORT_ACTIVITY_PHYSIC_AGRO);
                        break;
                    default:
                        $res = $this->oNativeApi->DanePobierzPelnyRaport($regon, Report::REPORT_ACTIVITY_PHYSIC_OTHER);
                        break;
                }
                break;
            case 'LP':
                break;
            case 'LF':
                break;

        }

        return $res;
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
}
