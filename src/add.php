<?php
require_once 'dbconnect.php';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
$title = $_POST['title'] ?? '';
$highlight = $_POST['highlight'] ?? '';
$record = $_POST['record'] ?? '';
$thanks = $_POST['thanks'] ?? '';

$date = date('Ymd');

$photo_filename = null;

if(isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK){

 $upload_dir = __DIR__.'/assets/img';

 if(!is_dir($upload_dir)){
 mkdir($upload_dir, 0777 , true);
}
 $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $new_filename = date('YmdHis') . '_' . uniqid() . '.' . $extension;
        
        // 一時保存場所から、本番の場所へ移動
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $upload_dir . $new_filename)) {
            $photo_filename = $new_filename;
        }
        
}
try {
        // SQL文を作成 (:name はプレースホルダ)
        $sql = "INSERT INTO diary (date, title, highlight, record, thanks, photo) 
                VALUES (:date, :title, :highlight, :record, :thanks, :photo)";
        
        $stmt = $pdo->prepare($sql);

        // 値をセット (bindValueで安全に値を渡す)
        $stmt->bindValue(':date', $date, PDO::PARAM_INT);
        $stmt->bindValue(':title', $title, PDO::PARAM_STR);
        $stmt->bindValue(':highlight', $highlight, PDO::PARAM_STR);
        $stmt->bindValue(':record', $record, PDO::PARAM_STR);
        $stmt->bindValue(':thanks', $thanks, PDO::PARAM_STR);
        $stmt->bindValue(':photo', $photo_filename, PDO::PARAM_STR); // 画像がない場合はNULLが入る

        // 実行
        $stmt->execute();

        // 4. 成功したらトップページ (index.php) に戻る
        header('Location: index.php');
        exit;

    } catch (PDOException $e) {
        exit('登録エラー: ' . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>エラー</title>
</head>
<body>
    <h1>不正なアクセスです</h1>
    <p>フォームから送信してください。</p>
    <a href="index.php">戻る</a>
</body>
</html>