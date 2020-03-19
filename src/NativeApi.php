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
 * Time: 20:01
 */

namespace mrcnpdlk\Regon;


use Mrcnpdlk\Lib\Mapper;
use mrcnpdlk\Regon\Enum\ReportFullEnum;
use mrcnpdlk\Regon\Enum\ValueEnum;
use mrcnpdlk\Regon\Exception\AuthException;
use mrcnpdlk\Regon\Exception\NotFound;
use mrcnpdlk\Regon\Sdk\DaneSzukajPodmiotyResponse;
use mrcnpdlk\Regon\Sdk\GetValueResponse;
use mrcnpdlk\Regon\Sdk\PodmiotModel;
use mrcnpdlk\Regon\Sdk\ZalogujResponse;

class NativeApi
{

    /**
     * @var \mrcnpdlk\Regon\Config
     */
    private $config;
    /**
     * @var \Mrcnpdlk\Lib\Mapper
     */
    private $mapper;
    /**
     * Token API
     *
     * @var string
     */
    private $sid = '';
    /**
     * @var \mrcnpdlk\Regon\RegonSoapClient
     */
    private $soap;

    /**
     * NativeApi constructor.
     *
     * @param \mrcnpdlk\Regon\Config $oConfig
     *
     */
    public function __construct(Config $oConfig)
    {
        $this->mapper = new Mapper(null);
        $this->config = $oConfig;

    }

    /**
     * @param string                              $regon
     * @param \mrcnpdlk\Regon\Enum\ReportFullEnum $report
     *
     * @throws \Mrcnpdlk\Lib\ModelMapException
     * @throws \mrcnpdlk\Regon\Exception
     * @throws \mrcnpdlk\Regon\Exception\AuthException
     * @throws \mrcnpdlk\Regon\Exception\InvalidResponse
     * @return \stdClass[]
     */
    public function DanePobierzPelnyRaport(string $regon, ReportFullEnum $report): array
    {
        $this->Zaloguj();
        $this->soap->setHttpSidHeader($this->sid);
        $res = $this->soap->__soapCall('DanePobierzPelnyRaport', [
            [
                'pRegon'        => $regon,
                'pNazwaRaportu' => $report->getValue(),
            ],
        ]);

        return $this->decodeResponse($res->DanePobierzPelnyRaportResult);
    }

    /**
     * @param string|null $regon
     * @param string|null $nip
     * @param string|null $krs
     * @param array       $tRegon
     * @param array       $tNip
     * @param array       $tKrs
     *
     * @throws \Mrcnpdlk\Lib\ModelMapException
     * @throws \mrcnpdlk\Regon\Exception
     * @throws \mrcnpdlk\Regon\Exception\AuthException
     * @throws \mrcnpdlk\Regon\Exception\InvalidResponse
     * @return \mrcnpdlk\Regon\Sdk\PodmiotModel[]
     */
    public function DaneSzukajPodmioty(
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


        $this->Zaloguj();
        $this->soap->setHttpSidHeader($this->sid);
        $res = $this->soap->__soapCall('DaneSzukajPodmioty', [
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
            ],
        ]);

        /** @var DaneSzukajPodmiotyResponse $obj */
        $obj = $this->mapper->jsonMap(DaneSzukajPodmiotyResponse::class, $res);

        $tList = $this->decodeResponse($obj->response);
        var_dump($tList);
        /** @var PodmiotModel[] $tResp */
        $tResp = $this->mapper->jsonMapArray(PodmiotModel::class, $tList);

        return $tResp;
    }

    /**
     * @param \mrcnpdlk\Regon\Enum\ValueEnum $param
     *
     * @throws \Mrcnpdlk\Lib\ModelMapException
     * @throws \mrcnpdlk\Regon\Exception
     * @throws \mrcnpdlk\Regon\Exception\AuthException
     * @return mixed
     */
    public function GetValue(ValueEnum $param)
    {
        $this->Zaloguj();
        $this->soap->setHttpSidHeader($this->sid);
        $res = $this->soap->__soapCall('GetValue', [['pNazwaParametru' => $param->getValue()]]);
        /** @var GetValueResponse $obj */
        $obj = $this->mapper->jsonMap(GetValueResponse::class, $res);

        return $obj->response;
    }

    /**
     * Wylogowywanie
     */
    public function Wyloguj(): void
    {
        $this->soap->__soapCall('Wyloguj', [['pIdentyfikatorSesji' => $this->sid]]);
    }

    /**
     * @throws \Mrcnpdlk\Lib\ModelMapException
     * @throws \mrcnpdlk\Regon\Exception
     * @throws \mrcnpdlk\Regon\Exception\AuthException
     * @return $this
     */
    public function Zaloguj(): self
    {
        if ($this->soap === null) {
            $this->reinitSoap();
        }
        if ($this->sid === '') {
            $res = $this->soap->__soapCall('Zaloguj', [['pKluczUzytkownika' => $this->config->getPassword()]]);
            /** @var ZalogujResponse $obj */
            $obj = $this->mapper->jsonMap(ZalogujResponse::class, $res);
            if ($obj->sid === '') {
                throw new AuthException('Niepoprawne dane autoryzacyjne');
            }
            $this->sid = $obj->sid;
        }


        return $this;
    }

    /**
     * Destruktor
     */
    public function __destruct()
    {
        $this->Wyloguj();
    }

    /**
     * @param string $response xml string
     *
     * @throws Exception\InvalidResponse
     * @throws \Exception
     * @return \stdClass[]
     */
    private function decodeResponse(string $response): array
    {
        $answer = [];
        $code   = (int)$this->GetValue(ValueEnum::KomunikatKod());
        if ($code > 0) {
            throw new NotFound($this->GetValue(ValueEnum::KomunikatTresc()), $code);
        }

        $res = new \SimpleXMLElement($response);

        foreach ($res->children() as $child) {
            $item = json_decode(json_encode($child), false);
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
     * @throws \mrcnpdlk\Regon\Exception
     * @return  $this
     */
    private function reinitSoap(): self
    {
        $options = [
            'soap_version' => \SOAP_1_2,
            'trace'        => true,
            'style'        => \SOAP_DOCUMENT,
            'location'     => $this->config->getLocation(),
            'features'     => 1,
        ];
        try {
            $this->soap = new RegonSoapClient(
                $this->config->getWsdl(),
                $this->config->getLocation(),
                $options);
        } catch (\SoapFault $e) {
            throw new Exception('Nie udało utworzyć się instancji SoapClient', 1, $e);
        }

        return $this;
    }
}
