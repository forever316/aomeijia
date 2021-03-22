<div class="news-wrapper">
    <div class="header">
        <span class="text">百科资讯</span>
        <span class="more">更多 ></span>
    </div>
    <ul>
        @foreach($data['info'] as $key=>$val)
        <li >
            <img src="/{!! $val['thumb'] !!}" alt="">
            <p class="text-overflow-2">{!! $val['title'] !!}</p>
        </li>
        @endforeach
    </ul>
</div>