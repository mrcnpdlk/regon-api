<?php

namespace mrcnpdlk\Regon;


class Api
{
    /**
     * @var Client
     */
    private $oGusApi;

    public function __construct(Client $oClient)
    {
        $this->oGusApi = new NativeApi($oClient);
    }
}
