function right_js() {
    $(".sidebar_right-phone_img").mouseover(function () {
        $('.sidebar_right-phone').css('display', 'block');
    })
    $(".sidebar_right-wechat_img").mouseover(function () {
        $('.sidebar_right-wechat').css('display', 'block');
    })
    $(".sidebar_right-phone").mouseout(function () {
        $('.sidebar_right-phone').css('display', 'none');
    })
    $(".sidebar_right-phone_img").mouseout(function () {
        $('.sidebar_right-phone').css('display', 'none');
    })
    $(".sidebar_right-wechat_img").mouseout(function () {
        $('.sidebar_right-wechat').css('display', 'none');
    })
    $(".sidebar_right-wechat").mouseout(function () {
        $('.sidebar_right-wechat').css('display', 'none');
    })
//投资报告
    $(".sidebar_right-invest_img").mouseover(function () {
        $('.sidebar_right-invest').css('display', 'block');
    })
// 右边悬浮框的js---end

// 点击回到顶部---start
    $(".back-top").hide();
    $(window).scroll(function () {
        if ($(window).scrollTop() > 50) {
            $(".back-top").fadeIn(200);
        } else {
            $(".back-top").fadeOut(200);
        }
    });
    $(".back-top").click(function () {
        $('body,html').animate({
                scrollTop: 0
            },
            500);
        return false;
    });
// 点击回到顶部---end
}
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

//右侧悬浮框提交投资报告表单
function consult_right($type){
    $('#form_consult_right').find("input[name='type']").val($type);
    submitConsultData_right();
    $('.web_components_sidebar_info .sidebar_right-invest').css('display','none');
}
function submitConsultData_right(){
    $.ajax({
        type: "POST",
        url: "/consult/add",
        data: $('#form_consult_right').serialize(),
        dataType: "json",
        success: function(data){
            alert(data.msg);
        }
    });
}
function table_hide(){
    $('.web_components_sidebar_info .sidebar_right-invest').css('display','none');
}




