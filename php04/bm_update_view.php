<?php
//データ一覧から選択されたデータに対して更新、ユーザ入力


//入力チェック
if(
    !isset($_POST["name"]) || $_POST["name"]=="" ||
    !isset($_POST["password1"]) || $_POST["password1"]=="" ||
    !isset($_POST["password2"]) || $_POST["password2"]==""
){
    exit('ParamError');
}

//idデータ取得、bm_selectから
$id = $_GET["id"];

//DB定義
define("dsn", "mysql:dbname=gs_db2;charset=utf8;host=localhost");
define("user", "root");
define("pass", "");

//DB接続
try {
    $pdo = new PDO(dsn, user, pass);
} catch(PDOException $e) {
    exit('DbConnectError:'. $e->getMessage());
}

//mysqlテーブル指定
$sql = "SELECT * FROM gs_user_table WHERE id=:id";

//作成したmysqlテーブルにbindValueの変数をDBに入れる
$statement = $pdo->prepare($sql);

//取得したデータをbindValueの変数に代入、↑に行く、リンクする
$statement->bindValue(':id', $id, PDO::PARAM_INT);

//DB登録、実行
$status = $statement->execute();

//データ表示処理
if($status == false) {
    $error = $statement->errorInfo();
    exit("QueryError:". $error[2]);
} else {
    $row = $statement->fetch();
}


?>


<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>ユーザ情報更新</title>
    </head>
    <body>
        <form action="bm_update.php" method="post">
            <input type="text" name="name" value="<?= $row["name"] ?>">
            <input type="text" name="password1" value="<?= $row["password1"] ?>">
            <input type="text" name="password2" value="<?= $row["password2"] ?>">
            <input type="hidden" name="id" value="<?= $row["id"] ?>">
            <input type="submit" value="更新">
        </form>
    </body>
</html>






















