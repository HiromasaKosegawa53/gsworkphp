<?php



?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>秘密の質問</title>
    </head>
    <body>
        <form action="bm_insert2.php" method="post">
            名前：<input type="text" name="name">
            パスワード：<input type="text" name="password1">
            パスワード確認：<input type="text" name="password2">
            <input type="hidden" name="lifeFlag">
            <select name="secret_question">
                <option value="1">好きな食べ物は？</option>
                <option value="2">地元は？</option>
            </select>
            秘密の質問：<input type="text" name="secret_answer">
            <input type="submit" value="登録">
        </form>
    </body>
</html>