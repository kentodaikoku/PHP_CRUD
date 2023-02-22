<?php // ステータス変更　処理

require_once  '../../include/conf/const.php';
require_once  '../../include/model/db.php';
require_once  '../../include/model/function.php';
require_once  '../../include/model/item.php';

$session = sessionMode();
$err = [];

$request_method = get_request_method();
if ($request_method === 'POST') {
    $item_id = get_post_data('item_id');
    $status = get_post_data('status');

    // ステータスバリデーション
    if (!isset($status)) {
        $err = '更新エラーがありました。';
    }

    try {
        $link = get_db_connect();
        $link->beginTransaction();

        if (!empty($err)) {
            $_SESSION['error'] = $err;
            redirect_to('admin.php');
            exit();
        }

        // 在庫数変更
        $result = update_status($link, $status, $item_id);
        $link->commit();

        $status = entity_str($status);
        $_SESSION['success'] = '商品ステータスを変更しました。';

    } catch(PDOException $e) {
        $link->rollback();
        echo $e->getMessage();
        exit();
    }
}

redirect_to('admin.php');