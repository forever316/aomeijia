<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8" />
    <title>统计首页</title>
    <link type="text/css" rel="stylesheet" href="/assets/admin/tongji/css/tableCss.css">
</head>
<body>
<div class="tabCon">
    <!--一行-->
    <div class="rowCss">

        <div class="rowOne one">
            <div class="row_title"><img src="/assets/admin/tongji/images/xs.png">本月销售额</div>
            <p>{{$data['benyuexiaoshou']}}</p>
        </div>

        <div class="rowOne two">
            <div class="row_title"><img src="/assets/admin/tongji/images/dd.png"><span>本月订单数</span></div>
            <p>{{$data['benyuedingdan']}}</p>
        </div>

        <div class="rowOne three">
            <div class="row_title"><img src="/assets/admin/tongji/images/zc.png"><span>本月注册用户</span></div>
            <p>{{$data['benyuezhuce']}}</p>
        </div>

        <div class="rowOne four">
            <div class="row_title"><img src="/assets/admin/tongji/images/dd.png"><span>本月已扫描积分</span></div>
            <p>{{$data['benyueshaomiao']}}</p>
        </div>

        @if($data['paihangbang'])
            <div class="anniu">
                <a href="/finance/rankingList">查看排行榜</a>
            </div>
        @endif
    </div>
    <!--一行-->

    <!--一行-->
    <div class="rowCss">

        <!--一个统计-->
        <div class="ColCss">
            <div class="colTitle">待处理：<? echo  $data['daifahuo']+$data['daituikuan']+$data['daitixian']; ?></div>
            <div class="col_list">
                <ul>
                    <li><a href="#"><span>待发货</span><em>{{$data['daifahuo']}}</em></a></li>
                    <li><a href="#"><span>待退款</span><em>{{$data['daituikuan']}}</em></a></li>
                    <li><a href="#"><span>待提现</span><em>{{$data['daitixian']}}</em></a></li>
                </ul>
            </div>
        </div>
        <!--一个统计-->

        <!--一个统计-->
        <div class="ColCss">
            <div class="colTitle">订单：<? echo  $data['daifukuan']+$data['yiwancheng']+$data['yiquxiao']; ?></div>
            <div class="col_list">
                <ul>
                    <li><a href="#"><span>待付款</span><em>{{$data['daifukuan']}}</em></a></li>
                    <li><a href="#"><span>已完成</span><em>{{$data['yiwancheng']}}</em></a></li>
                    <li><a href="#"><span>已取消</span><em>{{$data['yiquxiao']}}</em></a></li>
                </ul>
            </div>
        </div>
        <!--一个统计-->


        <!--一个统计-->
        <div class="ColCss">
            <div class="colTitle">商品：<? echo  $data['goodsCount']; ?></div>
            <div class="col_list">
                <ul>
                    <li><a href="#"><span>商品总数</span><em>{{$data['goodsCount']}}</em></a></li>
                    <li><a href="#"><span>上架商品</span><em>{{$data['goods_status_Count']}}</em></a></li>
                    <li><a href="#"><span>未上架商品</span><em>{{$data['goods_no_status_Count']}}</em></a></li>
                </ul>
            </div>
        </div>
        <!--一个统计-->

        <!--一个统计-->
        <div class="ColCss">
            <div class="colTitle">积分统计：{{$data['zongjifen']}}</div>
            <div class="col_list col_list1">
                <ul>
                    <li><a href="#"><span>已扫描</span><em>{{$data['yishaomiao']}}</em></a></li>
                    <li><a href="#"><span>未扫描</span><em>{{$data['weishaomiao']}}</em></a></li>
                    <li><a href="#"><span>已兑现</span><em>{{$data['yiduixian']}}</em></a></li>
                    <li><a href="#"><span>未兑现</span><em>{{$data['weiduixian']}}</em></a></li>
                </ul>
            </div>
        </div>
        <!--一个统计-->
    </div>
    <!--一行-->


    <div class="sys">
        <div class="peizhi">
            <ul>
                <li>服务器操作系统：LINUX</li>
                <li>WEB服务器：APACHE</li>
                <li>PHP版本：7</li>
                <li>MYSQL版本：5.6</li>
                <li>版本：1</li>
                <li>安装日期：2019-04-08</li>
            </ul>
        </div>
    </div>
</div>

</body>
</html>