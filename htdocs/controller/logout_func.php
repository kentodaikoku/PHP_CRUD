<?php // ログアウト処理

require_once '../../include/conf/const.php';
require_once '../../include/model/db.php';
require_once '../../include/model/function.php';

session_start();

// セッション名取得
$session_name = session_name();

$_SESSION = [];

// セッションID削除
if (isset($_COOKIE[$session_name])) {
    // sessionン関する設定を取得
    $params = session_get_cookie_params();

    // sessionに利用しているcookieの有効期限を過去にすることで無効化
    setcookie(
        $session_name, '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();
redirect_to('login.php');