// JavaScript Document
$(document).ready(function(){
	//分类选择
	$(".sort-left li").click(function(){
		$(".sort-left li").removeClass("dqsort");
		$(this).addClass("dqsort");
		var sortid=$(this).attr('id');
		$(".oneli").hide();
		$("#"+sortid+"_01").show();
	})
	

	$(".quanxuan").click(function(){
		$(this).toggleClass("quanxuan-01");
		var zhi=$(this).attr('title');
		if(zhi==1){
			$(".xuanzhong").addClass("xuanzhong-01");
			$(this).attr('title','2');
		}else{
			$(".xuanzhong").removeClass("xuanzhong-01");
			$(this).attr('title','1');
		}

	});
	
	//编辑购物车
	$(".bianji").click(function(){
		var zhi1=$(this).attr("title");
		if(zhi1==1){
			$(".bianji").html("完成");
			$("#jiesuan1").hide();
			$("#jiesuan2").show();
			$(this).attr("title","2");
		}else{
			$(".bianji").html("编辑");
			$("#jiesuan1").show();
			$("#jiesuan2").hide();
			$(this).attr("title","1");
		}
	})
	
	//首页文字无缝滚动
     $(function(){
     	lottery();
 	 });
	 function lottery(){
		 var $obj=$("#wufeng li");
		 var len = $obj.length;
    	 var i = 0;
		 $("#next").click(function(){
		   i++;
		   if(i==len){
			i = 0;
		   }
		   $obj.stop(true,true).hide().eq(i).fadeIn(500);
		   return false;
		 });
		 MyTime = setInterval(function(){
		   $("#next").trigger("click");
		 } , 3000);
	 }  
});