// JavaScript Document
$(document).ready(function(){
	$(".cz li").click(function(){
		$(".cz li").removeClass("on");
		$(this).addClass("on");
	})
});