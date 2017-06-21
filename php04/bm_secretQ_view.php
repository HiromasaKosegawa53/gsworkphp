<?php



?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>秘密の質問</title>
    </head>
    <body>
        <form action="bm_secretQ_reset.php">
            <select name="secret_question">
                <option value="1">好きな食べ物は？</option>
                <option value="2">地元は？</option>
            </select>
            答え：<input type="text" name="answer">
            <input type="submit" value="送信">
        </form>
    </body>
</html>