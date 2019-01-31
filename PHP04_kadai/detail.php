<?php
session_start();
$id = $_GET["id"];
include "funcs.php";
sessChk();

$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_an_bookmark WHERE id=:id");
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
    sqlError($stmt);
} else {
    $row = $stmt->fetch();
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>更新</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="update.php">
  <div class="jumbotron">
   <fieldset>
   <legend>更新</legend>
     <label>名前：<input type="text" name="bookName" value="<?php echo $row["bookName"];?>"></label><br> 
     <label>Url：<input type="text" name="bookUrl" value="<?php echo $row["bookUrl"];?>"></label><br>
     <label><textArea name="comment" rows="4" cols="40"><?php echo $row["comment"];?></textArea></label><br>
     <input type="hidden" name="id" value="<?=$row["id"]?>">
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
