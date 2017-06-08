<?php
//初期値
$filename = 'data/data.txt'; //File名
$ar = array();               //配列格納用

//ファイルからデータ取得
$fp = fopen($filename, 'r'); //Fileを読み込み
while(!feof($fp)) {          //ファイルの最後行までループを繰り返す
  $txt = fgets($fp);         //1行取得
  $exp = explode(",", $txt); //カンマ区切り文字を配列変換
  array_push($ar, $exp);     //$ar配列に$expを追加
}
fclose($fp);

//JSON形式に変換
$json = json_encode($ar);   //$ar配列をjsonに変換
echo $json;                 //jsonを表示
?>
