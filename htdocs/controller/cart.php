<?php 

require_once '../../include/conf/const.php';
require_once '../../include/model/db.php';
require_once '../../include/model/function.php';
require_once '../../include/model/item.php';
require_once '../../include/model/cart.php';

$session =sessionMode();
// ユーザーネーム表示用
$user_name = user_name_cookie();

$cart_data = [];
$user_id = $_SESSION['user_id'];

try {
  $link = get_db_connect();

  $cart_data = get_cart($link, $user_id);
  
  $cart_data = entity_assoc_array($cart_data);
} catch(PDOException $e) {
  echo $e->getMessage();
  exit();
}

$total_price = 0;
foreach ($cart_data as $value) {
  $total_price += $value['price'] * $value['amount'];
}

if (isset($_SESSION['success'])) {
  $success = $_SESSION['success'];
  unset($_SESSION['success']);
}

if (isset($_SESSION['error'])) {
  $error = $_SESSION['error'];
  unset($_SESSION['error']);
}

include_once '../../include/view/cart.php';