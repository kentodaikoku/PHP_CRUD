<?php

/**
* DBハンドルを取得
* @return obj $link DBハンドル
*/
function get_db_connect() {
    try {
        $link = new PDO(DB_HOST_PDO, DB_USER, DB_PASSWD, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //連想配列に
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //例外
            PDO::ATTR_EMULATE_PREPARES => false //SQLインジェクション対策
        ]);
    } catch(PDOException $e) {
        echo '接続失敗' . $e->getMessage() . "\n";
        exit();
    }
    return $link;
}


function insert_db($link, $sql, $params) {
    $stmt = $link->prepare($sql);
    $stmt->execute($params);
}


// SQL文実行（Insert, Update, Delete）
function execute_db($link, $sql, $params = array()) {
    try {
      $stmt = $link->prepare($sql);
      return $stmt->execute($params);
    } catch (PDOException $e) {
      die('クエリ実行エラー:' . $e->getMessage());
    }
    return false;
  }

  // SQL文実行（読みとりRead）
function read_db_array($db, $sql, $params = array()) {
    try {
      $stmt = $db->prepare($sql);
      $stmt->execute($params);
      return $stmt->fetchAll();
    } catch(PDOException $e) {
      die('クエリ読みとりエラー');
    }
    return false;
  }