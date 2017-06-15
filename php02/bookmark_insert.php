<?php
//「ChromePhp.php」をダウンロードしてincludeする
require_once 'ChromePhp.php';
//ChromePhp::log('log');


//POSTデータの取得
$bookTitle = $_POST["bookTitle"];
$bookUrl = $_POST["bookUrl"];
$comment = $_POST["comment"];

//DB変数定義
define("dsn","mysql:dbname=gs_db;charset=utf8;host=localhost");
define("user","root");
define("password","");

//DB接続
try {
    $pdo = new PDO(dsn, user, password);
} catch(PDOException $e) {
    exit('DbConnectError:'.$e->getMessage());
}

//データ登録
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(
                        id, bookTitle, bookUrl, comment, indate
                        ) VALUES (
                        NULL, :bookTitle, :bookUrl, :comment, sysdate())"
                     );
$stmt->bindValue(':bookTitle', $bookTitle, PDO::PARAM_STR);
$stmt->bindValue('bookUrl', $bookUrl, PDO::PARAM_STR);
$stmt->bindValue('comment', $comment, PDO::PARAM_STR);
$status = $stmt->execute();

//ChromePhp::log($status);

//データ登録処理後
if($status==false) {
    $error = $stmt->errorInfo();
    exit("QueryError:".error[2]);
    ChromePhp::log($error);
} else {
    header("Location: bookmark.php");
    exit;
}


?>