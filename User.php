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
        $default_privileges = ['create', 'read', 'update', 'delete'];
        data($this->relations)->set('user_groups.0.privileges', $default_privileges);
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