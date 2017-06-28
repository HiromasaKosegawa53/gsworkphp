<?php
//ログインの処理


//session変数を使えるよう宣言
session_start();

$sendId = $_SESSION["sendId"];
$name = $_SESSION["name"];
$password1 = $_SESSION["password1"];
$password2 = $_SESSION["password2"];
//lifeFlagの0は入会中にする（退会は1をにして消す）
$lifeFlag = 0;

//DB定義
const DSN = "mysql:dbname=gs_db2;charset=utf8;host=localhost";
const USER = "root";
const PASS = "";

//DB接続
try {
    $pdo = new PDO(DSN, USER, PASS);
} catch(PDOException $e) {
    exit('DbConnectError'. $e->getMessage());
}

//mysqlテーブル指定
$sql = "SELECT * FROM gs_question_table WHERE user_id=:id";

//作成したmysqlテーブルにbindValueの変数をDBに入れる
$statement = $pdo->prepare($sql);

//取得したデータをbindValueの変数に代入、↑に行く、リンクする
$statement->bindValue(':id', $sendId, PDO::PARAM_INT);

//DBからデータ取得、実行
$status = $statement->execute();

//DB登録後の処理
if($status == false) {
    $error = $statement->errorInfo();
    exit("QueryError:". error[2]);
}


//mysqlテーブル指定
$sql =
    "SELECT * FROM gs_user_table
    WHERE name=:name AND password1=:password1 AND lifeFlag=0";

//作成したmysqlテーブルにbindValueの変数をDBに入れる
$statement = $pdo->prepare($sql);

//取得したデータをbindValueの変数に代入、↑に行く、リンクする
$statement->bindValue(':name', $name, PDO::PARAM_STR);
$statement->bindValue(':password1', $password1, PDO::PARAM_STR);

//DBからデータ取得、実行
$status = $statement->execute();

//DB登録後の処理
if($status == false) {
    $error = $statement->errorInfo();
    exit("QueryError:". error[2]);
}


//今回入力されたname（ID）の$statementレコードを配列で取得、statusがエラーでなければ
$val = $statement->fetch();

//該当レコードがあればSESSIONに値を代入
if( $val["id"] != "" ) {
    //ログイン成功の場合
    $_SESSION["chk_sessionId"] = session_id();
    $_SESSION["name"] = $val["name"];
    $_SESSION["user_id"] = $val["id"];
    header("Location: qa_select.php");
} else {
    //ログイン失敗の場合
    header("Location: qa_login_fail.php");
}

exit();


?>