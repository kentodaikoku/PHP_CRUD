<?php

/**
* 特殊文字をHTMLエンティティに変換する
* @param str $str 変換前文字
* @return str 変換後文字
*/
function entity_str($str) {
    return htmlspecialchars($str, ENT_QUOTES, HTML_CHARACTER_SET);
}

/**
* 特殊文字をHTMLエンティティに変換する(2次元配列の値)
* @param array $assoc_array 変換前配列  * @return array 変換後配列
*/
function entity_assoc_array($assoc_array) {
    foreach ($assoc_array as $key => $value) {
        foreach ($value as $keys => $values) {
            // 特殊文字をHTMLエンティティに変換
            $assoc_array[$key][$keys] = entity_str($values);
        }
    }
    return $assoc_array;
}

/**
* リクエストメソッドを取得
* @return str GET/POST/PUTなど
*/
function get_request_method() {
    return $_SERVER['REQUEST_METHOD'];
}

/**
* POSTデータを取得
* @param str $key 配列キー  @return str POST値
*/
function get_post_data(string $key) {
    $str = '';
    if (isset($_POST[$key]) === TRUE) {
        $str = $_POST[$key];
    }
    return $str;
}

/**
 * @param int [type] $key
 * @return int $int 
 */
function get_post_int_data($key) {
    if (isset($_POST[$key]) === TRUE) {
        $int = (int) $_POST[$key];
    }
    return $int;
}

// URLリンク用関数
function redirect_to ($url) {
    header('Location:' . $url );
    exit();
}

// session
function sessionMode() {
    // セッション開始
    session_start();
    // セッション変数からuser_id取得
    if (isset($_SESSION['user_id']) === TRUE) {
        $user_id = $_SESSION['user_id'];
    } else {
       // 非ログインの場合、ログインページへリダイレクト
        redirect_to('login.php');
    }
}

function user_name_cookie() {
    if (isset($_COOKIE['user_name']) === true) {
        $user_name = $_COOKIE['user_name'];
    } else {
        $user_name = '';
    }
    $user_name = entity_str($user_name);
    return $user_name;
}
