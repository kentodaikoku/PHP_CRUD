<?php // 商品管理ページ用

require_once '../../include/conf/const.php';
require_once '../../include/model/db.php';
require_once '../../include/model/function.php';
require_once '../../include/model/item.php';

$session = sessionMode();
$items_data = [];

try {
  // DB接続
  $link = get_db_connect();
  // 商品の一覧を取得
  $items_data = get_items_list($link);
  
  // 特殊文字をHTMLエンティティに変換
  $items_data = entity_assoc_array($items_data);
  
} catch(PDOException $e) {
  echo $e->getMessage();
  exit();
}

// メッセージ表示
$errors = [];
if (!empty($_SESSION['errors'])) {
  $errors = $_SESSION['errors'];
  unset($_SESSION['errors']);
}

if (isset($_SESSION['success'])) {
  $success = $_SESSION['success'];
  unset($_SESSION['success']);
}

// 商品一覧テンプレートファイルを読み込み
include_once '../../include/view/item_control.php';
