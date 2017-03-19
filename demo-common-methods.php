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
#END SEEDING

#return self
$items = $all_items
    ->each(function ($item) {/*echo $item;*/
    })
    // map & filter is equals
    ->push(new User())
    ->reject(function () {
        return false;
    })
;

#GET ITEM
print_r($all_items[2]);
print_r($all_items->search('value'));
print_r($all_items->search(function () {
    return true;
}));
print_r($all_items->all());
print_r($items->implode(''));
#CHECKER
print_r($all_items->isEmpty());
print_r($all_items->every(function () {return true;}));
print_r($all_items->contains('value'));
