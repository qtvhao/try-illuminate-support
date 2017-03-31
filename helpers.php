<?php
use Illuminate\Support\Collection;

/**
 * Created by PhpStorm.
 * User: haonx
 * Date: 3/31/2017
 * Time: 7:06 PM
 */

function data(&$data){
    return new DataAccessor($data);
}

/**
 * @return Collection
 */
function seed_users(){
    $users = collect(range(1, 5))->map(function () {
        return new User();
    });

    return $users;
}
