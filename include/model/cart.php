<?php

// ログインしているユーザーが追加した商品情報が欲しい
function get_item_cart($link, $user_id, $item_id) {
  $sql = 'SELECT cart_table.item_id, cart_table.user_id, cart_table.amount FROM cart_table 
          JOIN item_table ON item_table.item_id = cart_table.item_id 
          WHERE cart_table.user_id = ? AND cart_table.item_id = ?';
  $stmt = $link->prepare($sql);
  $stmt->bindValue(1, $user_id);
  $stmt->bindValue(2, $item_id);
  $stmt->execute();
  return $stmt->fetch();
}

// カートに商品追加（新規追加）
function insert_to_cart($link, $user_id, $item_id, $amount) {
  $date = date('Y-m-d H:i:s');
  $sql = 'INSERT INTO cart_table(user_id, item_id, amount, created_at)
          VALUES(?, ?, ?, ?)';
  $stmt = $link->prepare($sql);
  $stmt->bindValue(1, $user_id);
  $stmt->bindValue(2, $item_id);
  $stmt->bindValue(3, $amount);
  $stmt->bindValue(4, $date);
  $stmt->execute();
  return $stmt;
}

// カート商品数１増やす
function update_amount($link, $amount, $item_id, $user_id) {
  $sql = 'UPDATE cart_table SET amount = ? WHERE item_id = ? AND user_id = ? LIMIT 1';
  $stmt = $link->prepare($sql);
  $stmt->bindValue(1, $amount);
  $stmt->bindValue(2, $item_id);
  $stmt->bindValue(3, $user_id);
  $stmt->execute();
  return $stmt;
}

// カートの商品一覧取得用
function get_cart($link, $user_id) {
  $sql = 'SELECT cart_table.cart_id, cart_table.item_id, cart_table.user_id, cart_table.amount, item_table.img, item_table.item_name, item_table.price, item_table.stock 
          FROM cart_table JOIN item_table ON cart_table.item_id = item_table.item_id
          WHERE cart_table.user_id = ?';
  $stmt = $link->prepare($sql);
  $stmt->bindValue(1, $user_id);
  $stmt->execute();
  return $stmt->fetchAll();
}


// カート内商品削除
function delete_cart($link, $item_id, $user_id) {
  $sql = 'DELETE FROM cart_table WHERE item_id = ? AND user_id = ?';
  $stmt = $link->prepare($sql);
  $stmt->bindValue(1, $item_id);
  $stmt->bindValue(2, $user_id);
  $stmt->execute();
  return $stmt;
}

// カート内商品数量変更
function update_cart($link, $amount, $item_id, $user_id) {
  $sql ='UPDATE cart_table SET amount = ? WHERE item_id = ? AND user_id = ?';
  $stmt = $link->prepare($sql);
  $stmt->bindValue(1, $amount);
  $stmt->bindValue(2, $item_id);
  $stmt->bindValue(3, $user_id);
  $stmt->execute();
  return $stmt;
}

// 購入後カートの削除
function delete_user_cart($link, $user_id) {
  $sql = 'DELETE FROM cart_table WHERE user_id = ?';
  $stmt = $link->prepare($sql);
  $stmt->bindValue(1, $user_id);
  $stmt->execute();
  return $stmt;
}
