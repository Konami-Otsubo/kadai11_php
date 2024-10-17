<?php
session_start();
if (isset($_SESSION["login_error"])) {
    echo '<p style="color:red;">'.$_SESSION["login_error"].'</p>';
    unset($_SESSION["login_error"]); // エラーメッセージを一度表示したら削除
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/main.css">
  <title>ログイン</title>
  <style>
    body {
      background-image: url('img/haikei2.png'); /* 背景画像を設定 */
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      font-family: 'Arial', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh; /* 画面全体の高さを確保 */
      margin: 0; /* ページの余白をなくす */
    }

    .container {
      width: 100%;
      max-width: 500px;
      padding: 20px;
      background-color: rgba(255, 255, 255, 0.9); /* 背景を少し透明にして目立たせる */
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-group input {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 4px;
      border: 1px solid #ced4da;
    }

    .form-group input:focus {
      border-color: #80bdff;
      outline: none;
      box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
    }

    .btn {
      width: 100%;
      padding: 10px;
      background-color: #4CAF50; /* グリーンに変更 */
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .btn:hover {
      background-color: #45a049; /* ホバー時に少し濃いグリーンに変更 */
    }

    .login-title {
      text-align: center;
      margin-bottom: 20px;
      font-size: 24px;
      font-weight: bold;
      color: #343a40;
    }

    .error-message {
      color: red;
      text-align: center;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

<div class="container">
  <h1 class="login-title">ログイン</h1>

  <?php if (isset($_SESSION["login_error"])): ?>
    <p class="error-message"><?= $_SESSION["login_error"] ?></p>
    <?php unset($_SESSION["login_error"]); ?>
  <?php endif; ?>

  <!-- login_act.php は認証処理用のPHPです。 -->
  <form name="form1" action="login_act.php" method="post">
    <div class="form-group">
      <label for="lid">ID:</label>
      <input type="text" name="lid" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="lpw">パスワード:</label>
      <input type="password" name="lpw" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">ログイン</button>
  </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
