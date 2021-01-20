// JavaScript Document
var id;
var access_key;
var access_token;
$(document).ready(function(){
function getQueryString(name) { 
var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i"); 
var r = window.location.search.substr(1).match(reg); 
if (r != null) return unescape(r[2]); return null; 
}
function getLocalTime(nS) {     
   return new Date(parseInt(nS) * 1000).toLocaleString().replace(/:\d{1,2}$/,' ');
}     
id=getQueryString("id");
access_key=getQueryString("access_key");
access_token=getQueryString("access_token");
	$.ajax({
 	type:"post",  
    url : 'http://tl.youyu333.com/viewMessage',
    data:{id:id,access_key:access_key,access_token:access_token},
    dataType:'json',
	beforeSend: function(XMLHttpRequest){
		$("#jiazai").show();
		$('body').addClass("body");
	},
	success:function(data){
		$("#jiazai").hide();
		$('body').removeClass("body");
		$(".time").html(getLocalTime(data.msg.add_time));
		$(".neirong").html(data.msg.content);
	}
	})
});