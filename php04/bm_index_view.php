<?php
//ブックマークの登録画面
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>登録画面</title>
    </head>
    <body>
        <form action="bm_insert.php" method="post">
            名前：<input type="text" name="name">
            パスワード：<input type="text" name="password1">
            パスワード確認：<input type="text" name="password2">
            <input type="hidden" name="lifeFlag">
            <input type="submit" value="登録">
        </form>
        <div><a href="bm_secretQ.php">秘密の質問を設定し登録する</a></div>
        <form action="bm_login_view.php">
            既にアカウントをお持ちの方：
            <input type="submit" value="ログインする">
        </form>
        <form method="post" action="bm_serch.php">
            名前を調べる：<input type="text" name="search">
            <input type="submit" value="検索">
        </form>
        <form action="bm_select.php" method="post">
            管理者専用（一覧表示）：
            <input type="submit" value="表示">
        </form>
    </body>
</html>