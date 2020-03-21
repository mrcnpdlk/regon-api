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
 * Time: 20:03
 */

namespace Mrcnpdlk\Api\Regon;

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
     * @var string
     */
    protected $cacheDir;
    /**
     * Cache time [sec]
     *
     * @var int
     */
    protected $cacheTtl = 60;

    /**
     * Config constructor.
     *
     * @param array<string,mixed> $config
     *
     * @throws \Mrcnpdlk\Lib\ConfigurationException
     */
    public function __construct(array $config = [])
    {
        $this->cacheDir = sys_get_temp_dir();
        parent::__construct($config);
    }

    /**
     * @return string
     */
    public function getCacheDir(): string
    {
        return $this->cacheDir;
    }

    /**
     * @param string $cacheDir
     *
     * @return Config
     */
    public function setCacheDir(string $cacheDir): Config
    {
        $this->cacheDir = $cacheDir;

        return $this;
    }

    /**
     * @return int
     */
    public function getCacheTtl(): int
    {
        return $this->cacheTtl;
    }

    /**
     * @param int $cacheTtl
     *
     * @return Config
     */
    public function setCacheTtl(int $cacheTtl): Config
    {
        $this->cacheTtl = $cacheTtl;

        return $this;
    }

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
