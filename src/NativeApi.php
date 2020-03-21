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
 * Time: 20:01
 */

declare(strict_types=1);

namespace Mrcnpdlk\Api\Regon;

use Mrcnpdlk\Api\Regon\Enum\ReportCompactEnum;
use Mrcnpdlk\Api\Regon\Enum\ReportFullEnum;
use Mrcnpdlk\Api\Regon\Enum\ValueEnum;
use Mrcnpdlk\Api\Regon\Exception\AuthException;
use Mrcnpdlk\Api\Regon\Exception\NotFoundException;
use Mrcnpdlk\Api\Regon\Sdk\DaneSzukajPodmiotyResponse;
use Mrcnpdlk\Api\Regon\Sdk\GetValueResponse;
use Mrcnpdlk\Api\Regon\Sdk\ZalogujResponse;
use Mrcnpdlk\Lib\Mapper;

class NativeApi
{
    /**
     * @var \Mrcnpdlk\Api\Regon\Config
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
     * @var \Mrcnpdlk\Api\Regon\RegonSoapClient
     */
    private $soap;

    /**
     * NativeApi constructor.
     *
     * @param \Mrcnpdlk\Api\Regon\Config $oConfig
     */
    public function __construct(Config $oConfig)
    {
        $this->mapper = new Mapper(null);
        $this->config = $oConfig;
    }

    /**
     * @param string                                  $regon
     * @param \Mrcnpdlk\Api\Regon\Enum\ReportFullEnum $report
     *
     * @throws \Mrcnpdlk\Lib\ModelMapException
     * @throws \Mrcnpdlk\Api\Regon\Exception
     * @throws \Mrcnpdlk\Api\Regon\Exception\AuthException
     * @throws \Mrcnpdlk\Api\Regon\Exception\InvalidResponse
     *
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
     * @param string                                     $date
     * @param \Mrcnpdlk\Api\Regon\Enum\ReportCompactEnum $report
     *
     * @throws \Mrcnpdlk\Lib\ModelMapException
     * @throws \Mrcnpdlk\Api\Regon\Exception
     * @throws \Mrcnpdlk\Api\Regon\Exception\AuthException
     * @throws \Mrcnpdlk\Api\Regon\Exception\InvalidResponse
     *
     * @return string[]
     */
    public function DanePobierzRaportZbiorczy(string $date, ReportCompactEnum $report): array
    {
        $this->Zaloguj();
        $this->soap->setHttpSidHeader($this->sid);
        $res = $this->soap->__soapCall('DanePobierzRaportZbiorczy', [
            [
                'pDataRaportu'  => $date,
                'pNazwaRaportu' => $report->getValue(),
            ],
        ]);

        return array_column($this->decodeResponse($res->DanePobierzRaportZbiorczyResult), 'regon');
    }

    /**
     * @param string|null $regon
     * @param string|null $nip
     * @param string|null $krs
     * @param string[]    $tRegon
     * @param string[]    $tNip
     * @param string[]    $tKrs
     *
     * @throws \Mrcnpdlk\Lib\ModelMapException
     * @throws \Mrcnpdlk\Api\Regon\Exception
     * @throws \Mrcnpdlk\Api\Regon\Exception\AuthException
     * @throws \Mrcnpdlk\Api\Regon\Exception\InvalidResponse
     *
     * @return \stdClass[]
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
            if (9 === strlen($r)) {
                $tRegon9zn[] = $r;
            } elseif (14 === strlen($r)) {
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

        return $this->decodeResponse($obj->response);
    }

    /**
     * @param \Mrcnpdlk\Api\Regon\Enum\ValueEnum $param
     *
     * @throws \Mrcnpdlk\Lib\ModelMapException
     * @throws \Mrcnpdlk\Api\Regon\Exception
     * @throws \Mrcnpdlk\Api\Regon\Exception\AuthException
     *
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
        if (null !== $this->soap) {
            $this->soap->__soapCall('Wyloguj', [['pIdentyfikatorSesji' => $this->sid]]);
        }
    }

    /**
     * @throws \Mrcnpdlk\Lib\ModelMapException
     * @throws \Mrcnpdlk\Api\Regon\Exception
     * @throws \Mrcnpdlk\Api\Regon\Exception\AuthException
     *
     * @return $this
     */
    public function Zaloguj(): self
    {
        if (null === $this->soap) {
            $this->reinitSoap();
        }
        if ('' === $this->sid) {
            $res = $this->soap->__soapCall('Zaloguj', [['pKluczUzytkownika' => $this->config->getPassword()]]);
            /** @var ZalogujResponse $obj */
            $obj = $this->mapper->jsonMap(ZalogujResponse::class, $res);
            if ('' === $obj->sid) {
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
     *
     * @return \stdClass[]
     */
    private function decodeResponse(string $response): array
    {
        $answer = [];
        $code   = (int)$this->GetValue(ValueEnum::KomunikatKod());
        if ($code > 0) {
            throw new NotFoundException($this->GetValue(ValueEnum::KomunikatTresc()), $code);
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
     * @throws \Mrcnpdlk\Api\Regon\Exception
     *
     * @return $this
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
