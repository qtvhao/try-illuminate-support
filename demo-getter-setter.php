<pre><?php
/**
 * Created by PhpStorm.
 * User: qtvha
 * Date: 3/9/2017
 * Time: 12:01 AM
 */
use Illuminate\Support\Collection;
function dd($data){
    echo json_encode($data, JSON_PRETTY_PRINT);
    die;
}
require_once 'vendor/autoload.php';
require_once 'User.php';
require_once 'DataAccessor.php';

function data(&$data = [])
{
    return new DataAccessor($data);
}
/** @var DataAccessor $user */
$user = new User();
$userAccessor = data($user);
#GETTER
dd($userAccessor->get('display_name'));
dd($userAccessor->get('property_not_exists', 'default_value'));
$userAccessor->dd();
dd($userAccessor->get('relations.user_groups.*.privileges.*'));
dd($userAccessor->collect('relations.user_groups.*.privileges.*')->unique()->toArray());
#DEBUG
//$userAccessor->dd('relations.user_groups.*.privileges.*');
#SETTER
$userAccessor->set('relations.sites.0.domain', 'g.co');
$userAccessor->set('relations.user_groups.0.privileges', ['c','r','u','d']);
$userAccessor->set('relations.user_groups.*.privileges', ['c','r','u','d']);
