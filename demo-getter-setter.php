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
$user = data(new User());

#GETTER
#Lấy $user->display_name hoặc $user[display_name]
dd($user->get('display_name'));
#Trả về default_value nếu không tồn tại property
dd($user->get('property_not_exists', 'default_value'));
$user->dd();
# dump & die data
dd($user->get('relations.user_groups.*.privileges.*'));
dd($user->collect('relations.user_groups.*.privileges.*')->unique()->toArray());

#DEBUG
//$userAccessor->dd('relations.user_groups.*.privileges.*');

#SETTER
$user->set('relations.sites.0.domain', 'g.co');
$user->set('relations.user_groups.0.privileges', ['c','r','u','d']);
$user->set('relations.user_groups.*.privileges', ['c','r','u','d']);
