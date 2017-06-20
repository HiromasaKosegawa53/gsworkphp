<?php

include("funcs.php");

//DB変数定義
define("dsn","mysql:dbname=gs_db2;charset=utf8;host=localhost");
define("user","root");
define("password","");

//DB接続
try {
    $pdo = new PDO(dsn, user, password);
} catch(PDOException $e) {
    exit('DbConnectError:'.$e->getMessage());
}

//データ表示
$stmt = $pdo->prepare("SELECT * FROM gs_book_table");
$status = $stmt->execute();
//データ表示
$view="";
if($status==false){
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
}else{
    //Selectデータの数だけ自動でループしてくれる
    while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $view .= $result["bookTitle"]."\n";
    }
}


?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>bookmark</title>
    </head>
    <body>
        <h1>登録しました。</h1>
        <a href="bookmark2.php">データ登録画面へ戻る</a>
        <p>登録した本の一覧：<br><?= h($view); ?></p>
    </body>
</html>