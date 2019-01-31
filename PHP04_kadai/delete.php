<?php
$id = $_GET["id"];
include "funcs.php";
$pdo = db_con();
$sql = "DELETE FROM gs_an_bookmark WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT); //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();
if ($status == false) {
    sqlError($stmt);
} else {
    header("Location: select.php");
    exit;
}
