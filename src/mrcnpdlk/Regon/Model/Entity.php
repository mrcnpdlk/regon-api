<?php

namespace mrcnpdlk\Regon\Model;


use mrcnpdlk\Regon\Model\Entity\Address;
use mrcnpdlk\Regon\Model\Entity\Register;

class Entity
{
    /**
     * Forma prawna - ID
     *
     * @var string
     */
    public $basicLegalFormId;
    /**
     * Forma prawna - nazwa
     *
     * @var string
     */
    public $basicLegalFormName;
    /**
     * Szczególna forma prawna - ID
     *
     * @var string
     */
    public $detailedLegalFormId;
    /**
     * Szczególna forma prawna - nazwa
     *
     * @var string
     */
    public $detailedLegalFormName;
    /**
     * Czy aktywna
     *
     * @var boolean
     */
    public $isActive;
    /**
     * @var string
     */
    public $regon;
    /**
     * @var string
     */
    public $nip;
    /**
     * @var string
     */
    public $krs;
    /**
     * Numer wpisu do CEIDG
     *
     * @var string
     */
    public $ceidg;
    /**
     * @var \mrcnpdlk\Regon\Model\Entity\Register
     */
    public $register;
    /**
     * Nazwa pełna
     *
     * @var string
     */
    public $name;
    /**
     * Nazwa skrócona
     *
     * @var string
     */
    public $nameShort;
    /**
     * @var Entity\Owner
     */
    public $owner;

    /**
     * @var \mrcnpdlk\Regon\Model\Entity\Date
     */
    public $history;

    /**
     * Liczba jednostek lokalnych/oddziałów
     *
     * @var int
     */
    public $departmentsCount;

    /**
     * Dane adresowe siedziby głównej
     *
     * @var Entity\Address
     */
    public $addressHead;
    /**
     * Dane adresowe korespondencji
     *
     * @var Entity\Address
     */
    public $addressCorr;
    /**
     * Telefon kontaktowy
     *
     * @var string
     */
    public $contactPhone;
    /**
     * Adres email
     *
     * @var string
     */
    public $contactEmail;
    /**
     * @var string[]
     */
    public $availableReports;


    public function __construct(\stdClass $oData = null)
    {
        if ($oData) {
            $this->name      = $oData->fiz_nazwa ?? $oData->praw_nazwa;
            $this->nameShort = $oData->fiz_nazwaSkrocona ?? $oData->praw_nazwaSkrocona;

            $oDate          = new Entity\Date();
            $oDate->create  = $oData->fiz_dataPowstania ?? $oData->praw_dataPowstania;
            $oDate->start   = $oData->fiz_dataRozpoczeciaDzialalnosci ?? $oData->praw_dataRozpoczeciaDzialalnosci;
            $oDate->add     = $oData->fiz_dataWpisuDoREGONDzialalnosci ?? $oData->praw_dataWpisuDoREGON;
            $oDate->suspend = $oData->fiz_dataZawieszeniaDzialalnosci ?? $oData->praw_dataZawieszeniaDzialalnosci;
            $oDate->resume  = $oData->fiz_dataWznowieniaDzialalnosci ?? $oData->praw_dataWznowieniaDzialalnosci;
            $oDate->change  = $oData->fiz_dataZaistnieniaZmianyDzialalnosci ?? $oData->praw_dataZaistnieniaZmiany;
            $oDate->close   = $oData->fiz_dataZakonczeniaDzialalnosci ?? $oData->praw_dataZakonczeniaDzialalnosci;
            $oDate->delete  = $oData->fiz_dataSkresleniazRegonDzialalnosci ?? $oData->praw_dataSkresleniazRegon;

            $this->history = $oDate;

            $this->contactPhone = $oData->fiz_numerTelefonu ?? $oData->praw_numerTelefonu;
            $this->contactEmail = $oData->fiz_adresEmail ?? $oData->praw_adresEmail;
            if (isset($oData->fizC_RodzajRejestru_Symbol) && ($oData->fizC_RodzajRejestru_Symbol === '151')) { //CEIDG
                $this->ceidg = $oData->fizC_numerwRejestrzeEwidencji;
            }
            if (isset($oData->fizC_numerwRejestrzeEwidencji)) {
                $this->register = new Register(
                    $oData->fizC_numerwRejestrzeEwidencji,
                    $oData->fizC_RodzajRejestru_Symbol,
                    $oData->fizC_RodzajRejestru_Nazwa,
                    $oData->fizC_dataWpisuDoRejestruEwidencji
                );
            }
            if (isset($oData->fizP_numerwRejestrzeEwidencji)) {
                $this->register = new Register(
                    $oData->fizP_numerwRejestrzeEwidencji,
                    $oData->fizP_RodzajRejestru_Symbol,
                    $oData->fizP_RodzajRejestru_Nazwa,
                    $oData->fizP_dataWpisuDoRejestruEwidencji
                );
            }

            if (isset($oData->praw_numerWrejestrzeEwidencji)) {
                $this->register = new Register(
                    $oData->praw_numerWrejestrzeEwidencji,
                    $oData->praw_rodzajRejestruEwidencji_Symbol,
                    $oData->praw_rodzajRejestruEwidencji_Nazwa,
                    null
                );
            }

            if ($oData->fiz_adSiedzWojewodztwo_Symbol) {
                $oHeadAddress                 = new Address();
                $oHeadAddress->countryId      = $oData->fiz_adSiedzKraj_Symbol;
                $oHeadAddress->countryName    = $oData->fiz_adSiedzKraj_Nazwa;
                $oHeadAddress->provinceId     = $oData->fiz_adSiedzWojewodztwo_Symbol;
                $oHeadAddress->provinceName   = $oData->fiz_adSiedzWojewodztwo_Nazwa;
                $oHeadAddress->districtId     = $oData->fiz_adSiedzPowiat_Symbol;
                $oHeadAddress->districtName   = $oData->fiz_adSiedzPowiat_Nazwa;
                $oHeadAddress->communeId      = substr($oData->fiz_adSiedzGmina_Symbol, 0, 2);
                $oHeadAddress->communeTypeId  = substr($oData->fiz_adSiedzGmina_Symbol, 2, 1);
                $oHeadAddress->communeName    = $oData->fiz_adSiedzGmina_Nazwa;
                $oHeadAddress->cityId         = $oData->fiz_adSiedzMiejscowosc_Symbol;
                $oHeadAddress->cityName       = $oData->fiz_adSiedzMiejscowosc_Nazwa;
                $oHeadAddress->postalCityId   = $oData->fiz_adSiedzMiejscowoscPoczty_Symbol;
                $oHeadAddress->postalCityName = $oData->fiz_adSiedzMiejscowoscPoczty_Nazwa;
                $oHeadAddress->postalCode     = $oData->fiz_adSiedzKodPocztowy;
                $oHeadAddress->streetId       = $oData->fiz_adSiedzUlica_Symbol;
                $oHeadAddress->streetName     = $oData->fiz_adSiedzUlica_Nazwa;
                $oHeadAddress->homeNr         = $oData->fiz_adSiedzNumerNieruchomosci;
                $oHeadAddress->flatNr         = $oData->fiz_adSiedzNumerLokalu;
                $this->addressHead            = $oHeadAddress;
            }
        }
    }
}