<?php

//POSTデータの取得
$bookTitle = $_POST["bookTitle"];
$bookUrl = $_POST["bookUrl"];
$bookText = $_POST["bookText"];

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

//データ登録
$stmt = $pdo->prepare("INSERT INTO gs_book_table(
                        id, bookTitle, bookUrl, bookText, indate
                        ) VALUES (
                        NULL, :bookTitle, :bookUrl, :bookText, sysdate())"
                     );
$stmt->bindValue(':bookTitle', $bookTitle, PDO::PARAM_STR);
$stmt->bindValue(':bookUrl', $bookUrl, PDO::PARAM_STR);
$stmt->bindValue(':bookText', $bookText, PDO::PARAM_STR);
$status = $stmt->execute();

//データ登録処理後
if($status==false) {
    $error = $stmt->errorInfo();
    exit("QueryError:".error[2]);
    ChromePhp::log($error);
} else {
    header("Location: bookmark_enroll2.php");
    exit;
}


?>