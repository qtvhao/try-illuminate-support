<?php

/**
 * Created by PhpStorm.
 * User: qtvha
 * Date: 3/9/2017
 * Time: 7:56 PM
 */
class Data
{
    /**
     * @var mixed
     */
    public $target;

    public function make($data)
    {
        return new static($data);
    }

    public function __construct($target)
    {
        $this->target = $target;
    }

    public function get($key, $default = null)
    {
        return data_get($this->target, $key, $default);
    }

    public function set($key, $value)
    {
        return data_set($this->target,$key,$value);
    }

    public function fill($key, $value)
    {
        return data_set($this->target,$key,$value);
    }

    public function collect($key, $default = [])
    {
        return collect($this->get($key, $default));
    }
}