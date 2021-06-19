<!DOCTYPE html>
<html lang="en">
<head>

    {{--    <link type="text/css" rel="styleSheet" href="/front/css/header.css" />--}}
        <link type="text/css" rel="styleSheet" href="/front/css/common_part.css" />
    <link type="text/css" rel="styleSheet" href="/front/css/active/index.css" />
    {{--    <link type="text/css" rel="styleSheet" href="/front/utils/swiper/swiper-bundle.min.css" />--}}
    <link type="text/css" rel="styleSheet" href="/front/utils/sharejs/css/share.min.css" />
    @include('front.common.layout')
</head>

<body>
<main id="inspect-page" v-cloak>
    @include('front.common.header')
    @include('front.common.banner')
    <section class="container-wrapper">
        <div class="router-wrapper">
            <span>首页</span>
            <i>></i>
            <span>热门活动</span>
        </div>

        <div class="list-wrapper">
            <ul class="items">
                @foreach($data['data'] as $key=>$val)
                    <li class="item">
                        <div class="img-box">
                            <a target="_blank" href="/active/detail?id={{$val['id']}}" class="black-btn btn"><img src="/{!! $val['thumb_358_640'] !!}" alt=""></a>
                        </div>
                        <div class="detail-box">
                            <p class="box" style="">
                                <span class="tag">主题:</span>
                                <span class="val"><a target="_blank" href="/active/detail?id={{$val['id']}}" class="black-btn btn"><b>{{$val['theme']}}</b></a></span>
                            </p>
                            <p class="box" style="">
                                <span class="tag">类型:</span>
                                <span class="val">{{$val['type']}}</span>
                            </p>
                            <p class="box" style="">
                                <span class="tag">时间:</span>
                                <span class="val">{{$val['time']}}</span>
                            </p>
                            <p class="box" style="">
                                <span class="tag">地点:</span>
                                <span class="val">{{$val['address']}}</span>
                            </p>
                        </div>
                        <div class="btn-wrapper">
                            <a target="_blank" href="/active/detail?id={{$val['id']}}" class="black-btn btn">
                                查看详情
                            </a>
                            <div class="btn appointment" @click="isAppointmentShow = true">
                                马上预约
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="page-wrapper">
                {{ $data['data']->links() }}
            </div>
        </div>


        <div class="common-box-header">
            <p>往期活动回顾</p>
            <p><a target="_blank" href="/active/review">查看更多 > > ></a></p>
        </div>
        <div class="back-review">
            <ul class="items">
                @foreach($data['back_review'] as $key=>$val)
                    <li  class="item">
                        <a target="_blank" href="/active/review/detail?id={{$val['id']}}" class="desc">
                        <img src="/{!! $val['thumb_276_211'] !!}" class="img" style="width: 276px;height: 211px;">
                        <p class="name text-overflow-1">
                            {!! $val['title'] !!}
                        </p>
                        <p class="detail">
                            <a target="_blank" href="/active/review/detail?id={{$val['id']}}" class="desc"> < 查看详情 ></a>
                        </p>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>



    <section class="page-footer">
        <div class="page-footer-wrapper">
{{--            @include('front.common.four_house')--}}
            @include('front.common.seven_info')
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
<script src="/front/js/inspect/index.js"></script>
<script>
    function consult($type=1){
        $('#form_consult').find("input[name='type']").val(9);
        submitConsultData();
    }
    function consult_1($type=1){
        $('#form_consult_1').find("input[name='type']").val($type);
        submitConsultData_1();
    }
</script>
</body>
</html>