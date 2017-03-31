<?php

/**
 * Created by PhpStorm.
 * User: qtvha
 * Date: 3/9/2017
 * Time: 12:09 AM
 */
class User implements \Illuminate\Contracts\Support\Arrayable, \Illuminate\Contracts\Support\Jsonable
{
    public $relations;
    public $display_name;

    public function __construct()
    {
        $default_privileges = ['create', 'read', 'update', 'delete'];
        data($this)->set('relations.user_groups.0.privileges', $default_privileges);
        data($this)->set('relations.user_groups.1.privileges', $default_privileges);
        data($this)->set('display_name', 'haonx '.str_random(5));
    }

    public function hasPrivilege($privilege)
    {
        $privileges = data($this)->collect('relations.user_groups.*.privileges.*');

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

    public function sayHello()
    {
        echo "Hi, $this->display_name <br/>";
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param  int $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this, $options);
    }
}
