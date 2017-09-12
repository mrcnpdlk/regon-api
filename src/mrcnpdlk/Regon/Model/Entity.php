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
     * Szczególna orma prawna - ID
     *
     * @var string
     */
    public $detailedLegalFormId;
    /**
     * Szczególna orma prawna - nazwa
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
     * @var Owner
     */
    public $owner;

    /**
     * Data wpisu do REGON
     *
     * @var string
     */
    public $dateAdd;
    /**
     * Data wpisu do REGON
     *
     * @var string
     */
    public $dateCreate;
    /**
     * Data rozpoczęcia działalności
     *
     * @var string
     */
    public $dateStart;
    /**
     * Data zakończenia
     *
     * @var string
     */
    public $dateSuspend;
    /**
     * Data odwweszenia
     *
     * @var string
     */
    public $dateResume;
    /**
     * Data zmiany wpisu
     *
     * @var string
     */
    public $dateChange;
    /**
     * Data zamknięcia
     *
     * @var string
     */
    public $dateClose;
    /**
     * Data wykreślenia z REGON
     *
     * @var string
     */
    public $dateDelete;

    /**
     * Liczba jednostek lokalnych/oddziałów
     *
     * @var int
     */
    public $departmentsCount;

    /**
     * Dane adresowe siedziby głównej
     *
     * @var Address
     */
    public $addressHead;
    /**
     * Dane adresowe korespondencji
     *
     * @var Address
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