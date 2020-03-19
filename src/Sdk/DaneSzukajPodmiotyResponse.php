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
 * Time: 20:37
 */

namespace Mrcnpdlk\Api\Regon\Sdk;


class DaneSzukajPodmiotyResponse
{
    /**
     * @var string
     */
    public $response;

    /**
     * @param string $result
     *
     * @return $this
     */
    public function setDaneSzukajPodmiotyResult(string $result): self
    {
        $this->response = $result;

        return $this;
    }
}
