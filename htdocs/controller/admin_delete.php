<?php // 商品削除 処理

require_once  '../../include/conf/const.php';
require_once  '../../include/model/db.php';
require_once  '../../include/model/function.php';
require_once  '../../include/model/item.php';

$session = sessionMode();
$err = [];

$request_method = get_request_method();
if ($request_method === 'POST') {
  $item_id = get_post_data('item_id');
  $filename = get_post_data('img');
  $img_dir = dirname(__DIR__) . '\images\\';

  if (empty($item_id)) {
    $err[] = '削除できませんでした。';
  }
  
  if (!empty($err)) {
    $_SESSION['errors'] = $err; 
    redirect_to('admin.php');
    exit();
  }

  if (file_exists($img_dir . $filename)) {
    unlink($img_dir . $filename);
  }

  try {
    $link = get_db_connect();
    $link->beginTransaction();

    $result = delete_items($link, $item_id);
    $link->commit();

    $_SESSION['success'] = '商品を削除しました。';

  } catch(PDOException $e) {
    $link->rollback();
    echo $e->getMessage();
    exit();
  }
}
redirect_to('admin.php');