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


class Register
{
    /**
     * @var string
     */
    public $nr;
    /**
     * @var string
     */
    public $typeId;
    /**
     * @var string
     */
    public $typeName;
    /**
     * @var string
     */
    public $dateAdd;

    public function __construct(string $nr = null, string $typeId, string $typeName, string $dateAdd = null)
    {
        $this->nr       = $nr;
        $this->typeId   = $typeId;
        $this->typeName = $typeName;
        $this->dateAdd  = $dateAdd;
    }
}
