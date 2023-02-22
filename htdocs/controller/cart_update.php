<?php

require_once '../../include/conf/const.php';
require_once '../../include/model/db.php';
require_once '../../include/model/function.php';
require_once '../../include/model/item.php';
require_once '../../include/model/cart.php';

$session = sessionMode();
$user_id = $_SESSION['user_id'];

$request_method = get_request_method();
if ($request_method === 'POST') {
  $item_id = get_post_data('item_id');
  $amount = get_post_int_data('amount');

  // バリデーション

  try {
    $link = get_db_connect();
    $link->beginTransaction();

    $item = get_item($link, $item_id);

    if ($amount > $item['stock']) {
      $err = '*指定した数量分の在庫数が不足しています。';
      $_SESSION['error'] = $err;
      redirect_to('cart.php');
    }

    // 商品数を更新
    $result = update_cart($link, $amount, $item_id, $user_id);
    $link->commit();

    $_SESSION['success'] = '商品をカートに追加しました。';
    $amount = entity_str($amount);

  } catch(PDOException $e) {
    $link->rollback();
    echo $e->getMessage();
    exit();
  }

  redirect_to('cart.php');
}