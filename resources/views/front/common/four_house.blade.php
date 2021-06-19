@if(isset($data['house']) && $data['house'])
<div class="project-recommend-wrapper">
    <div class="common-box-header">
        <p>@if(isset($data['searchInfo']['areaName'])){!! $data['searchInfo']['areaName'] !!}@endif热门房产项目</p>
        <p><a target="_blank" href="/house">查看更多 > > ></a></p>
    </div>
    <div class="project-recommend-inner">
        <dl>
            @foreach($data['house'] as $key=>$val)
                <dt>
                    <div class="recommend-img-wrapper">
                        <a target="_blank" href="/house/detail?id={{$val['id']}}">
                            <img src="/{{$val['img_292_254']}}" alt="" style="width: 292px;height: 254px;">
                        </a>
                        <span class="hot-logo">
                    热门
                  </span>
                        <p>价格：￥{{$val['total_price']}}万起</p>
                    </div>
                    <div class="recommend-desc-wrapper none-pointer">
                        <p class="recommend-desc-title">
                            {{$val['title']}}
                        </p>
                        <div class="recommend-desc-info">
                    <span>
                      <p>{{$val['city_name']}}</p>
                      <p>城市</p>
                    </span>
                            <span>
                      <p>{{$val['type_name']}}</p>
                      <p>类型</p>
                    </span>
                            <span>
                      <p>￥{{$val['unit_price']}}万起</p>
                      <p>单价</p>
                    </span>
                            <span>
                      <p>{{$val['first_payment']}}%</p>
                      <p>首付</p>
                    </span>
                        </div>
                    </div>
                </dt>
            @endforeach
        </dl>
    </div>
</div>
@endif