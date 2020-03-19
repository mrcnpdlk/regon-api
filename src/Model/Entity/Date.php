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


class Date
{
    /**
     * @var string
     */
    public $add;
    /**
     * @var string
     */
    public $create;
    /**
     * @var string
     */
    public $start;
    /**
     * @var string
     */
    public $suspend;
    /**
     * @var string
     */
    public $resume;
    /**
     * @var string
     */
    public $change;
    /**
     * @var string
     */
    public $close;
    /**
     * @var string
     */
    public $delete;

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return !($this->close || $this->delete);
    }
}
