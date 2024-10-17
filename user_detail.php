<!-- user_detail.php -->
<?php
$id = $_GET['id'];
include('funcs.php');
$pdo = db_conn();

// 指定された野菜の詳細を取得
$stmt = $pdo->prepare("SELECT * FROM vegetables WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$veg = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($veg['name']) ?></title>
  <style>
    body {
      background-image: url('img/hatatomo_haikei.png');
      background-size: cover;
      background-repeat: no-repeat;
      margin: 0;
      padding: 0;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
    }
    .bubble {
      position: absolute;
      bottom: 40%; /* 画像に重ならないように調整 */
      left: 50%;
      transform: translateX(-50%);
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
      font-size: 18px;
      max-width: 60%;
      text-align: left; /* 左寄せに変更 */
    }
    .vegetable-img {
      position: absolute;
      bottom: 10%;
      left: 50%;
      transform: translateX(-50%);
      max-width: 200px;
      height: auto;
    }
    .back-button {
      position: absolute;
      bottom: 20px;
      left: 50%;
      transform: translateX(-50%);
      padding: 10px 20px;
      background-color: #4CAF50;
      color: white;
      border-radius: 5px;
      text-decoration: none;
    }
  </style>
</head>
<body>

<div class="bubble"><?= nl2br(htmlspecialchars($veg['description'])) ?></div>
<img src="uploads/<?= htmlspecialchars($veg['image_path']) ?>" alt="<?= htmlspecialchars($veg['name']) ?>" class="vegetable-img">
<a href="user_top.php" class="back-button">戻る</a>

</body>
</html>
