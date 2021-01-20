// JavaScript Document
$(document).ready(function(){
    //我的订单切换
	$(".orderNav li").click(function(){
		$(".orderNav li a").removeClass("tspan");
		$(this).find('a').addClass("tspan");
		var tabIds=$(this).attr('id')+"_01";
		$(".zh_order").hide();
		$("#"+tabIds).show();
	})
	
	//弹出支付方式
	$("#present").click(function(){
		$(".curtain").show();
		var shiji=$(".way").height();
		var gao=$(window).height();
		$(".way").css({"top":(gao-shiji)/2+"px"});
	})
	
	//关闭支付方式
	$("#close").click(function(){
		$(".curtain").hide();
	})
	
	//待付款关闭提示
	$("#gbtishi").click(function(){
		$(".tishi").hide();
	})
});