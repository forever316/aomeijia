<div class="detail-right-wrapper">
    <div class="hot-wrapper">
        <div class="header">
            <span class="text">热门投资主题</span>
            <a target="_blank" href="/invest/theme">
            <span class="more">更多 ></span>
            </a>
        </div>
        <div class="cont">
            @foreach($data['theme'] as $tk=>$tv)
                <div class="hot-box">
                    <img src="/{{$tv['thumb']}}" alt="">
                    <p class="name text-overflow-2">
                        <a target="_blank" href="/invest/theme/detail?id={{$tv['id']}}">
                        {{$tv['title']}}
                        </a>
                    </p>
                    <p class="desc text-overflow-2">
                        {!! $tv['describe'] !!}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
    @include('front.common.right_four_faqs')
    @if($data['adver_img'])
        <img src="/$data['adver_img'][0]['img_url']" class="ad">
    @endif
</div>