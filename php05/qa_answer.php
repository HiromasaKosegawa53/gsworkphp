<?php
//回答を処理する


//session変数を使えるよう宣言
session_start();

//入力チェック
if(
    !isset($_POST["answerText"]) || $_POST["answerText"]==""
){
    exit('ParamError');
}

//POSTデータの取得、qa_answer_view.phpから
$answerText = $_POST["answerText"];
$id = $_POST["id"];


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

//質問のidをanswer_tableに登録する
$question_id = $id;

//ログインした時点で発行するidを取得がuser_idになる
$user_id = $_SESSION["user_id"];

//mysqlテーブル指定
$sql =
    "INSERT INTO gs_answer_table(
        id, question_id, user_id, answerText, indate
    ) VALUES (
        NULL, :question_id, :user_id, :answerText, sysdate()
    )";


//作成したmysqlテーブルにbindValueの変数をDBに入れる
$statement = $pdo->prepare($sql);

//取得したデータをbindValueの変数に代入、↑に行く、リンクする
$statement->bindValue(':question_id', $question_id, PDO::PARAM_INT);
$statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$statement->bindValue(':answerText', $answerText, PDO::PARAM_STR);

//DB登録、実行
$status = $statement->execute();

//DB登録後の処理
if($status==false) {
    $error = $statement->errorInfo();
    exit("QueryError:". error[2]);
} else {
    header("Location: qa_answer_view.php?id=". $id);
    exit;
}


?>