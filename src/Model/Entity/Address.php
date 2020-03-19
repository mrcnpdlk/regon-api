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

namespace Mrcnpdlk\Api\Regon\Model\Entity;


class Address
{
    /**
     * @var string
     */
    public $countryId;
    /**
     * @var string
     */
    public $countryName;
    /**
     * @var string
     */
    public $provinceId;
    /**
     * @var string
     */
    public $provinceName;
    /**
     * @var string
     */
    public $districtId;
    /**
     * @var string
     */
    public $districtName;
    /**
     * @var string
     */
    public $communeId;
    /**
     * @var string
     */
    public $communeTypeId;
    /**
     * @var string
     */
    public $communeName;
    /**
     * @var string
     */
    public $postalCode;
    /**
     * @var string
     */
    public $cityId;
    /**
     * @var string
     */
    public $cityName;
    /**
     * @var string
     */
    public $postalCityId;
    /**
     * @var string
     */
    public $postalCityName;
    /**
     * @var string
     */
    public $streetId;
    /**
     * @var string
     */
    public $streetName;
    /**
     * @var string
     */
    public $homeNr;
    /**
     * @var string
     */
    public $flatNr;
}
