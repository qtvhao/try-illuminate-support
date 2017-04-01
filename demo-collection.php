<?php
/**
 * Created by PhpStorm.
 * User: qtvha
 * Date: 3/9/2017
 * Time: 12:01 AM
 */
use Illuminate\Support\Collection;
require_once 'vendor/autoload.php';
$users = seed_users();
echo $users;
#return self
$items = $users
    ->except(2, 3)
    ->except([1, 2])
    ->only(0, 5, 6)
    ->pluck('relations.user_groups.*.privileges.*')
    ->flatten()
    ->unique()
;
print_r($items->toArray());
#Thế Collection là gì?
