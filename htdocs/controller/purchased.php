<?php
require_once '../../include/conf/const.php';
require_once '../../include/model/db.php';
require_once '../../include/model/function.php';
require_once '../../include/model/item.php';
require_once '../../include/model/purchase.php';

$session =sessionMode();
// ユーザーネーム表示用
$user_name = user_name_cookie();

$purchased_data = [];
$user_id = $_SESSION['user_id'];

try {
  $link = get_db_connect();
  $link->beginTransaction();
  
  // 購入商品取得
  $purchased_data = get_purchased_items($link, $user_id);

  $link->commit();
  $purchased_data = entity_assoc_array($purchased_data);

  $total_price = 0;
  foreach ($purchased_data as $value) {
    $total_price += $value['price'] * $value['amount'];
  }

  // 購入履歴削除（仕様によって変更）
  $result = delete_purchased_items($link, $user_id);

} catch(PDOException $e) {
  $link->rollback();
  echo $e->getMessage();
  exit();
}

include_once ('../../include/view/purchased.php');
