<!DOCTYPE>
<html>
<head>
<meta charset="utf-8" />
<title>师傅排行榜</title>
<link rel="stylesheet" href="/assets/admin/tongji/css/rankingCss.css">
</head>
<body>
      <div class="ran">
          <div class="ranTitle"><img src="/assets/admin/tongji/images/pai.png">师傅排行榜</div>
          <div class="rowCss">
              <div class="onege wu">
                  <p><span>积分榜</span> </p>
                  <div class="bang_title">
                      <ul>
                         <li>排名</li>
                         <li>姓名</li>
                         <li>地区</li>
                         <li>销量</li>
                         <li>积分</li>
                      </ul>
                  </div>
                  <!--积分榜数据-->
                  <div class="shuju">
                      @foreach($data['jifenpaihang'] as $key=>$item)
                    <!--一条数据-->
                    <div class="oneshuju">
                       <ul>
                          <li><?php echo $key+1;?></li>
                          <li>{{$item->user_nickname}}</li>
                          <li>{{$item->city}}</li>
                          <li>{{$item->integralCount}}</li>
                          <li>{{$item->integral}}</li>
                       </ul>
                    </div>
                          <!--一条数据-->
                      @endforeach
                  </div>
                  <!--积分榜数据-->
              </div>
              
              <div class="onege si">
                  <p><span>工种榜</span> </p>
                  <div class="bang_title">
                      <ul>
                         <li>排名</li>
                         <li>工种</li>
                         <li>积分</li>
                         <li>百分比</li>
                      </ul>
                  </div>
                  
                  <!--工种榜数据-->
                  <div class="shuju">

                    @foreach($data['gongzhongbang'] as $key=>$item)
                    <!--一条数据-->
                    <div class="oneshuju">
                       <ul>
                          <li><?php echo $key+1;?></li>
                          <li>{{$item->name}}</li>
                          <li>{{$item->integralCount}}</li>
                          <li>@if($data['zongjifen'] > 0){{bcdiv($item->integralCount,$data['zongjifen'],4)*100}} @else 0 @endif%</li>
                       </ul>
                    </div>
                          <!--一条数据-->
                    @endforeach

                  </div>
                  <!--工种榜数据-->
              </div>
          
          
              <div class="onege si">
                  <p><span>地区榜</span> </p>
                  <div class="bang_title">
                      <ul>
                         <li>排名</li>
                         <li>地区</li>
                         <li>积分</li>
                         <li>百分比</li>
                      </ul>
                  </div>
                  
                  <!--地区榜数据-->
                  <div class="shuju">

                     @foreach($data['diqubang'] as $key=>$item)
                    <!--一条数据-->
                    <div class="oneshuju">
                       <ul>
                          <li><?php echo $key+1;?></li>
                          <li>{{$item->city}}</li>
                           <li>{{$item->integralCount}}</li>
                           <li>@if($data['zongjifen'] > 0){{bcdiv($item->integralCount,$data['zongjifen'],4)*100}} @else 0 @endif%</li>
                       </ul>
                    </div>
                    <!--一条数据-->
                    @endforeach

                  </div>
                  <!--地区榜数据-->
              </div>
              
          </div>
          
          
          <div class="ranTitle"><img src="/assets/admin/tongji/images/pai.png">经销商排行榜</div>
          <div class="rowCss">
              <div class="onege wu">
                  <p><span>业绩榜</span> </p>
                  <div class="bang_title">
                      <ul>
                         <li>排名</li>
                         <li>姓名</li>
                         <li>地区</li>
                         <li>师傅数量</li>
                         <li>业绩</li>
                      </ul>
                  </div>
                  <!--业绩榜数据-->
                  <div class="shuju">

                      @foreach($data['yejibang'] as $key=>$item)
                    <!--一条数据-->
                    <div class="oneshuju">
                       <ul>
                          <li><?php echo $key+1;?></li>
                          <li>{{$item->nickname}}</li>
                          <li>{{$item->city}}</li>
                          <li>{{$item->zong}}</li>
                          <li>@if(!empty($item->yeji) && $item->yeji > 0) {{$item->yeji}} @else 0.00 @endif</li>
                       </ul>
                    </div>
                    <!--一条数据-->
                    @endforeach

                  </div>
                  <!--业绩榜数据-->
              </div>
			  
              
              <div class="onege wu">
                  <p><span>地区榜</span> </p>
                  <div class="bang_title">
                      <ul>
                         <li>排名</li>
                         <li>地区</li>
                         <li>经销商数量</li>
                         <li>业绩</li>
                         <li>百分比</li>
                      </ul>
                  </div>
                  <!--业绩榜数据-->
                  <div class="shuju">

                      @foreach($data['jxs_diqubang'] as $key=>$item)
                    <!--一条数据-->
                    <div class="oneshuju">
                       <ul>
                          <li><?php echo $key+1;?></li>
                          <li>{{$item->city}}</li>
                          <li>{{$item->zong}}</li>
                          <li>@if(!empty($item->yeji) && $item->yeji > 0) {{$item->yeji}} @else 0.00 @endif</li>
                          <li>@if($data['zongjine'][0]->zong > 0){{bcdiv($item->yeji,$data['zongjine'][0]->zong,4)*100}} @else 0 @endif%</li>
                       </ul>
                    </div>
                    <!--一条数据-->
                          @endforeach
                  </div>
                  <!--地区榜数据-->
              </div>
              
              
          </div>
      </div>
</body>
</html>
