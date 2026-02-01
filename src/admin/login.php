<!-- src/admin/app.html として保存 -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/login.css">
    <title>login/register</title>
</head>
<body>
    <div class="container">
        <!-- ログイン画面 -->
        <div id="loginScreen">
            <h1>palette</h1>
            <div id="message" class="message"></div>
            
            <div class="form-group">
                <label>メールアドレス</label>
                <input type="email" id="email" placeholder="example@email.com">
            </div>
            
            <div class="form-group">
                <label>パスワード</label>
                <input type="password" id="password" placeholder="6文字以上">
            </div>
            
            <button class="btn" onclick="login()">ログイン</button>
            <button class="btn btn-secondary" onclick="register()">新規登録</button>
        </div>

        <!-- ダッシュボード -->
        <div id="dashboard">
            <h1>ダッシュボード</h1>
            <p style="text-align: center; margin-bottom: 20px; color: #666;">
                ようこそ、<span id="username"></span>さん！
            </p>
            
            <div class="stats">
                <div class="stat">
                    <div class="stat-value" id="days">0</div>
                    <div class="stat-label">記録日数</div>
                </div>
                <div class="stat" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                    <div class="stat-value" id="records">0</div>
                    <div class="stat-label">記録数</div>
                </div>
                <div class="stat" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                    <div class="stat-value">12</div>
                    <div class="stat-label">目標達成</div>
                </div>
            </div>
            
            <button class="btn" onclick="addRecord()">今日の記録をつける</button>
            <button class="btn btn-secondary" onclick="logout()">ログアウト</button>
        </div>
    </div>
    <script src="./scripts/login.js"></script>
</body>
</html>