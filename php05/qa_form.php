<?php
//ユーザ情報登録
    //新規登録
    //ログイン
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>ScrachQA_登録画面</title>
        <link rel="stylesheet" href="css/top.css">
        <link rel="shortcut icon" href="image/scractch_favicon.png">
    </head>
    <body>
       <div class="wrapper">
           <!-- 新規登録[Start] -->
           <div class="item">
              <div class="s_item">
                  <h2>新規登録</h2>
                  <form action="qa_insert.php" method="post">
                      ID：<input type="text" name="name">
                      パスワード：<input type="password" name="password1">
                      パスワード（確認）：<input type="password" name="password2">
                      <!-- ライフフラグ作成 -->
                      <input type="hidden" name="lifeFlag">
                      <input type="submit" value="確認画面に進む" class="btn">
                  </form>
                  <!-- 新規登録[End] -->
              </div>
           </div>


           <div class="item">
              <div class="s_item">
                  <!-- ログイン[Start] -->
                  <h2>ログイン</h2>
                  <form action="qa_login.php" method="post">
                      ID：<input type="text" name="name">
                      パスワード：<input type="password" name="password1">
                      <input type="submit" value="ログイン" class="btn">
                  </form>
                  <!-- ログイン[End] -->
              </div>
           </div>

           <!-- パスワード忘れたときのform -->
           <!-- //パスワード忘れたときのform -->
       </div>
        
    </body>
</html>