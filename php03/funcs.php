<?php

//クロスサイトスクリプティング
function h ($val) {
    return htmlspecialchars($val,ENT_QUOTES);
}

//30秒判定
function s ($s) {
    if($s >= 30) {
        return $time_30 = "今は、30秒以上です。";
    } else {
        return $time_30 = "今は、30秒以下です。";
    }
}

//秒判定ごとの指定
function ss ($date_s) {
    if($date_s >= 1 && $date_s <= 19) {
        return $d = "morning";
    } else if($date_s >= 20 && $date_s <= 39) {
        return $d = "noon";
    } else if($date_s >= 40 && $date_s <= 59) {
        return $d = "night";
    } else {
        return $d = "ぴったり";
    }
}

?>