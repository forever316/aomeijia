<!DOCTYPE html>
<html lang="en">
<head>

{{--    <link type="text/css" rel="styleSheet" href="/front/css/header.css" />--}}
{{--    <link type="text/css" rel="styleSheet" href="/front/css/common.css" />--}}
    <link type="text/css" rel="styleSheet" href="/front/css/overseas-property/detail.css" />
{{--    <link type="text/css" rel="styleSheet" href="/front/utils/swiper/swiper-bundle.min.css" />--}}
    <link type="text/css" rel="styleSheet" href="/front/utils/sharejs/css/share.min.css" />
    @include('front.common.layout')
</head>

<body>
<main id="overseas-property-detail-page" v-cloak>
    @include('front.common.header')
    <section class="container-wrapper">
        <div class="router-wrapper">
            <span>首页</span>
            <i>></i>
            <span>海外房产</span>
            <i>></i>
            <span>{{$data['data']['country_name']}}房产</span>
            <i>></i>
            <span>{{$data['data']['city_name']}}房产</span>
        </div>

        <div class="basic-wrapper">
            <div class="title-box">
                <p class="title">
                    {{$data['data']['title']}}
                </p>
                <div class="share-btn" @click="isShareShow = !isShareShow">
                    <img src="/front/images/overseas-property/detail/share.png" alt="">
                    <span>分享</span>
                    <div v-show="isShareShow" class="share-wrapper" @click.stop="">
                        <div id="share"></div>
                    </div>
                </div>
            </div>
            <div class="sub-title-box">
                <p class="sub-title">
                    {{$data['data']['describe']}}
                </p>
                <div class="view-box">
                    <img src="/front/images/overseas-property/detail/pv.png" alt="">
                    <span>{{$data['data']['watch_number']}} 人在看</span>
                </div>
            </div>

            <div class="basic-content" id="basic-content" data-longitude="{{$data['data']['longitude']}}" data-latitude="{{$data['data']['latitude']}}">
                <div class="left-wrapper">
                    <div class="swiper-container gallery-top">
                        <div class="swiper-wrapper">
                            @foreach($data['data']['imgs'] as $key=>$val)
                                <div class="swiper-slide" style="background-image:url(/{!! $val !!})"></div>
                            @endforeach
                        </div>
                        <!-- <div class="gallery-button-next swiper-button-next swiper-button-white"></div>
                        <div class="gallery-button-prev swiper-button-prev swiper-button-white"></div> -->
                    </div>
                    <div class="swiper-container gallery-thumbs">
                        <div class="swiper-wrapper">
                            @foreach($data['data']['imgs'] as $key=>$val)
                            <div
                                    class="swiper-slide"
                                    style="background-image:url(/{!! $val !!})"
                                    @mouseenter="slideToggle"
                            ></div>
                            @endforeach
                        </div>
                        <div class="thumbs-button-next" @click="slideNext">
                            <img src="/front/images/overseas-property/detail/next.png" alt="">
                        </div>
                        <div class="thumbs-button-prev" @click="slidePrev">
                            <img src="/front/images/overseas-property/detail/next.png" alt="">
                        </div>
                    </div>
                </div>

                <div class="right-wrapper">
                    <div class="top-box">
                        <ul>
                            <li>
                                <p>￥<span>{{$data['data']['total_price']}}</span>万起</p>
                                <p>总价（起）</p>
                            </li>
                            <li>
                                <p><span>{{$data['data']['first_payment']}}</span>%</p>
                                <p>首付比例</p>
                            </li>
                            <li>
                                <p><span>{{$data['data']['year_return']}}</span>%</p>
                                <p>年回报率（约）</p>
                            </li>
                        </ul>

                        <div class="tag">
                            @foreach($data['data']['tag_name'] as $k=>$v)
                                <span>{!! $v !!}</span>
                            @endforeach
                        </div>
                    </div>

                    <div class="center-box">
                        <p>
                            <span>面积：{{$data['data']['area']}}</span>
                            <span>产权年限：{{$data['data']['property_year']}}</span>
                        </p>
                        <p>
                            <span>单价：￥{{$data['data']['unit_price']}}万起</span>
                            <span>交房标准：{{$data['data']['house_standard']}}</span>
                        </p>
                        <p>
                            <span>类型：{{$data['data']['type_name']}}</span>
                            <span>交房时间：{{$data['data']['complete_date']}}</span>
                        </p>
                        <p>
                            <span>户型：{{$data['data']['house_type']}}</span>
                            <span>项目地址：{{$data['data']['country_name']}} - {{$data['data']['city_name']}}</span>
                        </p>
                    </div>

                    <div class="bottom-box">
                        <div class="tel">
                            <img src="/front/images/overseas-property/detail/tel.png" alt="">
                            <span>{{$data['company']['custom_service_phone']}}</span>
                        </div>
                        <div class="btn" @click="isCodeShow = true">
                            <span>免费询盘</span>
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
                            <span>预约看房</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="step-wrapper">
                <img src="/{!! $data['data']['process_img'] !!}" alt="">
            </div>
        </div>
    </section>

    <section ref="detailWrapper" class="detail-wrapper">
        <div class="detail-box">
            <div class="inner-wrapper">
                <div ref="basic" id="basic" class="box">
                    <div class="header">
                        <span>基本信息</span>
                    </div>
                    <div class="cont">
                        {!! $data['data']['basic_info'] !!}
                    </div>
                </div>
                <div ref="type" id="type" class="box">
                    <div class="header">
                        <span>主力户型</span>
                    </div>
                    <div class="cont">
                        {!! $data['data']['main_door'] !!}
                    </div>
                </div>
                <div ref="location" id="location" class="box">
                    <div class="header">
                        <span>项目位置</span>
                    </div>
                    @if($data['data']['longitude'] && $data['data']['latitude'])
                    <div class="cont">
                        <div id="map"></div>
                    </div>
                    @endif
                </div>
                <?php header('Access-Control-Allow-Origin:*'); ?>
                <div ref="conf" id="conf" class="box">
                    <div class="header">
                        <span>周边配置</span>
                    </div>
                    <div class="cont">
                        {!! $data['data']['surround_facility'] !!}
                    </div>
                </div>
                <div ref="feature" id="feature" class="box">
                    <div class="header">
                        <span>项目特色</span>
                    </div>
                    <div class="cont">
                        {!! $data['data']['program_feature'] !!}
                    </div>
                </div>
                <div ref="pic" id="pic" class="box">
                    <div class="header">
                        <span>项目图集</span>
                    </div>
                    <div class="cont">
                        {!! $data['data']['project_atlas'] !!}
                    </div>
                </div>
                <div ref="analyse" id="analyse" class="box">
                    <div class="header">
                        <span>投资分析</span>
                    </div>
                    <div class="cont">
                        {!! $data['data']['invest_analysis'] !!}
                    </div>
                </div>
                @if($data['dynamic'])
                    <div ref="news" id="news" class="box">
                        <div class="header">
                            <span>项目动态</span>
                        </div>
                        <div class="cont">
                            <div class="project-news">
                                @foreach($data['dynamic'] as $key=>$val)
                                    <a target="_blank" href="/article?id={{$val['id']}}">
                                        <img src="/{{$val['thumb_180_120']}}" alt="">
                                        <div class="right">
                                            <p class="title text-overflow-2">
                                                {{$val['title']}}
                                            </p>
                                            <p class="text text-overflow-2">
                                                {{$val['describe']}}
                                            </p>
                                            <p class="text">
                                                {{$val['publish_date']}}
                                            </p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <div class="contact-box">
                    <div class="contact-header">
                        <p class="title">
                            预约看房：
                        </p>
                        <p class="tip">
                            所有信息均已进行加密处理，请放心填写！
                        </p>
                    </div>
                    <form id="form_consult_1">
                    <div class="input-box">
                        <div class="input-left">
                            <input type="hidden" name="type" value="">
                            <input type="text" name="name" placeholder="请输入您的姓名">
                            <input type="text" name="phone" placeholder="请输入您的电话">
                            <input type="text" name="email" placeholder="请输入您的邮箱">
                        </div>
                        <div class="input-right">
                            <textarea name="content" placeholder="请输入您想了解的更多信息"></textarea>
                            <div class="btn-wrapper">
                                <div class="btn" onclick="consult_1(5)">
                                    提交
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

            <div ref="catalogueWrapper" :class="['catalogue-wrapper', catalogueStyle]">
                <div class="catalogue">
                    <ul>
                        <li :class="{ on: catalogueSelected == 'basic' }">
                            <a href="#basic">基本信息</a>
                        </li>
                        <li :class="{ on: catalogueSelected == 'type' }">
                            <a href="#type">主力户型</a>
                        </li>
                        <li :class="{ on: catalogueSelected == 'location' }">
                            <a href="#location">项目位置</a>
                        </li>
                        <li :class="{ on: catalogueSelected == 'conf' }">
                            <a href="#conf">周边配置</a>
                        </li>
                        <li :class="{ on: catalogueSelected == 'feature' }">
                            <a href="#feature">项目特色</a>
                        </li>
                        <li :class="{ on: catalogueSelected == 'pic' }">
                            <a href="#pic">项目图集</a>
                        </li>
                        <li :class="{ on: catalogueSelected == 'analyse' }">
                            <a href="#analyse">投资分析</a>
                        </li>
                        <li :class="{ on: catalogueSelected == 'news' }">
                            <a href="#news">项目动态</a>
                        </li>
                    </ul>
                </div>
                @include('front.common.right_five_info')
            </div>
        </div>
    </section>

    <section class="page-footer">
        <div class="page-footer-wrapper">
            @include('front.common.four_house')

            @include('front.common.six_case')
        </div>
    </section>

    @include('front.common.consult')
    @include('front.common.footer')
</main>
<script src="https://webapi.amap.com/maps?v=1.4.15&key=be5a980395b91bc587856e35f55e4766"></script>
{{--    <script src="/front/utils/amap.js"></script>--}}
<script src="/front/utils/sharejs/js/qrcode.js"></script>
<script src="/front/utils/sharejs/js/social-share.js"></script>

<!-- <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script> -->
{{--<script src="/front/utils/swiper/swiper-bundle.min.js"></script>--}}
{{--<script src="/front/utils/vue.js"></script>--}}
<script src="/front/js/overseas-property/detail.js"></script>
<script>
    function consult($type=1){
        $('#form_consult').find("input[name='type']").val($type);
        submitConsultData();
    }
    function consult_1($type=1){
        $('#form_consult_1').find("input[name='type']").val($type);
        submitConsultData_1();
    }
    // window.onload = function () {
        // 初始化地图

    // }



</script>
</body>
</html>