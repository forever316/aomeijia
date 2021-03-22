<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投资主题</title>
{{--    <link type="text/css" rel="styleSheet" href="/front/css/common.css" />--}}
    <link type="text/css" rel="styleSheet" href="/front/css/investment-strategy/theme.css" />
{{--    <link type="text/css" rel="styleSheet" href="/front/utils/swiper/swiper-bundle.min.css" />--}}
    @include('front.common.layout')
</head>

<body>
<main id="investment-strategy-theme-page" v-cloak>
    @include('front.common.header')
    <section class="container-wrapper">
        <div class="router-wrapper">
            <span>首页</span>
            <i>></i>
            <span>投资攻略</span>
            <i>></i>
            <span>投资主题</span>
        </div>

        <div class="search-wrapper">
            <div class="search-left-wrapper">
                <div class="search-box">
                    <input class="keywords" type="text" @if($data['searchInfo']['words'])value="{{$data['searchInfo']['words']}}" @endif placeholder="请输入关键字搜索">
                    <div class="btn" @click="search">
                        <img src="/front/images/overseas-property/index/search.png" alt="">
                    </div>
                </div>
                <div class="hot-box">
                    <span>热门搜索：</span>
                    @foreach($data['search'] as $key=>$val)
                        <span class=""><a href="/invest/theme?words={{$val}}">{!! $val !!}</a></span>
                    @endforeach
                </div>
            </div>
            <div class="search-right-wrapper">
                共找到{!!$data['theme']->total()!!}个项目
            </div>
        </div>

        <div class="list-wrapper">
            <ul class="items">
                @foreach($data['theme'] as $key=>$val)
                <li  class="item">
                    <a href="/invest/theme/detail?id={!! $val['id'] !!}">
                        <img src="/{!! $val['thumb'] !!}" class="img">
                        <p class="name text-overflow-1">
                            {!! $val['title'] !!}
                        </p>
                        <p class="desc text-overflow-2">
                            {!! $val['describe'] !!}
                        </p>
                    </a>
                </li>
                @endforeach
            </ul>
            <div class="page-wrapper">
                {{ $data['theme']->links() }}
            </div>
        </div>
    </section>
    @include('front.common.footer')
</main>

<!-- <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script> -->
{{--<script src="/front/utils/swiper/swiper-bundle.min.js"></script>--}}
{{--<script src="/front/utils/vue.js"></script>--}}
<script src="/front/js/investment-strategy/theme.js"></script>
</body>
</html>