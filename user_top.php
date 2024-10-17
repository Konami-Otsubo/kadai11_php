<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>畑友ストーリー - 野菜選択</title>
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
        }
        .container {
            display: flex;
            width: 100%;
            height: 100%;
        }
        .sidebar {
            width: 200px;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            margin: 20px;
        }
        .btn {
            display: block;
            margin: 10px 0;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .vegetable-container {
            display: none; /* 最初は非表示 */
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 70%;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin: auto;
        }
        .vegetable {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
        .vegetable img {
            max-width: 150px;
            height: auto;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        .vegetable img:hover {
            transform: scale(1.1);
        }
        .vegetable-name {
            text-align: center;
            margin-top: 10px;
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="sidebar">
        <a href="#" class="btn" onclick="showVegetables('グリーン')">グリーン</a>
        <a href="#" class="btn" onclick="showVegetables('オレンジ')">オレンジ</a>
        <a href="#" class="btn" onclick="showVegetables('ホワイト')">ホワイト</a>
        <a href="#" class="btn" onclick="showVegetables('レッド')">レッド</a>
        <a href="#" class="btn" onclick="showVegetables('ブラウン')">ブラウン</a>
        <a href="#" class="btn" onclick="showVegetables('イエロー')">イエロー</a>
        <a href="#" class="btn" onclick="showVegetables('パープル')">パープル</a>
    </div>
    
    <!-- 野菜の画像と名前を表示するエリア -->
    <div class="vegetable-container" id="vegetableDisplay"></div>
</div>

<script>
function showVegetables(color) {
    fetch(`get_vegetables_by_color.php?color=${color}`)
        .then(response => response.json())
        .then(data => {
            const display = document.getElementById('vegetableDisplay');
            display.innerHTML = ''; // 前の内容をクリア
            display.style.display = 'flex'; // ボタンが押されたときに表示

            const vegetableDiv = document.createElement('div');
            vegetableDiv.className = 'vegetable';

            // 各野菜名と画像を追加
            data.forEach(veg => {
                const img = document.createElement('img');
                img.src = `uploads/${veg.image_path}`;
                img.alt = veg.name;
                img.onclick = () => showVegetableDetail(veg.id);

                const name = document.createElement('p');
                name.className = 'vegetable-name';
                name.textContent = veg.name;

                const vegItem = document.createElement('div');
                vegItem.style.textAlign = 'center';
                vegItem.appendChild(img);
                vegItem.appendChild(name);

                vegetableDiv.appendChild(vegItem);
            });

            display.appendChild(vegetableDiv);
        });
}

function showVegetableDetail(id) {
    window.location.href = `user_detail.php?id=${id}`;
}
</script>

</body>
</html>
