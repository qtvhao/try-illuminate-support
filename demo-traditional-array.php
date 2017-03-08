<?php
/**
 * Created by PhpStorm.
 * User: qtvha
 * Date: 3/9/2017
 * Time: 12:01 AM
 */
use Illuminate\Support\Collection;

require_once 'vendor/autoload.php';
require_once 'User.php';
#BEGIN SEEDING
$all_items = Collection::make();
for ($i = 0; $i < 10; $i++) {
    $all_items->push(new User());
}
$all_items = $all_items->toArray();
#END SEEDING

//echo json_encode($all_items);
$items = $all_items;
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
