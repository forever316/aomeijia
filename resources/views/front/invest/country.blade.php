<!DOCTYPE html>
<html lang="en">
<head>
    <link type="text/css" rel="styleSheet" href="/front/css/common.css" />
    <link type="text/css" rel="styleSheet" href="/front/css/investment-strategy/index.css" />
{{--    <link type="text/css" rel="styleSheet" href="/front/utils/swiper/swiper-bundle.min.css" />--}}
    @include('front.common.layout')
</head>
<style>
    .area-wrapper .items a:hover{
        color: #000000;
    }
    .immigrant-wrapper ul:after{
        content: '';
        width: 380px;
    }
</style>

<body>
<main id="investment-strategy-page" v-cloak>
    @include('front.common.header')
    <section class="banner">
        <img src="/{!! $data['banner_img']['img_url'] !!}" alt="" style="height:420px;">
    </section>

    <section class="container-wrapper">
        <div class="router-wrapper">
            <span>首页</span>
            <i>></i>
            <span>投资攻略</span>
            <i>></i>
            <span>国家攻略</span>
        </div>

        <div class="area-wrapper">
            <ul class="items">
                @foreach($data['region'] as $key=>$val)
                    <li class="item @if($data['searchInfo']['region']==$key) on  @endif"><a href="/invest/country?region={{$key}}">{!! $val !!}</a></li>
                @endforeach
            </ul>
        </div>

        <div class="strategy-wrapper">
            <ul class="items">
                @foreach($data['data'] as $key=>$val)
                    <li class="item">
                        <a target="_blank" href="/invest/country/detail?id={{$val['id']}}"></a>
                        <p class="name">
                            {!! $val['city_name'] !!}
                        </p>
                        <div class="hot-wrapper">
                            <div class="hot-box">
                                <span>投资热度</span>
                                <div class="star">
                                    <img v-for="(item, index) in {!! $val['hot'] !!}" :key="index" src="/front/images/investment-strategy/index/star.png" alt="">
                                </div>
                            </div>
                        </div>
                        <img style="height: 226.66px;" src="/{!! $val['thumb_340_227'] !!}" class="img">
                        <p class="desc text-overflow-2" style="height:38px;">
                            {!! $val['title'] !!}
                        </p>
                        <div class="tag">
                            @foreach($val['tag_name'] as $k=>$v)
                                <span>{!! $v !!}</span>
                            @endforeach
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        @if($data['house'])
        <div class="house-wrapper">
            <div class="common-box-header">
                <p>{!! $data['searchInfo']['areaName'] !!}热门房产项目</p>
                <p><a target="_blank" href="/house">查看更多 > > ></a></p>
            </div>
            <ul class="items">
                @foreach($data['house'] as $key=>$val)
                <li  class="item">
                    <a target="_blank" href="/house/detail?id={{$val['id']}}">
                        <div class="img">
                            <img src="/{!! $val['img_430_247'] !!}" alt="">
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
                                <span>{!! $data['searchInfo']['areaName'] !!}-{!! $val['city_name'] !!}</span>
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
            <div class="more-btn">
                <a target="_blank" href="/house">查看更多</a>
            </div>
        </div>
        @endif

        @if($data['migrate'])
        <div class="immigrant-wrapper">
            <div class="common-box-header">
                <p>{!! $data['searchInfo']['areaName'] !!}热门移民项目</p>
                <p><a target="_blank" href="/migrate">查看更多 > > ></a></p>
            </div>
            <ul class="items">
                @foreach($data['migrate'] as $key=>$val)
                <li class="item">
                    <div class="img-box">
                        <img src="/{!! $val['img_380_280'] !!}" alt="">
                        <p>{!! $val['title'] !!}</p>
                    </div>
                    <div class="detail-box">
                        <p class="desc">
                            @if($val['face'])面向人群：{{$val['face']}}@endif
                        </p>
                        <div class="box">
                            <span class="tag">项目特点</span>
                            <span class="val">{!! $val['project_charac'] !!}</span>
                        </div>
                        <div class="box">
                            <span class="tag">办理周期</span>
                            <span class="val">{!! $val['transact_period'] !!}</span>
                            <div class="price">
                                ￥<span>{!! $val['total_price'] !!}万</span>
                            </div>
                        </div>
                    </div>
                    <div class="btn-wrapper">
                        <a target="_blank" href="/migrate/detail?id={{$val['id']}}" class="btn">
                            点击查看详情
                        </a>
                        <div class="btn appointment" @click="isAppointmentShow = true">
                            立即预约
                        </div>
                    </div>
                </li>
                @endforeach
{{--                @if($data['migrate_less']==2)--}}
{{--                    <li class="item"></li>--}}
{{--                    <li class="item"></li>--}}
{{--                @endif--}}
{{--                @if($data['migrate_less']==1)--}}
{{--                    <li class="item"></li>--}}
{{--                @endif--}}

            </ul>
        </div>
        @endif
    </section>

    <section class="page-footer">
        <div class="page-footer-wrapper">
            @include('front.common.seven_info')
            @include('front.common.six_case')
        </div>
    </section>

    @include('front.common.consult')
    @include('front.common.footer')
</main>

<!-- <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script> -->
{{--<script src="/front/utils/swiper/swiper-bundle.min.js"></script>--}}
{{--<script src="/front/utils/vue.js"></script>--}}
<script src="/front/js/investment-strategy/index.js"></script>

<script>
    function consult(){
        $('#form_consult').find("input[name='type']").val(2);
        submitConsultData();
    }

</script>

</body>
</html>