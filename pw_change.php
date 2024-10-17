<?php
session_start();
include("funcs.php");
$pdo = db_conn();
if (!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"] != session_id()) {
    header("Location: login.php");
    exit();
}

$shainno = $_SESSION["shainno"];

$sql = "SELECT * FROM user_table WHERE lid = :lid";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lid', $shainno, PDO::PARAM_STR);
$stmt->execute();
$v = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>パスワード変更</title>
</head>
<body>
<form method="post" action="pw_update.php">
  <label>新しいパスワード:<input type="password" name="new_lpw" required></label><br>
  <input type="submit" value="更新">
</form>
</body>
</html>
