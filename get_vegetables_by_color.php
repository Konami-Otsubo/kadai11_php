<?php
include('funcs.php');
$pdo = db_conn();

$color = $_GET['color'];

// 色でフィルターして野菜を取得
$stmt = $pdo->prepare("SELECT * FROM vegetables WHERE color = :color");
$stmt->bindValue(':color', $color, PDO::PARAM_STR);
$stmt->execute();

$vegetables = $stmt->fetchAll(PDO::FETCH_ASSOC);

// データをJSON形式で返す
echo json_encode($vegetables, JSON_UNESCAPED_UNICODE);
?>
