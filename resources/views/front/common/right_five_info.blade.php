<div class="news-wrapper">
    <div class="header">

            <span class="text">百科资讯</span>
        <a target="_blank" href="/information">
            更多 >
        </a>
    </div>
    <ul>
        @foreach($data['info'] as $key=>$val)
        <li class="none-pointer">
            <img src="/{!! $val['thumb'] !!}" alt="" style="width:100px;height:60px;">
            <p class="text-overflow-2">
                <a target="_blank" href="/information/detail?id={{$val['id']}}">{!! $val['title'] !!}</a>
            </p>
        </li>
        @endforeach
    </ul>
</div>