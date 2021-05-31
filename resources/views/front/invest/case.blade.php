<!DOCTYPE html>
<html lang="en">
<head>
    @include('front.common.layout')
{{--    <link type="text/css" rel="styleSheet" href="/front/css/common.css" />--}}
    <link type="text/css" rel="styleSheet" href="/front/css/investment-strategy/case.css" />

</head>

<body>
<main id="investment-strategy-case-page" v-cloak>
    @include('front.common.header')
    <section class="container-wrapper">
        <div class="router-wrapper">
            <span>首页</span>
            <i>></i>
            <span>投资攻略</span>
            <i>></i>
            <span>成功案例</span>
        </div>

        <div class="filter-wrapper">
            <ul>
                <li>
                    <span class="text">地区：</span>
                    <div class="val">
                        @foreach($data['region'] as $key=>$val)
                            <span class="@if($data['searchInfo']['region']==$key) on @endif"><a href="{{$data['url']}}&region={{$key}}">{!! $val !!}</a></span>
                        @endforeach
                    </div>
                </li>
                <li>
                    <span class="text">国家：</span>
                    <div class="val">
                        @foreach($data['country'] as $key=>$val)
                            <span class="@if($data['searchInfo']['country']==$key) on @endif"><a href="{{$data['url']}}&country={{$key}}">{!! $val !!}</a></span>
                        @endforeach
                    </div>
                </li>
                <li>
                    <span class="text">类型：</span>
                    <div class="val">
                        @foreach($data['type'] as $key=>$val)
                            <span class="@if($data['searchInfo']['type']==$key) on @endif"><a href="{{$data['url']}}&type={{$key}}">{!! $val !!}</a></span>
                        @endforeach
                    </div>
                </li>
            </ul>
        </div>

        <div class="list-wrapper">
            <div class="case-box">
                @foreach($data['data'] as $k=>$v)
                <a target="_blank" href="/invest/case/detail?id={{$v['id']}}">
                    <div class="img-wrapper">
                        <img src="/{!! $v['thumb'] !!}" alt="">
                    </div>
                    <p class="name text-overflow-2">
                        {!! $v['title'] !!}
                    </p>
                    <p class="desc text-overflow-2">
                        {!! $v['describe'] !!}
                    </p>
                </a>
                @endforeach
            </div>
            <div class="page-wrapper">
                {!! $data['data']->links() !!}
            </div>
        </div>
    </section>

    <section class="page-footer">
        <div class="page-footer-wrapper">
            @include('front.common.four_house')
            @include('front.common.four_migrate')
        </div>
    </section>
    @include('front.common.footer')
</main>

<!-- <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script> -->
{{--<script src="/front/utils/vue.js"></script>--}}
<script src="/front/js/investment-strategy/case.js"></script>
</body>
</html>