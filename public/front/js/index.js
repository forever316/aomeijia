
window.onload=function(){
	$('.home_consult').css('display','block');
	var app = {
		data() {
			return {
				isAppointmentShow: false,
			}
		},
	}

	Vue.createApp(app).mount('#home-page');

	// 导航
	$(".nav-list").mouseenter(function () {
		var el = $(this).find(".sub-nav");
		if (el) {
			el.stop().animate({ height : "show" }, 300);
		}
	});
	$(".nav-list").mouseleave(function() {
		var el = $(this).find(".sub-nav");
		if (el) {
			el.stop().animate({ height : "hide" }, 300);
		}
	});

	// banner轮播图---start
	var banner_slider=$('#banner_slider'),
		pics=$('#banner_slider_pics'),
		items=$('#banner_slider_pics a'),
		pic_num = items.length,
		pic_width=items.eq(0).width(),
		btn_prev=$('#arrow_prev'),
		btn_next=$('#arrow_next'),
		current=0,
		timmer=null;
	// 定义一个鼠标滑过判断事件
	banner_slider.hover(function(){
		clearInterval(timmer);
	},function(){
		timmer=setInterval(slider,3000);
	});
	function slider(){
		if(current < pic_num-1){
			current++;
		}
		doSlider();
	}
	timmer=setInterval(slider,3000);
	function doSlider(){
		// 图片轮播
		pics.stop().animate({
			left:-(current)*pic_width
		},1000,function(){
			if(current==pic_num-1){
				pics.css('left',-(current)*pic_width+'px');
				clearInterval(timmer);
			}
		});
	}

	// 点击上一张按钮切换图片
	btn_prev.click(function(){
		if(0<current&&current<=pic_num-1){
			current--;
		}else{
			current = 0;
		}
		doSlider();
	});
	// 点击下一张按钮切换图片	
	btn_next.click(function(){
		if(current < pic_num-1){
			current++;
		}
		doSlider();
	});
	// banner轮播图---end

	// 二级菜单---start
	$(".country-list-one>dt").mouseover(function() {
		$(this).children('div').css('cursor','pointer');
		$(this).children('div').css('color','#ee8300');
		$(this).find(".country-list-two").stop().slideLeftShow(300);
	})
	$(".country-list-one>dt").mouseout(function() {
		$(this).children('div').css('color','#fff');
		$(this).find(".country-list-two").stop().slideLeftHide(300);
	})
	
	 jQuery.fn.slideLeftHide = function( speed, callback ) {  
        this.animate({  
            width : "hide",  
            paddingLeft : "hide",  
            paddingRight : "hide",  
            marginLeft : "hide",  
            marginRight : "hide"  
        }, speed, callback );  
    };  
    jQuery.fn.slideLeftShow = function( speed, callback ) {  
        this.animate({  
            width : "show",  
            paddingLeft : "show",  
            paddingRight : "show",  
            marginLeft : "show",  
            marginRight : "show"  
        }, speed, callback );  
    }; 
    // 二级菜单---end 

    // 文字滚动---start
    $(".hot-list-bar").hover(function(){
		clearInterval(scrtime);
	},function(){
		scrtime=setInterval(function(){
		 $ul=$(".hot-list-bar ul");
		 liheight=$ul.find("li:first").height();
		 $ul.animate({marginTop:"-300px"},20000,function(){
		 $ul.find("li:first").appendTo(".hot-list-bar  ul");
		 $ul.find("li:first").hide();
		 $ul.css("margin-top","0px");
		 $ul.find("li:first").show();
	 });
	},5000);
	}).trigger("mouseleave");
	// 文字滚动---end

    // 合作伙伴选项卡----start
	var tab = $(".cooperative-partner-tag-list");
    var tab_item = $(".cooperative-partner-tag-list>span");
    var content = $(".cooperative-partner-list>ul");
     
    for(var i=0; i<tab_item.length; i++){
        tab_item[i].onmouseover=function(){
	       $(this).addClass("chosen").siblings().removeClass("chosen");
	       var index = $(this).index();
	       $(this).parent().siblings().children().eq(index).addClass("active").siblings().removeClass("active");
        }
    }
    // 合作伙伴选项卡----end
		 
	// 专业团队轮播
	var teamSwiper = new Swiper('.special-team-inner', {
		slidesPerView: 5,
		spaceBetween: 12.5,
		autoplay: true,
		loop: true,
	});
	$('.case-button-next').click(function () {
		teamSwiper.slideNext();
	});
	$('.case-button-prev').click(function () {
		teamSwiper.slidePrev();
	});

	//右边悬浮框的js
	right_js();

	//轮播图插件的启动
	hdp({
		li:"li",	//默认值：li;默认用li包裹
		boxid:"box_lbt",	//最外面div  id
		imgid:"img",	//图片外面id
		optid:"li",	//opt外面id
		an:"an",		//左右按钮id，用于移上显示和隐藏
		prev:"prev",	//左边箭头id
		next:"next",	//右边箭头id
		ms:3000		//多少毫秒切换一张,默认800毫秒
	})
	
	//最新资讯的点击切换
	$('.info-menu').click(function(){
		console.log(222);
		$('.info-menu').removeClass('active');
		$(this).addClass('active');
		var type_id = $(this).attr('value');
		$.ajax({
			type: "POST",
			url: "/index/getInfoByType",
			data: {type_id:type_id},
			dataType: "json",
			success: function(data){
				var html_info_two = '';
				var html_info_other = '';
				$.each(data.info_two, function(index, infoTwo){
					html_info_two += '<li><img src="/'+infoTwo.thumb+'" style="width:310px;height:259px;"><a target="_blank" href="/information/detail?id='+infoTwo.id+'"> <p class="hot-info-left-title text-overflow-1">'+infoTwo.title+'</p><p class="hot-info-left-introduction text-overflow-3">'+infoTwo.describe+'</p> </a> </li>';
				});

				$.each(data.info_other, function(index, infoOther){
					html_info_other += '<li><a target="_blank" href="/information/detail?id='+infoOther.id+'"><p class="text-overflow-1">'+infoOther.title+'</p></a></li>';
				});
				$('.hot-info-inner .hot-info-left .info_two').html(html_info_two);
				$('.hot-info-inner .hot-info-right .info_other').html(html_info_other);
			}
		});
	})

}




