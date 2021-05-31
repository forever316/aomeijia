function submitConsultData(){
    $.ajax({
        type: "POST",
        url: "/consult/add",
        data: $('#form_consult').serialize(),
        dataType: "json",
        success: function(data){
            alert(data.msg);
        }
    });
}
function submitConsultData_1(){
    $.ajax({
        type: "POST",
        url: "/consult/add",
        data: $('#form_consult_1').serialize(),
        dataType: "json",
        success: function(data){
            alert(data.msg);
        }
    });
}


window.onload=function(){

    // 右边悬浮框的js
    $(".sidebar_right-phone_img").mouseover(function() {
        $('.sidebar_right-phone').css('display','block');
    })
    $(".sidebar_right-wechat_img").mouseover(function() {
        $('.sidebar_right-wechat').css('display','block');
    })
    $(".sidebar_right-phone").mouseout(function() {
        $('.sidebar_right-phone').css('display','none');
    })
    $(".sidebar_right-phone_img").mouseout(function() {
        $('.sidebar_right-phone').css('display','none');
    })
    $(".sidebar_right-wechat_img").mouseout(function() {
        $('.sidebar_right-wechat').css('display','none');
    })
    $(".sidebar_right-wechat").mouseout(function() {
        $('.sidebar_right-wechat').css('display','none');
    })

    // 右边悬浮框的js---end

    // 点击回到顶部---start
    $(".back-top").hide();
    $(window).scroll(function() {
        if ($(window).scrollTop() > 50) {
            $(".back-top").fadeIn(200);
        } else {
            $(".back-top").fadeOut(200);
        }
    });
    $(".back-top").click(function() {
        $('body,html').animate({
                scrollTop: 0
            },
            500);
        return false;
    });
    // 点击回到顶部---end

}





