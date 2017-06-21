<?php
//ログインの処理


//session変数を使えるよう宣言
session_start();

//入力チェック
if(
    !isset($_POST["name"]) || $_POST["name"]=="" ||
    !isset($_POST["password1"]) || $_POST["password1"]==""
){
    exit('ParamError');
}

//POSTデータの取得、bm_login_viewから
$name = $_POST["name"];
$password1 = $_POST["password1"];

//DB定義
const dsn = "mysql:dbname=gs_db2;charset=utf8;host=localhost";
const user = "root";
const pass = "";

//DB接続
try {
    $pdo = new PDO(dsn, user, pass);
} catch(PDOException $e) {
    exit('DbConnectError'. $e->getMessage());
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

//該当レコードがあればSESSIONに値を代入、、、わからないから下の方で
//if( password_verify($password1, $val["password1"]) ) {
//    $_SESSION["chk_sessionId"]  = session_id();
//    $_SESSION["name"] = $val["name"];
//    header("Location: bm_select.php");
//} else {
//    header("Location: bm_index_view.php");
//}

//該当レコードがあればSESSIONに値を代入
if( $val["id"] != "" ) {
    $_SESSION["chk_sessionId"] = session_id();
    $_SESSION["name"] = $val["name"];
    header("Location: bm_select.php");
} else {
    header("Location: bm_index_view.php");
}

exit();
?>


























