<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AJAXでデータ取得</title>
    <style>
        td{
            background-color: chocolate;
        }
    </style>
</head>
<body>


<!-- JSONデータを表示 -->
<table id="data"></table>
<button id="get1">データ１取得</button>
<button id="get2">データ２取得</button>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> 
<script>
$("#get1").on("click",function(){
    //JSON取得
    $.getJSON("output_data.php",function(data) {
        console.log(data);
        //DATA数ループ処理
        $("#data").empty();
        for(val in data){
            //表示HTML作成
            var td = "<tr>";
                td += "<td>"+data[val][0]+"</td>";
                td += "<td>"+data[val][1]+"</td>";
                td += "<td>"+data[val][2]+"</td>";
                td += "</tr>";
            //文字作成後にid="data"に追加
            $("#data").append(td);
        }
    });
});
$("#get2").on("click",function(){
    //JSON取得
    $.getJSON("output_data2.php",function(data) {
        console.log(data);
        //DATA数ループ処理
        $("#data").empty();
        for(val in data){
            //表示HTML作成
            var td = "<tr>";
                td += "<td>"+data[val][0]+"</td>";
                td += "<td>"+data[val][1]+"</td>";
                td += "<td>"+data[val][2]+"</td>";
                td += "</tr>";
            //文字作成後にid="data"に追加
            $("#data").append(td);
        }
    });
});
</script>
</body>
</html>