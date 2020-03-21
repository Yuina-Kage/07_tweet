<?php

define('DSN', 'mysql:host=mysql;dbname=camp_tweet;charset=utf8');
define('USER', 'admin_user');
define('PASSWORD', '1234');

error_reporting(E_ALL & ~E_NOTICE);

// try {
//   $dbh = new PDO(DSN, USER, PASSWORD);
//   echo '接続に成功しました！' . '<br>';
// } catch (PDOException $e) {
//   // 接続がうまくいかない場合こちらの処理がなされる
//   echo $e->getMessage();
//   exit;
// }