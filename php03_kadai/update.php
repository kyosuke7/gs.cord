<?php

// insert.phpからコピー

$bookName = $_POST["bookName"];
$bookUrl = $_POST["bookUrl"];
$comment = $_POST["comment"];
$id     = $_POST["id"];

//2. DB接続します
include("funcs.php");
$pdo = db_con();

//３．データ登録SQL作成
$sql = "UPDATE gs_an_bookmark SET bookName=:bookName,bookUrl=:bookUrl,comment=:comment  WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':bookName', $bookName, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':bookUrl', $bookUrl, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT); //Integer（数値の場合 PDO::PARAM_INT)


$status = $stmt->execute();

//->のあとは空白は開けない！

//４．データ登録処理後
if ($status == false) {
    sqlError($stmt);
} else {
    //５．index.phpへリダイレクト
    header("Location: select.php");//selectの前に必ず空白！
    exit;
}




?>
