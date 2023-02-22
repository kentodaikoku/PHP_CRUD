<?php

require_once '../../include/conf/const.php';
require_once '../../include/model/function.php';
require_once '../../include/model/db.php';
require_once '../../include/model/item.php';
require_once '../../include/model/cart.php';

$session = sessionMode();

$request_method = get_request_method();
if ($request_method === 'POST') {
  $item_id = get_post_int_data('item_id');
  $user_id = $_SESSION['user_id'];

  try {
    $link = get_db_connect();
    $link->beginTransaction();
    
    // カート用の情報取得
    $item_cart = get_item_cart($link, $user_id, $item_id);
    $amount = $item_cart['amount'];

    // カートに入れるボタンをした際の在庫数チェック
    $item = get_item($link, $item_id);
    if ($amount >= $item['stock']) {
      $err = '*指定した数量分の在庫数が不足しています。';
      $_SESSION['error'] = $err;
      redirect_to('goods.php');
    }

    if (isset($amount)) {
      // 商品数を更新
      $amount++;
      $result = update_amount($link, $amount, $item_id, $user_id);
    } else {
      // 商品をカートに追加
      $amount = 1;
      $result = insert_to_cart($link, $user_id, $item_id, $amount);
    }

    $link->commit();
    $_SESSION['success'] = '商品をカートに追加しました。';

  } catch(PDOException $e) {
    $link->rollback();
    echo $e->getMessage();
    exit();
  }

  redirect_to('goods.php');
}