<?php

// 購入商品挿入
function insert_purchased_items($link, $user_id, $item_id, $amount) {
  $date = date('Y-m-d H:i:s');
  $sql = 'INSERT INTO purchased_table(user_id, item_id, amount, created_at) 
          VALUES(:user_id, :item_id, :amount, :date)';
  $stmt = $link->prepare($sql);
  $stmt->bindValue(':user_id', $user_id);
  $stmt->bindValue(':item_id', $item_id);
  $stmt->bindValue(':amount', $amount);
  $stmt->bindValue(':date', $date);
  $stmt->execute();
  return $stmt;
}

// 購入商品一覧表示処理
function get_purchased_items($link, $user_id) {
  $sql = 'SELECT purchased_table.user_id, item_table.item_id, item_table.item_name, item_table.price, item_table.img, purchased_table.amount 
          FROM purchased_table 
          JOIN item_table ON item_table.item_id = purchased_table.item_id 
          WHERE purchased_table.user_id = ?';
  $stmt = $link->prepare($sql);
  $stmt->bindValue(1, $user_id);
  $stmt->execute();
  return $stmt->fetchAll();
}

// 該当購入レコード削除
function delete_purchased_items($link, $user_id) {
  $sql = 'DELETE FROM purchased_table WHERE user_id = ?';
  $stmt = $link->prepare($sql);
  $stmt->bindValue(1, $user_id);
  $stmt->execute();
  return $stmt;
}