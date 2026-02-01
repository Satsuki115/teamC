<?php
header('Content-Type :application/json; charset=utf-8');
require_once'../dbconnect.php';
try{
    $sql = "SELECT * FROM diary";
    $stmt = $pdo->query($sql);
    $diaries = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($diaries);

}catch(PDOException $e){
    http_response_code(500);
    echo json_encode(['error' => 'データ取得エラー: ' . $e->getMessage()]);
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/reset.css">
    <link rel="stylesheet" href="./styles/diary.css">
    <title>Photo Diary Calendar</title>
</head>
<body>
    <header class="header">
        <div class="header-contents">
            <img class="header-logo" src="../assets/img/palette.png" alt="">
            <nav class="header-nav">
                <a class="header-top" href="../index.php">トップ</a>
                <a class="header-menu" href="">メニュー</a>
                <a class="header-logout" href="">ログアウト</a>
            </nav>
        </div>

    </header>
    <div class="container">
        <aside class="sidebar">
            <div class="current-month-large" id="largeMonth">08</div>
            <div class="controls">
                <button id="prev">PREV</button>
                <button id="next">NEXT</button>
            </div>
            <div class="side-record-parent">
                <div class="side-record-day"><p>記録日数</p></div>
                <div class="side-record-goal"><p>達成回数</p></div>
                <div class="side-record-review"><p>振り返り</p></div>
            </div>
        </aside>

        <main class="main-content">
            <header class="calendar-header">
                <span id="year-display">2026</span>
                <span id="month-name-display">FEBRUARY</span>
            </header>
            <div id="calendar-grid"></div>
        </main>
    </div>

<div id="mask" class="mask"></div>
<div id="modal" class="modal">
    <div class="modal-content">
        <p id="modal-date-display"></p>

        <div class="modal-body">
            <div class="modal-photo" id="modal-photo-container">
                <img src="" alt="Diary Photo" id="modal-img">
            </div>

            <div class="modal-info">
                <div class="info-section">
                    <h3>Today's memory</h3>
                    <p id="modal-quote">その日を象徴する一言がここに入ります</p>
                </div>
                <div class="info-section">
                    <h3>Highlights</h3>
                    <p id="modal-highlights">ハイライトや詳細な思い出がここに入ります</p>
                </div>
            </div>
        </div>

        <div class="close-btn-container">
            <button class="close-btn">Close</button>
        </div>
    </div>
</div>
    <script src="./scripts/diary.js"></script>
</body>
</html>