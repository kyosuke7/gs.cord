<?php
$id = $_GET["id"];


// いかselect.phpをコピー


//1.  DB接続します insert.phpからコピー、fucs.phpで共通化して登録しよう
include "funcs.php";
$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_an_bookmark WHERE id=:id");//id:id　バインドbaryu-ってなんたら
$stmt->bindValue(":id",$id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php

  $row = $stmt->fetch();


}


//index.php（登録フォームの画面ソースコードを全コピーして、このファイルをまるっと上書き保存）
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ブックマーク詳細</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">ブックマーク詳細</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
  <div class="jumbotron">
   <fieldset>
     <label>名前：<?php echo $row["bookName"];?></label><br> 
     <label>Url：<?php echo $row["bookUrl"];?></label><br>
     <!-- <label>年齢：<input type="text" name="age"></label><br> -->
     <label>コメント:<?php echo $row["comment"];?></label><br>
     <input type="hidden" name="id" value="<?php echo $id; ?>">
    </fieldset>
  </div>
<!-- Main[End] -->


</body>
</html>
