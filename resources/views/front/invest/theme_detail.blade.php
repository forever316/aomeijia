<!DOCTYPE html>
<html lang="en">
<head>
{{--    <link type="text/css" rel="styleSheet" href="/front/css/common.css" />--}}
    <link type="text/css" rel="styleSheet" href="/front/css/investment-strategy/theme-detail.css" />
    <link type="text/css" rel="styleSheet" href="/front/utils/sharejs/css/share.min.css" />
    @include('front.common.layout')
</head>

<body>
<main id="investment-strategy-theme-detail-page" v-cloak>
    @include('front.common.header')
    <section class="container-wrapper">
        <div class="router-wrapper">
            <span>首页</span>
            <i>></i>
            <span>投资攻略</span>
            <i>></i>
            <span>投资主题</span>
            <i>></i>
            <span>{!! $data['data']['title'] !!}</span>
        </div>

        <div class="detail-wrapper">
            <div class="detail-left-wrapper">
                <div class="news-wrapper">
                    <div class="info-box">
                        <img src="/{!! $data['data']['thumb'] !!}" alt="">
                        <div class="info-right">
                            <p class="title">
                                {!! $data['data']['title'] !!}
                            </p>
                            <p class="desc">
                                {!! $data['data']['describe'] !!}
                            </p>
                        </div>
                    </div>
                    <div class="share-box">
                        <div class="share-btn" @click="isShareShow = !isShareShow">
                            <img src="/front/images/overseas-property/detail/share.png" alt="">
                            <span>分享</span>
                            <div v-show="isShareShow" class="share-wrapper" @click.stop="">
                                <div id="share"></div>
                            </div>
                        </div>
                    </div>
                    <div class="detail">
                        {!! $data['data']['content'] !!}
                    </div>
{{--                    <div class="more-case">--}}
{{--                        更多热门成功案例：<span>柬埔寨</span><span>迪拜</span><span>希腊</span>--}}
{{--                    </div>--}}
                </div>
            </div>

            <div class="detail-right-wrapper">
                @include('front.common.right_five_info')
                @include('front.common.right_four_faqs')
            </div>
        </div>

        <div class="contact-wrapper">
            <div class="contact-box">
                <div class="left-box">
                    <p class="title">
                        免费咨询
                    </p>
                    <form id="form_consult">
                        <div class="input-box">
                            <div class="input-left">
                                <input type="hidden" name="type" value="">
                                <input type="text" name="name" placeholder="请输入您的姓名">
                                <input type="text" name="phone" placeholder="请输入您的电话">
                                <input type="text" name="email" placeholder="请输入您的邮箱">
                            </div>
                            <div class="input-right">
                                <textarea name="content" placeholder="请输入您想了解的更多信息"></textarea>
                            </div>
                        </div>
                    </form>
                    <p class="tip">
                        * 所有信息均已进行加密处理，请放心填写！
                    </p>
                    <div class="btn-wrapper">
                        <div class="btn" onclick="consult(7)">
                            立即提交
                        </div>
                    </div>
                </div>
                <div class="right-box">
                    <div class="tel">
                        <img src="/front/images/common/tel.png" alt="">
                        <span>24小时咨询热线</span>
                    </div>
                    <p class="number">
                        {{$data['company']['custom_service_phone']}}
                    </p>
                    <div class="time">
                        <img src="/front/images/common/chat.png" alt="">
                        <span>在线咨询，周一至周五，9:00 - 18:00</span>
                    </div>
                    <div class="btn">
                    <a class="no-color" target="_blank" href=" http://p.qiao.baidu.com/cps/chat?siteId=6088728&userId=7240211&siteToken=41095c4a656b37c14a45dc99176af78f" class="web_components_sidebar-item">
                        在线咨询
                    </a>
                    </div>
                </div>
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

<script src="/front/utils/sharejs/js/qrcode.js"></script>
<script src="/front/utils/sharejs/js/social-share.js"></script>
<!-- <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script> -->
{{--<script src="/front/utils/vue.js"></script>--}}
<script src="/front/js/investment-strategy/theme-detail.js"></script>
</body>
</html>
<script>
    function consult($type){
        $('#form_consult').find("input[name='type']").val($type);
        submitConsultData();
    }
</script>