<?php // 在庫数変更　処理

require_once  '../../include/conf/const.php';
require_once  '../../include/model/db.php';
require_once  '../../include/model/function.php';
require_once  '../../include/model/item.php';

$session = sessionMode();
$err = [];

$request_method = get_request_method();
if ($request_method === 'POST') {
    $item_id = get_post_data('item_id');
    $stock = get_post_data('stock');

    // 在庫数バリデーション
    if (empty($stock)) {
        $err[] = '在庫数が未入力です。';
    }
    if (preg_match("/\A[0-9]+\Z/", $stock) !== 1) {
        $err[] = '在庫数は半角数字で入力してください。';
    }

    try {
        $link = get_db_connect();
        $link->beginTransaction();

        if (count($err) > 0) {
            $_SESSION['errors'] = $err;
            redirect_to('admin.php');
            exit();
        }

        // 在庫数変更
        $result = update_stock($link, $stock, $item_id);
        $link->commit();

        $stock = entity_str($stock);
        $_SESSION['success'] = '在庫数を更新しました。';

    } catch(PDOException $e) {
        $link->rollback();
        echo $e->getMessage();
        exit();
    }
}

redirect_to('admin.php');