<section class="header-wrapper">
			<div class="header-inner-wrapper">
				<div class="nav-wrapper">
					<div class="header-logo">
						<a target="_blank" href="#">
							<img src="/{{$data['company']['header_logo']}}">
						</a>
					</div>
					<ul class="header-nav">
						<li class="nav-list"><a target="_blank" class="@if($data['menu']=='index') on @endif" href="/">首页</a></li>
						<li class="nav-list">|</li>
						<li class="nav-list"><a target="_blank" href="/house" class="@if($data['menu']=='house') on @endif">全球房产</a></li>
						<li class="nav-list">|</li>
						<li class="nav-list"><a target="_blank" href="/migrate" class="@if($data['menu']=='migrate') on @endif">全球移民</a></li>
						<li class="nav-list">|</li>
						<li class="nav-list">
							<a target="_blank" href="/invest/country" class="@if($data['menu']=='invest') on @endif">投资攻略</a>
							<div class="sub-nav">
								<div class="arrow"><i></i></div>
								<div class="sub">
									<a target="_blank" href="/invest/country" class="@if($data['menu_son']=='country') on @endif">国家攻略</a>
									<a target="_blank" href="/invest/theme" class="@if($data['menu_son']=='theme') on @endif">投资主题</a>
									<a target="_blank" href="/invest/faqs" class="@if($data['menu_son']=='faqs') on @endif">投资问答</a>
									<a target="_blank" href="/invest/case" class="@if($data['menu_son']=='case') on @endif">成功案例</a>
								</div>
							</div>
						</li>
						<li class="nav-list">|</li>
						<li class="nav-list">
							<a target="_blank" href="/information" class="@if($data['menu']=='information') on @endif">百科资讯</a>
						</li>
						<li class="nav-list">|</li>
						<li class="nav-list"><a target="_blank" href="/corp/corpBrief" class="@if($data['menu']=='corp') on @endif">集团简介</a></li>
					</ul>
				</div>
				<div class="header-phone">
					<span>{{$data['company']['custom_service_phone']}}</span>
				</div>
			</div>
    </section>