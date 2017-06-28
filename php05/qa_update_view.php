<?php
//データ一覧から選択されたデータに対して更新、質問の編集、回答者は回答


//入力チェック
//if(
//    !isset($_POST["questionTitle"]) || $_POST["questionTitle"]=="" ||
//    !isset($_POST["questionText"]) || $_POST["questionText"]==""
//){
//    exit('ParamError');
//}

//idデータ取得、qa_select.phpから
$id = $_GET["id"];

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
$sql = "SELECT * FROM gs_question_table WHERE id=:id";

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
        <title>ScrachQA_質問の更新</title>
    </head>
    <body>
        <!-- 質問の更新[Start] -->
        <form action="qa_update.php" method="post">
            質問の内容：<input type="text" name="questionTitle" value="<?= $row["questionTitle"] ?>">
            <p>質問の内容</p>
            <textarea name="questionText" cols="30" rows="10"><?= $row["questionText"] ?></textarea>
            <input type="hidden" name="id" value="<?= $row["id"] ?>">
            <input type="submit" value="確認画面に進む">
        </form>
        <!-- 質問の更新[End] -->
    </body>
</html>