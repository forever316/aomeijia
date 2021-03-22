<!DOCTYPE html>
<html lang="en">
<style>
    .filter-wrapper > ul > li .val > span.on a {
        color: #fff !important;
    }
</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>全球移民</title>
{{--    <link type="text/css" rel="styleSheet" href="/front/css/common.css" />--}}
    <link type="text/css" rel="styleSheet" href="/front/css/immigrant/index.css" />
    @include('front.common.layout')
</head>

<body>
<main id="immigrant-page" v-cloak>
    @include('front.common.header')
    <section class="banner">
        <img src="/{!! $data['banner_img']['img_url'] !!}" alt="" style="height:420px;">
    </section>

    <section class="container-wrapper">
        <div class="router-wrapper">
            <span>首页</span>
            <i>></i>
            <span>全球移民</span>
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
                <li>
                    <span class="text">投资：</span>
                    <div class="val">
                        @foreach($data['type_invest'] as $key=>$val)
                            <span class="@if($data['searchInfo']['type_invest']==$key) on @endif"><a href="{{$data['url']}}&type_invest={{$key}}">{!! $val !!}</a></span>
                        @endforeach
                    </div>
                </li>
            </ul>
        </div>

        <div class="list-wrapper">
            <ul class="items">
{{--                <template v-for="(item, index) in 3" :key="index">--}}
                @foreach($data['data'] as $key=>$val)
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
                            <a href="/migrate/detail?id={{$val['id']}}" class="btn">
                                点击查看详情
                            </a>
                            <div class="btn appointment" @click="isAppointmentShow = true">
                                立即预约
                            </div>
                        </div>
                    </li>
                @endforeach

{{--                </template>--}}
            </ul>
        </div>

        <div class="test">
            @if($data['test_img'])<img style="height:150px;" onclick="javascript:location.href='/migrate/test'" src="/{{$data['test_img']['img_url']}}" alt="">@endif
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
{{--<script src="/front/utils/vue.js"></script>--}}
<script src="/front/js/immigrant/index.js"></script>
</body>
</html>