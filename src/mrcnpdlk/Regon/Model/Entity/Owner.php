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
 * @author Marcin Pudełek <marcin@pudelek.org.pl>
 */

namespace mrcnpdlk\Regon\Model\Entity;


class Owner
{
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $nameSecond;
    /**
     * @var string
     */
    public $surname;

    public function __construct(string $name, string $surname, string $nameSecond = null)
    {
        $this->name       = $name;
        $this->nameSecond = $nameSecond;
        $this->surname    = $surname;
    }
}
