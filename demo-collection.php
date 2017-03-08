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

echo $all_items;