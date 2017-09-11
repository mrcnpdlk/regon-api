<?php

namespace mrcnpdlk\Regon;


use mrcnpdlk\Regon\Enum\Connection;

/**
 * Class NativeApi
 *
 * @package mrcnpdlk\Regon
 */
class NativeApi
{
    /**
     * @var Client
     */
    private $oClient;

    public function __construct(Client $oClient)
    {
        $this->oClient = $oClient;
        $this->oClient->login();
    }

    public function DanePobierzPelnyRaport(string $regon, string $reportName)
    {
        $res = $this->oClient->request('DanePobierzPelnyRaport',
            [
                'pRegon'        => $regon,
                'pNazwaRaportu' => $reportName,
            ]);

        return $this->decodeResponse($res);
    }

    /**
     * @param string $response xml string
     *
     * @return \SimpleXMLElement[]
     * @throws Exception\InvalidResponse
     * @todo Sparwdzic czy 'dane' istnieja
     */
    private function decodeResponse(string $response)
    {
        $answer = [];
        $code   = intval($this->GetValue(Connection::PARAM_GETVALUE_MESSAGE_CODE));
        if ($code) {
            throw new Exception\InvalidResponse($this->GetValue(Connection::PARAM_GETVALUE_MESSAGE), $code);
        }

        $res = new \SimpleXMLElement($response);

        foreach ($res->children() as $child) {
            $answer[] = $child;
        }

        return $answer;
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
            false
        );

        return $res;
    }

    /**
     * @param string|null $regon Regon
     * @param string|null $nip   NIP
     * @param string|null $krs   KRS
     * @param array       $tRegon
     * @param array       $tNip
     * @param array       $tKrs
     *
     * @return \SimpleXMLElement[]
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
            } else {
                if (strlen($r) === 14) {
                    $tRegon14zn[] = $r;
                }
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
     * Login
     *
     * @return $this
     */
    public function Zaloguj()
    {
        $this->oClient->login();

        return $this;
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
}
