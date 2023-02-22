<?php  // 商品追加＆在庫数変更処理用ページ

require_once '../../include/conf/const.php';
require_once '../../include/model/db.php';
require_once '../../include/model/function.php';
require_once '../../include/model/item.php';

$session = sessionMode();
$err = [];
$img_dir = dirname(__DIR__) . '\images\\';

$request_method = get_request_method();
if ($request_method === 'POST') {
    $item_name = get_post_data('item_name');
    $price = get_post_data('price');
    $status = get_post_data('status');
    $stock = get_post_data('stock'); 
    
    if (isset($_FILES['img']['tmp_name'])) {
        $img_src = $_FILES['img']['tmp_name'];
        $filename = $_FILES['img']['name'];
        $img_name = date('YmdHis') . $filename;
    }
    
    // $item_name 空文字
    if (empty($item_name)) {
        $err[] = '商品名が未入力です。';
    }
    // 文字数
    if (mb_strlen($item_name) >= 30) {
        $err[] = '商品名は３０文字以内です。';
    }
    // 空文字
    if (empty($price) || empty($stock)) {
        $err[] = '値段または在庫数が未入力です。';
    }
    // 正規表現
    if (preg_match("/\A[0-9]+\Z/", $price) !== 1 || preg_match("/\A[0-9]+\Z/", $stock) !== 1) {
        $err[] = '値段及び在庫数は半角数字で入力してください。';
    }
    // 空文字
    if (empty($status)) {
        $err[] = '商品ステータスが未入力です。';
    }
    // 画像空
    if (empty($img_src)) {
        $err[] = '画像を挿入されていません';
    }
    // 画像拡張子
    if (!check_img_type($filename)) {
        $err[] = '画像の拡張式は「jpg」「jpeg」「png」のみ可能です。';
        $img_src = '';
    }

    if(!move_uploaded_file($img_src, $img_dir . $img_name)) {
        $err[] = '画像をアップロードできませんでした。';
    }

    if (count($err) > 0) {
        $_SESSION['errors'] = $err;
        redirect_to('admin.php');
        exit();
    }
    
    try {
        $link = get_db_connect();
        $link->beginTransaction();
        
        $result = insert_items($link, $item_name, $price, $img_name, $status, $stock);
        $link->commit();

        $item_name = entity_str($item_name);
        $price = entity_str($price);
        $stock = entity_str($stock);
        $status = entity_str($status);

        $_SESSION['success'] = '登録が完了しました。';

    } catch(PDOException $e) {
        $link->rollback();
        echo $e->getMessage();
        exit();
    }
}
redirect_to('admin.php');
