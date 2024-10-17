<?php
session_start();
include('funcs.php');
$pdo = db_conn();

$lid = $_POST["lid"];
$lpw = $_POST["lpw"];

// ユーザー認証のSQLを実行
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE lid = :lid AND life_flg = 0");
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt->execute();

// SQL実行時にエラーがある場合
if ($status == false) {
    sql_error($stmt);
}

// データを取得
$val = $stmt->fetch();

// パスワードの確認をpassword_verify()で行う
if ($val && password_verify($lpw, $val["lpw"])) {
    // ログイン成功時
    $_SESSION["chk_ssid"] = session_id();
    $_SESSION["kanri_flg"] = $val['kanri_flg'];
    $_SESSION["name"] = $val['name'];
    $_SESSION["id"] = $val['id']; // ユーザーのIDをセッションに保存
    header("Location: index.php");
} else {
    // ログイン失敗時
    $_SESSION["login_error"] = "ユーザー名またはパスワードが間違っています。";
    header("Location: login.php");
}

exit();
?>
