<?php
/**
 * Created by Marcin.
 * Date: 11.09.2017
 * Time: 21:58
 */

namespace mrcnpdlk\Regon\Model;


class SearchResult
{
    /**
     * Regon ID
     *
     * @var string
     */
    public $regon;
    /**
     * Entity name
     *
     * @var string
     */
    public $name;
    /**
     * Province name
     *
     * @var string
     */
    public $provinceName;
    /**
     * District name
     *
     * @var string
     */
    public $districtName;
    /**
     * Commune name
     *
     * @var string
     */
    public $communeName;
    /**
     * City name
     *
     * @var string
     */
    public $cityName;
    /**
     * Postal code
     *
     * @var string
     */
    public $postalCode;
    /**
     * Street name
     *
     * @var string
     */
    public $streetName;
    /**
     * @var string
     */
    protected $typeId;
    /**
     * @var string
     */
    protected $silosId;

    public function __construct(\stdClass $element)
    {
        /** @noinspection PhpUndefinedFieldInspection */
        $this->regon = $element->Regon;
        /** @noinspection PhpUndefinedFieldInspection */
        $this->name = $element->Nazwa;
        /** @noinspection PhpUndefinedFieldInspection */
        $this->provinceName = $element->Wojewodztwo;
        /** @noinspection PhpUndefinedFieldInspection */
        $this->districtName = $element->Powiat;
        /** @noinspection PhpUndefinedFieldInspection */
        $this->communeName = $element->Gmina;
        /** @noinspection PhpUndefinedFieldInspection */
        $this->cityName = $element->Miejscowosc;
        /** @noinspection PhpUndefinedFieldInspection */
        $this->postalCode = $element->KodPocztowy;
        /** @noinspection PhpUndefinedFieldInspection */
        $this->streetName = $element->Ulica;
        /** @noinspection PhpUndefinedFieldInspection */
        $this->typeId = $element->Typ;
        /** @noinspection PhpUndefinedFieldInspection */
        $this->silosId = $element->SilosID;
    }

    /**
     * @return string
     */
    public function getTypeId()
    {
        return $this->typeId;
    }

    /**
     * @return string
     */
    public function getSilosId()
    {
        return $this->silosId;
    }
}