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
    public $regon9;
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
    /**
     * @var string[]
     */
    public $locals = [];
    /**
     * @var Entity
     */
    public $mainEntity;


    public function __construct(\stdClass $oData = null)
    {
        if ($oData) {
            $this->name      = $oData->fiz_nazwa ?? $oData->praw_nazwa ?? $oData->lokpraw_nazwa ?? $oData->lokfiz_nazwa ?? null;
            $this->nameShort = $oData->fiz_nazwaSkrocona ?? $oData->praw_nazwaSkrocona ?? null;

            $oDate          = new Entity\Date();
            $oDate->create  = $oData->fiz_dataPowstania ?? $oData->praw_dataPowstania ?? $oData->lokpraw_dataPowstania ?? $oData->lokfiz_dataPowstania ?? null;
            $oDate->start   = $oData->fiz_dataRozpoczeciaDzialalnosci ?? $oData->praw_dataRozpoczeciaDzialalnosci ?? $oData->lokpraw_dataRozpoczeciaDzialalnosci ?? $oData->lokfiz_dataRozpoczeciaDzialalnosci ?? null;
            $oDate->add     = $oData->fiz_dataWpisuDoREGONDzialalnosci ?? $oData->praw_dataWpisuDoREGON ?? $oData->lokpraw_dataWpisuDoREGON ?? $oData->lokfiz_dataWpisuDoREGON ?? null;
            $oDate->suspend = $oData->fiz_dataZawieszeniaDzialalnosci ?? $oData->praw_dataZawieszeniaDzialalnosci ?? $oData->lokpraw_dataZawieszeniaDzialalnosci ?? $oData->lokfiz_dataZawieszeniaDzialalnosci ?? null;
            $oDate->resume  = $oData->fiz_dataWznowieniaDzialalnosci ?? $oData->praw_dataWznowieniaDzialalnosci ?? $oData->lokpraw_dataWznowieniaDzialalnosci ?? $oData->lokfiz_dataWznowieniaDzialalnosci ?? null;
            $oDate->change  = $oData->fiz_dataZaistnieniaZmianyDzialalnosci ?? $oData->praw_dataZaistnieniaZmiany ?? $oData->lokpraw_dataZaistnieniaZmiany ?? $oData->lokfiz_dataZaistnieniaZmiany ?? null;
            $oDate->close   = $oData->fiz_dataZakonczeniaDzialalnosci ?? $oData->praw_dataZakonczeniaDzialalnosci ?? $oData->lokpraw_dataZakonczeniaDzialalnosci ?? $oData->lokfiz_dataZakonczeniaDzialalnosci ?? null;
            $oDate->delete  = $oData->fiz_dataSkresleniazRegonDzialalnosci ?? $oData->praw_dataSkresleniazRegon ?? $oData->lokpraw_dataSkresleniazRegon ?? $oData->lokfiz_dataSkresleniazRegon ?? null;

            $this->history = $oDate;

            $this->contactPhone = $oData->fiz_numerTelefonu ?? $oData->praw_numerTelefonu ?? null;
            $this->contactEmail = $oData->fiz_adresEmail ?? $oData->praw_adresEmail ?? null;

            /**
             * rejestr ewidencji
             */
            if (isset($oData->fizC_RodzajRejestru_Symbol)) {
                $this->register = new Register(
                    $oData->fizC_numerwRejestrzeEwidencji,
                    $oData->fizC_RodzajRejestru_Symbol,
                    $oData->fizC_RodzajRejestru_Nazwa,
                    $oData->fizC_dataWpisuDoRejestruEwidencji
                );
            }
            if (isset($oData->fizP_RodzajRejestru_Symbol)) {
                $this->register = new Register(
                    $oData->fizP_numerwRejestrzeEwidencji,
                    $oData->fizP_RodzajRejestru_Symbol,
                    $oData->fizP_RodzajRejestru_Nazwa,
                    $oData->fizP_dataWpisuDoRejestruEwidencji
                );
            }
            if (isset($oData->praw_rodzajRejestruEwidencji_Symbol)) {
                $this->register = new Register(
                    $oData->praw_numerWrejestrzeEwidencji ?? $oData->lokpraw_numerWrejestrzeEwidencji ?? null,
                    $oData->praw_rodzajRejestruEwidencji_Symbol,
                    $oData->praw_rodzajRejestruEwidencji_Nazwa,
                    $oData->lokpraw_dataWpisuDoRejestruEwidencji ?? null
                );
            }
            if (isset($oData->lokfiz_RodzajRejestru_Symbol)) {
                $this->register = new Register(
                    $oData->lokfiz_numerwRejestrzeEwidencji,
                    $oData->lokfiz_RodzajRejestru_Symbol,
                    $oData->lokfiz_RodzajRejestru_Nazwa,
                    $oData->lokfiz_dataWpisuDoRejestruEwidencji
                );
            }

            /**
             * adres siedziby
             */
            if (isset($oData->fiz_adSiedzWojewodztwo_Symbol)) {
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
            if (isset($oData->lokfiz_adSiedzWojewodztwo_Symbol)) {
                $oHeadAddress                 = new Address();
                $oHeadAddress->countryId      = $oData->lokfiz_adSiedzKraj_Symbol;
                $oHeadAddress->countryName    = $oData->lokfiz_adSiedzKraj_Nazwa;
                $oHeadAddress->provinceId     = $oData->lokfiz_adSiedzWojewodztwo_Symbol;
                $oHeadAddress->provinceName   = $oData->lokfiz_adSiedzWojewodztwo_Nazwa;
                $oHeadAddress->districtId     = $oData->lokfiz_adSiedzPowiat_Symbol;
                $oHeadAddress->districtName   = $oData->lokfiz_adSiedzPowiat_Nazwa;
                $oHeadAddress->communeId      = substr($oData->lokfiz_adSiedzGmina_Symbol, 0, 2);
                $oHeadAddress->communeTypeId  = substr($oData->lokfiz_adSiedzGmina_Symbol, 2, 1);
                $oHeadAddress->communeName    = $oData->lokfiz_adSiedzGmina_Nazwa;
                $oHeadAddress->cityId         = $oData->lokfiz_adSiedzMiejscowosc_Symbol;
                $oHeadAddress->cityName       = $oData->lokfiz_adSiedzMiejscowosc_Nazwa;
                $oHeadAddress->postalCityId   = $oData->lokfiz_adSiedzMiejscowoscPoczty_Symbol;
                $oHeadAddress->postalCityName = $oData->lokfiz_adSiedzMiejscowoscPoczty_Nazwa;
                $oHeadAddress->postalCode     = $oData->lokfiz_adSiedzKodPocztowy;
                $oHeadAddress->streetId       = $oData->lokfiz_adSiedzUlica_Symbol;
                $oHeadAddress->streetName     = $oData->lokfiz_adSiedzUlica_Nazwa;
                $oHeadAddress->homeNr         = $oData->lokfiz_adSiedzNumerNieruchomosci;
                $oHeadAddress->flatNr         = $oData->lokfiz_adSiedzNumerLokalu;
                $this->addressHead            = $oHeadAddress;
            }
            if (isset($oData->praw_adSiedzWojewodztwo_Symbol)) {
                $oHeadAddress                 = new Address();
                $oHeadAddress->countryId      = $oData->praw_adSiedzKraj_Symbol;
                $oHeadAddress->countryName    = $oData->praw_adSiedzKraj_Nazwa;
                $oHeadAddress->provinceId     = $oData->praw_adSiedzWojewodztwo_Symbol;
                $oHeadAddress->provinceName   = $oData->praw_adSiedzWojewodztwo_Nazwa;
                $oHeadAddress->districtId     = $oData->praw_adSiedzPowiat_Symbol;
                $oHeadAddress->districtName   = $oData->praw_adSiedzPowiat_Nazwa;
                $oHeadAddress->communeId      = substr($oData->praw_adSiedzGmina_Symbol, 0, 2);
                $oHeadAddress->communeTypeId  = substr($oData->praw_adSiedzGmina_Symbol, 2, 1);
                $oHeadAddress->communeName    = $oData->praw_adSiedzGmina_Nazwa;
                $oHeadAddress->cityId         = $oData->praw_adSiedzMiejscowosc_Symbol;
                $oHeadAddress->cityName       = $oData->praw_adSiedzMiejscowosc_Nazwa;
                $oHeadAddress->postalCityId   = $oData->praw_adSiedzMiejscowoscPoczty_Symbol;
                $oHeadAddress->postalCityName = $oData->praw_adSiedzMiejscowoscPoczty_Nazwa;
                $oHeadAddress->postalCode     = $oData->praw_adSiedzKodPocztowy;
                $oHeadAddress->streetId       = $oData->praw_adSiedzUlica_Symbol;
                $oHeadAddress->streetName     = $oData->praw_adSiedzUlica_Nazwa;
                $oHeadAddress->homeNr         = $oData->praw_adSiedzNumerNieruchomosci;
                $oHeadAddress->flatNr         = $oData->praw_adSiedzNumerLokalu;
                $this->addressHead            = $oHeadAddress;
            }
            if (isset($oData->lokpraw_adSiedzWojewodztwo_Symbol)) {
                $oHeadAddress                 = new Address();
                $oHeadAddress->countryId      = $oData->lokpraw_adSiedzKraj_Symbol;
                $oHeadAddress->countryName    = $oData->lokpraw_adSiedzKraj_Nazwa;
                $oHeadAddress->provinceId     = $oData->lokpraw_adSiedzWojewodztwo_Symbol;
                $oHeadAddress->provinceName   = $oData->lokpraw_adSiedzWojewodztwo_Nazwa;
                $oHeadAddress->districtId     = $oData->lokpraw_adSiedzPowiat_Symbol;
                $oHeadAddress->districtName   = $oData->lokpraw_adSiedzPowiat_Nazwa;
                $oHeadAddress->communeId      = substr($oData->lokpraw_adSiedzGmina_Symbol, 0, 2);
                $oHeadAddress->communeTypeId  = substr($oData->lokpraw_adSiedzGmina_Symbol, 2, 1);
                $oHeadAddress->communeName    = $oData->lokpraw_adSiedzGmina_Nazwa;
                $oHeadAddress->cityId         = $oData->lokpraw_adSiedzMiejscowosc_Symbol;
                $oHeadAddress->cityName       = $oData->lokpraw_adSiedzMiejscowosc_Nazwa;
                $oHeadAddress->postalCityId   = $oData->lokpraw_adSiedzMiejscowoscPoczty_Symbol;
                $oHeadAddress->postalCityName = $oData->lokpraw_adSiedzMiejscowoscPoczty_Nazwa;
                $oHeadAddress->postalCode     = $oData->lokpraw_adSiedzKodPocztowy;
                $oHeadAddress->streetId       = $oData->lokpraw_adSiedzUlica_Symbol;
                $oHeadAddress->streetName     = $oData->lokpraw_adSiedzUlica_Nazwa;
                $oHeadAddress->homeNr         = $oData->lokpraw_adSiedzNumerNieruchomosci;
                $oHeadAddress->flatNr         = $oData->lokpraw_adSiedzNumerLokalu;
                $this->addressHead            = $oHeadAddress;
            }
            if (isset($oData->praw_adKorWojewodztwo_Symbol)) {
                $oHeadAddress                 = new Address();
                $oHeadAddress->countryId      = $oData->praw_adKorKraj_Symbol;
                $oHeadAddress->countryName    = $oData->praw_adKorKraj_Nazwa;
                $oHeadAddress->provinceId     = $oData->praw_adKorWojewodztwo_Symbol;
                $oHeadAddress->provinceName   = $oData->praw_adKorWojewodztwo_Nazwa;
                $oHeadAddress->districtId     = $oData->praw_adKorPowiat_Symbol;
                $oHeadAddress->districtName   = $oData->praw_adKorPowiat_Nazwa;
                $oHeadAddress->communeId      = substr($oData->praw_adKorGmina_Symbol, 0, 2);
                $oHeadAddress->communeTypeId  = substr($oData->praw_adKorGmina_Symbol, 2, 1);
                $oHeadAddress->communeName    = $oData->praw_adKorGmina_Nazwa;
                $oHeadAddress->cityId         = $oData->praw_adKorMiejscowosc_Symbol;
                $oHeadAddress->cityName       = $oData->praw_adKorMiejscowosc_Nazwa;
                $oHeadAddress->postalCityId   = $oData->praw_adKorMiejscowoscPoczty_Symbol;
                $oHeadAddress->postalCityName = $oData->praw_adKorMiejscowoscPoczty_Nazwa;
                $oHeadAddress->postalCode     = $oData->praw_adKorKodPocztowy;
                $oHeadAddress->streetId       = $oData->praw_adKorUlica_Symbol;
                $oHeadAddress->streetName     = $oData->praw_adKorUlica_Nazwa;
                $oHeadAddress->homeNr         = $oData->praw_adKorNumerNieruchomosci;
                $oHeadAddress->flatNr         = $oData->praw_adKorNumerLokalu;
                $this->addressCorr            = $oHeadAddress;
            }

            $this->nip = $oData->praw_nip ?? $oData->lokpraw_nip ?? null;

            if (in_array($this->register->typeId ?? null, ['138', '139'])) {
                $this->krs = $this->register->nr;
            } elseif (in_array($this->register->typeId ?? null, ['151'])) {
                $this->ceidg = $this->register->nr;
            }

            $this->regon  = $oData->fiz_regon9 ?? $oData->praw_regon14 ?? $oData->lokpraw_regon14 ?? $oData->lokfiz_regon14 ?? null;
            $this->regon9 = substr($this->regon, 0, 9);

            $this->isActive = $this->history->isActive();

            $this->basicLegalFormId      = $oData->praw_podstawowaFormaPrawna_Symbol ?? null;
            $this->basicLegalFormName    = $oData->praw_podstawowaFormaPrawna_Nazwa ?? null;
            $this->detailedLegalFormId   = $oData->praw_szczegolnaFormaPrawna_Symbol ?? null;
            $this->detailedLegalFormName = $oData->praw_szczegolnaFormaPrawna_Nazwa ?? null;
            $this->departmentsCount      = $oData->praw_jednostekLokalnych ?? $oData->lokpraw_dzialalnosci ?? $oData->lokfiz_dzialalnosci ?? null;
        }
    }
}
