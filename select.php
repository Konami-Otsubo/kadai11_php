<?php
session_start();
include('funcs.php');

// ログインチェックと管理者権限の確認
if (!isset($_SESSION["chk_ssid"]) || $_SESSION["kanri_flg"] != 1) {
    // セッションが存在しない、または管理者権限がない場合はログインページにリダイレクト
    $_SESSION["login_error"] = "管理者としてログインしてください。";
    header("Location: login.php");
    exit();
}

$pdo = db_conn();

// データ取得SQL作成
$sql = "SELECT * FROM gs_user_table";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

$values = "";
if ($status == false) {
    sql_error($stmt);
} else {
    $values = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>ユーザー管理一覧</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Arial', sans-serif;
    }
    .container {
        max-width: 900px;
        margin: 50px auto;
        padding: 20px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    table, th, td {
        border: 1px solid #ddd;
    }
    th, td {
        padding: 10px;
        text-align: center;
    }
    th {
        background-color: #f2f2f2;
    }
    .btn {
        padding: 5px 10px;
        background-color: #28a745;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }
    .btn:hover {
        background-color: #218838;
    }
</style>
</head>
<body>

<div class="container">
    <h2>ユーザー管理一覧</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>名前</th>
                <th>ユーザーID</th>
                <th>管理フラグ</th>
                <th>状態</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($values as $v) { ?>
                <tr>
                    <td><?= htmlspecialchars($v["id"]) ?></td>
                    <td><?= htmlspecialchars($v["name"]) ?></td>
                    <td><?= htmlspecialchars($v["lid"]) ?></td>
                    <td><?= $v["kanri_flg"] == 1 ? '管理者' : '一般ユーザー' ?></td>
                    <td><?= $v["life_flg"] == 0 ? '有効' : '無効' ?></td>
                    <td>
                        <a href="update_user.php?id=<?= htmlspecialchars($v["id"]) ?>" class="btn">編集</a>
                        <a href="delete_user.php?id=<?= htmlspecialchars($v["id"]) ?>" class="btn" style="background-color: #dc3545;">削除</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
