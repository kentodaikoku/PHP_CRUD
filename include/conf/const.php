<?php // 繰り返し使用するものを定義

// ディレクトリパス
define('MODEL_PATH', $_SERVER['DOCUMENT_ROOT'] . '/../include/model/');
// define('VIEW_PATH', $_SERVER['DOCUMENT_ROOT'] . '../include/view/');

define('DB_HOST', 'localhost'); // データベースのホスト名又はIPアドレス
define('DB_HOST_PDO', ''); //PDO接続設定
define('DB_USER', ''); // MySQLのユーザ名
define('DB_PASSWD', ''); // MySQLのパスワード
define('DB_NAME', 'php_crud'); // データベース名

define('HTML_CHARACTER_SET', 'UTF-8'); // HTML文字エンコーディング
define('DB_CHARACTER_SET', 'UTF8'); // DB文字エンコーディング
