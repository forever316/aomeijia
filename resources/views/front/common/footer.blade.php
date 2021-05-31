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