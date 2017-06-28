<?php
//質問の一覧を表示させる


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
$sql = "SELECT * FROM gs_question_table";

//作成したmysqlテーブルをDBに入れる
$statement = $pdo->prepare($sql);

//DBからデータ取得、実行
$status = $statement->execute();

//配列から取った値を入れる変数の定義
$view = "";

//データ表示処理
if($status==false) {
    $error = $statement->errorInfo();
    exit("QueryError:". $error[2]);
} else {
    while( $result = $statement->fetch(PDO::FETCH_ASSOC)){
        $view .= "<p>";
        //$view .= '<a href="qa_update_view.php?id='. $result["id"]. '">';
        $view .= '<a href="qa_answer_view.php?id='. $result["id"]. '">';
        $view .= $result["id"]. ",". $result["questionTitle"];
        $view .= "</a>";
        $view .= "　";
        $view .= "</p>";
    }
}


?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>質問一覧</title>
        <link rel="shortcut icon" href="image/scractch_favicon.png">
        <link rel="stylesheet" href="css/selcet.css">
    </head>
    <body>
        <!--header-->
        <header>
            <div class="header-above">
                <p class="logo"><a href="#"><img src="image/scractch_title.png" alt="Scractch" class="logo_size"></a></p>
            </div>
            <div class="main-img">
                <h1 class="main-title">ScrachのQAサイト</h1>
            </div>
        </header>
        <!--//header-->
        <div class="content">
            <div><a href="qa_logout.php">【ログアウト】</a></div>

            <div><a href="qa_main.php">質問を投稿する</a></div>
            
            <div><p>質問一覧</p></div>

            <div><?= $view; ?></div>
        </div>
        
    </body>
</html>