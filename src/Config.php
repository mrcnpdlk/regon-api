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
 * Time: 20:03
 */

namespace mrcnpdlk\Regon;


use Mrcnpdlk\Lib\ConfigurationOptionsAbstract;

class Config extends ConfigurationOptionsAbstract
{
    /**
     * @var string
     */
    protected $password;
    /**
     * @var string
     */
    protected $wsdl = 'https://wyszukiwarkaregon.stat.gov.pl/wsBIR/wsdl/UslugaBIRzewnPubl-ver11-prod.wsdl';
    /**
     * @var string
     */
    protected $location = 'https://wyszukiwarkaregon.stat.gov.pl/wsBIR/UslugaBIRzewnPubl.svc';

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @param string $location
     *
     * @return Config
     */
    public function setLocation(string $location): Config
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return Config
     */
    public function setPassword(string $password): Config
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getWsdl(): string
    {
        return $this->wsdl;
    }

    /**
     * @param string $wsdl
     *
     * @return Config
     */
    public function setWsdl(string $wsdl): Config
    {
        $this->wsdl = $wsdl;

        return $this;
    }
}
