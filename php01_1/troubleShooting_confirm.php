<?php
$name = $_POST["name"];
$nameKana = $_POST["nameKana"];
$error_content = $_POST["error_content"];
$error_select = $_POST["error_select"];
$HTML = $_POST["HTML"];
$CSS = $_POST["CSS"];
$JavaScript = $_POST["JavaScript"];
$PHP = $_POST["PHP"];
$error_text = $_POST["error_text"];
//echo $name."<br>";
//echo $nameKana."<br>";
//echo $error_content."<br>";
//echo $error_select."<br>";
//echo $HTML."<br>";
//echo $CSS."<br>";
//echo $JavaScript."<br>";
//echo $PHP."<br>";
//echo $error_text."<br>";

//functionを用意
//function h ($val){
//    return htmlspecialchars($name, ENT_QUOTES);
//}

?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <title>TroubleShooting2</title>
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
                <h1 class="main-title">Trouble shooting result.</h1>
            </div>
        </header>
        <!--//header-->
        
        <!--main-->
            <p><?= htmlspecialchars($name, ENT_QUOTES); ?></p>
            <p><?= htmlspecialchars($nameKana, ENT_QUOTES); ?></p>
            <p><?= htmlspecialchars($error_content, ENT_QUOTES); ?></p>
            <p><?= htmlspecialchars($error_select, ENT_QUOTES); ?></p>
            <p><?= htmlspecialchars($HTML, ENT_QUOTES); ?></p>
            <p><?= htmlspecialchars($CSS, ENT_QUOTES); ?></p>
            <p><?= htmlspecialchars($JavaScript, ENT_QUOTES); ?></p>
            <p><?= htmlspecialchars($PHP, ENT_QUOTES); ?></p>
            <p><?= htmlspecialchars($error_text, ENT_QUOTES); ?></p>
        <!--//main-->
        
        <?php
        $file = fopen("data/data.csv","a");
        flock($file, LOCE_EX);
        fwrite($file, $str."\n");
        flock($file, LOCK_UN);
        fclose($file);
        ?>
        
        <!--footer-->
        <footer>
            <p class="footer-sentence">copyrights 2017 Powered by EducationalTroubleShooting_KOSE All RIghts Reserved.</p>
        </footer>
        <!--//footer-->
    </body>
</html>