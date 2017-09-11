<?php
/**
 * Created by Marcin.
 * Date: 11.09.2017
 * Time: 21:58
 */

namespace mrcnpdlk\Regon\Model;


class Entity
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

    public function __construct(\SimpleXMLElement $element)
    {
        /** @noinspection PhpUndefinedFieldInspection */
        $this->regon = strval($element->Regon);
        /** @noinspection PhpUndefinedFieldInspection */
        $this->name         = strval($element->Nazwa);
        /** @noinspection PhpUndefinedFieldInspection */
        $this->provinceName = strval($element->Wojewodztwo);
        /** @noinspection PhpUndefinedFieldInspection */
        $this->districtName = strval($element->Powiat);
        /** @noinspection PhpUndefinedFieldInspection */
        $this->communeName = strval($element->Gmina);
        /** @noinspection PhpUndefinedFieldInspection */
        $this->cityName   = strval($element->Miejscowosc);
        /** @noinspection PhpUndefinedFieldInspection */
        $this->postalCode = strval($element->KodPocztowy);
        /** @noinspection PhpUndefinedFieldInspection */
        $this->streetName = strval($element->Ulica);
        /** @noinspection PhpUndefinedFieldInspection */
        $this->typeId = strval($element->Typ);
        /** @noinspection PhpUndefinedFieldInspection */
        $this->silosId = strval($element->SilosID);
    }
}
