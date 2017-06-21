<?php
//データを削除処理、selectにリダイレクトさせる


//getデータ取得、selectから
$id = $_GET["id"];

//退会させる、1のlifeFlag退会に変える（0のlifeFlag入会中を）
$name = "";
$password1 = "";
$password2 = "";
$lifeFlag = 1;

//DB定義
const dsn = "mysql:dbname=gs_db2;charset=utf8;host=localhost";
const user = "root";
const pass = "";

//DB接続
try {
    $pdo = new PDO(dsn, user, pass);
} catch(PDOException $e) {
    exit('DbConnectError:'. $e->getMessage());
}

//mysqlテーブル指定
$sql =
    "UPDATE gs_user_table
    SET name=:name, password1=:password1, password2=:password2, lifeFlag=:lifeFlag
    WHERE id=:id";

//作成したmysqlテーブルをDBに入れる
$statement = $pdo->prepare($sql);

//取得したデータをbindValueの変数に代入、↑に行く、リンクする
$statement->bindValue(":name", $name, PDO::PARAM_STR);
$statement->bindValue(":password1", $password1, PDO::PARAM_STR);
$statement->bindValue(":password2", $password2, PDO::PARAM_STR);
$statement->bindValue(":lifeFlag", $lifeFlag, PDO::PARAM_INT);
$statement->bindValue(":id", $id, PDO::PARAM_INT);

//DB削除、実行
$status = $statement->execute();

//DB削除後の処理
if($status == false) {
    $error = $statement->errorInfo();
    exit("QueryError:". $error[2]);
} else {
    header("Location: bm_select.php");
    exit;
}

?>