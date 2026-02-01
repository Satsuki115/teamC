<?php
require_once 'dbconnect.php';

$sql = "SELECT * FROM diary ORDER BY date DESC LIMIT 7";
$stmt = $pdo->query($sql);
$diaries = $stmt->fetchAll();

function h($str) {
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パレット - メインページ</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .dream-shadow {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }
        input, textarea {
            background: transparent;
            border: none;
            outline: none;
            width: 100%;
        }
    </style>
</head>
<<<<<<< HEAD

<body class="bg-[#FFE1E6] min-h-screen font-sans text-slate-700">

<header class="h-20 bg-white/50 backdrop-blur-sm shadow-sm">
    <div class="max-w-6xl mx-auto h-full px-6 flex items-center justify-between">
        <div class="flex items-center">
            <img src="./assets/img/messageImage_1769877927224-removebg-preview.png" alt="パレット" class="h-12 w-auto object-contain">
        </div>

        <nav class="flex items-center gap-8 text-slate-600 font-medium">
            <a href="" class="hover:text-[#F7C9D4] transition-colors">トップ</a>
            <a href="" class="hover:text-[#F7C9D4] transition-colors">メニュー</a>
            <a href="" class="bg-[#B9D8E8] hover:bg-[#a2c8db] text-slate-700 px-5 py-2 rounded-full text-sm transition-all shadow-sm">
                ログアウト
            </a>
        </nav>
    </div>
</header>
    
<main class="max-w-6xl mx-auto px-4 pb-12">

    <section class="bg-[#F7C9D4] rounded-3xl p-6 mb-10 dream-shadow relative">
        <div class="flex items-center justify-between gap-4 overflow-x-auto py-2">
            <button class="text-slate-500 bg-white/50 rounded-full w-8 h-8 flex items-center justify-center">＜</button>

            <div class="flex gap-4">
                <?php foreach($diaries as $diary): ?>
                    <div class="bg-white/80 rounded-lg p-2 min-w-[120px] text-center shadow-sm">
                        <?php if(!empty($diary['photo'])): ?>
                            <img src="./assets/img/<?= h($diary['photo']) ?>" class="w-full h-20 object-cover rounded mb-1" alt="">
                        <?php else: ?>
                            <div class="w-full h-20 bg-blue-50/50 rounded mb-1"></div>
                        <?php endif; ?>
                        <div class="text-[10px] text-slate-400"><?= h($diary['date']) ?></div>
=======
<body>
    <header>
        <h2>dashboard</h2>
        <div class="diary-container">
            <?php foreach($diaries as $diary): ?>
                <div class="card">
                    <?php if(!empty($diary['photo'])): ?>
                    <div class="image-container">
                    <img src="assets/img/<?= h($diary['photo']) ?>" class="diary-img">
>>>>>>> 677053d31181101db41cb98809c1e18930c4be7c
                    </div>
                <?php endforeach; ?>
            </div>

            <button class="text-slate-500 bg-white/50 rounded-full w-8 h-8 flex items-center justify-center">＞</button>
        </div>

        <a href="http://localhost:8080/admin/diary.php"
            class="absolute bottom-4 right-6 bg-[#B9D8E8] text-slate-600 px-4 py-1 rounded-full text-sm shadow-sm block">
            もっと見る
        </a>
    </section>

    <div class="flex flex-col md:flex-row gap-8">

        <form action="add.php" method="post" enctype="multipart/form-data" class="flex-1 bg-white rounded-[40px] p-12 dream-shadow border border-slate-100">
            <div class="mb-8">
                <input type="text" name="title" placeholder="タイトルを入力" class="text-3xl font-bold border-b border-slate-200 pb-2 mb-4 placeholder:text-slate-300">
            </div>

            <div class="space-y-10">
                <div>
                    <h3 class="text-xl font-bold mb-3 flex items-center">・今日のハイライト</h3>
                    <textarea name="highlight" rows="4" placeholder="ここに内容を書く..." class="text-lg leading-relaxed"></textarea>
                </div>

                <div>
                    <h3 class="text-xl font-bold mb-3 flex items-center">・感情の記録</h3>
                    <textarea name="record" rows="4" placeholder="どんな気持ちだった？" class="text-lg leading-relaxed"></textarea>
                </div>

                <div>
                    <h3 class="text-xl font-bold mb-3 flex items-center">・感謝</h3>
                    <textarea name="thanks" rows="4" placeholder="ありがとうを記録しよう" class="text-lg leading-relaxed"></textarea>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-dashed border-slate-200 flex justify-between items-center">
                <input type="file" name="photo" class="text-sm text-slate-400">
                <button type="submit" class="bg-[#B9D8E8] hover:bg-[#a2c8db] text-slate-600 font-bold px-14 py-3 rounded-full transition-all shadow-md">
                    保存する
                </button>
            </div>
        </form>

    </div>
</main>
</body>
</html>