<?php

/**
 * Created by PhpStorm.
 * User: qtvha
 * Date: 3/9/2017
 * Time: 7:56 PM
 */
class Data
{
    public $data;

    public function make($data)
    {
        return new static($data);
    }

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function get($key, $default = null)
    {
        return data_get($this->data, $key, $default);
    }

    public function set($key, $value)
    {
        return data_set($this->data,$key,$value);
    }

    public function fill($key, $value)
    {
        return data_set($this->data,$key,$value);
    }

    public function collect($key, $default = [])
    {
        return collect($this->get($key, $default));
    }
}