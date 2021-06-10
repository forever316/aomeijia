<!DOCTYPE html>
<html lang="en">
	<head>
		<link type="text/css" rel="styleSheet" href="/front/css/banner.css" />
		<link type="text/css" rel="styleSheet" href="/front/css/index.css" />
		<script src="/front/js/index.js"></script>
		@include('front.common.layout')
	</head>
<body>
<style>
.cooperative-partner-list img{
	width:140px;
	height:80px;
}
	.banner_slider_pics img{
		width:1920px;
		height:550px;
	}
	.hot-info-left-introduction{
		max-height:36px;
	}
	.country-list-one .menu_city:hover{
		color: #ee8300 !important;
	}
	.country-list-one .menu_city{
		color:#fff;
	}
	.country-list-one a.on{
		color:#ee8300;
	}
	.menu-bg-black{
		background: rgba(0, 0, 0, .5);
		height: 58px !important;
		position: absolute;
		top: -16px;
		border-radius: 5px;
	}
	.country-list-two>dl>dt:first-child~dt span>b {
		line-height: 58px !important;
		left: 49% !important;
		width: 90px !important;
	}
	.hot-info-header-list .info-menu{
		cursor: pointer;
	}
	.web_components_sidebar_info .sidebar_right-phone {
		width: 110px !important;
	}
	.hot-delegation-bottom {
		height: 125px !important;
	}
    .hot-delegation-bottom .hot-delegation-bottom-list{
        margin:10px;
    }
	.hot-delegation-bottom .hot-delegation-bottom-list img{
		width:282px;
		height:100%;
	}
    /*解决列表不向左对齐问题*/
    .hot-delegation-bottom::after {
        content: "";
        flex: auto;
    }

</style>
<main id="home-page" v-cloak>
	@include('front.common.header')
		<!-- banner区域 -->
	<div class="home-banner-wrapper">
		<div class="home-banner">
			<div class="banner-main">
				<!-- 轮播图 -->
				<div class="banner_slider" id="banner_slider">
					<div class="banner_slider_pics" id="banner_slider_pics">
						@if($data['topBanner'])
							@foreach($data['topBanner'] as $tp=>$tv)
							<a target="_blank" href="{{$tv['link']}}"><img src="{{$tv['img_url']}}"></a>
							@endforeach
						@endif
					</div>
					<div class="banner_slider_arrow">
						<p class="arrow_item prev" id="arrow_prev">&lt;</p>
						<p class="arrow_item next" id="arrow_next">&gt;</p>
					</div>
				</div>
				<!-- 一级菜单 -->
				<dl class="country-list-one">
					<dt>
						<img src="/front/images/housing-resources-logo1.jpeg" alt="">
						<div style="margin-left:8px;cursor: pointer;">
							<a href="/?pid=0" class="menu_city @if($data['pid']==0) on @endif" target="_blank"><p>全球</p></a>
							<span>></span>
						</div>
						<code class="country-list-two">
							<dl>
								<dt>
									热门城市/地区
								</dt>
								@if($data['cityList_hot'])
									@foreach($data['cityList_hot'] as $hot)
										<dt>
											<span>
												<img src="/{{$hot['pic']}}">

													<b class="menu-bg-black">
														<a href="/?pid=0&id={{$hot['id']}}" class="menu_city @if($data['id']==$hot['id']) on @endif" target="_blank">
															{{$hot['name']}}
														</a>
													</b>

											</span>
										</dt>
									@endforeach
								@endif
							</dl>
						</code>
					</dt>

					@if($data['cityList'])
						@foreach($data['cityList'] as $ck=>$cv)
							<dt>
								@if($cv['pic'])
								<img src="/{{$cv['pic']}}" alt="">
								@endif
								<div style="margin-left: 8px;cursor: pointer;">
									<p><a href="/?pid={{$cv['id']}}" class="menu_city @if($data['pid']==$cv['id']) on @endif" target="_blank">{{$cv['name']}}</a></p>
									<span>></span>
								</div>
								<code class="country-list-two">
									<dl>
										<dt>
											城市/地区
										</dt>
										@if(isset($cv['childs']) && $cv['childs'])
											@foreach($cv['childs'] as $child)
{{--												<a href="/?id={{$child['id']}}" class="menu_city" target="_blank">--}}
												<dt>
													<span>
														<img style="width:89px;height:58px;" src="/{{$child['pic']}}">
														<b class="menu-bg-black"><a href="/?pid={{$cv['id']}}&id={{$child['id']}}" class="menu_city @if($data['id']==$child['id']) on @endif" target="_blank">{{$child['name']}}</a></b>
													</span>
												</dt>
{{--												</a>--}}
											@endforeach
										@endif
									</dl>
								</code>
							</dt>

						@endforeach
					@endif
				</dl>
			</div>
			<div class="banner-bottom">
				@if(isset($data['serviceBanner']['img_url']))
					<img src="/{{$data['serviceBanner']['img_url']}}">
				@endif
			</div>
		</div>
	</div>
	<div class="container-wrapper">
		<!-- 热门资讯 -->
		<div class="hot-info-wrapper">
			<div class="hot-info-header">
				<div class="hot-info-header-list">
					<ul>
						<li class="hot-header-first">热门资讯</li>
						@if($data['infoType'])
							@foreach($data['infoType'] as $tk=>$type)
								<li class="info-menu @if($tk==0) active @endif" value="{{$type['id']}}">{!! $type['name'] !!}</li>
							@endforeach
						@endif
					</ul>
				</div>
				<div class="hot-view-more">
					<a target="_blank" href="/information"><p>查看更多 > > ></p></a>
				</div>
			</div>
			<div class="hot-info-inner">
				<div class="hot-info-left">
					<ul class="info_two">
						@if($data['info_two'])
							@foreach($data['info_two'] as $info)
								<li>
									<img src="/{{$info['thumb']}}" style="width:310px;height:259px;">
									<a target="_blank" href="/information/detail?id={{$info['id']}}">
										<p class="hot-info-left-title text-overflow-1">{{$info['title']}}</p>
										<p class="hot-info-left-introduction desc text-overflow-2">{!! $info['describe'] !!}</p>
									</a>
								</li>
							@endforeach
						@endif
					</ul>
				</div>
				<div class="hot-info-right">
					<ul class="info_other">
						@if($data['info_other'])
							@foreach($data['info_other'] as $infos)
								<li><a target="_blank" href="/information/detail?id={{$infos['id']}}">{!! $infos['title'] !!}</a></li>
							@endforeach
						@endif
					</ul>
				</div>
			</div>
		</div>
		<!-- 热门资讯下的列表 -->
		<div class="hot-list-bar">
			<ul>
				@if($data['wechat'])
					@foreach($data['wechat'] as $wechat)
						<li>• <a target="_blank" href="{!! $wechat['url'] !!}">{!! $wechat['title'] !!}</a></li>
					@endforeach
				@endif
			</ul>
		</div>
		<!-- 热门展会 + 考察团-->
		<div class="exhibitions-delegation-wrapper">
			<!-- 热门展会 -->
			<div class="hot-exhibitions-wrapper">
				<div class="hot-exhibitions-header">
					<div class="exhibitions-header-title">热门活动</div>
					<div class="exhibitions-header-view-more"><a target="_blank" href="#">查看更多 > > ></a></div>
				</div>
				<div class="hot-exhibitions-inner">
					@if($data['active'])
					<div class="hot-exhibitions-adv">
						<img src="/{{$data['active']['thumb']}}" alt="" >
					</div>
					<div class="hot-exhibitions-info">
						<span class="hot-exhibitions-info-title">{{$data['active']['theme']}}</span>
						<dl>
{{--							<dt>深圳站</dt>--}}
							<dt>
								<img src="/front/images/time-logo2.jpeg">
								<span>{{$data['active']['time']}}</span>
							</dt>
							<dt>
								<img src="/front/images/address-logo.jpeg">
								<span>{{$data['active']['address']}}</span>
							</dt>
						</dl>
{{--						<dl>--}}
{{--							<dt>广州站</dt>--}}
{{--							<dt>--}}
{{--								<img src="/front/images/time-logo2.jpeg">--}}
{{--								<span>2020年12月30日 13:00pm</span>--}}
{{--							</dt>--}}
{{--							<dt>--}}
{{--								<img src="/front/images/address-logo.jpeg">--}}
{{--								<span>广州天河区林和西路161号中泰国际广场40楼</span>--}}
{{--							</dt>--}}
{{--						</dl>--}}
						<span class="btn appointment exhibitions-sign-button" @click="isAppointmentShow = true">立即预约报名</span>
{{--						<div class="exhibitions-sign-button btn appointment" @click="isAppointmentShow = true">--}}
{{--							立即预约报名--}}
{{--						</div>--}}
					</div>
					@endif
				</div>
			</div>
			<!-- 考察团 -->
			<div class="delegation-wrapper">
				<div class="delegation-header">
					<div class="delegation-header-title">考察团</div>
					<div class="delegation-header-view-more"><a target="_blank" href="/inspect">查看更多 > > ></a></div>
				</div>
				<div class="delegation-inner">
					<a target="_blank" href="/inspect/detail?id={{$data['inspect'][0]['id']}}">
						<div class="delegation-banner">
							@if(isset($data['inspect'][0]))
							<img src="/{{$data['inspect'][0]['thumb']}}" style="width:464px;height:197px;">
							<div class="delegation-banner-describe">
								<p>{{$data['inspect'][0]['title']}}</p>
								<p>
									<span>{{$data['inspect'][0]['end_date']}} 结截</span>
								</p>
							</div>
							@endif
						</div>
					</a>
					<div class="delegation-list">
						<dl>
							@foreach($data['inspect'] as $ki=>$kiv)
								@if($ki>0)
									<dt>
										<a target="_blank" href="/inspect/detail?id={{$kiv['id']}}">
											<span><img src="/{{$kiv['thumb']}}" style="width:110px;height:62px;"></span>
											<div class="delegation-list-describe">
												<p class="desc text-overflow-1">{{$kiv['title']}}</p>
												<p class="desc text-overflow-1">{{$kiv['describe']}}</p>
											</div>
										</a>
									</dt>
								@endif
							@endforeach
						</dl>
					</div>
				</div>
			</div>
		</div>
		<!-- 热门展会 考察团下的模块 -->
		<div class="hot-delegation-bottom">
			@foreach($data['past_active'] as $val)
				<div class="hot-delegation-bottom-list">
					<a target="_blank" href=""><img src="/{{$val['thumb']}}"></a>
				</div>
			@endforeach
			@foreach($data['past_inspect'] as $val)
				<div class="hot-delegation-bottom-list">
					<a target="_blank" href="/inspect/review/detail?id={{$val['id']}}"><img src="/{{$val['thumb']}}"></a>
				</div>
			@endforeach
		</div>
		<!-- 热点项目推荐 -->
		<div class="project-recommend-wrapper">
			<div class="project-recommend-header">
				<p>
					热点项目推荐
					<span>好房源那么多 我们为您精挑细选</span>
				</p>
				<p><a target="_blank" href="/house">查看更多 > > ></a></p>
			</div>
			<div class="project-recommend-inner">
				<dl>
					@foreach($data['house'] as $key=>$val)
						<dt>
							<div class="recommend-img-wrapper">
								<a target="_blank" href="/house/detail?id={{$val['id']}}"><img style="width: 292px;height: 254px;" src="/{{$val['img']}}" alt=""></a>
								<span class="hot-logo">
                    热门
                  </span>
								<p>价格：￥{{$val['total_price']}}万起</p>
							</div>
							<div class="recommend-desc-wrapper none-pointer">
								<p class="recommend-desc-title">
									{{$val['title']}}
								</p>
								<div class="recommend-desc-info">
                    <span>
                      <p>{{$val['city_name']}}</p>
                      <p>城市</p>
                    </span>
									<span>
                      <p>{{$val['type_name']}}</p>
                      <p>类型</p>
                    </span>
									<span>
                      <p>￥{{$val['unit_price']}}万起</p>
                      <p>单价</p>
                    </span>
									<span>
                      <p>{{$val['first_payment']}}%</p>
                      <p>首付</p>
                    </span>
								</div>
							</div>
						</dt>
					@endforeach
				</dl>
			</div>
		</div>
		<!-- 海外移民 -->
		<div class="overseas-migrate-wrapper">
			<div class="overseas-migrate-header">
				<p>
					<span>海外移民</span>
					<span>好房源那么多 我们为您精挑细选</span>
				</p>
				<p><a target="_blank" href="/migrate">查看更多 > > ></a></p>
			</div>
			<div class="overseas-migrate-inner">
				@if($data['migrate_first'])
					<div class="overseas-migrate-inner-left none-pointer">
						<img src="/{{$data['migrate_first']['img']}}">
						<div class="overseas-migrate-inner-info">
							<span class="view-info-desc">
								<p>{{$data['migrate_first']['title']}}</p>
								<p>{{$data['migrate_first']['project_charac']}}</p>
							</span>
							<span class="view-info-button"><a target="_blank" href="/migrate/detail?id={{$data['migrate_first']['id']}}">查看详情</a></span>
						</div>
					</div>
				@endif
				@if($data['migrate_two'])
					<div class="overseas-migrate-inner-right none-pointer">
						<img src="/{{$data['migrate_two']['img']}}">
						<div class="overseas-migrate-inner-info">
							<span class="view-info-desc">
								<p>{{$data['migrate_two']['title']}}</p>
								<p>{{$data['migrate_two']['project_charac']}}</p>
							</span>
							<span class="view-info-button"><a target="_blank" href="/migrate/detail?id={{$data['migrate_two']['id']}}">查看详情</a></span>
						</div>
					</div>
				@endif
			</div>
		</div>
		<!-- 海外移民下的list -->
		<div class="overseas-bottom-list-wrapper">
			@foreach($data['migrate'] as $mkey=>$mval)
				<div class="overseas-bottom-list" style="height:291px; !important">
					<a target="_blank" href="/migrate/detail?id={{$mval['id']}}">
						<img src="/{{$mval['img']}}" style="width:287px;height: 288px;">
						<div class="overseas-bottom-list-desc bg-black">
							<p style="font-size: 22px;">{{$mval['title']}}</p>
							<p>{{$mval['total_price']}}万起</p>
							<p>
								<span>{{$mval['project_charac']}}</span>
								<span>{{$mval['identity']}}</span>
								<span>{{$mval['transact_period']}}</span>
							</p>
						</div>
					</a>
				</div>
			@endforeach
		</div>
		<!-- 成功案例 -->
		<div class="success-case-wrapper">
			<div class="success-case-header">
				<p>
					成功案例
					<span>好房源那么多 我们为您精挑细选</span>
				</p>
				<p><a target="_blank" href="/invest/case">查看更多 > > ></a></p>
			</div>
			<div class="success-case-inner">
				@if($data['case'] && isset($data['case'][0]))
					<div class="success-case-inner-left">
						<img src="/{!! $data['case'][0]['thumb'] !!}">
						<div class="success-case-inner-info">
							<p><a target="_blank" href="/invest/case/detail?id={{$data['case'][0]['id']}}">{!! $data['case'][0]['title'] !!}</a></p>
							<p class="desc text-overflow-2">{!! $data['case'][0]['describe'] !!}</p>
						</div>
					</div>
				@endif

				<div class="success-case-inner-right">
					<dl>
						@if($data['case'])
							@foreach($data['case'] as $case_key=>$case_val)
								@if($case_key>=1)
									<dt>
										<a target="_blank" href="/invest/case/detail?id={{$case_val['id']}}">
											<div><img src="/{!! $case_val['thumb'] !!}" alt=""></div>
											<div class="success-case-list-desc">
												<p>{!! $case_val['title'] !!}</p>
												<p class="desc text-overflow-2">{!! $case_val['describe'] !!} </p>
											</div>
										</a>
									</dt>
								@endif
							@endforeach
						@endif
					</dl>
				</div>
			</div>
		</div>
		<!-- 专业团队 -->
		<div class="special-team-wrapper">
				<div class="special-team-header">
					<p>
						专业团队
						<span>好房源那么多 我们为您精挑细选</span>
					</p>
					<p></p>
				</div>
				<div class="special-team-inner">
					<dl class="swiper-wrapper">
						@if($data['member'])
							@foreach($data['member'] as $member)
								<dt class="swiper-slide">
									<p>
										<img src="{!! $member['photo'] !!}" alt="">
									</p>
									<div class="special-team-inner-desc">
										<span>{!! $member['name'] !!}</span>
										<span>{!! $member['job'] !!}</span>
										<span class="text-overflow-3">{!! $member['describe'] !!}</span>
										<span>
											<a target="_blank" class="special-a" style="text-decoration: none;
	color: #fff;" targe="_blank" href=" http://p.qiao.baidu.com/cps/chat?siteId=6088728&userId=7240211&siteToken=41095c4a656b37c14a45dc99176af78f">
											联系TA
											</a>
										</span>
									</div>
								</dt>
							@endforeach
						@endif

					</dl>
				</div>
				<div class="case-button-next"></div>
        <div class="case-button-prev"></div>
			</div>
			<!-- 专业团队下的内容 -->
			<div class="special-team-bottom-wrapper">
				<div class="special-team-bottom-video">
					<iframe width="592" height="398" src="{{$data['company']['video']}}" frameborder="0" allowfullscreen>
					</iframe>
{{--					<video src="{{$data['company']['video']}}" controls="controls"></video>--}}
				</div>
				<div class="special-team-bottom-info">
					<p>
						专业售前售后服务
					</p>
					<div class="special-team-bottom-info-list">
						@if($data['bottomBanner'])
							@foreach($data['bottomBanner'] as $sk=>$service)
								@if($sk==0 || $sk==3)<dl>@endif
								<dt>
									<img src="/{!! $service['img_url'] !!}">
									<div>
										<p>{!! $service['title'] !!}</p>
										<p>{!! $service['describe'] !!}</p>
									</div>
								</dt>
								@if($sk==2 || $sk==5)</dl>@endif
							@endforeach
						@endif
					</div>
				</div>
			</div>
		<!-- 合作伙伴 -->
		<div class="cooperative-partner-wrapper">
			<div class="cooperative-partner-header">
				<p>
					合作伙伴
					<span>好房源那么多 我们为您精挑细选</span>
				</p>
				<p></p>
			</div>
			<div class="cooperative-partner-inner">
				<div class="cooperative-partner-tag-list">
				@foreach($data['partnerData'] as $key=>$val)
					<span class="@if($val['class']=='active') chosen  @endif">{{$val['typeName']}}</span>
				@endforeach
				</div>
				<div class="cooperative-partner-list">
					@if($data['partnerData'])
						@foreach($data['partnerData'] as $key=>$val)
							<ul class=" aaa @if($val['class']=='active') active @endif">
								@if(isset($val['partner']))
									@foreach($val['partner'] as $pk=>$pv)
										<li>
											<img src="{{$pv['logo']}}" alt="">
											<span>{{$pv['title']}}</span>
										</li>
									@endforeach
								@endif
							</ul>
						@endforeach
					@endif
				</div>
			</div>
		</div>
	</div>
	<div class="home_consult" style="display:none;">
		@include('front.common.consult')
	</div>
	<div class="sidebar_right-invest">
	@include('front.common.footer')

<script>
	$('.info-menu').click(function(){
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
					html_info_other += '<li><a target="_blank" href="/information/detail?id='+infoOther.id+'">'+infoOther.title+'</a></li>';
				});
				$('.hot-info-inner .hot-info-left .info_two').html(html_info_two);
				$('.hot-info-inner .hot-info-right .info_other').html(html_info_other);
			}
		});
	})
	function consult(){
		$('#form_consult').find("input[name='type']").val(9);
		submitConsultData();
	}

</script>
</body>
