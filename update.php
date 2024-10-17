<?php
include('funcs.php');
$pdo = db_conn();

// POSTデータ取得（デフォルト値の設定）
$id = $_POST['id'] ?? '';
$name = $_POST['name'] ?? '';
$color = $_POST['color'] ?? '';
$description = $_POST['description'] ?? '';

// 画像アップロード処理
$target_dir = "img/"; // img フォルダを指定
$image_path = $_POST['existing_image'] ?? ''; // 既存の画像パス

if (!empty($_FILES["image"]["name"])) {
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    // アップロードを試みる
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $image_path = basename($_FILES["image"]["name"]);
    } else {
        echo "画像のアップロードに失敗しました。";
        exit();
    }
}

// SQL更新処理
$sql = "UPDATE vegetables 
        SET name = :name, color = :color, description = :description, image_path = :image_path 
        WHERE id = :id";
$stmt = $pdo->prepare($sql);

$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':color', $color, PDO::PARAM_STR);
$stmt->bindValue(':description', $description, PDO::PARAM_STR);
$stmt->bindValue(':image_path', $image_path, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

$status = $stmt->execute();

if ($status === false) {
    sql_error($stmt);
} else {
    header('Location: index.php');
    exit();
}
?>
