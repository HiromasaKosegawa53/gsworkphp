<?php
//回答する画面

//session変数を使えるよう宣言
session_start();

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


//質問を表示させる処理
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

//回答を表示させる処理
//mysqlテーブル指定
$sql = "SELECT * FROM gs_answer_table WHERE question_id=:id";

//作成したmysqlテーブルにbindValueの変数をDBに入れる
$statement = $pdo->prepare($sql);

//取得したデータをbindValueの変数に代入、↑に行く、リンクする
$statement->bindValue(':id', $id, PDO::PARAM_INT);

//DB登録、実行
$status = $statement->execute();

//配列から取った値を入れる変数の定義
$view = "";

//データ表示処理
if($status == false) {
    $error = $statement->errorInfo();
    exit("QueryError:". $error[2]);
} else {
    while( $result = $statement->fetch(PDO::FETCH_ASSOC)){
        $view .= "<p>";
        //$view .= '<a href="qa_update_view.php?id='. $result["id"]. '">';
//        $view .= '<a href="qa_answer_view.php?id='. $result["id"]. '">';
        $view .= $result["id"]. ",". $result["answerText"];
//        $view .= "</a>";
        $view .= "　";
        $view .= "</p>";
    }
}

?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>ScrachQA_質問の回答</title>
    </head>
    <body>
        <!-- 質問の表示[Start] -->
        <form action="qa_update.php" method="post">
            質問の内容：<input type="text" name="questionTitle" value="<?= $row["questionTitle"] ?>">
            <p>質問の内容</p>
            <textarea name="questionText" cols="30" rows="10"><?= $row["questionText"] ?></textarea>
            <input type="hidden" name="id" value="<?= $row["id"] ?>">
            <!-- <input type="submit" value="更新"> -->
        </form>
        <!-- 質問の表示[End] -->
        
        
        <!-- 回答の入力[Start] -->
        <form action="qa_answer.php" method="post">
            <p>回答</p>
            <textarea name="answerText" id="" cols="30" rows="10"></textarea>
            <input type="hidden" name="id" value="<?= $row["id"] ?>">
            <input type="submit" view="回答する">
        </form>
        <!-- 回答の入力[End] -->
        
        
        <!-- 回答の表示[Start] -->
        <p>回答一覧</p>
        <?= $view ?>
        <!-- 回答の表示[End] -->
        
        
        <!-- 質問一覧に戻る -->
        <div><a href="qa_select.php">質問一覧に戻る</a></div>
    </body>
</html>