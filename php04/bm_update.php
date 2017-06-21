<?php
//データ更新の処理

//postデータ取得、bm_update_viewtから
$name = $_POST["name"];
$password1 = $_POST["password1"];
$password2 = $_POST["password2"];
$id = $_POST["id"];

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
    "UPDATE gs_user_table
    SET name=:name, password1=:password1, password2=:password2
    WHERE id=:id";

//作成したmysqlテーブルにbindValueの変数をDBに入れる
$statement = $pdo->prepare($sql);

//取得したデータをbindValueの変数に代入、↑に行く、リンクする
$statement->bindValue(":name", $name, PDO::PARAM_STR);
$statement->bindValue(":password1", $password1, PDO::PARAM_STR);
$statement->bindValue(":password2", $password2, PDO::PARAM_STR);
$statement->bindValue(":id", $id, PDO::PARAM_INT);

//DB更新、実行
$status = $statement->execute();

//DB更新後の処理
if($status == false) {
    $error = $statement->errorInfo();
    exit("QueryError:". $error[2]);
} else {
    header("Location: bm_select.php");
    exit;
}


?>