<?php
//「ChromePhp.php」をダウンロードしてincludeする
require_once 'ChromePhp.php';
//ChromePhp::log('log');

//検索クエリの受け取り判定
if($_POST["search"]=="") {
    $s = 0;
} else {
    $s = 1;
}
ChromePhp::log($s);

//DB変数定義
define("dsn","mysql:dbname=gs_db;charset=utf8;host=localhost");
define("user","root");
define("password","");

//DB接続
try {
    $pdo = new PDO(dsn, user, password);
} catch(PODException $e) {
    exit('DbConnedtError'.$e->getMessage());
}

//データ登録
if($s == 1){
    $stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE name LIKE :name");
    $stmt->bindValue(":name", '%'.$_POST["search"].'%');
}else{
    $stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
}
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
        $view .= "<p>".$result["name"].",".$result["email"]."</p>";
    }
}


?>


<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>bookmark</title>
        <link rel="stylesheet" href="css/range.css">
    </head>
    <body>
        <!-- Head[Start] -->
        <header>
            <a href="bookmark.php">データ登録</a>
        </header>
        <!-- Head[End] -->

        <!-- Main[Start] -->
        <div>
            <?=$view?>
        </div>
        <!-- Main[End] -->

    </body>
</html>