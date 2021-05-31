<style>
    template { display: block !important; }
</style>
<div class="case-wrapper">
    <div class="common-box-header">
        <p>@if(isset($data['searchInfo']['areaName'])){!! $data['searchInfo']['areaName'] !!}@endif成功案例</p>
        <p><a target="_blank" href="/invest/case">查看更多 > > ></a></p>
    </div>
    <div class="case-box">
        <div class="swiper-wrapper">
            @foreach($data['case'] as $key=>$val)
{{--                <template >--}}
{{--                style="width:384px;margin:20px;"--}}
            @foreach($val as $k=>$v)
                        <a target="_blank" class="swiper-slide" href="/invest/case/detail?id={{$v['id']}}">
                            <div class="img-wrapper">
                                <img src="/{!! $v['thumb'] !!}" alt="">
                            </div>
                            <p class="name text-overflow-2">
                                {!! $v['title'] !!}
                            </p>
                            <p class="desc text-overflow-2">
                                {!! $v['describe'] !!}
                            </p>
                        </a>
                    @endforeach
{{--                </template>--}}
            @endforeach
        </div>
    </div>




    <div class="case-button-next" @click="nextCase"></div>
    <div class="case-button-prev" @click="prevCase"></div>
</div>