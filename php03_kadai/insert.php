<?php
//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
$bookName = $_POST["bookName"];
$bookUrl = $_POST["bookUrl"];
$comment = $_POST["comment"];

//2. DB接続します
include("funcs.php");
$pdo = db_con();

//３．データ登録SQL作成
$sql = "INSERT INTO gs_an_bookmark(bookName,bookUrl,comment,indate)VALUES(:bookName,:bookUrl,:comment,sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':bookName', $bookName, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':bookUrl', $bookUrl, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

$status = $stmt->execute();


//４．データ登録処理後
if ($status == false) {
    sqlError($stmt);
} else {
    //５．index.phpへリダイレクト
    header("Location: index.php");
    exit;
}
