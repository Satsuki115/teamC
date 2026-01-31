<?php
require_once 'dbconnect.php';
// データ取得（ロジックはそのまま）
$sql = "SELECT * FROM diary ORDER BY date DESC LIMIT 7";
$stmt = $pdo->query($sql);
$diaries = $stmt->fetchAll();

// XSS対策用関数 (これがないと h() が使えません！)
function h($str) {
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="./style/main.css">
    <title>Main</title>
</head>
<body>
    <header>
        <h2>dashboard</h2>
        <div class="diary-container">
            <?php foreach($diaries as $diary): ?>
                <div class="card">
                    <?php if(!empty($diary['photo'])): ?>
                    <div class="image-container">
                    <img src="assets/img/<?= h($diary['photo']) ?>" class="diary-img">
                    </div>
                    <?php endif; ?>
                    <div class="date"><?= h($diary['date']) ?></div>
                    <p><?= h($diary['title']) ?></p>

                </div>
            <?php endforeach; ?></div>
    </header>
    <main>
        <form action="add.php" method="post" enctype="multipart/form-data">
            <h2>日記を追加</h2>
            <h3>タイトル</h3>
            <input type="text" name="title" placeholder="タイトルを入力">
            <h3>今日のハイライト</h3>
            <textarea type="text" name="highlight" placeholder="ハイライトを入力"></textarea>
            <h3>感情の記録</h3>
            <textarea name="record" placeholder="感謝記録を入力"></textarea>
            <h3>感謝</h3>
            <textarea name="thanks" placeholder="感謝を入力"></textarea>
            <h3>写真ファイル名</h3>
            <input type="file" name="photo" accept="images/png, images/jpeg, application/pdf" placeholder="写真ファイルをアップロード">
            <button type="submit">追加</button>
        </form>
    </main>
    <aside>

        
    </aside>
</body>
</html>