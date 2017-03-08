<?php

/**
 * Created by PhpStorm.
 * User: qtvha
 * Date: 3/9/2017
 * Time: 12:09 AM
 */
class User
{
    public $relations;

    public function __construct()
    {
        data_set($this, 'relations.user_groups.0.privileges', [
            'create',
            'read',
            'update',
            'delete'
        ]);
    }

    public function hasPrivilege($privilege)
    {
        $privileges = data_get($this, 'relations.user_groups.*.privileges.*');

        return collect($privileges)->search($privilege) !== false;
    }
}