<?php
$dsn = 'mysql:host=db;dbname=laravel_db;charset=utf8';
$user = 'phper';    
$password = 'secret';  

try{
    $pdo = new PDO($dsn,$user,$password,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        
    ]);
}catch (PDOException $e){
    exit('DB接続失敗'.$e->getMessage());
}
?>