<input type="hidden" name="longitude" value="@if(isset($detailData->longitude)){{$detailData->longitude}}@endif">
<input type="hidden" name="latitude" value="@if(isset($detailData->latitude)){{$detailData->latitude}}@endif">
<div class="form-group" style="height: 500px" >
	<label class="col-sm-1 control-label">店铺位置</label>
	<div class="col-sm-10" style="width: 70%; height: 500px">
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
			<style type="text/css">
				body, html {width: 100%;height: 100%;margin:0;font-family:"微软雅黑";font-family:"微软雅黑";}
				#allmap{    width: 100%;  height: 500px;}
				p{margin-left:5px; font-size:14px;}
			</style>
			<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=flQjwsD7Q1ll8rBUl6lhn6z8"></script>
		</head>
		<body>
		<div id="allmap"></div>

		</body>

		<script type="text/javascript">
			// 百度地图API功能
			var map = new BMap.Map("allmap");
			map.centerAndZoom("厦门",13);
			map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放
			map.centerAndZoom(new BMap.Point(118.143, 24.487), 11);
			function showInfo(e){
				map.clearOverlays();
				var x = e.point.lng;
				var y = e.point.lat;
				var marker = new BMap.Marker(new BMap.Point(x, y));  // 创建标注
				map.addOverlay(marker);               // 将标注添加到地图中
				marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
				$("[name='longitude']").val(x);
				$("[name='latitude']").val(y);
				console.log(x+'--'+y);
			}
			map.addEventListener("click", showInfo);
					@if(isset($detailData->longitude))
			var point = new BMap.Point({{$detailData->longitude}},{{$detailData->latitude}});
			map.centerAndZoom(point, 15);
			var marker = new BMap.Marker(point);  // 创建标注
			map.addOverlay(marker);               // 将标注添加到地图中
			marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
			@endif
		</script>

	</div>
</div>
<script src="/assets/common/jquery.cityselect.js"></script>
<div class="form-group" style="margin-top: 1%">
	<label class="col-sm-1 control-label">商家地区</label>
	<div class="col-sm-10" style="width: 70%">
		<div id="ziduanContent">
			<div id="chengshi_1" style="overflow:hidden;width: 100%;">
				<select class="form-control prov" name="province" placeholder="省份" style="width: 30%;float: left;margin-right: 20px;"></select>
				<select class="form-control city" id="city" name="city" placeholder="城市" style="width: 30%;float: left;margin-right: 20px;"></select>
				<select class="form-control dist" id="area" name="area" placeholder="地区" style="width: 30%;float: left;margin-right: 20px;"></select>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		@if(isset($detailData->province))
                    $("#chengshi_1").citySelect({prov:"{{$detailData->province}}", city:"{{$detailData->city}}", dist:"{{$detailData->area}}"});
		@else
			$("#chengshi_1").citySelect({nodata:"none",
			required:false});
		@endif

	</script>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
	<label class="col-sm-1 control-label">店铺地址</label>
	<div class="col-sm-10" style="width: 70%">
		<input type="text" class="form-control" id="address" name="address" value="@if(isset($detailData->address)){{$detailData->address}}@endif">
	</div>
</div>
@if(isset($detailData->status)&&$detailData->status==1)
<div class="origin_limit">
<div class="hr-line-dashed"></div>
<div class="form-group">
	<label class="col-sm-1 control-label">商家每日宝分额度</label>
	<div class="col-sm-10" style="width: 70%">
		<input type="text" class="form-control" id="origin_limit" name="origin_limit" value="@if(isset($detailData->origin_limit)){{$detailData->origin_limit}}@endif">
		<span class="help-block m-b-none" style="color: red;">修改后，第二日凌晨生效</span>
	</div>
</div>
</div>
<div class="origin_limit">
	<div class="hr-line-dashed"></div>
	<div class="form-group">
		<label class="col-sm-1 control-label">商家今日剩余宝分额度</label>
		<div class="col-sm-10" style="width: 70%">
			<input type="text" class="form-control" id="remain_limit" name="remain_limit" value="@if(isset($detailData->remain_limit)){{$detailData->remain_limit}}@endif" readonly>
		</div>
	</div>
</div>
@endif