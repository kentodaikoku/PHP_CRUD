<?php

// ログイン用user取得
function get_user_for_login($link, $user_name) {
    $sql = 'SELECT user_id, password FROM user_table WHERE user_name = ?';
    $stmt = $link->prepare($sql);
    $stmt->bindValue(1, $user_name);
    $stmt->execute();
    return $stmt->fetch();
}

// user一覧を取得
function get_user_name($link) {
    $sql = 'SELECT user_id, user_name, created_at FROM user_table';
    $stmt = $link->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

/**
* userを追加する
*
* @param obj $link DBハンドル
* @return bool
*/
function insert_user_table($link, $user_name, $passwd) {
    $date = date('Y-m-d H:i:s');
    $sql = 'INSERT INTO user_table(user_name, password, created_at) VALUES(?, ?, ?)';
    $stmt = $link->prepare($sql);
    $stmt->bindValue(1, $user_name);
    $stmt->bindValue(2, $passwd);
    $stmt->bindValue(3, $date);
    $stmt->execute();
    return $stmt;
}

// 未入力チェック
function emptyInputSignup($user_name, $passwd) {
    if (empty($user_name) || empty($passwd)) return true;

    return false;
}

// 正規表現チェック
function matchInputSignup($user_name, $passwd) {
    if (preg_match("/^[a-zA-Z0-9]{6,}$/", $user_name) && preg_match("/^[a-zA-Z0-9]{6,}$/", $passwd)) {
        return true;
    }
    return false;
}