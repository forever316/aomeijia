// JavaScript Document
$(document).ready(function(){
	 //选择地址
     $(".xz").click(function(){
		 $(".xz").removeClass("thisxz");
		 $(this).addClass("thisxz");
	 })
	 
	 //选择工种
	 $(".profession li").click(function(){
		 $(".profession li").removeClass("pitch-on");
		 $(this).addClass("pitch-on");
	 })
});