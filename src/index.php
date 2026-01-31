<?php
try {
    // 環境変数から接続情報を取得
    $dsn = 'mysql:host=db;dbname=laravel_db;charset=utf8';
    $user = 'phper';
    $password = 'secret';

    $pdo = new PDO($dsn, $user, $password);
    echo "<h1>DB Connection Success! 🎉</h1>";
    echo "PHP Version: " . phpversion() . "<br>";
    echo "MySQL Server Info: " . $pdo->getAttribute(PDO::ATTR_SERVER_INFO);

} catch (PDOException $e) {
    echo "<h1>Connection Failed 😱</h1>";
    echo $e->getMessage();
}
// 詳細な設定情報
phpinfo();