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
 * Date: 20.03.2020
 * Time: 00:04
 */

namespace Mrcnpdlk\Api\Regon\Sdk;

class EntityModel
{
    /**
     * @var string|null
     */
    public $regon;
    /**
     * @var string|null
     */
    public $nip;
    /**
     * @var string|null
     */
    public $nipStatus;
    /**
     * @var string|null
     */
    public $name;
    /**
     * @var string|null
     */
    public $nameShort;
    /**
     * @var string|null
     */
    public $ownerName;
    /**
     * @var string|null
     */
    public $ownerSurname;
    /**
     * Numer w rejestrze ewidencji
     *
     * @var string|null
     */
    public $registerNr;
    /**
     * Data wpisu do rejestru ewidencji
     *
     * @var string|null
     */
    public $dateRegisterCreate;
    /**
     * Data skreślenia z rejestru ewidencji
     *
     * @var string|null
     */
    public $dateRegisterDelete;
    /**
     * Data powstania
     *
     * @var string|null
     */
    public $dateCreate;
    /**
     * Data rozpoczęcia działalności
     *
     * @var string|null
     */
    public $dateStart;
    /**
     * Data wpisu do REGON
     *
     * @var string|null
     */
    public $dateRegonCreate;
    /**
     * Data zawieszenia działalności
     *
     * @var string|null
     */
    public $dateSuspend;
    /**
     * Data wznowienia działalności
     *
     * @var string|null
     */
    public $dateResume;
    /**
     * Data zainstnienia zmioany
     *
     * @var string|null
     */
    public $dateChange;
    /**
     * Data zakończenia działalności
     *
     * @var string|null
     */
    public $dateEnd;
    /**
     * Data skreślenia z REGON
     *
     * @var string|null
     */
    public $dateRegonDelete;
    /**
     * Data orzeczenia o upadłości
     *
     * @var string|null
     */
    public $dateBankruptcy;
    /**
     * Data zakończenia postępowania upadłościowego
     *
     * @var string|null
     */
    public $dateBankruptcyProcessEnd;
    /**
     * @var string|null
     */
    public $addressHeadCountryId;
    /**
     * @var string|null
     */
    public $addressHeadVoivodshipId;
    /**
     * @var string|null
     */
    public $addressHeadPoviatId;
    /**
     * @var string|null
     */
    public $addressHeadCommuneId;
    /**
     * @var string|null
     */
    public $addressHeadPostalCode;
    /**
     * @var string|null
     */
    public $addressHeadPostalCityId;
    /**
     * @var string|null
     */
    public $addressHeadCityId;
    /**
     * @var string|null
     */
    public $addressHeadStreetId;
    /**
     * @var string|null
     */
    public $addressHeadHomeNr;
    /**
     * @var string|null
     */
    public $addressHeadFlatNr;
    /**
     * Nietypowe miejsce lokalizacji
     *
     * @var string|null
     */
    public $addressAlternative;
    /**
     * @var string|null
     */
    public $contactPhone;
    /**
     * @var string|null
     */
    public $contactPhoneInternal;
    /**
     * @var string|null
     */
    public $contactFax;
    /**
     * @var string|null
     */
    public $contactEmail;
    /**
     * @var string|null
     */
    public $website;
    /**
     * @var string|null
     */
    public $addressHeadCountryName;
    /**
     * @var string|null
     */
    public $addressHeadVoivodshipName;
    /**
     * @var string|null
     */
    public $addressHeadPoviatName;
    /**
     * @var string|null
     */
    public $addressHeadCommuneName;
    /**
     * @var string|null
     */
    public $addressHeadCityName;
    /**
     * @var string|null
     */
    public $addressHeadPostalCityName;
    /**
     * @var string|null
     */
    public $addressHeadStreetName;
    /**
     * @var string|null
     */
    public $basicLegalFormId;
    /**
     * @var string|null
     */
    public $basicLegalFormName;
    /**
     * @var string|null
     */
    public $detailLegalFormId;
    /**
     * @var string|null
     */
    public $detailLegalFormName;
    /**
     * @var string|null
     */
    public $financialFormId;
    /**
     * Forma finansowania
     *
     * @var string|null
     */
    public $financialFormName;
    /**
     * @var string|null
     */
    public $propertyFormId;
    /**
     * Forma własności
     *
     * @var string|null
     */
    public $propertyFormName;
    /**
     * @var string|null
     */
    public $foundingBodyId;
    /**
     * Organ założycielski
     *
     * @var string|null
     */
    public $foundingBodyName;
    /**
     * @var string|null
     */
    public $registerId;
    /**
     * Nazwa organu rejestrowego
     *
     * @var string|null
     */
    public $registerName;
    /**
     * @var string|null
     */
    public $registerTypeId;
    /**
     * Rodzaj rejestru ewidencji
     *
     * @var string|null
     */
    public $registerTypeName;
    /**
     * @var int|null
     */
    public $localCount;
    /**
     * @var string|null
     */
    public $krs;
    /**
     * @var string|null
     */
    public $ceidg;
    /**
     * @var false|string
     */
    public $regon9;

    /**
     * @param string|null $addressHeadCommuneName
     *
     * @return EntityModel
     */
    public function setFizAdSiedzGminaNazwa(?string $addressHeadCommuneName): EntityModel
    {
        $this->addressHeadCommuneName = $addressHeadCommuneName;

        return $this;
    }

    /**
     * @param string|null $addressHeadCommuneId
     *
     * @return EntityModel
     */
    public function setFizAdSiedzGminaSymbol(?string $addressHeadCommuneId): EntityModel
    {
        $this->addressHeadCommuneId = $addressHeadCommuneId;

        return $this;
    }

    /**
     * @param string|null $addressHeadPostalCode
     *
     * @return EntityModel
     */
    public function setFizAdSiedzKodPocztowy(?string $addressHeadPostalCode): EntityModel
    {
        $this->addressHeadPostalCode = $addressHeadPostalCode;

        return $this;
    }

    /**
     * @param string|null $addressHeadCountryName
     *
     * @return EntityModel
     */
    public function setFizAdSiedzKrajNazwa(?string $addressHeadCountryName): EntityModel
    {
        $this->addressHeadCountryName = $addressHeadCountryName;

        return $this;
    }

    /**
     * @param string|null $addressHeadCountryId
     *
     * @return EntityModel
     */
    public function setFizAdSiedzKrajSymbol(?string $addressHeadCountryId): EntityModel
    {
        $this->addressHeadCountryId = $addressHeadCountryId;

        return $this;
    }

    /**
     * @param string|null $addressHeadCityName
     *
     * @return EntityModel
     */
    public function setFizAdSiedzMiejscowoscNazwa(?string $addressHeadCityName): EntityModel
    {
        $this->addressHeadCityName = $addressHeadCityName;

        return $this;
    }

    /**
     * @param string|null $addressHeadPostalCityName
     *
     * @return EntityModel
     */
    public function setFizAdSiedzMiejscowoscPocztyNazwa(?string $addressHeadPostalCityName): EntityModel
    {
        $this->addressHeadPostalCityName = $addressHeadPostalCityName;

        return $this;
    }

    /**
     * @param string|null $addressHeadPostalCityId
     *
     * @return EntityModel
     */
    public function setFizAdSiedzMiejscowoscPocztySymbol(?string $addressHeadPostalCityId): EntityModel
    {
        $this->addressHeadPostalCityId = $addressHeadPostalCityId;

        return $this;
    }

    /**
     * @param string|null $addressHeadCityId
     *
     * @return EntityModel
     */
    public function setFizAdSiedzMiejscowoscSymbol(?string $addressHeadCityId): EntityModel
    {
        $this->addressHeadCityId = $addressHeadCityId;

        return $this;
    }

    /**
     * @param string|null $addressAlternative
     *
     * @return EntityModel
     */
    public function setFizAdSiedzNietypoweMiejsceLokalizacji(?string $addressAlternative): EntityModel
    {
        $this->addressAlternative = $addressAlternative;

        return $this;
    }

    /**
     * @param string|null $addressHeadFlatNr
     *
     * @return EntityModel
     */
    public function setFizAdSiedzNumerLokalu(?string $addressHeadFlatNr): EntityModel
    {
        $this->addressHeadFlatNr = $addressHeadFlatNr;

        return $this;
    }

    /**
     * @param string|null $addressHeadHomeNr
     *
     * @return EntityModel
     */
    public function setFizAdSiedzNumerNieruchomosci(?string $addressHeadHomeNr): EntityModel
    {
        $this->addressHeadHomeNr = $addressHeadHomeNr;

        return $this;
    }

    /**
     * @param string|null $addressHeadPoviatName
     *
     * @return EntityModel
     */
    public function setFizAdSiedzPowiatNazwa(?string $addressHeadPoviatName): EntityModel
    {
        $this->addressHeadPoviatName = $addressHeadPoviatName;

        return $this;
    }

    /**
     * @param string|null $addressHeadPoviatId
     *
     * @return EntityModel
     */
    public function setFizAdSiedzPowiatSymbol(?string $addressHeadPoviatId): EntityModel
    {
        $this->addressHeadPoviatId = $addressHeadPoviatId;

        return $this;
    }

    /**
     * @param string|null $addressHeadStreetName
     *
     * @return EntityModel
     */
    public function setFizAdSiedzUlicaNazwa(?string $addressHeadStreetName): EntityModel
    {
        $this->addressHeadStreetName = $addressHeadStreetName;

        return $this;
    }

    /**
     * @param string|null $addressHeadStreetId
     *
     * @return EntityModel
     */
    public function setFizAdSiedzUlicaSymbol(?string $addressHeadStreetId): EntityModel
    {
        $this->addressHeadStreetId = $addressHeadStreetId;

        return $this;
    }

    /**
     * @param string|null $addressHeadVoivodshipName
     *
     * @return EntityModel
     */
    public function setFizAdSiedzWojewodztwoNazwa(?string $addressHeadVoivodshipName): EntityModel
    {
        $this->addressHeadVoivodshipName = $addressHeadVoivodshipName;

        return $this;
    }

    /**
     * @param string|null $addressHeadVoivodshipId
     *
     * @return EntityModel
     */
    public function setFizAdSiedzWojewodztwoSymbol(?string $addressHeadVoivodshipId): EntityModel
    {
        $this->addressHeadVoivodshipId = $addressHeadVoivodshipId;

        return $this;
    }

    /**
     * @param string|null $contactEmail
     *
     * @return EntityModel
     */
    public function setFizAdresEmail(?string $contactEmail): EntityModel
    {
        $this->contactEmail = $contactEmail;

        return $this;
    }

    /**
     * @param string|null $praw_adresStronyinternetowej
     *
     * @return EntityModel
     */
    public function setFizAdresStronyinternetowej(?string $praw_adresStronyinternetowej): EntityModel
    {
        $this->website = $praw_adresStronyinternetowej;

        return $this;
    }

    /**
     * @param string|null $dateRegisterDelete
     *
     * @return EntityModel
     */
    public function setFizCDataSkresleniaZRejestruEwidencji(?string $dateRegisterDelete): EntityModel
    {
        $this->dateRegisterDelete = $dateRegisterDelete;

        return $this;
    }

    /**
     * @param string|null $dateRegisterCreate
     *
     * @return EntityModel
     */
    public function setFizCDataWpisuDoRejestruEwidencji(?string $dateRegisterCreate): EntityModel
    {
        $this->dateRegisterCreate = $dateRegisterCreate;

        return $this;
    }

    /**
     * @param string|null $registerNr
     *
     * @return EntityModel
     */
    public function setFizCNumerWRejestrzeEwidencji(?string $registerNr): EntityModel
    {
        $this->registerNr = $registerNr;

        return $this;
    }

    /**
     * @param string|null $registerName
     *
     * @return EntityModel
     */
    public function setFizCOrganRejestrowyNazwa(?string $registerName): EntityModel
    {
        $this->registerName = $registerName;

        return $this;
    }

    /**
     * @param string|null $registerId
     *
     * @return EntityModel
     */
    public function setFizCOrganRejestrowySymbol(?string $registerId): EntityModel
    {
        $this->registerId = $registerId;

        return $this;
    }

    /**
     * @param string|null $registerTypeName
     *
     * @return EntityModel
     */
    public function setFizCRodzajRejestruNazwa(?string $registerTypeName): EntityModel
    {
        $this->registerTypeName = $registerTypeName;

        return $this;
    }

    /**
     * @param string|null $registerTypeId
     *
     * @return EntityModel
     */
    public function setFizCRodzajRejestruSymbol(?string $registerTypeId): EntityModel
    {
        $this->registerTypeId = $registerTypeId;

        return $this;
    }

    /**
     * @param string|null $dateBankruptcy
     *
     * @return EntityModel
     */
    public function setFizDataOrzeczeniaOUpadlosci(?string $dateBankruptcy): EntityModel
    {
        $this->dateBankruptcy = $dateBankruptcy;

        return $this;
    }

    /**
     * @param string|null $createDate
     *
     * @return EntityModel
     */
    public function setFizDataPowstania(?string $createDate): EntityModel
    {
        $this->dateCreate = $createDate;

        return $this;
    }

    /**
     * @param string|null $dateStart
     *
     * @return EntityModel
     */
    public function setFizDataRozpoczeciaDzialalnosci(?string $dateStart): EntityModel
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * @param string|null $dateRegonDelete
     *
     * @return EntityModel
     */
    public function setFizDataSkresleniaPodmiotuZRegon(?string $dateRegonDelete): EntityModel
    {
        $this->dateRegonDelete = $dateRegonDelete;

        return $this;
    }

    /**
     * @param string|null $dateRegonDelete
     *
     * @return EntityModel
     */
    public function setFizDataSkresleniaZRegon(?string $dateRegonDelete): EntityModel
    {
        $this->dateRegonDelete = $dateRegonDelete;

        return $this;
    }

    /**
     * @param string|null $dateRegonCreate
     *
     * @return EntityModel
     */
    public function setFizDataWpisuDoRegon(?string $dateRegonCreate): EntityModel
    {
        $this->dateRegonCreate = $dateRegonCreate;

        return $this;
    }

    /**
     * @param string|null $dateRegonCreate
     *
     * @return EntityModel
     */
    public function setFizDataWpisuDzialalnosciDoRegon(?string $dateRegonCreate): EntityModel
    {
        $this->dateRegonCreate = $dateRegonCreate;

        return $this;
    }

    /**
     * @param string|null $dateRegonCreate
     *
     * @return EntityModel
     */
    public function setFizDataWpisuPodmiotuDoRegon(?string $dateRegonCreate): EntityModel
    {
        $this->dateRegonCreate = $dateRegonCreate;

        return $this;
    }

    /**
     * @param string|null $dateResume
     *
     * @return EntityModel
     */
    public function setFizDataWznowieniaDzialalnosci(?string $dateResume): EntityModel
    {
        $this->dateResume = $dateResume;

        return $this;
    }

    /**
     * @param string|null $dateChange
     *
     * @return EntityModel
     */
    public function setFizDataZaistnieniaZmiany(?string $dateChange): EntityModel
    {
        $this->dateChange = $dateChange;

        return $this;
    }

    /**
     * @param string|null $dateEnd
     *
     * @return EntityModel
     */
    public function setFizDataZakonczeniaDzialalnosci(?string $dateEnd): EntityModel
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * @param string|null $dateBankruptcyProcess
     *
     * @return EntityModel
     */
    public function setFizDataZakonczeniaPostepowaniaUpadlosciowego(?string $dateBankruptcyProcess): EntityModel
    {
        $this->dateBankruptcyProcessEnd = $dateBankruptcyProcess;

        return $this;
    }

    /**
     * @param string|null $dateSuspend
     *
     * @return EntityModel
     */
    public function setFizDataZawieszeniaDzialalnosci(?string $dateSuspend): EntityModel
    {
        $this->dateSuspend = $dateSuspend;

        return $this;
    }

    /**
     * @param string|null $financialFormName
     *
     * @return EntityModel
     */
    public function setFizFormaFinansowaniaNazwa(?string $financialFormName): EntityModel
    {
        $this->financialFormName = $financialFormName;

        return $this;
    }

    /**
     * @param string|null $financialFormId
     *
     * @return EntityModel
     */
    public function setFizFormaFinansowaniaSymbol(?string $financialFormId): EntityModel
    {
        $this->financialFormId = $financialFormId;

        return $this;
    }

    /**
     * @param string|null $propertyFormName
     *
     * @return EntityModel
     */
    public function setFizFormaWlasnosciNazwa(?string $propertyFormName): EntityModel
    {
        $this->propertyFormName = $propertyFormName;

        return $this;
    }

    /**
     * @param string|null $propertyFormId
     *
     * @return EntityModel
     */
    public function setFizFormaWlasnosciSymbol(?string $propertyFormId): EntityModel
    {
        $this->propertyFormId = $propertyFormId;

        return $this;
    }

    /**
     * @param string|null $ownerName
     *
     * @return EntityModel
     */
    public function setFizImie1(?string $ownerName): EntityModel
    {
        $this->ownerName = $ownerName;

        return $this;
    }

    /**
     * @param string|null $localCount
     *
     * @return EntityModel
     */
    public function setFizLiczbaJednLokalnych(?string $localCount): EntityModel
    {
        $this->localCount = (int)$localCount;

        return $this;
    }

    /**
     * @param string|null $name
     *
     * @return EntityModel
     */
    public function setFizNazwa(?string $name): EntityModel
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string|null $nameShort
     *
     * @return EntityModel
     */
    public function setFizNazwaSkrocona(?string $nameShort): EntityModel
    {
        $this->nameShort = $nameShort;

        return $this;
    }

    /**
     * @param string|null $ownerSurname
     *
     * @return EntityModel
     */
    public function setFizNazwisko(?string $ownerSurname): EntityModel
    {
        $this->ownerSurname = $ownerSurname;

        return $this;
    }

    /**
     * @param string|null $nip
     *
     * @return EntityModel
     */
    public function setFizNip(?string $nip): EntityModel
    {
        $this->nip = $nip;

        return $this;
    }

    /**
     * @param string|null $contactFax
     *
     * @return EntityModel
     */
    public function setFizNumerFaksu(?string $contactFax): EntityModel
    {
        $this->contactFax = $contactFax;

        return $this;
    }

    /**
     * @param string|null $contactPhone
     *
     * @return EntityModel
     */
    public function setFizNumerTelefonu(?string $contactPhone): EntityModel
    {
        $this->contactPhone = $contactPhone;

        return $this;
    }

    /**
     * @param string|null $contactPhoneInternal
     *
     * @return EntityModel
     */
    public function setFizNumerWewnetrznyTelefonu(?string $contactPhoneInternal): EntityModel
    {
        $this->contactPhoneInternal = $contactPhoneInternal;

        return $this;
    }

    /**
     * @param string|null $foundingBodyName
     *
     * @return EntityModel
     */
    public function setFizOrganZalozycielskiNazwa(?string $foundingBodyName): EntityModel
    {
        $this->foundingBodyName = $foundingBodyName;

        return $this;
    }

    /**
     * @param string|null $foundingBodyId
     *
     * @return EntityModel
     */
    public function setFizOrganZalozycielskiSymbol(?string $foundingBodyId): EntityModel
    {
        $this->foundingBodyId = $foundingBodyId;

        return $this;
    }

    /**
     * @param string|null $basicLegalFormName
     *
     * @return EntityModel
     */
    public function setFizPodstawowaFormaPrawnaNazwa(?string $basicLegalFormName): EntityModel
    {
        $this->basicLegalFormName = $basicLegalFormName;

        return $this;
    }

    /**
     * @param string|null $basicLegalFormId
     *
     * @return EntityModel
     */
    public function setFizPodstawowaFormaPrawnaSymbol(?string $basicLegalFormId): EntityModel
    {
        $this->basicLegalFormId = $basicLegalFormId;

        return $this;
    }

    /**
     * @param string|null $regon
     *
     * @return EntityModel
     */
    public function setFizRegon9(?string $regon): EntityModel
    {
        $this->regon = $regon;

        return $this;
    }

    /**
     * @param string|null $statusNip
     *
     * @return EntityModel
     */
    public function setFizStatusNip(?string $statusNip): EntityModel
    {
        $this->nipStatus = $statusNip;

        return $this;
    }

    /**
     * @param string|null $detailLegalFormName
     *
     * @return EntityModel
     */
    public function setFizSzczegolnaFormaPrawnaNazwa(?string $detailLegalFormName): EntityModel
    {
        $this->detailLegalFormName = $detailLegalFormName;

        return $this;
    }

    /**
     * @param string|null $detailLegalFormId
     *
     * @return EntityModel
     */
    public function setFizSzczegolnaFormaPrawnaSymbol(?string $detailLegalFormId): EntityModel
    {
        $this->detailLegalFormId = $detailLegalFormId;

        return $this;
    }

    /**
     * @param string|null $addressHeadCommuneName
     *
     * @return EntityModel
     */
    public function setLokFizAdSiedzGminaNazwa(?string $addressHeadCommuneName): EntityModel
    {
        $this->addressHeadCommuneName = $addressHeadCommuneName;

        return $this;
    }

    /**
     * @param string|null $addressHeadCommuneId
     *
     * @return EntityModel
     */
    public function setLokFizAdSiedzGminaSymbol(?string $addressHeadCommuneId): EntityModel
    {
        $this->addressHeadCommuneId = $addressHeadCommuneId;

        return $this;
    }

    /**
     * @param string|null $addressHeadPostalCode
     *
     * @return EntityModel
     */
    public function setLokFizAdSiedzKodPocztowy(?string $addressHeadPostalCode): EntityModel
    {
        $this->addressHeadPostalCode = $addressHeadPostalCode;

        return $this;
    }

    /**
     * @param string|null $addressHeadCountryName
     *
     * @return EntityModel
     */
    public function setLokFizAdSiedzKrajNazwa(?string $addressHeadCountryName): EntityModel
    {
        $this->addressHeadCountryName = $addressHeadCountryName;

        return $this;
    }

    /**
     * @param string|null $addressHeadCountryId
     *
     * @return EntityModel
     */
    public function setLokFizAdSiedzKrajSymbol(?string $addressHeadCountryId): EntityModel
    {
        $this->addressHeadCountryId = $addressHeadCountryId;

        return $this;
    }

    /**
     * @param string|null $addressHeadCityName
     *
     * @return EntityModel
     */
    public function setLokFizAdSiedzMiejscowoscNazwa(?string $addressHeadCityName): EntityModel
    {
        $this->addressHeadCityName = $addressHeadCityName;

        return $this;
    }

    /**
     * @param string|null $addressHeadPostalCityName
     *
     * @return EntityModel
     */
    public function setLokFizAdSiedzMiejscowoscPocztyNazwa(?string $addressHeadPostalCityName): EntityModel
    {
        $this->addressHeadPostalCityName = $addressHeadPostalCityName;

        return $this;
    }

    /**
     * @param string|null $addressHeadPostalCityId
     *
     * @return EntityModel
     */
    public function setLokFizAdSiedzMiejscowoscPocztySymbol(?string $addressHeadPostalCityId): EntityModel
    {
        $this->addressHeadPostalCityId = $addressHeadPostalCityId;

        return $this;
    }

    /**
     * @param string|null $addressHeadCityId
     *
     * @return EntityModel
     */
    public function setLokFizAdSiedzMiejscowoscSymbol(?string $addressHeadCityId): EntityModel
    {
        $this->addressHeadCityId = $addressHeadCityId;

        return $this;
    }

    /**
     * @param string|null $addressAlternative
     *
     * @return EntityModel
     */
    public function setLokFizAdSiedzNietypoweMiejsceLokalizacji(?string $addressAlternative): EntityModel
    {
        $this->addressAlternative = $addressAlternative;

        return $this;
    }

    /**
     * @param string|null $addressHeadFlatNr
     *
     * @return EntityModel
     */
    public function setLokFizAdSiedzNumerLokalu(?string $addressHeadFlatNr): EntityModel
    {
        $this->addressHeadFlatNr = $addressHeadFlatNr;

        return $this;
    }

    /**
     * @param string|null $addressHeadHomeNr
     *
     * @return EntityModel
     */
    public function setLokFizAdSiedzNumerNieruchomosci(?string $addressHeadHomeNr): EntityModel
    {
        $this->addressHeadHomeNr = $addressHeadHomeNr;

        return $this;
    }

    /**
     * @param string|null $addressHeadPoviatName
     *
     * @return EntityModel
     */
    public function setLokFizAdSiedzPowiatNazwa(?string $addressHeadPoviatName): EntityModel
    {
        $this->addressHeadPoviatName = $addressHeadPoviatName;

        return $this;
    }

    /**
     * @param string|null $addressHeadPoviatId
     *
     * @return EntityModel
     */
    public function setLokFizAdSiedzPowiatSymbol(?string $addressHeadPoviatId): EntityModel
    {
        $this->addressHeadPoviatId = $addressHeadPoviatId;

        return $this;
    }

    /**
     * @param string|null $addressHeadStreetName
     *
     * @return EntityModel
     */
    public function setLokFizAdSiedzUlicaNazwa(?string $addressHeadStreetName): EntityModel
    {
        $this->addressHeadStreetName = $addressHeadStreetName;

        return $this;
    }

    /**
     * @param string|null $addressHeadStreetId
     *
     * @return EntityModel
     */
    public function setLokFizAdSiedzUlicaSymbol(?string $addressHeadStreetId): EntityModel
    {
        $this->addressHeadStreetId = $addressHeadStreetId;

        return $this;
    }

    /**
     * @param string|null $addressHeadVoivodshipName
     *
     * @return EntityModel
     */
    public function setLokFizAdSiedzWojewodztwoNazwa(?string $addressHeadVoivodshipName): EntityModel
    {
        $this->addressHeadVoivodshipName = $addressHeadVoivodshipName;

        return $this;
    }

    /**
     * @param string|null $addressHeadVoivodshipId
     *
     * @return EntityModel
     */
    public function setLokFizAdSiedzWojewodztwoSymbol(?string $addressHeadVoivodshipId): EntityModel
    {
        $this->addressHeadVoivodshipId = $addressHeadVoivodshipId;

        return $this;
    }

    /**
     * @param string|null $contactEmail
     *
     * @return EntityModel
     */
    public function setLokFizAdresEmail(?string $contactEmail): EntityModel
    {
        $this->contactEmail = $contactEmail;

        return $this;
    }

    /**
     * @param string|null $praw_adresStronyinternetowej
     *
     * @return EntityModel
     */
    public function setLokFizAdresStronyinternetowej(?string $praw_adresStronyinternetowej): EntityModel
    {
        $this->website = $praw_adresStronyinternetowej;

        return $this;
    }

    /**
     * @param string|null $dateRegisterDelete
     *
     * @return EntityModel
     */
    public function setLokFizCDataSkresleniaZRejestruEwidencji(?string $dateRegisterDelete): EntityModel
    {
        $this->dateRegisterDelete = $dateRegisterDelete;

        return $this;
    }

    /**
     * @param string|null $dateRegisterCreate
     *
     * @return EntityModel
     */
    public function setLokFizCDataWpisuDoRejestruEwidencji(?string $dateRegisterCreate): EntityModel
    {
        $this->dateRegisterCreate = $dateRegisterCreate;

        return $this;
    }

    /**
     * @param string|null $registerNr
     *
     * @return EntityModel
     */
    public function setLokFizCNumerWRejestrzeEwidencji(?string $registerNr): EntityModel
    {
        $this->registerNr = $registerNr;

        return $this;
    }

    /**
     * @param string|null $registerName
     *
     * @return EntityModel
     */
    public function setLokFizCOrganRejestrowyNazwa(?string $registerName): EntityModel
    {
        $this->registerName = $registerName;

        return $this;
    }

    /**
     * @param string|null $registerId
     *
     * @return EntityModel
     */
    public function setLokFizCOrganRejestrowySymbol(?string $registerId): EntityModel
    {
        $this->registerId = $registerId;

        return $this;
    }

    /**
     * @param string|null $dateBankruptcy
     *
     * @return EntityModel
     */
    public function setLokFizDataOrzeczeniaOUpadlosci(?string $dateBankruptcy): EntityModel
    {
        $this->dateBankruptcy = $dateBankruptcy;

        return $this;
    }

    /**
     * @param string|null $createDate
     *
     * @return EntityModel
     */
    public function setLokFizDataPowstania(?string $createDate): EntityModel
    {
        $this->dateCreate = $createDate;

        return $this;
    }

    /**
     * @param string|null $dateStart
     *
     * @return EntityModel
     */
    public function setLokFizDataRozpoczeciaDzialalnosci(?string $dateStart): EntityModel
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * @param string|null $dateRegonDelete
     *
     * @return EntityModel
     */
    public function setLokFizDataSkresleniaPodmiotuZRegon(?string $dateRegonDelete): EntityModel
    {
        $this->dateRegonDelete = $dateRegonDelete;

        return $this;
    }

    /**
     * @param string|null $dateRegonDelete
     *
     * @return EntityModel
     */
    public function setLokFizDataSkresleniaZRegon(?string $dateRegonDelete): EntityModel
    {
        $this->dateRegonDelete = $dateRegonDelete;

        return $this;
    }

    /**
     * @param string|null $dateRegonCreate
     *
     * @return EntityModel
     */
    public function setLokFizDataWpisuDoRegon(?string $dateRegonCreate): EntityModel
    {
        $this->dateRegonCreate = $dateRegonCreate;

        return $this;
    }

    /**
     * @param string|null $dateRegonCreate
     *
     * @return EntityModel
     */
    public function setLokFizDataWpisuDzialalnosciDoRegon(?string $dateRegonCreate): EntityModel
    {
        $this->dateRegonCreate = $dateRegonCreate;

        return $this;
    }

    /**
     * @param string|null $dateRegonCreate
     *
     * @return EntityModel
     */
    public function setLokFizDataWpisuPodmiotuDoRegon(?string $dateRegonCreate): EntityModel
    {
        $this->dateRegonCreate = $dateRegonCreate;

        return $this;
    }

    /**
     * @param string|null $dateResume
     *
     * @return EntityModel
     */
    public function setLokFizDataWznowieniaDzialalnosci(?string $dateResume): EntityModel
    {
        $this->dateResume = $dateResume;

        return $this;
    }

    /**
     * @param string|null $dateChange
     *
     * @return EntityModel
     */
    public function setLokFizDataZaistnieniaZmiany(?string $dateChange): EntityModel
    {
        $this->dateChange = $dateChange;

        return $this;
    }

    /**
     * @param string|null $dateEnd
     *
     * @return EntityModel
     */
    public function setLokFizDataZakonczeniaDzialalnosci(?string $dateEnd): EntityModel
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * @param string|null $dateBankruptcyProcess
     *
     * @return EntityModel
     */
    public function setLokFizDataZakonczeniaPostepowaniaUpadlosciowego(?string $dateBankruptcyProcess): EntityModel
    {
        $this->dateBankruptcyProcessEnd = $dateBankruptcyProcess;

        return $this;
    }

    /**
     * @param string|null $dateSuspend
     *
     * @return EntityModel
     */
    public function setLokFizDataZawieszeniaDzialalnosci(?string $dateSuspend): EntityModel
    {
        $this->dateSuspend = $dateSuspend;

        return $this;
    }

    /**
     * @param string|null $financialFormName
     *
     * @return EntityModel
     */
    public function setLokFizFormaFinansowaniaNazwa(?string $financialFormName): EntityModel
    {
        $this->financialFormName = $financialFormName;

        return $this;
    }

    /**
     * @param string|null $financialFormId
     *
     * @return EntityModel
     */
    public function setLokFizFormaFinansowaniaSymbol(?string $financialFormId): EntityModel
    {
        $this->financialFormId = $financialFormId;

        return $this;
    }

    /**
     * @param string|null $propertyFormName
     *
     * @return EntityModel
     */
    public function setLokFizFormaWlasnosciNazwa(?string $propertyFormName): EntityModel
    {
        $this->propertyFormName = $propertyFormName;

        return $this;
    }

    /**
     * @param string|null $propertyFormId
     *
     * @return EntityModel
     */
    public function setLokFizFormaWlasnosciSymbol(?string $propertyFormId): EntityModel
    {
        $this->propertyFormId = $propertyFormId;

        return $this;
    }

    /**
     * @param string|null $ownerName
     *
     * @return EntityModel
     */
    public function setLokFizImie1(?string $ownerName): EntityModel
    {
        $this->ownerName = $ownerName;

        return $this;
    }

    /**
     * @param string|null $localCount
     *
     * @return EntityModel
     */
    public function setLokFizLiczbaJednLokalnych(?string $localCount): EntityModel
    {
        $this->localCount = (int)$localCount;

        return $this;
    }

    /**
     * @param string|null $name
     *
     * @return EntityModel
     */
    public function setLokFizNazwa(?string $name): EntityModel
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string|null $nameShort
     *
     * @return EntityModel
     */
    public function setLokFizNazwaSkrocona(?string $nameShort): EntityModel
    {
        $this->nameShort = $nameShort;

        return $this;
    }

    /**
     * @param string|null $ownerSurname
     *
     * @return EntityModel
     */
    public function setLokFizNazwisko(?string $ownerSurname): EntityModel
    {
        $this->ownerSurname = $ownerSurname;

        return $this;
    }

    /**
     * @param string|null $nip
     *
     * @return EntityModel
     */
    public function setLokFizNip(?string $nip): EntityModel
    {
        $this->nip = $nip;

        return $this;
    }

    /**
     * @param string|null $contactFax
     *
     * @return EntityModel
     */
    public function setLokFizNumerFaksu(?string $contactFax): EntityModel
    {
        $this->contactFax = $contactFax;

        return $this;
    }

    /**
     * @param string|null $contactPhone
     *
     * @return EntityModel
     */
    public function setLokFizNumerTelefonu(?string $contactPhone): EntityModel
    {
        $this->contactPhone = $contactPhone;

        return $this;
    }

    /**
     * @param string|null $contactPhoneInternal
     *
     * @return EntityModel
     */
    public function setLokFizNumerWewnetrznyTelefonu(?string $contactPhoneInternal): EntityModel
    {
        $this->contactPhoneInternal = $contactPhoneInternal;

        return $this;
    }

    /**
     * @param string|null $foundingBodyName
     *
     * @return EntityModel
     */
    public function setLokFizOrganZalozycielskiNazwa(?string $foundingBodyName): EntityModel
    {
        $this->foundingBodyName = $foundingBodyName;

        return $this;
    }

    /**
     * @param string|null $foundingBodyId
     *
     * @return EntityModel
     */
    public function setLokFizOrganZalozycielskiSymbol(?string $foundingBodyId): EntityModel
    {
        $this->foundingBodyId = $foundingBodyId;

        return $this;
    }

    /**
     * @param string|null $basicLegalFormName
     *
     * @return EntityModel
     */
    public function setLokFizPodstawowaFormaPrawnaNazwa(?string $basicLegalFormName): EntityModel
    {
        $this->basicLegalFormName = $basicLegalFormName;

        return $this;
    }

    /**
     * @param string|null $basicLegalFormId
     *
     * @return EntityModel
     */
    public function setLokFizPodstawowaFormaPrawnaSymbol(?string $basicLegalFormId): EntityModel
    {
        $this->basicLegalFormId = $basicLegalFormId;

        return $this;
    }

    /**
     * @param string|null $regon
     *
     * @return EntityModel
     */
    public function setLokFizRegon14(?string $regon): EntityModel
    {
        $this->regon = $regon;

        return $this;
    }

    /**
     * @param string|null $registerTypeName
     *
     * @return EntityModel
     */
    public function setLokFizRodzajRejestruNazwa(?string $registerTypeName): EntityModel
    {
        $this->registerTypeName = $registerTypeName;

        return $this;
    }

    /**
     * @param string|null $registerTypeId
     *
     * @return EntityModel
     */
    public function setLokFizRodzajRejestruSymbol(?string $registerTypeId): EntityModel
    {
        $this->registerTypeId = $registerTypeId;

        return $this;
    }

    /**
     * @param string|null $statusNip
     *
     * @return EntityModel
     */
    public function setLokFizStatusNip(?string $statusNip): EntityModel
    {
        $this->nipStatus = $statusNip;

        return $this;
    }

    /**
     * @param string|null $detailLegalFormName
     *
     * @return EntityModel
     */
    public function setLokFizSzczegolnaFormaPrawnaNazwa(?string $detailLegalFormName): EntityModel
    {
        $this->detailLegalFormName = $detailLegalFormName;

        return $this;
    }

    /**
     * @param string|null $detailLegalFormId
     *
     * @return EntityModel
     */
    public function setLokFizSzczegolnaFormaPrawnaSymbol(?string $detailLegalFormId): EntityModel
    {
        $this->detailLegalFormId = $detailLegalFormId;

        return $this;
    }

    /**
     * @param string|null $addressHeadCommuneName
     *
     * @return EntityModel
     */
    public function setPrawAdSiedzGminaNazwa(?string $addressHeadCommuneName): EntityModel
    {
        $this->addressHeadCommuneName = $addressHeadCommuneName;

        return $this;
    }

    /**
     * @param string|null $addressHeadCommuneId
     *
     * @return EntityModel
     */
    public function setPrawAdSiedzGminaSymbol(?string $addressHeadCommuneId): EntityModel
    {
        $this->addressHeadCommuneId = $addressHeadCommuneId;

        return $this;
    }

    /**
     * @param string|null $addressHeadPostalCode
     *
     * @return EntityModel
     */
    public function setPrawAdSiedzKodPocztowy(?string $addressHeadPostalCode): EntityModel
    {
        $this->addressHeadPostalCode = $addressHeadPostalCode;

        return $this;
    }

    /**
     * @param string|null $addressHeadCountryName
     *
     * @return EntityModel
     */
    public function setPrawAdSiedzKrajNazwa(?string $addressHeadCountryName): EntityModel
    {
        $this->addressHeadCountryName = $addressHeadCountryName;

        return $this;
    }

    /**
     * @param string|null $addressHeadCountryId
     *
     * @return EntityModel
     */
    public function setPrawAdSiedzKrajSymbol(?string $addressHeadCountryId): EntityModel
    {
        $this->addressHeadCountryId = $addressHeadCountryId;

        return $this;
    }

    /**
     * @param string|null $addressHeadCityName
     *
     * @return EntityModel
     */
    public function setPrawAdSiedzMiejscowoscNazwa(?string $addressHeadCityName): EntityModel
    {
        $this->addressHeadCityName = $addressHeadCityName;

        return $this;
    }

    /**
     * @param string|null $addressHeadPostalCityName
     *
     * @return EntityModel
     */
    public function setPrawAdSiedzMiejscowoscPocztyNazwa(?string $addressHeadPostalCityName): EntityModel
    {
        $this->addressHeadPostalCityName = $addressHeadPostalCityName;

        return $this;
    }

    /**
     * @param string|null $addressHeadPostalCityId
     *
     * @return EntityModel
     */
    public function setPrawAdSiedzMiejscowoscPocztySymbol(?string $addressHeadPostalCityId): EntityModel
    {
        $this->addressHeadPostalCityId = $addressHeadPostalCityId;

        return $this;
    }

    /**
     * @param string|null $addressHeadCityId
     *
     * @return EntityModel
     */
    public function setPrawAdSiedzMiejscowoscSymbol(?string $addressHeadCityId): EntityModel
    {
        $this->addressHeadCityId = $addressHeadCityId;

        return $this;
    }

    /**
     * @param string|null $addressAlternative
     *
     * @return EntityModel
     */
    public function setPrawAdSiedzNietypoweMiejsceLokalizacji(?string $addressAlternative): EntityModel
    {
        $this->addressAlternative = $addressAlternative;

        return $this;
    }

    /**
     * @param string|null $addressHeadFlatNr
     *
     * @return EntityModel
     */
    public function setPrawAdSiedzNumerLokalu(?string $addressHeadFlatNr): EntityModel
    {
        $this->addressHeadFlatNr = $addressHeadFlatNr;

        return $this;
    }

    /**
     * @param string|null $addressHeadHomeNr
     *
     * @return EntityModel
     */
    public function setPrawAdSiedzNumerNieruchomosci(?string $addressHeadHomeNr): EntityModel
    {
        $this->addressHeadHomeNr = $addressHeadHomeNr;

        return $this;
    }

    /**
     * @param string|null $addressHeadPoviatName
     *
     * @return EntityModel
     */
    public function setPrawAdSiedzPowiatNazwa(?string $addressHeadPoviatName): EntityModel
    {
        $this->addressHeadPoviatName = $addressHeadPoviatName;

        return $this;
    }

    /**
     * @param string|null $addressHeadPoviatId
     *
     * @return EntityModel
     */
    public function setPrawAdSiedzPowiatSymbol(?string $addressHeadPoviatId): EntityModel
    {
        $this->addressHeadPoviatId = $addressHeadPoviatId;

        return $this;
    }

    /**
     * @param string|null $addressHeadStreetName
     *
     * @return EntityModel
     */
    public function setPrawAdSiedzUlicaNazwa(?string $addressHeadStreetName): EntityModel
    {
        $this->addressHeadStreetName = $addressHeadStreetName;

        return $this;
    }

    /**
     * @param string|null $addressHeadStreetId
     *
     * @return EntityModel
     */
    public function setPrawAdSiedzUlicaSymbol(?string $addressHeadStreetId): EntityModel
    {
        $this->addressHeadStreetId = $addressHeadStreetId;

        return $this;
    }

    /**
     * @param string|null $addressHeadVoivodshipName
     *
     * @return EntityModel
     */
    public function setPrawAdSiedzWojewodztwoNazwa(?string $addressHeadVoivodshipName): EntityModel
    {
        $this->addressHeadVoivodshipName = $addressHeadVoivodshipName;

        return $this;
    }

    /**
     * @param string|null $addressHeadVoivodshipId
     *
     * @return EntityModel
     */
    public function setPrawAdSiedzWojewodztwoSymbol(?string $addressHeadVoivodshipId): EntityModel
    {
        $this->addressHeadVoivodshipId = $addressHeadVoivodshipId;

        return $this;
    }

    /**
     * @param string|null $contactEmail
     *
     * @return EntityModel
     */
    public function setPrawAdresEmail(?string $contactEmail): EntityModel
    {
        $this->contactEmail = $contactEmail;

        return $this;
    }

    /**
     * @param string|null $website
     *
     * @return EntityModel
     */
    public function setPrawAdresStronyinternetowej(?string $website): EntityModel
    {
        $this->website = $website;

        return $this;
    }

    /**
     * @param string|null $dateBankruptcy
     *
     * @return EntityModel
     */
    public function setPrawDataOrzeczeniaOUpadlosci(?string $dateBankruptcy): EntityModel
    {
        $this->dateBankruptcy = $dateBankruptcy;

        return $this;
    }

    /**
     * @param string|null $createDate
     *
     * @return EntityModel
     */
    public function setPrawDataPowstania(?string $createDate): EntityModel
    {
        $this->dateCreate = $createDate;

        return $this;
    }

    /**
     * @param string|null $dateStart
     *
     * @return EntityModel
     */
    public function setPrawDataRozpoczeciaDzialalnosci(?string $dateStart): EntityModel
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * @param string|null $dateRegonDelete
     *
     * @return EntityModel
     */
    public function setPrawDataSkresleniaZRegon(?string $dateRegonDelete): EntityModel
    {
        $this->dateRegonDelete = $dateRegonDelete;

        return $this;
    }

    /**
     * @param string|null $dateRegonCreate
     *
     * @return EntityModel
     */
    public function setPrawDataWpisuDoRegon(?string $dateRegonCreate): EntityModel
    {
        $this->dateRegonCreate = $dateRegonCreate;

        return $this;
    }

    /**
     * @param string|null $dateRegisterCreate
     *
     * @return EntityModel
     */
    public function setPrawDataWpisuDoRejestruEwidencji(?string $dateRegisterCreate): EntityModel
    {
        $this->dateRegisterCreate = $dateRegisterCreate;

        return $this;
    }

    /**
     * @param string|null $dateResume
     *
     * @return EntityModel
     */
    public function setPrawDataWznowieniaDzialalnosci(?string $dateResume): EntityModel
    {
        $this->dateResume = $dateResume;

        return $this;
    }

    /**
     * @param string|null $dateChange
     *
     * @return EntityModel
     */
    public function setPrawDataZaistnieniaZmiany(?string $dateChange): EntityModel
    {
        $this->dateChange = $dateChange;

        return $this;
    }

    /**
     * @param string|null $dateEnd
     *
     * @return EntityModel
     */
    public function setPrawDataZakonczeniaDzialalnosci(?string $dateEnd): EntityModel
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * @param string|null $dateBankruptcyProcess
     *
     * @return EntityModel
     */
    public function setPrawDataZakonczeniaPostepowaniaUpadlosciowego(?string $dateBankruptcyProcess): EntityModel
    {
        $this->dateBankruptcyProcessEnd = $dateBankruptcyProcess;

        return $this;
    }

    /**
     * @param string|null $dateSuspend
     *
     * @return EntityModel
     */
    public function setPrawDataZawieszeniaDzialalnosci(?string $dateSuspend): EntityModel
    {
        $this->dateSuspend = $dateSuspend;

        return $this;
    }

    /**
     * @param string|null $financialFormName
     *
     * @return EntityModel
     */
    public function setPrawFormaFinansowaniaNazwa(?string $financialFormName): EntityModel
    {
        $this->financialFormName = $financialFormName;

        return $this;
    }

    /**
     * @param string|null $financialFormId
     *
     * @return EntityModel
     */
    public function setPrawFormaFinansowaniaSymbol(?string $financialFormId): EntityModel
    {
        $this->financialFormId = $financialFormId;

        return $this;
    }

    /**
     * @param string|null $propertyFormName
     *
     * @return EntityModel
     */
    public function setPrawFormaWlasnosciNazwa(?string $propertyFormName): EntityModel
    {
        $this->propertyFormName = $propertyFormName;

        return $this;
    }

    /**
     * @param string|null $propertyFormId
     *
     * @return EntityModel
     */
    public function setPrawFormaWlasnosciSymbol(?string $propertyFormId): EntityModel
    {
        $this->propertyFormId = $propertyFormId;

        return $this;
    }

    /**
     * @param string|null $localCount
     *
     * @return EntityModel
     */
    public function setPrawLiczbaJednLokalnych(?string $localCount): EntityModel
    {
        $this->localCount = (int)$localCount;

        return $this;
    }

    /**
     * @param string|null $name
     *
     * @return EntityModel
     */
    public function setPrawNazwa(?string $name): EntityModel
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string|null $nameShort
     *
     * @return EntityModel
     */
    public function setPrawNazwaSkrocona(?string $nameShort): EntityModel
    {
        $this->nameShort = $nameShort;

        return $this;
    }

    /**
     * @param string|null $nip
     *
     * @return EntityModel
     */
    public function setPrawNip(?string $nip): EntityModel
    {
        $this->nip = $nip;

        return $this;
    }

    /**
     * @param string|null $contactFax
     *
     * @return EntityModel
     */
    public function setPrawNumerFaksu(?string $contactFax): EntityModel
    {
        $this->contactFax = $contactFax;

        return $this;
    }

    /**
     * @param string|null $contactPhone
     *
     * @return EntityModel
     */
    public function setPrawNumerTelefonu(?string $contactPhone): EntityModel
    {
        $this->contactPhone = $contactPhone;

        return $this;
    }

    /**
     * @param string|null $registerNr
     *
     * @return EntityModel
     */
    public function setPrawNumerWRejestrzeEwidencji(?string $registerNr): EntityModel
    {
        $this->registerNr = $registerNr;

        return $this;
    }

    /**
     * @param string|null $contactPhoneInternal
     *
     * @return EntityModel
     */
    public function setPrawNumerWewnetrznyTelefonu(?string $contactPhoneInternal): EntityModel
    {
        $this->contactPhoneInternal = $contactPhoneInternal;

        return $this;
    }

    /**
     * @param string|null $registerName
     *
     * @return EntityModel
     */
    public function setPrawOrganRejestrowyNazwa(?string $registerName): EntityModel
    {
        $this->registerName = $registerName;

        return $this;
    }

    /**
     * @param string|null $registerId
     *
     * @return EntityModel
     */
    public function setPrawOrganRejestrowySymbol(?string $registerId): EntityModel
    {
        $this->registerId = $registerId;

        return $this;
    }

    /**
     * @param string|null $foundingBodyName
     *
     * @return EntityModel
     */
    public function setPrawOrganZalozycielskiNazwa(?string $foundingBodyName): EntityModel
    {
        $this->foundingBodyName = $foundingBodyName;

        return $this;
    }

    /**
     * @param string|null $foundingBodyId
     *
     * @return EntityModel
     */
    public function setPrawOrganZalozycielskiSymbol(?string $foundingBodyId): EntityModel
    {
        $this->foundingBodyId = $foundingBodyId;

        return $this;
    }

    /**
     * @param string|null $basicLegalFormName
     *
     * @return EntityModel
     */
    public function setPrawPodstawowaFormaPrawnaNazwa(?string $basicLegalFormName): EntityModel
    {
        $this->basicLegalFormName = $basicLegalFormName;

        return $this;
    }

    /**
     * @param string|null $basicLegalFormId
     *
     * @return EntityModel
     */
    public function setPrawPodstawowaFormaPrawnaSymbol(?string $basicLegalFormId): EntityModel
    {
        $this->basicLegalFormId = $basicLegalFormId;

        return $this;
    }

    /**
     * @param string|null $regon
     *
     * @return EntityModel
     */
    public function setPrawRegon9(?string $regon): EntityModel
    {
        $this->regon = $regon;

        return $this;
    }

    /**
     * @param string|null $registerTypeName
     *
     * @return EntityModel
     */
    public function setPrawRodzajRejestruEwidencjiNazwa(?string $registerTypeName): EntityModel
    {
        $this->registerTypeName = $registerTypeName;

        return $this;
    }

    /**
     * @param string|null $registerTypeId
     *
     * @return EntityModel
     */
    public function setPrawRodzajRejestruEwidencjiSymbol(?string $registerTypeId): EntityModel
    {
        $this->registerTypeId = $registerTypeId;

        return $this;
    }

    /**
     * @param string|null $statusNip
     *
     * @return EntityModel
     */
    public function setPrawStatusNip(?string $statusNip): EntityModel
    {
        $this->nipStatus = $statusNip;

        return $this;
    }

    /**
     * @param string|null $detailLegalFormName
     *
     * @return EntityModel
     */
    public function setPrawSzczegolnaFormaPrawnaNazwa(?string $detailLegalFormName): EntityModel
    {
        $this->detailLegalFormName = $detailLegalFormName;

        return $this;
    }

    /**
     * @param string|null $detailLegalFormId
     *
     * @return EntityModel
     */
    public function setPrawSzczegolnaFormaPrawnaSymbol(?string $detailLegalFormId): EntityModel
    {
        $this->detailLegalFormId = $detailLegalFormId;

        return $this;
    }

    /**
     * @param string|null $addressHeadCommuneName
     *
     * @return EntityModel
     */
    public function setLokprawAdSiedzGminaNazwa(?string $addressHeadCommuneName): EntityModel
    {
        $this->addressHeadCommuneName = $addressHeadCommuneName;

        return $this;
    }

    /**
     * @param string|null $addressHeadCommuneId
     *
     * @return EntityModel
     */
    public function setLokprawAdSiedzGminaSymbol(?string $addressHeadCommuneId): EntityModel
    {
        $this->addressHeadCommuneId = $addressHeadCommuneId;

        return $this;
    }

    /**
     * @param string|null $addressHeadPostalCode
     *
     * @return EntityModel
     */
    public function setLokprawAdSiedzKodPocztowy(?string $addressHeadPostalCode): EntityModel
    {
        $this->addressHeadPostalCode = $addressHeadPostalCode;

        return $this;
    }

    /**
     * @param string|null $addressHeadCountryName
     *
     * @return EntityModel
     */
    public function setLokprawAdSiedzKrajNazwa(?string $addressHeadCountryName): EntityModel
    {
        $this->addressHeadCountryName = $addressHeadCountryName;

        return $this;
    }

    /**
     * @param string|null $addressHeadCountryId
     *
     * @return EntityModel
     */
    public function setLokprawAdSiedzKrajSymbol(?string $addressHeadCountryId): EntityModel
    {
        $this->addressHeadCountryId = $addressHeadCountryId;

        return $this;
    }

    /**
     * @param string|null $addressHeadCityName
     *
     * @return EntityModel
     */
    public function setLokprawAdSiedzMiejscowoscNazwa(?string $addressHeadCityName): EntityModel
    {
        $this->addressHeadCityName = $addressHeadCityName;

        return $this;
    }

    /**
     * @param string|null $addressHeadPostalCityName
     *
     * @return EntityModel
     */
    public function setLokprawAdSiedzMiejscowoscPocztyNazwa(?string $addressHeadPostalCityName): EntityModel
    {
        $this->addressHeadPostalCityName = $addressHeadPostalCityName;

        return $this;
    }

    /**
     * @param string|null $addressHeadPostalCityId
     *
     * @return EntityModel
     */
    public function setLokprawAdSiedzMiejscowoscPocztySymbol(?string $addressHeadPostalCityId): EntityModel
    {
        $this->addressHeadPostalCityId = $addressHeadPostalCityId;

        return $this;
    }

    /**
     * @param string|null $addressHeadCityId
     *
     * @return EntityModel
     */
    public function setLokprawAdSiedzMiejscowoscSymbol(?string $addressHeadCityId): EntityModel
    {
        $this->addressHeadCityId = $addressHeadCityId;

        return $this;
    }

    /**
     * @param string|null $addressAlternative
     *
     * @return EntityModel
     */
    public function setLokprawAdSiedzNietypoweMiejsceLokalizacji(?string $addressAlternative): EntityModel
    {
        $this->addressAlternative = $addressAlternative;

        return $this;
    }

    /**
     * @param string|null $addressHeadFlatNr
     *
     * @return EntityModel
     */
    public function setLokprawAdSiedzNumerLokalu(?string $addressHeadFlatNr): EntityModel
    {
        $this->addressHeadFlatNr = $addressHeadFlatNr;

        return $this;
    }

    /**
     * @param string|null $addressHeadHomeNr
     *
     * @return EntityModel
     */
    public function setLokprawAdSiedzNumerNieruchomosci(?string $addressHeadHomeNr): EntityModel
    {
        $this->addressHeadHomeNr = $addressHeadHomeNr;

        return $this;
    }

    /**
     * @param string|null $addressHeadPoviatName
     *
     * @return EntityModel
     */
    public function setLokprawAdSiedzPowiatNazwa(?string $addressHeadPoviatName): EntityModel
    {
        $this->addressHeadPoviatName = $addressHeadPoviatName;

        return $this;
    }

    /**
     * @param string|null $addressHeadPoviatId
     *
     * @return EntityModel
     */
    public function setLokprawAdSiedzPowiatSymbol(?string $addressHeadPoviatId): EntityModel
    {
        $this->addressHeadPoviatId = $addressHeadPoviatId;

        return $this;
    }

    /**
     * @param string|null $addressHeadStreetName
     *
     * @return EntityModel
     */
    public function setLokprawAdSiedzUlicaNazwa(?string $addressHeadStreetName): EntityModel
    {
        $this->addressHeadStreetName = $addressHeadStreetName;

        return $this;
    }

    /**
     * @param string|null $addressHeadStreetId
     *
     * @return EntityModel
     */
    public function setLokprawAdSiedzUlicaSymbol(?string $addressHeadStreetId): EntityModel
    {
        $this->addressHeadStreetId = $addressHeadStreetId;

        return $this;
    }

    /**
     * @param string|null $addressHeadVoivodshipName
     *
     * @return EntityModel
     */
    public function setLokprawAdSiedzWojewodztwoNazwa(?string $addressHeadVoivodshipName): EntityModel
    {
        $this->addressHeadVoivodshipName = $addressHeadVoivodshipName;

        return $this;
    }

    /**
     * @param string|null $addressHeadVoivodshipId
     *
     * @return EntityModel
     */
    public function setLokprawAdSiedzWojewodztwoSymbol(?string $addressHeadVoivodshipId): EntityModel
    {
        $this->addressHeadVoivodshipId = $addressHeadVoivodshipId;

        return $this;
    }

    /**
     * @param string|null $contactEmail
     *
     * @return EntityModel
     */
    public function setLokprawAdresEmail(?string $contactEmail): EntityModel
    {
        $this->contactEmail = $contactEmail;

        return $this;
    }

    /**
     * @param string|null $website
     *
     * @return EntityModel
     */
    public function setLokprawAdresStronyinternetowej(?string $website): EntityModel
    {
        $this->website = $website;

        return $this;
    }

    /**
     * @param string|null $dateBankruptcy
     *
     * @return EntityModel
     */
    public function setLokprawDataOrzeczeniaOUpadlosci(?string $dateBankruptcy): EntityModel
    {
        $this->dateBankruptcy = $dateBankruptcy;

        return $this;
    }

    /**
     * @param string|null $createDate
     *
     * @return EntityModel
     */
    public function setLokprawDataPowstania(?string $createDate): EntityModel
    {
        $this->dateCreate = $createDate;

        return $this;
    }

    /**
     * @param string|null $dateStart
     *
     * @return EntityModel
     */
    public function setLokprawDataRozpoczeciaDzialalnosci(?string $dateStart): EntityModel
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * @param string|null $dateRegonDelete
     *
     * @return EntityModel
     */
    public function setLokprawDataSkresleniaZRegon(?string $dateRegonDelete): EntityModel
    {
        $this->dateRegonDelete = $dateRegonDelete;

        return $this;
    }

    /**
     * @param string|null $dateRegonCreate
     *
     * @return EntityModel
     */
    public function setLokprawDataWpisuDoRegon(?string $dateRegonCreate): EntityModel
    {
        $this->dateRegonCreate = $dateRegonCreate;

        return $this;
    }

    /**
     * @param string|null $dateRegisterCreate
     *
     * @return EntityModel
     */
    public function setLokprawDataWpisuDoRejestruEwidencji(?string $dateRegisterCreate): EntityModel
    {
        $this->dateRegisterCreate = $dateRegisterCreate;

        return $this;
    }

    /**
     * @param string|null $dateResume
     *
     * @return EntityModel
     */
    public function setLokprawDataWznowieniaDzialalnosci(?string $dateResume): EntityModel
    {
        $this->dateResume = $dateResume;

        return $this;
    }

    /**
     * @param string|null $dateChange
     *
     * @return EntityModel
     */
    public function setLokprawDataZaistnieniaZmiany(?string $dateChange): EntityModel
    {
        $this->dateChange = $dateChange;

        return $this;
    }

    /**
     * @param string|null $dateEnd
     *
     * @return EntityModel
     */
    public function setLokprawDataZakonczeniaDzialalnosci(?string $dateEnd): EntityModel
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * @param string|null $dateBankruptcyProcess
     *
     * @return EntityModel
     */
    public function setLokprawDataZakonczeniaPostepowaniaUpadlosciowego(?string $dateBankruptcyProcess): EntityModel
    {
        $this->dateBankruptcyProcessEnd = $dateBankruptcyProcess;

        return $this;
    }

    /**
     * @param string|null $dateSuspend
     *
     * @return EntityModel
     */
    public function setLokprawDataZawieszeniaDzialalnosci(?string $dateSuspend): EntityModel
    {
        $this->dateSuspend = $dateSuspend;

        return $this;
    }

    /**
     * @param string|null $financialFormName
     *
     * @return EntityModel
     */
    public function setLokprawFormaFinansowaniaNazwa(?string $financialFormName): EntityModel
    {
        $this->financialFormName = $financialFormName;

        return $this;
    }

    /**
     * @param string|null $financialFormId
     *
     * @return EntityModel
     */
    public function setLokprawFormaFinansowaniaSymbol(?string $financialFormId): EntityModel
    {
        $this->financialFormId = $financialFormId;

        return $this;
    }

    /**
     * @param string|null $propertyFormName
     *
     * @return EntityModel
     */
    public function setLokprawFormaWlasnosciNazwa(?string $propertyFormName): EntityModel
    {
        $this->propertyFormName = $propertyFormName;

        return $this;
    }

    /**
     * @param string|null $propertyFormId
     *
     * @return EntityModel
     */
    public function setLokprawFormaWlasnosciSymbol(?string $propertyFormId): EntityModel
    {
        $this->propertyFormId = $propertyFormId;

        return $this;
    }

    /**
     * @param string|null $localCount
     *
     * @return EntityModel
     */
    public function setLokprawLiczbaJednLokalnych(?string $localCount): EntityModel
    {
        $this->localCount = (int)$localCount;

        return $this;
    }

    /**
     * @param string|null $name
     *
     * @return EntityModel
     */
    public function setLokprawNazwa(?string $name): EntityModel
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string|null $nameShort
     *
     * @return EntityModel
     */
    public function setLokprawNazwaSkrocona(?string $nameShort): EntityModel
    {
        $this->nameShort = $nameShort;

        return $this;
    }

    /**
     * @param string|null $nip
     *
     * @return EntityModel
     */
    public function setLokprawNip(?string $nip): EntityModel
    {
        $this->nip = $nip;

        return $this;
    }

    /**
     * @param string|null $contactFax
     *
     * @return EntityModel
     */
    public function setLokprawNumerFaksu(?string $contactFax): EntityModel
    {
        $this->contactFax = $contactFax;

        return $this;
    }

    /**
     * @param string|null $contactPhone
     *
     * @return EntityModel
     */
    public function setLokprawNumerTelefonu(?string $contactPhone): EntityModel
    {
        $this->contactPhone = $contactPhone;

        return $this;
    }

    /**
     * @param string|null $registerNr
     *
     * @return EntityModel
     */
    public function setLokprawNumerWRejestrzeEwidencji(?string $registerNr): EntityModel
    {
        $this->registerNr = $registerNr;

        return $this;
    }

    /**
     * @param string|null $contactPhoneInternal
     *
     * @return EntityModel
     */
    public function setLokprawNumerWewnetrznyTelefonu(?string $contactPhoneInternal): EntityModel
    {
        $this->contactPhoneInternal = $contactPhoneInternal;

        return $this;
    }

    /**
     * @param string|null $registerName
     *
     * @return EntityModel
     */
    public function setLokprawOrganRejestrowyNazwa(?string $registerName): EntityModel
    {
        $this->registerName = $registerName;

        return $this;
    }

    /**
     * @param string|null $registerId
     *
     * @return EntityModel
     */
    public function setLokprawOrganRejestrowySymbol(?string $registerId): EntityModel
    {
        $this->registerId = $registerId;

        return $this;
    }

    /**
     * @param string|null $foundingBodyName
     *
     * @return EntityModel
     */
    public function setLokprawOrganZalozycielskiNazwa(?string $foundingBodyName): EntityModel
    {
        $this->foundingBodyName = $foundingBodyName;

        return $this;
    }

    /**
     * @param string|null $foundingBodyId
     *
     * @return EntityModel
     */
    public function setLokprawOrganZalozycielskiSymbol(?string $foundingBodyId): EntityModel
    {
        $this->foundingBodyId = $foundingBodyId;

        return $this;
    }

    /**
     * @param string|null $basicLegalFormName
     *
     * @return EntityModel
     */
    public function setLokprawPodstawowaFormaPrawnaNazwa(?string $basicLegalFormName): EntityModel
    {
        $this->basicLegalFormName = $basicLegalFormName;

        return $this;
    }

    /**
     * @param string|null $basicLegalFormId
     *
     * @return EntityModel
     */
    public function setLokprawPodstawowaFormaPrawnaSymbol(?string $basicLegalFormId): EntityModel
    {
        $this->basicLegalFormId = $basicLegalFormId;

        return $this;
    }

    /**
     * @param string|null $regon
     *
     * @return EntityModel
     */
    public function setLokprawRegon14(?string $regon): EntityModel
    {
        $this->regon = $regon;

        return $this;
    }

    /**
     * @param string|null $registerTypeName
     *
     * @return EntityModel
     */
    public function setLokprawRodzajRejestruEwidencjiNazwa(?string $registerTypeName): EntityModel
    {
        $this->registerTypeName = $registerTypeName;

        return $this;
    }

    /**
     * @param string|null $registerTypeId
     *
     * @return EntityModel
     */
    public function setLokprawRodzajRejestruEwidencjiSymbol(?string $registerTypeId): EntityModel
    {
        $this->registerTypeId = $registerTypeId;

        return $this;
    }

    /**
     * @param string|null $statusNip
     *
     * @return EntityModel
     */
    public function setLokprawStatusNip(?string $statusNip): EntityModel
    {
        $this->nipStatus = $statusNip;

        return $this;
    }

    /**
     * @param string|null $detailLegalFormName
     *
     * @return EntityModel
     */
    public function setLokprawSzczegolnaFormaPrawnaNazwa(?string $detailLegalFormName): EntityModel
    {
        $this->detailLegalFormName = $detailLegalFormName;

        return $this;
    }

    /**
     * @param string|null $detailLegalFormId
     *
     * @return EntityModel
     */
    public function setLokprawSzczegolnaFormaPrawnaSymbol(?string $detailLegalFormId): EntityModel
    {
        $this->detailLegalFormId = $detailLegalFormId;

        return $this;
    }

    /**
     * @return $this
     */
    public function validate(): self
    {
        if (in_array($this->registerTypeId, ['138', '139'])) {
            $this->krs = $this->registerNr;
        }
        if (in_array($this->registerTypeId, ['151'], true)) {
            $this->ceidg = $this->registerNr;
        }

        /*
         * returned regon 47304027200000 is invalid, need to cut leading zeros
         */
        if ('00000' === substr($this->regon, 9, 5)) {
            $this->regon = substr($this->regon, 0, 9);
        }
        $this->regon9 = substr($this->regon, 0, 9);

        return $this;
    }
}
