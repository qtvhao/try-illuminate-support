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
require_once 'Data.php';
#BEGIN SEEDING
$all_users = Collection::make();
for ($i = 0; $i < 10; $i++) {
    $all_users->push(new User());
}
#END SEEDING

function data($data = [])
{
    return new Data($data);
}

$privilegesPath = '*.relations.user_groups.*.privileges.*';
$usersAccessor = data($all_users);
$usersAccessor->set('*.relations.sites.0.domain', 'g.co');
$usersAccessor->fill('*.relations.sites.0.domain', 'g1.co');#not working with data exists
$usersAccessor->fill('*.relations.sites.1.domain', 'g1.co');
var_export($usersAccessor->target->toArray());
$usersAccessor->set('0.relations.user_groups.*.privileges', ['c','r','u','d']);
var_export($usersAccessor->target->toArray());
$usersAccessor->set('*.relations.user_groups.*.privileges', ['c','r','u','d']);
var_export($usersAccessor->target->toArray());
#
var_export($usersAccessor->get($privilegesPath));
var_export($usersAccessor->collect($privilegesPath)->unique());
