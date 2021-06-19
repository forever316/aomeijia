@if(isset($data['migrate']) && $data['migrate'])
<div class="overseas-wrapper">
    <div class="common-box-header">
        <p>@if(isset($data['searchInfo']['areaName'])){!! $data['searchInfo']['areaName'] !!}@endif热门移民项目</p>
        <p><a target="_blank" href="/migrate">查看更多 > > ></a></p>
    </div>
    <div class="overseas-bottom-list-wrapper">
        @foreach($data['migrate'] as $key=>$val)
            <div class="overseas-bottom-list">
                <a target="_blank" href="/migrate/detail?id={{$val['id']}}" >
                <img src="/{{$val['img_287_288']}}" style="width:287px;height: 288px;">
                <div class="overseas-bottom-list-desc bg-black">
                    <p style="font-size: 22px;">{{$val['title']}}</p>
                    <p>{{$val['total_price']}}万起</p>
                    <p>
                        <span>{{$val['project_charac']}}</span>
                        <span>{{$val['identity']}}</span>
                        <span>{{$val['transact_period']}}</span>
                    </p>
                </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endif