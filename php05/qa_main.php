<?php
//ScrachQAサイトのトップページ
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>ScrachQA</title>
        <link rel="stylesheet" href="css/top.css">
        <link rel="shortcut icon" href="image/scractch_favicon.png">
    </head>
    <body>
        <!-- main[Start] -->
        <form action="qa_question_insert.php" method="post">
            質問のタイトル：<input type="text" name="questionTitle"><br>
            <p>質問の内容</p>
            <textarea name="questionText" cols="30" rows="10"></textarea><br>
            <!-- ジャッジフラグ作成［未解決か解決かを判定する］ -->
            <input type="hidden" name="judgeFlag">
            <!-- アンサーカウント作成［回答の数をカウントする］ -->
            <input type="hidden" name="answerCount">
            <input type="submit" value="送信">
        </form>
        <!-- main[End] -->
        
        <!-- 質問一覧へ遷移 -->
        <a href="qa_select.php">質問一覧はコチラ</a>
    </body>
</html>