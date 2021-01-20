// JavaScript Document
$(document).ready(function() {
    //商品，详情切换
	$(".suspendNav li").click(function(){
		$(".suspendNav li").removeClass("thisnav");
		$(this).addClass("thisnav");
		var tab_id=$(this).attr("id");
		if(tab_id=="spxd"){
			$(".spxq").hide();
			$(".spxd").show();
		}else{
			$(".spxq").show();
			$(".spxd").hide();
		}
	})
	
	//详情切换
	$(".xqnav li").click(function(){
		$(".xqnav li").removeClass("dqcd");
		$(this).addClass("dqcd");
		var dqli=$(this).attr("id");
		$(".conter").find('div').hide();
		$("."+dqli).show();
		$("."+dqli).find('div').show();
	})
	
	//收藏
	$(".shouchang").click(function(){
		$(this).toggleClass("yisc");
		var va=$(this).attr('title');
		if(va==1){
			$(this).find('em').html('已收藏');
			$(this).attr('title','2')
		}else{
			$(this).find('em').html('收藏');
			$(this).attr('title','1')
		}
	})
	
	/*分类选择*/
	$(".lei li").click(function(){
		$(this).parent().find('li').removeClass('xz');
		$(this).addClass('xz');
	})
	$(".option").click(function(){
		$(".zhezhao").show();
		$(".classify").slideDown("slow");
		$(".car2").hide();
		$(".buy1,.car1").show();
	})
	// $(".car,.buy").click(function(){
	// 	if ($(this).hasClass('car')) {
			
	// 	};
	// 	if ($(this).hasClass('car')) {
			
	// 	};
	// 	$(".zhezhao").show();
	// 	$(".classify").slideDown("slow");
	// 	$(".car2").show();
	// 	$(".buy1,.car1").hide();
	// })
	$(".classgb").click(function(){
		setTimeout(function () {
        $(".zhezhao").hide();
    	}, 700);
		$(".classify").slideUp("slow");
	})
	$(document).click(function(){
    	setTimeout(function () {
        $(".zhezhao").hide();
    	}, 700);
		$(".classify").slideUp("slow");
	});
	$(".classify , .option,.car,.buy").click(function(event){
    	event.stopPropagation();
	});
});