var setTimer = 0
function redirect(){
    var timeCounter = $("#redirect_secs").html();
    var updateTimer = eval(timeCounter)-eval(1);
    var site = $("#redirect_site").html();

    $("#redirect_secs").html(updateTimer);

    if(updateTimer == 0){
        window.location = site;
        clearInterval(timer);
    }
}
$(function(){
    timer = window.setInterval(redirect, 1000);

});