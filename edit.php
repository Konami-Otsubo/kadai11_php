<?php
include('funcs.php');
$pdo = db_conn();

// GETパラメータのチェック
$id = $_GET['id'] ?? '';

if ($id === '') {
    echo "IDが指定されていません。";
    exit();
}

// 編集対象データ取得
$sql = "SELECT * FROM vegetables WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    echo "指定されたIDのデータが見つかりませんでした。";
    exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>編集 - 野菜分類表</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<h1>野菜分類表 - 編集</h1>

<div class="form-container">
  <form id="vegForm" method="POST" action="update.php" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">
    <label>名前：<input type="text" name="name" value="<?= htmlspecialchars($row['name']) ?>" required></label><br>
    <label>色：<input type="text" name="color" value="<?= htmlspecialchars($row['color']) ?>" required></label><br>
    <label>説明：<textarea name="description"><?= htmlspecialchars($row['description']) ?></textarea></label><br>
    <label>画像：
      <input type="file" name="image">
      <img src="uploads/<?= htmlspecialchars($row['image_path']) ?>" alt="<?= htmlspecialchars($row['name']) ?>" style="max-width: 100px;">
    </label><br>
    <button type="submit">更新</button>
  </form>
</div>

</body>
</html>
