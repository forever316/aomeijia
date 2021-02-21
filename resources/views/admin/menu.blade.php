<?php
$user = session('user');
?>
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="nav-close"><i class="fa fa-times-circle"></i>
    </div>
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    {{--<span><img alt="image" class="img-circle" src="/assets/admin/img/logo_64.png"/></span>--}}
                    <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0);">
                                <span class="clear">
                               <span class="block m-t-xs"><strong class="font-bold">{{$user->name}}</strong></span>
                                {{--<span class="text-muted text-xs block">超级管理员<b class="caret"></b></span>--}}
                                </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="/userOut">安全退出</a>
                        </li>
                    </ul>
                </div>
                <div class="logo-element">AMJ
                </div>
            </li>
            @foreach($menu as $key=>$item)
                <li>
                    <a href="#"><i class="{{$item['ico']}}"></i><span class="nav-label">{{$item['title']}}</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        @foreach($item['menu'] as $k=>$val)
                            <li><a class="J_menuItem" href="{{$val['url']}}">{{$val['title']}}</a></li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
</nav>
