<?php
$id = $_GET["id"] ?? ''; // GETパラメータが存在するか確認
include("funcs.php");
$pdo = db_conn();

// データ取得SQL作成
$sql = "SELECT * FROM vegetables WHERE id = :id";  
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    sql_error($stmt);
} else {
    $v = $stmt->fetch();
    if (!$v) {
        echo "指定されたIDのデータが存在しません。";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ更新</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="select.php">データ一覧</a>
      </div>
    </div>
  </nav>
</header>

<form method="POST" action="update.php">
  <div class="jumbotron">
    <fieldset>
      <legend>野菜分類表 - 更新</legend>
      <label>名前：<input type="text" name="name" value="<?= h($v['name']) ?>"></label><br>
      <label>色：<input type="text" name="color" value="<?= h($v['color']) ?>"></label><br>
      <label>説明：<textarea name="description" rows="4" cols="40"><?= h($v['description']) ?></textarea></label><br>
      <label>画像パス：<input type="text" name="image_path" value="<?= h($v['image_path']) ?>"></label><br>
      <input type="hidden" name="id" value="<?= h($v['id']) ?>">
      <input type="submit" value="送信">
    </fieldset>
  </div>
</form>

</body>
</html>
