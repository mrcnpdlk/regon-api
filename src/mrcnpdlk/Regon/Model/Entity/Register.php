<?php

namespace mrcnpdlk\Regon\Model\Entity;


class Register
{
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $name;

    public function __construct(string $id, string $name)
    {
        $this->id   = $id;
        $this->name = $name;
    }
}