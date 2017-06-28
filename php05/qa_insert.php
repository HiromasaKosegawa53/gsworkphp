<?php
//ユーザ情報登録の処理


//入力チェック
if(
    !isset($_POST["name"]) || $_POST["name"]=="" ||
    !isset($_POST["password1"]) || $_POST["password1"]=="" ||
    !isset($_POST["password2"]) || $_POST["password2"]==""
){
    exit('ParamError');
}

//POSTデータの取得、qa_form.phpから
$name = $_POST["name"];
$password1 = $_POST["password1"];
$password2 = $_POST["password2"];
$lifeFlag = $_POST["lifeFlag"];

//lifeFlagの0は入会中にする（退会は1をにして消す）
$lifeFlag = 0;

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
    "INSERT INTO gs_user_table(
        id, name, password1, password2, indate, lifeFlag
    ) VALUES (
        NULL, :name, :password1, :password2, sysdate(), :lifeFlag
    )";

//作成したmysqlテーブルにbindValueの変数をDBに入れる
$statement = $pdo->prepare($sql);

//取得したデータをbindValueの変数に代入、↑に行く、リンクする
$statement->bindValue(':name', $name, PDO::PARAM_STR);
$statement->bindValue(':password1', $password1, PDO::PARAM_STR);
$statement->bindValue(':password2', $password2, PDO::PARAM_STR);
$statement->bindValue(':lifeFlag', $lifeFlag, PDO::PARAM_INT);

//DB登録、実行
$status = $statement->execute();


//登録したデータを表示（確認）
//mysqlテーブル指定
$sql = "SELECT * FROM gs_user_table ORDER BY id DESC LIMIT 1";

//作成したmysqlテーブルをDBに入れる
$statement = $pdo->prepare($sql);

//DBからデータ取得、実行
$status = $statement->execute();

//配列から取った値を入れる変数の定義
$view = "";
$view_name = "";
$view_password1 = "";
$view_password2 = "";
$view_id = "";

//データ表示処理
if($status==false) {
    $error = $statement->errorInfo();
    exit("QueryError:". $error[2]);
} else {
    while( $result = $statement->fetch(PDO::FETCH_ASSOC)){
        $view .= "<p>";
        $view .= $result["name"]. ",". $result["password1"];
        $view .= "</p>";
        $view_name .= $result["name"];
        $view_password1 .= $result["password1"];
        $view_password2 .= $result["password2"];
        $view_id .= $result["id"];
    }
}

?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>ScrachQA_登録画面（確認）</title>
        <link rel="stylesheet" href="css/top.css">
        <link rel="shortcut icon" href="image/scractch_favicon.png">
    </head>
    <body>
        <div><?= $view; ?></div>
        <p>よろしいですか？</p>
        
        <!-- 確認[Start] -->
        <form action="qa_insert_end.php" method="post">
            お名前：<input type="text" name="name" value="<?= $view_name; ?>">
            パスワード：<input type="password" name="password1" value="<?= $view_password1; ?>">
            <!-- パスワード（確認）は隠して送る -->
            <input type="hidden" name="password2" value="<?= $view_password2; ?>">
            <!-- ライフフラグ作成 -->
            <input type="hidden" name="lifeFlag">
            <!-- idを送る -->
            <input type="hidden" name="sendId" value="<?= $view_id; ?>">
            <input type="submit" value="登録">
        </form>
        <!-- 確認[Start] -->
        
        <div><a href="qa_form.php">戻る</a></div>
    </body>
</html>
