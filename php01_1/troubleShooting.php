<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <title>TroubleShooting</title>
        <!--css-->
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/troubleShooting.css">
        <!--js-->
        <script src="js/jquery-2.1.3.min.js"></script>
        
    </head>
    <body>
        <!--header-->
        <header>
            <div class="main-img">
                <h1 class="main-title">Trouble shooting!!</h1>
            </div>
        </header>
        <!--//header-->
        
        <!--form-->
        <!--説明-->
        <div class="contact-wrapper">
            <div class="contact-container">
                <div class="contact-title">
                    <h2 id="contact" class="contact">Support and inquiries</h2>
                </div>
                <div class="contact-subTitle">
                    <p>エラー内容の投稿・お問い合わせ<br><span class="gutiru">（もしかして愚痴るん!?）</span></p>
                </div>
                <div class="contact-sentence">
                    <p class="contact-sentence1">プログラマとバグは切っても切れない関係にあります。
                    </p>
                    <p class="contact-sentence2">文法エラーや設定エラーなどエラーには様々な種類があります。
                    </p>
                    <p class="contact-sentence3">本サービスは投稿されたエラーについて、デバッグ法を提案します。
                    </p>
                    <p class="contact-sentence4">※本サービスは実際には存在しません。
                    </p>
                </div>
            </div>
            <!--記入フォーム-->
            <form method="post" action="troubleShooting_confirm.php" id="" name="" value="">
                <table class="form-table">
                    <!--名前、カナ、メールのinput-->
                    <tr>
                        <td class="form-tableTd-title">名前</td>
                        <td class="form-tableTd-input form-input-someType">
                            <input class="aInput" type="text" name="name" value="">
                        </td>
                    </tr>
                    <tr>
                        <td class="form-tableTd-title">カナ</td>
                        <td class="form-tableTd-input form-input-someType">
                            <input class="aInput" type="text" name="nameKana" value="">
                        </td>
                    </tr>
                    <tr>
                        <td class="form-tableTd-title">エラー内容</td>
                        <td class="form-tableTd-input form-input-someType">
                            <input class="aInput" type="text" name="error_content" value="">
                        </td>
                    </tr>
                    <!--セレクトボックス、cssはinputにほぼ合わせる-->
                    <tr>
                        <td class="form-tableTd-title">エラーが出ている<br>プログラミング言語</td>
                        <td class="form-tableTd-input form-input-someType">
                            <select name="error_select" id="">
                                <option value="HTML">HTML</option>
                                <option value="CSS">CSS</option>
                                <option value="JavaScript">JavaScript</option>
                                <option value="jQuery">jQuery</option>
                                <option value="PHP">PHP</option>
                            </select>
                        </td>
                    </tr>
                    <!--チェックボックス-->
                    <tr>
                        <td class="form-tableTd-title-n2">使用している<br>プログラミング言語</td>
                        <td class="form-tableTd-input">
                            <p class="chBox-paragraph">
                                <input class="chBox" type="checkbox" name="HTML" value="HTML" id="startUp">
                                <label for="startUp" class="check_css">HTML</label>
                            </p>
                            <p class="chBox-paragraph">
                                <input class="chBox" type="checkbox" name="CSS" value="CSS" id="startWork">
                                <label for="startWork" class="check_css">CSS</label>
                            </p>
                            <p class="chBox-paragraph">
                                <input class="chBox" type="checkbox" name="JavaScript" value="JavaScript" id="makeUse">
                                <label for="makeUse" class="check_css">JavaScript / jQuery</label>
                            </p>
                            <p class="chBox-paragraph">
                                <input class="chBox" type="checkbox" name="PHP" value="PHP" id="acquireKnowledge">
                                <label for="acquireKnowledge" class="check_css">PHP</label>
                            </p>
                        </td>
                    </tr>
                    <!--テキストエリア、cssはinputにほぼ合わせる-->
                    <tr>
                        <td class="form-tableTd-title-n2">エラー詳細or<br>うまくいかない内容<br>（任意）</td>
                        <td class="form-tableTd-input  form-input-someType">
                            <textarea name="error_text" id="" cols="30" rows="8"></textarea>
                        </td>
                    </tr>
                </table>
                <!--送信ボタン-->
                <div class="sub-wrapper sub-act">
                    <input type="submit" value="送信" class="sub">
                </div>
            </form>
        </div>
        <!--//form-->
        
        <!--footer-->
        <footer>
            <p class="footer-sentence">copyrights 2017 Powered by EducationalTroubleShooting_KOSE All RIghts Reserved.</p>
        </footer>
        <!--//footer-->
    </body>
</html>