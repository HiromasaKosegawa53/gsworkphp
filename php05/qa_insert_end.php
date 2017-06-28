<?php
//ユーザ情報登録の処理（確認後）


//session変数を使えるよう宣言
session_start();

//入力チェック
if(
    !isset($_POST["name"]) || $_POST["name"]=="" ||
    !isset($_POST["password1"]) || $_POST["password1"]=="" ||
    !isset($_POST["password2"]) || $_POST["password2"]==""
){
    exit('ParamError');
}

//POSTデータの取得、qa_form.phpから
$name = $_POST["name"];
$password1 = $_POST["password1"];
$password2 = $_POST["password2"];
$lifeFlag = $_POST["lifeFlag"];
$sendId = $_POST["sendId"];
$_SESSION["name"] = $name;
$_SESSION["password1"] = $password1;
$_SESSION["password2"] = $password2;

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
    exit('DbConnectError:'. $e->getMessage());
}

//mysqlテーブル指定
$sql =
    "INSERT INTO gs_user_table(
        id, name, password1, password2, indate, lifeFlag
    ) VALUES (
        NULL, :name, :password1, :password2, sysdate(), :lifeFlag
    )";

//作成したmysqlテーブルにbindValueの変数をDBに入れる
$statement = $pdo->prepare($sql);

//取得したデータをbindValueの変数に代入、↑に行く、リンクする
$statement->bindValue(':name', $name, PDO::PARAM_STR);
$statement->bindValue(':password1', $password1, PDO::PARAM_STR);
$statement->bindValue(':password2', $password2, PDO::PARAM_STR);
$statement->bindValue(':lifeFlag', $lifeFlag, PDO::PARAM_INT);

//DB登録、実行
$status = $statement->execute();

//DB登録後の処理
if($status==false) {
    $error = $statement->errorInfo();
    exit("QueryError:". error[2]);
} else {
    header("Location: qa_login_first.php");
    exit;
}


?>