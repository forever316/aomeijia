<!DOCTYPE html>
<html lang="en">
<head>
{{--    <link type="text/css" rel="styleSheet" href="/front/css/header.css" />--}}
{{--    <link type="text/css" rel="styleSheet" href="/front/css/common.css" />--}}
    <link type="text/css" rel="styleSheet" href="/front/css/immigrant/detail.css" />
{{--    <link type="text/css" rel="styleSheet" href="/front/utils/swiper/swiper-bundle.min.css" />--}}
    <link type="text/css" rel="styleSheet" href="/front/utils/sharejs/css/share.min.css" />
    @include('front.common.layout')
</head>

<body>
<main id="immigrant-detail-page" v-cloak>
    @include('front.common.header')

    <section ref="banner" class="banner">
        <img src="/{!! $data['banner_img']['img_url'] !!}" alt="" style="height:420px;">
    </section>

    <section ref="basic" class="container-wrapper">
        <div class="router-wrapper">
            <span>首页</span>
            <i>></i>
            <span>全球移民</span>
            <i>></i>
            <span>{!! $data['data']['title'] !!}</span>
        </div>

        <div class="basic-content">
            <img src="/{!! $data['data']['img'] !!}" alt="">
            <div class="right-wrapper">
                <div class="top-box">
                    <div class="share-box">
                        <div class="share-btn" @click="isShareShow = !isShareShow">
                            <img src="/front/images/overseas-property/detail/share.png" alt="">
                            <span>分享</span>
                            <div v-show="isShareShow" class="share-wrapper" @click.stop="">
                                <div id="share"></div>
                            </div>
                        </div>
                    </div>
                    <p class="name">
                        {!! $data['data']['title'] !!}
                    </p>
                    <p class="desc" style="height:16px;">
                        @if($data['data']['face'])面向人群：{{$data['data']['face']}}@endif
                    </p>
                </div>

                <div class="center-box">
                    <div class="content-inner">
                        <div>
                            <p class="text">
                                项目特点
                            </p>
                            <p class="val">
                                {!! $data['data']['project_charac'] !!}
                            </p>
                        </div>
                        <div>
                            <p class="text">
                                居住要求
                            </p>
                            <p class="val">
                                {!! $data['data']['live_require'] !!}
                            </p>
                        </div>
                    </div>
                    <div class="content-inner">
                        <div>
                            <p class="text">
                                身份类型
                            </p>
                            <p class="val">
                                {!! $data['data']['identity'] !!}
                            </p>
                        </div>
                        <div>
                            <p class="text">
                                办理周期
                            </p>
                            <p class="val">
                                {!! $data['data']['transact_period'] !!}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bottom-box">
                    <div class="tel">
                        <img src="/front/images/overseas-property/detail/tel.png" alt="">
                        <span>{{$data['company']['custom_service_phone']}}</span>
                    </div>
                    <div class="btn" @click="isCodeShow = true">
                        <span>免费咨询</span>
                        <div v-if="isCodeShow" class="code-wrapper">
                            <div class="head">
                                <span>微信扫一扫，加好友</span>
                                <i @click.stop="isCodeShow = false">×</i>
                            </div>
                            <div class="inner">
                                <img src="/{{$data['company']['consult_wechat_qrcode']}}" alt="">
                                <div class="text">
                                    <i></i>
                                    <span>微信号</span>
                                    <i></i>
                                </div>
                                <p class="val">
                                    {{$data['company']['consult_wechat_number']}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="btn appointment" @click="isAppointmentShow = true">
                        <span>预约项目</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section :class="['page-nav-wrapper', { fixed: isNavFixed }]">
        <div class="nav-box">
            <div :class="{ on: navSelected == 'introduce' }" @click="toNav('#introduce')">项目简介</div>
            <div :class="{ on: navSelected == 'advantage' }" @click="toNav('#advantage')">项目优势</div>
            <div :class="{ on: navSelected == 'conditions' }" @click="toNav('#conditions')">申请条件</div>
            <div :class="{ on: navSelected == 'steps' }" @click="toNav('#steps')">申请流程</div>
        </div>
    </section>

    <section ref="content" class="container-wrapper">
        <div class="inner-wrapper">
            <div ref="introduce" id="introduce" class="box">
                <div class="header">
                    <span>项目简介</span>
                </div>
                <div class="cont">
                    {!! $data['data']['project_brief'] !!}
                </div>
            </div>
            <div ref="advantage" id="advantage" class="box">
                <div class="header">
                    <span>项目优势</span>
                </div>
                <div class="cont">
                    {!! $data['data']['project_advantage'] !!}
                </div>
            </div>
            <div ref="conditions" id="conditions" class="box">
                <div class="header">
                    <span>申请条件</span>
                </div>
                <div class="cont">
                    {!! $data['data']['apply_condition'] !!}
                </div>
            </div>
            <div ref="steps" id="steps" class="box">
                <div class="header">
                    <span>申请流程</span>
                </div>
                <div class="cont">
                    {!! $data['data']['apply_process'] !!}
                </div>
            </div>
            <div ref="house" id="house" class="box">
                <div class="header">
                    <span>精品房源鉴赏</span>
                </div>
                <div class="project-recommend-inner">
                    <dl>
                        @foreach($data['house'] as $key=>$val)
                            <dt>
                                <div class="recommend-img-wrapper">
                                    <a target="_blank" href="/house/detail?id={{$val['id']}}">
                                        <img src="/{{$val['img_292_254']}}" alt="">
                                    </a>
{{--                                    <span class="hot-logo">--}}
                    热门
                  </span>
                                    <p>价格：￥{{$val['total_price']}}万起</p>
                                </div>
                                <div class="recommend-desc-wrapper none-pointer">
                                    <p class="recommend-desc-title">
                                        {{$val['title']}}
                                    </p>
                                    <div class="recommend-desc-info">
                    <span>
                      <p>{{$val['city_name']}}</p>
                      <p>城市</p>
                    </span>
                                        <span>
                      <p>{{$val['type_name']}}</p>
                      <p>类型</p>
                    </span>
                                        <span>
                      <p>￥{{$val['unit_price']}}万起</p>
                      <p>单价</p>
                    </span>
                                        <span>
                      <p>{{$val['first_payment']}}</p>
                      <p>首付</p>
                    </span>
                                    </div>
                                </div>
                            </dt>
                        @endforeach
                    </dl>
                    <div class="more-btn">
                        <a target="_blank" href="/house">查看更多</a>
                    </div>
                </div>
            </div>
        </div>
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

<script src="/front/utils/sharejs/js/qrcode.js"></script>
<script src="/front/utils/sharejs/js/social-share.js"></script>
<!-- <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script> -->
<script src="/front/utils/swiper/swiper-bundle.min.js"></script>
{{--<script src="/front/utils/vue.js"></script>--}}
<script src="/front/js/immigrant/detail.js"></script>

<script>
    function consult(){
        $('#form_consult').find("input[name='type']").val(2);
        submitConsultData();
    }

</script>

</body>
</html>