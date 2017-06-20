<?php

//PHPの関数呼び出し
include("funcs.php");

$d = date("Y年m月d日　H:i:s");
$date_s = date("s");



?>


<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>bookmark</title>
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/bookmark2.css">
        <script src="js/jquery-2.1.3.min.js"></script>
        <script src="js/funcs.js"></script>
    </head>
    <body>
        <!--メインビジュアル-->
        <div class="main_img">
            <div class="main_item">
                <p><?= h($d); ?></p>
                <p><?= h($date_s); ?>：<?= ss($date_s); ?></p>
            </div>
        </div>
        <!--ユーザ登録-->
        <form action="bookmark_insert2.php" method="post">
            <input type="text" name="bookTitle">本のタイトル<br>
            <input type="text" name="bookUrl">本のURL<br>
            <textarea name="bookText" cols="30" rows="10"></textarea><br>
            <input type="submit" value="送信">
        </form>
        
        <script>
            //メインビジュアル
            var a = <?php echo $date_s; ?>;
            console.log(a);
            judge_time(a);
        </script>
    </body>
</html>