// JavaScript Document
$(document).ready(function(){
	$(".onesc").click(function(){//单击综合执行操作
	    $(this).removeClass("onesc_02");
		$(this).toggleClass("onesc_01");
		$('body').toggleClass("BODY");
		$(".zzc").toggle();
		$(".twosc").removeClass("twothis");
		$(".threesc").removeClass("threesc-01");
		$(".shang").removeClass("shang-01");
		$(".xia").removeClass("xia-01");
	})
	$(".twosc").click(function(){
		$(".onesc").addClass("onesc_02");
		$(".zzc").hide();
		$(this).toggleClass("twothis");
		$(".threesc").removeClass("threesc-01");
		$(".shang").removeClass("shang-01");
		$(".xia").removeClass("xia-01");
		$('body').removeClass("BODY");
	})
	$(".zzc li").click(function(){
		$(".zzc li").removeClass("xzthis");
		$(this).addClass("xzthis");
	})
	$(".threesc").click(function(){
		$(this).addClass("threesc-01");
		var vajia=$(this).attr('value');
		$(".twosc").removeClass("twothis");
		$(".onesc").addClass("onesc_02");
		$(".zzc").hide();
		$('body').removeClass("BODY");
		if(vajia==1){
			$(".shang").addClass("shang-01");
			$(".xia").removeClass("xia-01");
			$(this).attr('value','2');
		}else{
			$(".shang").removeClass("shang-01");
			$(".xia").addClass("xia-01");
			$(this).attr('value','1');
		}
	})
});