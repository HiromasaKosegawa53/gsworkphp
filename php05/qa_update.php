<?php
//質問更新の処理


//入力チェック
if(
    !isset($_POST["questionTitle"]) || $_POST["questionTitle"]=="" ||
    !isset($_POST["questionText"]) || $_POST["questionText"]==""
){
    exit('ParamError');
}

//POSTデータの取得、qa_update_viewt.phpから
$questionTitle = $_POST["questionTitle"];
$questionText = $_POST["questionText"];
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


//登録したデータを表示（確認）
//mysqlテーブル指定
$sql = "SELECT * FROM gs_question_table WHERE id=:id";

//作成したmysqlテーブルをDBに入れる
$statement = $pdo->prepare($sql);

//取得したデータをbindValueの変数に代入、↑に行く、リンクする
$statement->bindValue(":id", $id, PDO::PARAM_INT);

//DBからデータ取得、実行
$status = $statement->execute();

//配列から取った値を入れる変数の定義
$view_questionTitle = "";
$view_questionText = "";

//データ表示処理
if($status==false) {
    $error = $statement->errorInfo();
    exit("QueryError:". $error[2]);
} else {
    while( $result = $statement->fetch(PDO::FETCH_ASSOC)){
        $view_questionTitle .= $result["questionTitle"];
        $view_questionText .= $result["questionText"];
    }
}


?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>ScrachQA_質問の更新（確認）</title>
    </head>
    <body>
        <!-- 質問の更新[Start] -->
        <form action="qa_update_end.php" method="post">
            質問のタイトル：<input type="text" name="questionTitle" value="<?= $view_questionTitle; ?>">
            <p>質問の内容</p>
            <textarea name="questionText" cols="30" rows="10"><?= $view_questionText; ?></textarea><br>
            <!-- ジャッジフラグ作成［未解決か解決かを判定する］ -->
            <input type="hidden" name="judgeFlag">
            <!-- アンサーカウント作成［回答の数をカウントする］ -->
            <input type="hidden" name="ansCount">
            <p>上記内容で投稿してよろしいですか？</p>
            <input type="submit" value="更新">
        </form>
        <!-- 質問の更新[[End]] -->
        
        <div><a href="qa_update_view.php">戻る</a></div>
    </body>
</html>