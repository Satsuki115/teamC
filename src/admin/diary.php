<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/diary.css">
    <title>Photo Diary Calendar</title>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="current-month-large" id="largeMonth">08</div>
            <div class="controls">
                <button id="prev">PREV</button>
                <button id="next">NEXT</button>
            </div>
            <div class="side-record-parent">
                <div class="side-record-day"> 
                    <p>記録日数</p>
                </div>
                <div class="side-record-goal">
                    <p>達成回数</p>
                </div>
                <div class="side-record-review"> 
                    <p>振り返り</p>
                </div>
            </div>
        </aside>

        <main class="main-content">
            <header class="calendar-header">
                <span id="year-display">2026</span>
                <span id="month-name-display">AUGUST</span>
            </header>
            <div id="calendar-grid"></div>
        </main>
    </div>
    <script src="./scripts/diary.js"></script>
</body>
</html>