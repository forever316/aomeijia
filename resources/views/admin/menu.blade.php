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
                <div class="logo-element">WL
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

            {{--<li>--}}
                {{--<a href="#"><i class="fa fa-picture-o"></i><span class="nav-label">Banner管理</span><span class="fa arrow"></span></a>--}}
                {{--<ul class="nav nav-second-level">--}}
                    {{--<li><a class="J_menuItem" href="/banner/bannerTypeList">Banner类型管理</a>--}}
                    {{--</li>--}}
                    {{--<li><a class="J_menuItem" href="/banner/bannerList">Banner管理</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="#"><i class="glyphicon glyphicon-book"></i><span class="nav-label">文章管理</span><span class="fa arrow"></span></a>--}}
                {{--<ul class="nav nav-second-level">--}}
                    {{--<li><a class="J_menuItem" href="/article/articleList/0">全部文章列表</a>--}}
                    {{--</li>--}}
                    {{--<li><a class="J_menuItem" href="/article/articleList/1">精彩回顾列表</a>--}}
                    {{--</li>--}}
                    {{--<li><a class="J_menuItem" href="/article/articleList/2">公司简介列表</a>--}}
                    {{--</li>--}}
                    {{--<li><a class="J_menuItem" href="/article/articleList/3">Banner文章列表</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="#"><i class="glyphicon glyphicon-fire"></i><span class="nav-label">微信公众号管理</span><span class="fa arrow"></span></a>--}}
                {{--<ul class="nav nav-second-level">--}}
                    {{--<li><a class="J_menuItem" href="/wechatConfig/wechatConfigList">配置管理</a>--}}
                    {{--</li>--}}
                    {{--<li><a class="J_menuItem" href="/wechatMember/wechatMemberList">用户管理</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="#"><i class="glyphicon glyphicon-user"></i><span class="nav-label">系统管理</span><span class="fa arrow"></span></a>--}}
                {{--<ul class="nav nav-second-level">--}}
                    {{--<li><a class="J_menuItem" href="/user/userList">管理员列表</a>--}}
                    {{--</li>--}}
                    {{--<li><a class="J_menuItem" href="/department/departmentList">部门列表</a>--}}
                    {{--</li>--}}
                    {{--<li><a class="J_menuItem" href="/role/roleList">角色列表</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}
        </ul>
    </div>
</nav>
