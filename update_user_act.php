<?php
session_start();
include('funcs.php');

// POSTデータ取得
$new_lid = $_POST['new_lid'];
$new_lpw = $_POST['new_lpw'];
$user_id = $_SESSION["user_id"]; // セッションのキー名を確認してください

// パスワードのハッシュ化
$hashed_password = password_hash($new_lpw, PASSWORD_DEFAULT);

// データベース接続
$pdo = db_conn();

// ユーザー情報の更新
$stmt = $pdo->prepare("UPDATE gs_user_table SET lid = :lid, lpw = :lpw WHERE id = :id");
$stmt->bindValue(':lid', $new_lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $hashed_password, PDO::PARAM_STR);
$stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status) {
    $_SESSION["success_message"] = "IDとパスワードが正常に変更されました。";
    header("Location: login.php"); // ログインページにリダイレクト
    exit();
} else {
    echo "更新に失敗しました。もう一度お試しください。";
}
?>
