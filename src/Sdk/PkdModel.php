<?php
/**
 * Created by Marcin.
 * Date: 21.03.2020
 * Time: 20:22
 */

namespace Mrcnpdlk\Api\Regon\Sdk;

class PkdModel
{
    /**
     * @var string
     */
    public $code;
    /**
     * @var string
     */
    public $name;
    /**
     * @var bool
     */
    public $isMain;

    /**
     * @param string $code
     *
     * @return $this
     */
    public function setPrawPkdKod(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setPrawPkdNazwa(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string $status
     *
     * @return $this
     */
    public function setPrawPkdPrzewazajace(string $status): self
    {
        $this->isMain = '1' === $status;

        return $this;
    }

    /**
     * @param string $code
     *
     * @return $this
     */
    public function setFizPkdKod(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setFizPkdNazwa(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string $status
     *
     * @return $this
     */
    public function setFizPkdPrzewazajace(string $status): self
    {
        $this->isMain = '1' === $status;

        return $this;
    }

    /**
     * @param string $code
     *
     * @return $this
     */
    public function setLokFizPkdKod(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setLokFizPkdNazwa(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string $status
     *
     * @return $this
     */
    public function setLokFizPkdPrzewazajace(string $status): self
    {
        $this->isMain = '1' === $status;

        return $this;
    }

    /**
     * @param string $code
     *
     * @return $this
     */
    public function setLokprawPkdKod(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setLokprawPkdNazwa(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string $status
     *
     * @return $this
     */
    public function setLokprawPkdPrzewazajace(string $status): self
    {
        $this->isMain = '1' === $status;

        return $this;
    }
}
