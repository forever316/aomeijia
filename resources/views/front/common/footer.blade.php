<div class="footer-wrapper">
	<div class="footer-inner">
		<div class="footer-left">
			<div class="footer-logo">
				<img src="/{{$data['company']['footer_logo']}}">
			</div>
			<div class="footer-phone">
				<p class="phone-title">
					<span>全国咨询电话</span>
				</p>
				<p class="phone-number">{{$data['company']['custom_service_phone']}}</p>
			</div>
		</div>
		<div class="footer-center">
			<ul>
				<li class="first-li">全球房产</li>
				@if(isset($data['linkData'][1]))
					@foreach($data['linkData'][1] as $key=>$val)
						<li><a target="_blank" href="{{$val['url']}}">{{$val['title']}}</a></li>
					@endforeach
				@endif
			</ul>
			<ul>
				<li class="first-li">全球移民</li>
				@if(isset($data['linkData'][2]))
					@foreach($data['linkData'][2] as $key=>$val)
						<li><a target="_blank" href="{{$val['url']}}">{{$val['title']}}</a></li>
					@endforeach
				@endif
			</ul>
			<ul>
				<li class="first-li">关于公司</li>
				@if(isset($data['linkData'][3]))
					@foreach($data['linkData'][3] as $key=>$val)
						<li><a target="_blank" href="{{$val['url']}}">{{$val['title']}}</a></li>
					@endforeach
				@endif
			</ul>
		</div>
		<div class="footer-right">
			<ul class="footer-right-ul">
				<li>
					<img style="width:150px;height:150px;" src="/{{$data['company']['wechat1_img']}}" alt="">
					<p>澳美家海外</p>
				</li>
				<li>
					<img style="width:150px;height:150px;" src="/{{$data['company']['wechat2_img']}}" alt="">
					<p>财富管理</p>
				</li>
			</ul>
		</div>

	</div>
	<div class="footer-bottom">
		<div class="friend-links">
			<ul>
				<li class="firend-linkd-title">友情链接：</li>
				@if(isset($data['linkData'][4]))
					@foreach($data['linkData'][4] as $key=>$val)
						<li @if($key==0)class="firend-linkd-first"@endif><a target="_blank" href="{{$val['url']}}">{{$val['title']}}</a></li>
					@endforeach
				@endif

			</ul>
		</div>
		<div class="footer-copyright">
			<span>版权所有：{{$data['company']['copyright']}}</span>
		</div>
	</div>
</div>

<!--  回到顶部等几个按钮 -->
<div class="web_components_sidebar_info">
	<div class="sidebar_right-phone">{{$data['company']['custom_service_phone']}}</div>
	<div class="sidebar_right-wechat"><img src="/{{$data['company']['consult_wechat_qrcode']}}" ></div>
</div>
<div class="web_components_sidebar">
	{{--		全国热线--}}
	<a href="javascript:void(0);" class="web_components_sidebar-item">
		<img class="sidebar_right-phone_img" src="/front/images/sidebar1.jpeg" alt="">
	</a>

	{{--		在线客服--}}
	<a target="_blank" href=" http://p.qiao.baidu.com/cps/chat?siteId=6088728&userId=7240211&siteToken=41095c4a656b37c14a45dc99176af78f" class="web_components_sidebar-item">
		<img src="/front/images/sidebar2.png" alt="">
	</a>
	{{--		投资报告--}}
	<a href="" class="web_components_sidebar-item">
		<img src="/front/images/sidebar3.jpeg" alt="">
	</a>
	{{--		官网微信--}}
	<a href="javascript:void(0);" class="web_components_sidebar-item">
		<img class="sidebar_right-wechat_img" src="/front/images/sidebar4.jpeg" alt="">
	</a>

	{{--		返回顶部--}}
	<a href="" class="web_components_sidebar-item back-top">
		<img src="/front/images/sidebar5.jpeg" alt="">
	</a>
</div>

