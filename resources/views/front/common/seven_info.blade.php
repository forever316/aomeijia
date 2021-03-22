<div class="news-wrapper">
    <div class="common-box-header">
        <p>@if(isset($data['searchInfo']['areaName'])){!! $data['searchInfo']['areaName'] !!}@endif最新资讯</p>
        <p><a href="#">查看更多 > > ></a></p>
    </div>
    <div class="news-box">
        <div class="top-wrapper">
            @if($data['info_top'])
                <a class="news" href="#">
                    <div class="img-wrapper">
                        <img src="/{!! $data['info_top']['thumb'] !!}" alt="">
                    </div>
                    <p class="name">
                        {!! $data['info_top']['title'] !!}
                    </p>
                </a>
            @endif
            @if($data['info_inner'])
                <div class="inner-wrapper">
                    @foreach($data['info_inner'] as $key=>$val)
                        <a  class="box" href="#">
                            <div class="img-wrapper">
                                <img src="/{!! $val['thumb'] !!}" alt="">
                            </div>
                            <div class="right">
                                <p class="name text-overflow-2">
                                    {!! $val['title'] !!}
                                </p>
                                <p class="desc text-overflow-2">
                                    {!! $val['describe'] !!}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="bottom-wrapper">
            @foreach($data['info_right'] as $key=>$val)
                <a class="box" href="#">
                    <div class="img-wrapper">
                        <img src="/{!! $val['thumb'] !!}" alt="">
                    </div>
                    <div class="right">
                        <p class="name text-overflow-2">
                            {!! $val['title'] !!}
                        </p>
                        <p class="desc text-overflow-2">
                            {!! $val['describe'] !!}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>