<?php
session_start();

// セッション情報を確認するためのデバッグ表示を削除
// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';

// ユーザーがログインしているか確認
if (!isset($_SESSION["chk_ssid"])) {
    header("Location: login.php");
    exit();
}

include('funcs.php');
$pdo = db_conn();

// ユーザーの現在の情報を取得
$user_id = $_SESSION["id"];
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id = :id");
$stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
$status = $stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "ユーザー情報が取得できませんでした。";
    exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>IDとパスワードの変更</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .btn {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50; /* グリーン色 */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #45a049; /* 濃いグリーン色 */
        }
    </style>
</head>
<body>

<div class="container">
    <h2>IDとパスワードの変更</h2>
    <form method="POST" action="update_user_act.php">
        <div class="form-group">
            <label for="new_lid">新しいID:</label>
            <input type="text" name="new_lid" class="form-control" value="<?= htmlspecialchars($user['lid']) ?>" required>
        </div>
        <div class="form-group">
            <label for="new_lpw">新しいパスワード:</label>
            <input type="password" name="new_lpw" class="form-control" required>
        </div>
        <button type="submit" class="btn">更新</button>
    </form>
</div>

</body>
</html>
