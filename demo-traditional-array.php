<?php
/**
 * Created by PhpStorm.
 * User: qtvha
 * Date: 3/9/2017
 * Time: 12:01 AM
 */
use Illuminate\Support\Collection;

require_once 'vendor/autoload.php';
$users = seed_users()->toArray();

//echo json_encode($all_items);
$items = $users;
#except
unset($items[2]);
unset($items[3]);
unset($items[1]);
unset($items[2]);
#only
$items = [
    0 => $items[0],
    5 => $items[5],
    6 => $items[6],
];
#pluck
$items = array_map(function($item){
    return data_get($item, 'relations.user_groups.*.privileges.*');
}, $items);
$items = array_flatten($items);
$items = array_unique($items);
print_r($items);
