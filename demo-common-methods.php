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
#return self
$users
    ->each(function (User $item) {/*echo $item;*/
        echo $item->display_name;
    })
    // Cách dùng cho các hàm map & filter & reject cũng như vậy
;

#GET ITEM
echo $users->__toString();
print_r($users[2]);
print_r($users->all());
print_r($users->implode(''));

#CHECKER
print_r($users->isEmpty());
print_r($users->every(function () {return true;}));
print_r($users->pluck('display_name')->contains('value'));
