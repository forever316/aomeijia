<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投资攻略</title>
    <link type="text/css" rel="styleSheet" href="/front/css/common.css" />
    <link type="text/css" rel="styleSheet" href="/front/css/investment-strategy/index.css" />
{{--    <link type="text/css" rel="styleSheet" href="/front/utils/swiper/swiper-bundle.min.css" />--}}
    @include('front.common.layout')
</head>
<style>
    .area-wrapper .items a:hover{
        color: #000000;
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
                        <a href="/invest/country/detail?id={{$val['id']}}"></a>
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
                        <img style="height: 226.66px;" src="/{!! $val['thumb'] !!}" class="img">
                        <p class="desc">
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

        <div class="house-wrapper">
            <div class="common-box-header">
                <p>{!! $data['searchInfo']['areaName'] !!}热门房产项目</p>
                <p><a href="#">查看更多 > > ></a></p>
            </div>
            <ul class="items">
                @foreach($data['house'] as $key=>$val)
                <li  class="item">
                    <a href="./detail.html">
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
                查看更多
            </div>
        </div>

        <div class="immigrant-wrapper">
            <div class="common-box-header">
                <p>{!! $data['searchInfo']['areaName'] !!}热门移民项目</p>
                <p><a href="#">查看更多 > > ></a></p>
            </div>
            <ul class="items">
                @foreach($data['migrate'] as $key=>$val)
                <li class="item">
                    <div class="img-box">
                        <img src="/{!! $val['img'] !!}" alt="">
                        <p>{!! $val['title'] !!}</p>
                    </div>
                    <div class="detail-box">
                        <p class="desc">
                            面向人群：有移民加拿大的高净值客户
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
                        <a href="../Immigrant/detail.html" class="btn">
                            点击查看详情
                        </a>
                        <div class="btn appointment" @click="isAppointmentShow = true">
                            立即预约
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </section>

    <section class="page-footer">
        <div class="page-footer-wrapper">
            @include('front.common.seven_info')
            @include('front.common.six_case')
        </div>
    </section>

    <transition name="fade">
        <section v-if="isAppointmentShow" class="appointment-wrapper" @click.self="isAppointmentShow = false">
            <div class="appointment-cont">
                <div class="head">
                    <img src="/front/images/overseas-property/detail/appointment-head.png" alt="">
                    <i @click="isAppointmentShow = false">×</i>
                </div>
                <div class="text">
                    <i></i>
                    <span>立即预约</span>
                    <i></i>
                </div>
                <div class="cont">
                    <form>
                        <input type="text" placeholder="请输入您的姓名">
                        <input type="text" placeholder="请输入您的手机号">
                        <input type="text" placeholder="请输入您的微信">
                        <textarea placeholder="请输入您想了解的更多信息"></textarea>
                        <p class="notice">
                            * 所有信息均已进行加密处理，请放心填写！
                        </p>
                        <button type="submit" @click="isAppointmentShow = false">
                            立即提交
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </transition>
    @include('front.common.footer')
</main>

<!-- <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script> -->
{{--<script src="/front/utils/swiper/swiper-bundle.min.js"></script>--}}
{{--<script src="/front/utils/vue.js"></script>--}}
<script src="/front/js/investment-strategy/index.js"></script>
</body>
</html>