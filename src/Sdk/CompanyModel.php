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
 * Time: 21:46
 */

namespace Mrcnpdlk\Api\Regon\Sdk;

use Mrcnpdlk\Api\Regon\Enum\SilosEnum;
use Mrcnpdlk\Api\Regon\Enum\TypeEnum;

class CompanyModel
{
    /**
     * @var string
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
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $voivodshipName;
    /**
     * @var string
     */
    public $poviatName;
    /**
     * @var string
     */
    public $communeName;
    /**
     * @var string
     */
    public $cityName;
    /**
     * @var string|null
     */
    public $postalCode;
    /**
     * @var string|null
     */
    public $streetName;
    /**
     * @var string
     */
    public $homeNr;
    /**
     * @var string|null
     */
    public $flatNr;
    /**
     * @var \Mrcnpdlk\Api\Regon\Enum\TypeEnum
     */
    public $type;
    /**
     * @var \Mrcnpdlk\Api\Regon\Enum\SilosEnum
     */
    public $silosID;
    /**
     * @var string|null
     */
    public $endingDate;
    /**
     * @var string|null
     */
    public $postalCityName;

    /**
     * @param string|null $endingDate
     *
     * @return CompanyModel
     */
    public function setDataZakonczeniaDzialalnosci(?string $endingDate): CompanyModel
    {
        $this->endingDate = $endingDate;

        return $this;
    }

    /**
     * @param string $communeName
     *
     * @return CompanyModel
     */
    public function setGmina(string $communeName): CompanyModel
    {
        $this->communeName = $communeName;

        return $this;
    }

    /**
     * @param string|null $postalCode
     *
     * @return CompanyModel
     */
    public function setKodPocztowy(?string $postalCode): CompanyModel
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * @param string $cityName
     *
     * @return CompanyModel
     */
    public function setMiejscowosc(string $cityName): CompanyModel
    {
        $this->cityName = $cityName;

        return $this;
    }

    /**
     * @param string|null $postalCityName
     *
     * @return CompanyModel
     */
    public function setMiejscowoscPoczty(?string $postalCityName): CompanyModel
    {
        $this->postalCityName = $postalCityName;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return CompanyModel
     */
    public function setNazwa(string $name): CompanyModel
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string|null $nip
     *
     * @return CompanyModel
     */
    public function setNip(?string $nip): CompanyModel
    {
        $this->nip = $nip;

        return $this;
    }

    /**
     * @param string|null $nipStatus
     *
     * @return CompanyModel
     */
    public function setNipStatus(?string $nipStatus): CompanyModel
    {
        $this->nipStatus = $nipStatus;

        return $this;
    }

    /**
     * @param string|null $flatNr
     *
     * @return CompanyModel
     */
    public function setNrLokalu(?string $flatNr): CompanyModel
    {
        $this->flatNr = $flatNr;

        return $this;
    }

    /**
     * @param string $homeNr
     *
     * @return CompanyModel
     */
    public function setNrNieruchomosci(string $homeNr): CompanyModel
    {
        $this->homeNr = $homeNr;

        return $this;
    }

    /**
     * @param string $poviatName
     *
     * @return CompanyModel
     */
    public function setPowiat(string $poviatName): CompanyModel
    {
        $this->poviatName = $poviatName;

        return $this;
    }

    /**
     * @param string $regon
     *
     * @return CompanyModel
     */
    public function setRegon(string $regon): CompanyModel
    {
        $this->regon = $regon;

        return $this;
    }

    /**
     * @param string $silosID
     *
     * @return CompanyModel
     */
    public function setSilosID(string $silosID): CompanyModel
    {
        $this->silosID = new SilosEnum((int)$silosID);

        return $this;
    }

    /**
     * @param mixed $type
     *
     * @return CompanyModel
     */
    public function setTyp($type): CompanyModel
    {
        $this->type = new TypeEnum($type);

        return $this;
    }

    /**
     * @param string|null $streetName
     *
     * @return CompanyModel
     */
    public function setUlica(?string $streetName): CompanyModel
    {
        $this->streetName = $streetName;

        return $this;
    }

    /**
     * @param string $voivodshipName
     *
     * @return CompanyModel
     */
    public function setWojewodztwo(string $voivodshipName): CompanyModel
    {
        $this->voivodshipName = $voivodshipName;

        return $this;
    }
}
