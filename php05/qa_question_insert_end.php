<?php
//質問登録の処理（確認後）


//session変数を使えるよう宣言
session_start();

//入力チェック
//if(
//    !isset($_POST["questionTitle"]) || $_POST["questionTitle"]=="" ||
//    !isset($_POST["questionText"]) || $_POST["questionText"]==""
//){
//    exit('ParamError');
//}

//POSTデータの取得
$questionTitle = $_SESSION["questionTitle"];
$questionText = $_SESSION["questionText"];
$judgeFlag = $_SESSION["judgeFlag"];
$answerCount = $_SESSION["answerCount"];

//未解決にする（1になると解決になる）
$judgeFlag = 0;
//回答の数を数える
$answerCount = 0;
//ログインした時点で発行するidを取得がuser_idになる
$user_id = $_SESSION["user_id"];

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
    "INSERT INTO gs_question_table(
        id, user_id, questionTitle, questionText, indate, judgeFlag, answerCount
    ) VALUES (
        NULL, :user_id, :questionTitle, :questionText, sysdate(), :judgeFlag, :answerCount
    )";

//作成したmysqlテーブルにbindValueの変数をDBに入れる
$statement = $pdo->prepare($sql);

//取得したデータをbindValueの変数に代入、↑に行く、リンクする
$statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$statement->bindValue(':questionTitle', $questionTitle, PDO::PARAM_STR);
$statement->bindValue(':questionText', $questionText, PDO::PARAM_STR);
$statement->bindValue(':judgeFlag', $judgeFlag, PDO::PARAM_INT);
$statement->bindValue(':answerCount', $answerCount, PDO::PARAM_INT);

//DB登録、実行
$status = $statement->execute();


//DB登録後の処理
if($status==false) {
    $error = $statement->errorInfo();
    exit("QueryError:". error[2]);
} else {
    header("Location: qa_main.php");
    exit;
}



?>