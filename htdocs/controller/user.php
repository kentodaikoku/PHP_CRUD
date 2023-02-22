<?php // ユーザー管理用ページ

require_once '../../include/conf/const.php';
require_once '../../include/model/function.php';
require_once '../../include/model/db.php';
require_once '../../include/model/user.php';

$session = sessionMode();

$user_data = [];

try {
  $link = get_db_connect();
  
  $user_data = get_user_name($link);

  $user_data = entity_assoc_array($user_data);
} catch(PDOException $e) {
  echo $e->getMessage();
  exit();
}

include_once '../../include/view/user_list.php';