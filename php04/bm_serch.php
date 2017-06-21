<?php
//DB内の検索、取得、nameの入力に対して


//DB定義
define("dsn", "mysql:dbname=gs_db2;charset=utf8;host=localhost");
define("user", "root");
define("pass", "");

//DB接続
try {
    $pdo = new PDO(dsn, user, pass);
} catch(PDOException $e) {
    exit('DbConnectError:'. $e->getMessage());
}

//mysqlテーブル指定
$sql = "SELECT * FROM gs_user_table WHERE name LIKE :name";
$sqlAll = "SELECT * FROM gs_user_table";

//作成したmysqlテーブルをDBに入れる
//$statement = $pdo->prepare($sql);

if(!isset($_POST["search"]) || $_POST["search"]==""){
    $s = 0;
    //echo "0";
}else{
    $s = 1;
    //echo "1";
}
if($s == 1){
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":name", '%'.$_POST["search"].'%');
}else{
    $statement = $pdo->prepare($sqlAll);
}

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
        $view .= '<a href="bm_update_view.php?id='. $result["id"]. '">';
        $view .= $result["id"]. ",". $result["name"];
        $view .= "</a>";
        $view .= "　";
        $view .= '<a href="bm_delete.php?id='. $result["id"]. '">';
        $view .= "[削除]";
        $view .= "</a>";
        $view .= "　";
        $view .= '<a href="bm_taikai.php?id='. $result["id"]. '">';
        $view .= "[退会させる]";
        $view .= "</a>";
        $view .= "</p>";
    }
}

?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>ユーザ一覧</title>
    </head>
    <body>
        <div><a href="bm_index_view.php">【TOPへ】</a></div>
        <div><?= $view; ?></div>
    </body>
</html>