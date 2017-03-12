<?php

/**
 * Created by PhpStorm.
 * User: qtvha
 * Date: 3/9/2017
 * Time: 12:09 AM
 */
class User implements \Illuminate\Contracts\Support\Arrayable
{
    public $relations;

    public function __construct()
    {
        data_set($this->relations, 'user_groups.0.privileges', [
            'create',
            'read',
            'update',
            'delete'
        ]);
    }

    public function hasPrivilege($privilege)
    {
        $privileges = data($this->relations)->collect('user_groups.*.privileges.*');

        return $privileges->contains($privilege);
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return (array)$this;
    }
}