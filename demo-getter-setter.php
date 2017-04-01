<pre><?php
/**
 * Created by PhpStorm.
 * User: qtvha
 * Date: 3/9/2017
 * Time: 12:01 AM
 */
/**
 * @param $data
 */
function dd($data){
    echo json_encode($data, JSON_PRETTY_PRINT);
    die;
}
require_once 'vendor/autoload.php';
$target = new User();
/** @var DataAccessor $user */
$user = data($target);
#GETTER

#Lấy $user->display_name hoặc $user[display_name]
$display_name = $user->get('display_name');
dd($display_name);

#Trả về default_value nếu không tồn tại property
$username = $user->get('property_not_exists', 'default_value');
dd($username);

# dump & die data
$user->dd();

# get data có cấu trúc phức tạp thì sẽ đơn giản hơn
# lấy $user.relations.user_groups
# lấy tất cả privileges trong từng user_groups
# collapse vào thành 1 mảng duy nhất
$privileges = $user->get('relations.user_groups.*.privileges.*');
dd($privileges);

$defaultVal = data($target)->get('the.very.very.very.long.path.which.not.exists', 'default_value');
dd($defaultVal);

# collect data dạng array từ dữ liệu phức tạp
$privileges = $user->collect('relations.user_groups.*.privileges.*');
$is_allow_to_read = $privileges->contains('read');
dd($is_allow_to_read);

#DEBUG

# có thể dump die data ra trước
# sau đó dễ dàng đổi từ $user->dd() thành $user->get() ngay được
$user->dd('relations.user_groups.*.privileges.*');

#SETTER

# các element không tồn tại sẽ tự động được tạo mới
$user->set('relations.sites.0.domain', 'g.co');
$user->dd();

# set data theo path chính xác
$user->set('relations.user_groups.0.privileges', ['c','r','u','d']);
$user->dd();

# set data theo path dạng wild-card
$user->set('relations.user_groups.*.privileges', ['c','r','u','d']);
$user->dd();
