<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>海外房地产</title>
{{--    <link type="text/css" rel="styleSheet" href="/front/css/common.css" />--}}
    <link type="text/css" rel="styleSheet" href="/front/css/overseas-property/index.css" />
{{--    <link type="text/css" rel="styleSheet" href="/front/utils/swiper/swiper-bundle.min.css" />--}}
    @include('front.common.layout')
</head>

<body>
<main id="overseas-property-page" v-cloak>
    @include('front.common.header')
    <section class="banner">
        <img src="/{!! $data['banner_img']['img_url'] !!}" alt="" style="height:405px;">
    </section>

    <section class="container-wrapper">
        <div class="router-wrapper">
            <span>首页</span>
            <i>></i>
            <span>海外房产</span>
        </div>

        <div class="search-wrapper">
            <div class="search-left-wrapper">
                <div class="search-box">
                    <input class="search_words keywords" @if($data['searchInfo']['words'])value="{{$data['searchInfo']['words']}}" @endif data-url="{!! $data['url'] !!}" type="text" placeholder="项目关键字">
                    <div class="btn" @click="search">
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
            <div class="search-right-wrapper">
                共找到{!!$data['data']->total()!!}个项目
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
                    <span class="text">城市：</span>
                    <div class="val">
                        @foreach($data['city'] as $key=>$val)
                            <span class="@if($data['searchInfo']['city']==$key) on @endif"><a href="{{$data['url']}}&city={{$key}}">{!! $val !!}</a></span>
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
                <li>
                    <span class="text">价格：</span>
                    <div class="val">
                        @foreach($data['price'] as $key=>$val)
                            <span class="@if($data['searchInfo']['price']==$key) on @endif"><a href="{{$data['url']}}&price={{$key}}">{!! $val !!}</a></span>
                        @endforeach
                    </div>
                </li>
                <li>
                    <span class="text">特色：</span>
                    <div class="val">
                        @foreach($data['feature'] as $key=>$val)
                            <span class="@if($data['searchInfo']['feature']==$key) on @endif"><a href="{{$data['url']}}&feature={{$key}}">{!! $val !!}</a></span>
                        @endforeach
                    </div>
                </li>
            </ul>
        </div>

        <div class="list-wrapper">
            <ul class="items">
                @foreach($data['data'] as $key=>$val)
                    <li  class="item">
                        <a href="/house/detail?id={{$val['id']}}">
                            <div class="img">
                                <img src="/{!! $val['img'] !!}" alt="">
                            </div>
                            <div class="detail">
                                <p class="name">
                                    {!! $val['title'] !!}
                                </p>
                                <p class="sub-name">
                                    {!! $val['describe'] !!}
                                </p>
                                <div class="desc">
                                    <img src="/front/images/overseas-property/index/house.png" alt="">
                                    <span>{!! $val['type_name'] !!}</span>
                                    <span>{!! $val['property_year'] !!}</span>
                                    <span>{!! $val['complete_date'] !!}</span>
                                    <span>{!! $val['area'] !!}</span>
                                    <span>{!! $val['house_type'] !!}</span>
                                </div>
                                <div class="location">
                                    <img src="/front/images/overseas-property/index/location.png" alt="">
                                    <span>{!! $val['country_name'] !!}-{!! $val['city_name'] !!}</span>
                                </div>
                                <div class="tag">
                                    @foreach($val['tag_name'] as $k=>$v)
                                        <span>{!! $v !!}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="price-wrapper">
                                <div class="price-box">
                                    <p class="price">
                                        ￥<span>{!! $val['total_price'] !!}</span>万起
                                    </p>
                                    <p class="unit-price">
                                        单价约￥{!! $val['unit_price'] !!}万起
                                    </p>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="page-wrapper">
                {{ $data['data']->links() }}
            </div>
        </div>
    </section>

    <section class="page-footer">
        <div class="page-footer-wrapper">
            @include('front.common.seven_info')
            @include('front.common.six_case')
        </div>
    </section>
    @include('front.common.footer')
</main>

<!-- <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script> -->
{{--<script src="/front/utils/swiper/swiper-bundle.min.js"></script>--}}
{{--<script src="/front/utils/vue.js"></script>--}}
<script src="/front/js/overseas-property/index.js"></script>
</body>
</html>