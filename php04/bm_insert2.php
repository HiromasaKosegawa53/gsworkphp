<?php
//ブックマークの登録処理、登録後の処理


//入力チェック
if(
    !isset($_POST["name"]) || $_POST["name"]=="" ||
    !isset($_POST["password1"]) || $_POST["password1"]=="" ||
    !isset($_POST["password2"]) || $_POST["password2"]==""
){
    exit('ParamError');
}

//POSTデータの取得、bm_index_viewから
$name = $_POST["name"];
$password1 = $_POST["password1"];
$password2 = $_POST["password2"];
$lifeFlag = $_POST["lifeFlag"];
$secret_question = $_POST["secret_question"];
$secret_answer = $_POST["secret_answer"];

//lifeFlagの0は入会中にする（退会は1をにして消す）
$lifeFlag = 0;

//DB定義
define("dsn","mysql:dbname=gs_db2;charset=utf8;host=localhost");
define("user","root");
define("pass","");

//DB接続
try {
    $pdo = new PDO(dsn, user, pass);
} catch(PDOException $e) {
    exit('DbConnectError:'. $e->getMessage());
}

//mysqlテーブル指定
$sql =
    "INSERT INTO gs_user2_table(
        id, name, password1, password2, indate, lifeFlag, secret_question, secret_answer
    ) VALUES (
        NULL, :name, :password1, :password2, sysdate(), :lifeFlag, :secret_question, :secret_answer
    )";

//作成したmysqlテーブルにbindValueの変数をDBに入れる
$statement = $pdo->prepare($sql);

//取得したデータをbindValueの変数に代入、↑に行く、リンクする
$statement->bindValue(':name', $name, PDO::PARAM_STR);
$statement->bindValue(':password1', $password1, PDO::PARAM_STR);
$statement->bindValue(':password2', $password2, PDO::PARAM_STR);
$statement->bindValue(':lifeFlag', $lifeFlag, PDO::PARAM_INT);
$statement->bindValue(':secret_question', $secret_question, PDO::PARAM_INT);
$statement->bindValue(':secret_answer', $secret_answer, PDO::PARAM_STR);

//DB登録、実行
$status = $statement->execute();

//DB登録後の処理
if($status==false) {
    $error = $statement->errorInfo();
    exit("QueryError:". error[2]);
} else {
    header("Location: bm_index_view.php");
    exit;
}


?>