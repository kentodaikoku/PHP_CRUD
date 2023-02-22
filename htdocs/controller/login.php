<?php // ログイン画面

require_once '../../include/conf/const.php';
require_once '../../include/model/db.php';
require_once '../../include/model/function.php';

session_start();

// TODO: ログイン済みの処理
// ログイン済み
// if (isset($_SESSION['user_id']) === true) {
//     redirect_to('goods.php');
// }

if (isset($_SESSION['login_err_flag']) === true) {
    $login_err_flag = $_SESSION['login_err_flag'];
    $_SESSION['login_err_flag'] = FALSE;
} else {
    $login_err_flag = FALSE;
}

// cookie
if (isset($_COOKIE['user_name']) === true) {
    $user_name = $_COOKIE['user_name'];
} else {
    $user_name = '';
}

if (isset($_SESSION['success']) === true) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}

$user_name = entity_str($user_name);

include_once '../../include/view/user_login.php';