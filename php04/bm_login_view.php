<?php
//ログインする画面
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
    </head>
    <body>
        <div><a href="bm_index_view.php">【TOPへ】</a></div>
        <form action="bm_login.php" method="post">
            ID：<input type="text" name="name">
            PW：<input type="text" name="password1">
            <input type="submit" value="LOGIN">
        </form>
        <p><a href="bm_secretQ_view.php">パスワードをリセットする</a></p>
    </body>
</html>