<?php // 商品購入画面用ページ

require_once '../../include/conf/const.php';
require_once '../../include/model/function.php';
require_once '../../include/model/db.php';
require_once '../../include/model/item.php';

$session = sessionMode();

// ユーザーネーム表示用
$user_name = user_name_cookie();

$items_data = [];

try {
  $link = get_db_connect();
  $link->beginTransaction();
  
  // 商品の一覧を取得
  $items_data = get_items_list($link);
  $link->commit();

  $items_data = entity_assoc_array($items_data);
} catch(PDOException $e) {
  $link->rollback();
  echo $e->getMessage();
  exit();
}

if (isset($_SESSION['success'])) {
  $success = $_SESSION['success'];
  unset($_SESSION['success']);
}

if (isset($_SESSION['error'])) {
  $error = $_SESSION['error'];
  unset($_SESSION['error']);
}

include_once '../../include/view/goods_list.php';