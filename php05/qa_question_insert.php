<?php
//質問登録の処理


//session変数を使えるよう宣言
session_start();

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
$answerCount = $_POST["answerCount"];

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


//登録したデータを表示（確認）
//mysqlテーブル指定
$sql = "SELECT * FROM gs_question_table ORDER BY id DESC LIMIT 1";

//作成したmysqlテーブルをDBに入れる
$statement = $pdo->prepare($sql);

//DBからデータ取得、実行
$status = $statement->execute();

//配列から取った値を入れる変数の定義
$view_questionTitle = "";
$view_questionText = "";
$view = "";

//データ表示処理
if($status==false) {
    $error = $statement->errorInfo();
    exit("QueryError:". $error[2]);
} else {
    while( $result = $statement->fetch(PDO::FETCH_ASSOC)){
        $view_questionTitle .= $result["questionTitle"];
        $view_questionText .= $result["questionText"];
        $view .= $result["id"];
    }
}


?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>ScrachQA_質問投稿（確認）</title>
    </head>
    <body>
        <!-- 質問の投稿[Start] -->
        <form action="delete.php" method="post">
            質問のタイトル：<input type="text" name="questionTitle" value="<?= $view_questionTitle; ?>">
            <p>質問の内容</p>
            <textarea name="questionText" cols="30" rows="10"><?= $view_questionText; ?></textarea><br>
            <input type="hidden" name="d_id" value="<?= $view ?>">
            <!-- ジャッジフラグ作成［未解決か解決かを判定する］ -->
            <input type="hidden" name="judgeFlag">
            <!-- アンサーカウント作成［回答の数をカウントする］ -->
            <input type="hidden" name="answerCount">
            <p>上記内容で投稿してよろしいですか？</p>
            <input type="submit" value="投稿">
        </form>
        <!-- 質問の投稿[End] -->
        
        <div><a href="qa_main.php">戻る</a></div>
    </body>
</html>
