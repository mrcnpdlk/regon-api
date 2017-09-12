<?php

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