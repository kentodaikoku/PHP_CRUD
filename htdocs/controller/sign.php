<?php  // 新規登録画面用ページ

require_once '../../include/conf/const.php';
require_once '../../include/model/function.php';
require_once '../../include/model/db.php';
require_once '../../include/model/user.php';

session_start();

$user_name = '';
$passwd = '';
$err = [];

$request_method = get_request_method();
if ($request_method === 'POST') {
    $user_name = get_post_data('user_name');
    $passwd = get_post_data('passwd');
    
    // バリデーション
    if (emptyInputSignup($user_name, $passwd)) {
        $err[] = 'ユーザー名またはパスワードが未入力です。';
    }
    if (!matchInputSignup($user_name, $passwd)) {
        $err[] = 'ユーザー名及びパスワードは半角英数字6文字以上で入力してください。';
    }
    if (mb_strlen($user_name) >= 30) {
        $err[] = 'ユーザー名は３０文字以内で入力してください。';
    }
    
    try {
        $link = get_db_connect();
        $link->beginTransaction();

        $old_users = get_user_name($link);
        foreach($old_users as $user) {
            if ($user_name === $user['user_name']) {
                $err[] = 'このユーザー名は既に利用されています。';
            }
        }

        if (!empty($err)) {
            include_once '../../include/view/user_sign.php';
            exit();
        }

        $passwd = password_hash($passwd, PASSWORD_DEFAULT);

        $result = insert_user_table($link, $user_name, $passwd);
        $link->commit();

        $user_name = entity_str($user_name);
        $passwd = entity_str($passwd);

        $_SESSION['success'] = '新規ユーザーを作成しました！ログインしてください。';
        redirect_to('login.php');
    } catch(PDOException $e) {
        $link->rollback();
        echo $e->getMessage();
        exit();
    }
}
include_once '../../include/view/user_sign.php';