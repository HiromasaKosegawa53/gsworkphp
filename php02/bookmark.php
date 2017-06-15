<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>bookmark</title>
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/bookmark.css">
        <script src="js/jquery-2.1.3.min.js"></script>
    </head>
    <body>
        <!-- Head[Start] -->
        <header>
            <!-- DB内からデータを検索して取り出す -->
            <form method="post" action="bookmark_select.php">
                <label>調べる：<input type="text" name="search"></label>
                <input type="submit" value="検索">
            </form>
        </header>
        <!-- Head[End] -->
        
        <!-- Main[Start] -->
        <form method="post" action="bookmark_insert.php">
            <fieldset>
                <legend>ブックマーク</legend>
                <div class="bookmark_form">
                    <label>書籍名：<input type="text" name="bookTitle"></label>
                    <label>書籍URL：<input type="text" name="bookUrl"></label>
                    <label>書籍コメント：<textarea name="comment" cols="30" rows="4"></textarea></label>
                </div>
                <input type="submit" value="登録" class="submit_btn">
            </fieldset>
        </form>
        <!-- Main[End] -->
        
        <!-- API[Start] -->
        <input id="isbtn" class="isbtn" type="text" value="本のキーワード"><button id="bookbtn" class="bookbtn">検索</button>
        <div id="content" class="content"></div>
        
        <div id="content"></div>
        <div id="content2"></div>


        <script>
            $("#bookbtn").on("click",function(){
                var keybtn = $("#isbtn").val();
                var keybtn2 = $("#isbtn").val();
                //Ajax
                $.getJSON(
                    //？はURLにキーワードをつける時で、q=は検索キーワードが入る。dataには検索された結果が入る。
                    "https://www.googleapis.com/books/v1/volumes?q=" + keybtn,//元々は?q=jquery
                    //getJSONの中なので、JSONの文字列化をオブジェクトに変換してくれる。
                    function(data){
                        console.dir(data);

                        //itemsの0番目のデータを参照するとき
                        var item = data.items[0];
                        $("#content").html("本のタイトル： " + item.volumeInfo.title).css("fontSize","30px");
                    }//セミコロンつけない。functionの中カッコ
                );
                //Ajax2
                $.getJSON(
                    //？はURLにキーワードをつける時で、q=は検索キーワードが入る。dataには検索された結果が入る。
                    "https://www.googleapis.com/books/v1/volumes?q=isbn:[ISBN10]" + keybtn2,//元々は?q=jquery
                    //getJSONの中なので、JSONの文字列化をオブジェクトに変換してくれる。
                    function(data){
                        console.dir(data);

                        //itemsの0番目のデータを参照するとき
                        var aLink = data.items[0];
                        $("#content2").html("URL： " + aLink.volumeInfo.title).css("fontSize","30px");
                    }//セミコロンつけない。functionの中カッコ
                );
            });

            //テキストボックスを選択したら全選択状態にする
            $('#isbtn').on('click', function(e) {
                //e.target.setSelectionRange(0, e.target.value.length);// 下と同じだった
                $(this).select();
            });
        </script>
        <!-- API[End] -->
    </body>
</html>