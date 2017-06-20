
//30以上の判定
function judge(second_a){
    if(second_a >= 30) {
        var a = $("#judge").addClass("colorRed");
    } else {
        var a = $("#judge").addClass("colorBlue");
    }
    return a;
};
//秒判定ごとの指定
function judge_time(a) {
    if(a >= 1 && a <= 19) {
        var time_a = $(".main_img").addClass("main_img_morning");
    } else if(a >= 20 && a <= 39) {
        var time_a = $(".main_img").addClass("main_img_noon");
    } else if(a >= 40 && a <= 59) {
        var time_a = $(".main_img").addClass("main_img_night");
    } else {
        var time_a = $(".main_img").addClass("main_img_tasogare");
    }
    return time_a;
}