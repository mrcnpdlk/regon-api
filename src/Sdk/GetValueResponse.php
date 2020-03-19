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

namespace mrcnpdlk\Regon\Sdk;


class GetValueResponse
{
    /**
     * @var string
     */
    public $response;

    /**
     * @param mixed $response
     *
     * @return $this
     */
    public function setGetValueResult($response): self
    {
        $this->response = $response;

        return $this;
    }
}
