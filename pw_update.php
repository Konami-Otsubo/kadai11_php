<?php
session_start();
include("funcs.php");
$pdo = db_conn();

if (!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"] != session_id()) {
    header("Location: login.php");
    exit();
}

$new_lpw = password_hash($_POST["new_lpw"], PASSWORD_DEFAULT);
$lid = $_SESSION["shainno"];

$stmt = $pdo->prepare("UPDATE user_table SET lpw = :lpw WHERE lid = :lid");
$stmt->bindValue(':lpw', $new_lpw, PDO::PARAM_STR);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
    sql_error($stmt);
} else {
    header("Location: index.php");
    exit();
}
?>
