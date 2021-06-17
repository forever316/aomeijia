<!DOCTYPE html>
<html lang="en">
<head>

    {{--    <link type="text/css" rel="styleSheet" href="/front/css/header.css" />--}}
    <link type="text/css" rel="styleSheet" href="/front/css/common_part.css" />
    <link type="text/css" rel="styleSheet" href="/front/css/inspect/index.css" />
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
            <span>往期考察团回顾</span>
        </div>

        <div class="back-review">
            <ul class="items">
                @foreach($data['data'] as $key=>$val)
                    <li  class="item">
                        <a target="_blank" href="/inspect/review/detail?id={{$val['id']}}" class="desc">
                        <img src="/{!! $val['thumb'] !!}" class="img">
                        <p class="name text-overflow-1">
                            {!! $val['title'] !!}
                        </p>
                        <p class="detail">
                            <a target="_blank" href="/inspect/review/detail?id={{$val['id']}}" class="desc"> < 查看详情 ></a>
                        </p>
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
            {{--            @include('front.common.four_house')--}}
            @include('front.common.seven_info')
            @include('front.common.six_case')
        </div>
    </section>

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
    function consult_1($type=1){
        $('#form_consult_1').find("input[name='type']").val($type);
        submitConsultData_1();
    }
</script>
</body>
</html>