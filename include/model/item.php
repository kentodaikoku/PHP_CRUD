<?php

// 一覧獲得（在庫数も）
function get_items_list($link) {
    $sql = 'SELECT item_id, item_name, price, img, status, stock FROM item_table';
    $stmt = $link->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

// 該当商品情報取得
function get_item($link, $item_id) {
    $sql = 'SELECT item_id, stock FROM item_table WHERE item_id = ?';
    $stmt = $link->prepare($sql);
    $stmt->bindValue(1, $item_id);
    $stmt->execute();
    return $stmt->fetch();
}

// 追加
function insert_items($link, $item_name, $price, $img, $status, $stock) {
    $date = date('Y-m-d H:i:s');
    $sql = 'INSERT INTO item_table(item_name, price, img, status, stock, created_at)
            VALUES(:item, :price, :img, :status, :stock, :date)';
    $stmt = $link->prepare($sql);
    $stmt->bindValue(':item', $item_name);
    $stmt->bindValue(':price', $price);
    $stmt->bindValue(':img', $img);
    $stmt->bindValue(':status', $status);
    $stmt->bindValue(':stock', $stock);
    $stmt->bindValue(':date', $date);
    $stmt->execute();
    return $stmt;
}


// 削除
function delete_items($link, $item_id) {
    $sql = 'DELETE FROM item_table WHERE item_id = ?';
    $stmt = $link->prepare($sql);
    $stmt->bindValue(1, $item_id);
    $stmt->execute();
    return $stmt;
}


// 在庫数変更
function update_stock($link, $stock, $item_id) {
    $sql = 'UPDATE item_table SET stock = ? WHERE item_id = ?';
    $stmt = $link->prepare($sql);
    $stmt->bindValue(1, $stock);
    $stmt->bindValue(2, $item_id);
    $stmt->execute();
    return $stmt;
}


// ステータス変更
function update_status($link, $status, $item_id) {
    $sql = 'UPDATE item_table SET status = ? WHERE item_id = ? ';
    $stmt = $link->prepare($sql);
    $stmt->bindValue(1, $status);
    $stmt->bindValue(2, $item_id);
    $stmt->execute();
    return $stmt;
}

// 画像拡張子チェック
function check_img_type($filename) {
    $check_type = array('jpg', 'jpeg', 'png');
    $img_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    if (!in_array($img_ext, $check_type)) return false;

    return true;
}
