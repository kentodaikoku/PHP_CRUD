<?php
require_once '../../include/conf/const.php';
require_once '../../include/model/db.php';
require_once '../../include/model/function.php';
require_once '../../include/model/item.php';
require_once '../../include/model/cart.php';
require_once '../../include/model/purchase.php';

$session = sessionMode();
$user_id = $_SESSION['user_id'];
$cart_data = [];
$err = [];

$request_method = get_request_method();
if ($request_method === 'POST') {
  try {
    $link = get_db_connect();
    $link->beginTransaction();
    
    // カートテーブルの情報取得
    $cart_data = get_cart($link, $user_id);

    foreach ($cart_data as $cart) {
      // 購入時点で在庫数が不足していた場合
      if ($cart['stock'] < $cart['amount']) {
        $err = "申し訳ございません、該当商品の在庫が不足しています。数量を変更してください。
                <br>商品：{$cart['item_name']}, 購入可能数量：{$cart['stock']}";
        $_SESSION['error'] = $err;
        redirect_to('cart.php');
      }
      
       // 購入テーブルにデータ挿入
      $result = insert_purchased_items($link, $user_id, $cart['item_id'], $cart['amount']);
      // 在庫数から購入分差し引く
      $cart['stock'] -= $cart['amount'];
      $result = update_stock($link,  $cart['stock'], $cart['item_id']);
    }

    // カートテーブルの情報削除
    $result = delete_user_cart($link, $user_id);

    $link->commit();

  } catch(PDOException $e) {
    $link->rollback();
    echo $e->getMessage();
    exit();
  }
  redirect_to('purchased.php');
}
