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
require_once 'DataAccessor.php';
#BEGIN SEEDING
$all_users = Collection::make();
for ($i = 0; $i < 10; $i++) {
    $all_users->push(new User());
}
#END SEEDING

function data(&$data = [])
{
    return new DataAccessor($data);
}

$privilegesPath = '*.relations.user_groups.*.privileges.*';
$users = data($all_users);
$users->set('*.relations.sites.0.domain', 'g.co');
$users->fill('*.relations.sites.0.domain', 'g1.co');#not working with data exists
$users->fill('*.relations.sites.1.domain', 'g1.co');
var_export($users->target->toArray());
$users->set('0.relations.user_groups.*.privileges', ['c','r','u','d']);
var_export($users->target->toArray());
$users->set('*.relations.user_groups.*.privileges', ['c','r','u','d']);
var_export($users->target->toArray());
#
var_export($users->get($privilegesPath));
var_export($users->collect($privilegesPath)->unique());
var_export($users->get('property_not_exists'), 'default_value');
