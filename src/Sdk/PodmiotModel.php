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
 *
 * @author  Marcin Pudełek <marcin@pudelek.org.pl>
 */

/**
 * Created by Marcin.
 * Date: 19.03.2020
 * Time: 21:46
 */

namespace Mrcnpdlk\Api\Regon\Sdk;


class PodmiotModel
{
    /**
     * @var string
     */
    public $Regon;
    /**
     * @var string|null
     */
    public $Nip;
    /**
     * @var string|null
     */
    public $StatusNip;
    /**
     * @var string
     */
    public $Nazwa;
    /**
     * @var string
     */
    public $Wojewodztwo;
    /**
     * @var string
     */
    public $Powiat;
    /**
     * @var string
     */
    public $Gmina;
    /**
     * @var string
     */
    public $Miejscowosc;
    /**
     * @var string|null
     */
    public $KodPocztowy;
    /**
     * @var string
     */
    public $Ulica;
    /**
     * @var string
     */
    public $NrNieruchomosci;
    /**
     * @var string|null
     */
    public $NrLokalu;
    /**
     * @var \Mrcnpdlk\Api\Regon\Enum\TypeEnum
     */
    public $Typ;
    /**
     * @var int
     */
    public $SilosID;
    /**
     * @var string|null
     */
    public $DataZakonczeniaDzialalnosci;
    /**
     * @var string
     */
    public $MiejscowoscPoczty;
}
