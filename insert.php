<?php
include('funcs.php');
$pdo = db_conn();

// POSTデータ取得
$name = $_POST['name'];
$color = $_POST['color'];
$description = $_POST['description'];

// 画像アップロード
$target_dir = "uploads/";
if (!is_dir($target_dir)) {
    // フォルダが存在しない場合は作成する
    mkdir($target_dir, 0777, true);
}

if (!empty($_FILES["image"]["name"])) {
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $image_path = basename($_FILES["image"]["name"]);
    } else {
        echo "画像のアップロードに失敗しました。";
        exit();
    }
} else {
    // 画像がアップロードされていない場合の処理
    $image_path = ""; // 画像が必須でない場合
}

// SQL文を準備
$sql = "INSERT INTO vegetables (name, color, description, image_path) 
        VALUES (:name, :color, :description, :image_path)";
$stmt = $pdo->prepare($sql);

// バインド変数に値を割り当て
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':color', $color, PDO::PARAM_STR);
$stmt->bindValue(':description', $description, PDO::PARAM_STR);
$stmt->bindValue(':image_path', $image_path, PDO::PARAM_STR);

// SQL実行
$status = $stmt->execute();

if ($status === false) {
    sql_error($stmt);
} else {
    header('Location: index.php');
    exit();
}
?>
