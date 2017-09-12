<?php

namespace mrcnpdlk\Regon\Model;


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


    public function __construct()
    {
    }
}