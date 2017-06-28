<?php
//質問更新の処理（確認後）


//入力チェック
if(
    !isset($_POST["questionTitle"]) || $_POST["questionTitle"]=="" ||
    !isset($_POST["questionText"]) || $_POST["questionText"]==""
){
    exit('ParamError');
}

//POSTデータの取得
$questionTitle = $_POST["questionTitle"];
$questionText = $_POST["questionText"];
$judgeFlag = $_POST["judgeFlag"];
$ansCount = $_POST["ansCount"];
$id = $_POST["id"];

//未解決にする（1になると解決になる）
$judgeFlag = 0;
//回答の数を数える
$ansCount = 0;

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
    "UPDATE gs_question_table
    SET questionTitle=:questionTitle, questionText=:questionText
    WHERE id=:id";

//作成したmysqlテーブルにbindValueの変数をDBに入れる
$statement = $pdo->prepare($sql);

//取得したデータをbindValueの変数に代入、↑に行く、リンクする
$statement->bindValue(":questionTitle", $questionTitle, PDO::PARAM_STR);
$statement->bindValue(":questionText", $questionText, PDO::PARAM_STR);
$statement->bindValue(":id", $id, PDO::PARAM_INT);

//DB更新、実行
$status = $statement->execute();

//DB登録後の処理
if($status==false) {
    $error = $statement->errorInfo();
    exit("QueryError:". error[2]);
} else {
    header("Location: qa_select.php");
    exit;
}


?>