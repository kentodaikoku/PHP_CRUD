<?php // ログイン処理

require_once '../../include/conf/const.php';
require_once '../../include/model/function.php';
require_once '../../include/model/db.php';
require_once '../../include/model/user.php';

if (get_request_method() !== 'POST') {
    redirect_to('login.php');
}

session_start();

$user_name = get_post_data('user_name');
$passwd = get_post_data('passwd');
setcookie('user_name', $user_name, time() + 60 * 60 * 24 * 365);

try {
    $link = get_db_connect();
    $link->beginTransaction();
    
    $user_data = get_user_for_login($link, $user_name);
    
    if (!password_verify($passwd, $user_data['password'])) {
        $_SESSION['login_err_flag'] = TRUE;
        redirect_to('login.php');
    }

    // ログイン成功
    $_SESSION['user_id'] = $user_data['user_id'];
    
    if ($user_name === 'admin123' && $passwd === 'admin123') {
        redirect_to('admin.php');
    }
    
    redirect_to('goods.php');   
    $link->commit();

} catch(PDOException $e) {
    $link->rollback();
    echo $e->getMessage();
    exit();
}
