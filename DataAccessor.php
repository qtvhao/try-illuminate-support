<?php

/**
 * Created by PhpStorm.
 * User: qtvha
 * Date: 3/9/2017
 * Time: 7:56 PM
 */
class DataAccessor
{
    /**
     * @var mixed
     */
    public $target;

    public static function make(&$data)
    {
        return new static($data);
    }

    public function __construct(&$target)
    {
        $this->target = &$target;
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
        return data_fill($this->target,$key,$value);
    }

    public function collect($key, $default = [])
    {
        return collect($this->get($key, $default));
    }

    public function dd($key = null)
    {
        if(is_null($key)){
            if($this->target instanceof \Illuminate\Contracts\Support\Arrayable){
                dd($this->target->toArray());
            }
            dd($this->target);
        }
        dd($this->get($key));
    }
}