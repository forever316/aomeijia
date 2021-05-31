<!DOCTYPE html>
<html lang="en">
<head>
    <link type="text/css" rel="styleSheet" href="/front/css/news/index.css" />
    @include('front.common.layout')
</head>

<body>
<main id="news-index-page" v-cloak>
    @include('front.common.header')
    <section class="container-wrapper">
        <div class="router-wrapper">
            <span>首页</span>
            <i>></i>
            <span>百科资讯</span>
        </div>

        <div class="detail-wrapper">
            <div class="detail-left-wrapper">
                <div class="search-wrapper">
                    <div class="search-box">
                        <input class="keywords" type="text" @if($data['searchInfo']['words'])value="{{$data['searchInfo']['words']}}" @endif placeholder="请输入关键字搜索">
                        <div class="btn search_words" @click="search" data-url="{{$data['url']}}">
                            <img src="/front/images/overseas-property/index/search.png" alt="">
                        </div>
                    </div>
                    <div class="hot-box">
                        <span>热门搜索：</span>
                        @foreach($data['search'] as $key=>$val)
                            <span class=""><a href="{{$data['url']}}&words={{$val}}">{!! $val !!}</a></span>
                        @endforeach
                    </div>
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

                <div class="swiper-container news-swiper">
                    <div class="swiper-wrapper">
                        @if($data['top_data'])
                            @foreach($data['top_data'] as $tdk=>$tdv)
                                <a target="_blank" class="swiper-slide" href="/information/detail?id={{$tdv['id']}}">
                                    <img src="/{!! $tdv['thumb'] !!}" alt="">
                                    <div class="title-box">
                                        <p class="title">
                                            {!! $tdv['title'] !!}
                                        </p>
                                        <p class="desc text-overflow-2">
                                            {!! $tdv['describe'] !!}
                                        </p>
                                    </div>
                                </a>
                            @endforeach
                        @endif
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

                <div class="news-list">
                    @if($data['list_data'])
                        @foreach($data['list_data'] as $ldk=>$ldv)
                            <a target="_blank" href="/information/detail?id={{$ldv['id']}}">
                                <img src="/{!! $ldv['thumb'] !!}" alt="">
                                <div class="right">
                                    <p class="title text-overflow-2">
                                        {!! $ldv['title'] !!}
                                    </p>
                                    <p class="text text-overflow-2">
                                        {!! $ldv['describe'] !!}
                                    </p>
                                    <div class="time">
                                        <span>{!! $ldv['publish_date'] !!}</span>
                                        <span>{!! $ldv['read'] !!}次阅读</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @endif
                </div>

                <div class="page-wrapper">
                    {{ $data['data']->links() }}
                </div>
            </div>
            @include('front.information.right_theme_faq_ad')
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

<script src="/front/js/news/index.js"></script>
</body>
</html>
<script>

    $(function(){
        $('.router-wrapper').click(function(){
            console.log(33);
        })
    });




    $('.search_words').click(function(){
        console.log(111);
        var words = $('.keywords').val();
        var url = $('.search_words').attr('data-url');
        url = url+'&words='+words;
        console.log(url);
        window.location.href = url;
        // window.open(url+'&words='+words);
    })
</script>