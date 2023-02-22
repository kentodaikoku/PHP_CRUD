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
  
  try {
    $link = get_db_connect();
    $link->beginTransaction();
    
    // 商品削除
    $result = delete_cart($link, $item_id, $user_id);

    $link->commit();
  } catch(PDOException $e) {
    $link->rollback();
    echo $e->getMessage();
    exit();
  }

  redirect_to('cart.php');
}
