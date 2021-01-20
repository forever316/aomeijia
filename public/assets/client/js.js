// JavaScript Document
var id;
var access_key;
$(document).ready(function(){
function getQueryString(name) { 
var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i"); 
var r = window.location.search.substr(1).match(reg); 
if (r != null) return unescape(r[2]); return null; 
}
id=getQueryString("id");
access_key=getQueryString("access_key");
	$.ajax({
 	type:"post",  
    url : 'http://tl.youyu333.com/viewArticle',
    data:{id:id,access_key:access_key},
    dataType:'json',
	beforeSend: function(XMLHttpRequest){
		$("#jiazai").show();
		$('body').addClass("body");
	},
	success:function(data){
		$("#jiazai").hide();
		$('body').removeClass("body");
		$("#title").html(data.msg.title);
		$(".time").html(data.msg.created_at);
		$(".neirong").html(data.msg.content);
	}
	})
});