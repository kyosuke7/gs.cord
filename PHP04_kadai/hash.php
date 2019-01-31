<?php

// パスワードをつくる場合
// ユーザー管理画面の登録する前に以下作業が必要
$pw = password_hash("test3", PASSWORD_DEFAULT);
echo $pw;


?>