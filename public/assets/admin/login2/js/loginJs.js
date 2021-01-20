// JavaScript Document
$(document).ready(function() {
    var height=$(window).height()-80;
	$(".content").css({"height":height+"px"});
	$(".login").css({"top":(height-407)/2+"px"})
	$(window).resize(function(){
		var height1=$(window).height()-80;
		$(".content").css({"height":height1+"px"});
		$(".login").css({"top":(height1-407)/2+"px"})
	})
});