<?php


//session変数を使えるよう宣言
session_start();

//入力チェック
if(
    !isset($_POST["questionTitle"]) || $_POST["questionTitle"]=="" ||
    !isset($_POST["questionText"]) || $_POST["questionText"]==""
){
    exit('ParamError');
}

//postデータ取得、selectから
$id = $_POST["d_id"];

//POSTデータの取得
$questionTitle = $_POST["questionTitle"];
$questionText = $_POST["questionText"];
$judgeFlag = $_POST["judgeFlag"];
$answerCount = $_POST["answerCount"];



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
$sql = "DELETE FROM gs_question_table WHERE id=:id";

//作成したmysqlテーブルをDBに入れる
$statement = $pdo->prepare($sql);

//取得したデータをbindValueの変数に代入、↑に行く、リンクする
$statement->bindValue(":id", $id, PDO::PARAM_INT);

//DB削除、実行
$status = $statement->execute();

//DB削除後の処理
if($status == false) {
    $error = $statement->errorInfo();
    exit("QueryError:". $error[2]);
} else {
    $_SESSION["questionTitle"] = $questionTitle;
    $_SESSION["questionText"] = $questionText;
    $_SESSION["judgeFlag"] = $judgeFlag;
    $_SESSION["answerCount"] = $answerCount;
    header("Location: qa_question_insert_end.php");
    exit;
}



?>