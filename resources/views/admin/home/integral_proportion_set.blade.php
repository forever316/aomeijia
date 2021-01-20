<!DOCTYPE html>
<html>
<head>
    @include('admin.common.resources')
    <style>
        .form-group{
            margin-bottom: 0px;
            overflow: hidden;
        }
        .layer-photos-demo img {
            width: 140px;
            height: 140px;
            cursor:pointer;
        }
        .l{
            padding: 4px;
            line-height: 1.42857143;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            -webkit-transition: border .2s ease-in-out;
            -o-transition: border .2s ease-in-out;
            transition: border .2s ease-in-out;
            overflow:hidden;float: left;position: relative;
            margin-right: 20px;
            margin-bottom: 20px;
        }
        .delImg{
            top: 4px;
            left: 4px;
            right: 4px;
            overflow: hidden;
            position: absolute;
            height: 0px;
            background: rgba( 0, 0, 0, 0.5 );
            z-index: 300;
            overflow: hidden;
        }
        .delImg span{
            width: 24px;
            height: 24px;
            display: inline;
            float: right;
            text-indent: -9999px;
            overflow: hidden;
            background: url(/assets/admin/img/icons.png) no-repeat;
            margin: 5px 1px 1px;
            cursor: pointer;
        }
        .delImg span.cancel{
            background-position: -48px -24px;
        }
        .delImg span.cancel:hover {
            background-position: -48px 0;
        }
    </style>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{$title}}</h5>
                </div>
                <div class="ibox-content" style="padding-top: 20px;">
                    <form id="editForm" method="post" action="/integral/integralProportionSet" class="form-horizontal">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-sm-1 control-label">比例</label>
                            <div class="col-sm-10" style="width: 70%">
                                <input id="group_key" name="proportion" type="text" @if(isset($detailData) && !empty($detailData)) value="{{$detailData['proportion']}}"  @endif class="form-control" />
                                <span class="help-block m-b-none">例如设置为100，比例就为100（积分）: 1（元）</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-1">
                                <button id="sub" class="btn btn-primary" type="button">保存内容</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        function formSub(index){
            $("#sub").on('click',function(){
                var layerload = layer.load(0, {
                    shadeClose:true,
                    shade:[0.3,'#000']
                });
                $(this).addClass('disabled');
                $(this).attr('disabled',true);
                $.ajax({
                    cache: true,
                    type: "POST",
                    url:$('#'+index).attr('action'),
                    data:$('#'+index).serialize(),
                    async: false,
                    dataType: "json",
                    error: function(request) {
                        layer.close(layerload);
                        var data = {};
                        data['msg'] = '提交失败！';
                        data['status'] = 500;
                        data['type'] = 'all';
                        $.kh.fromTips(data,2);
                        $("#sub").removeClass('disabled');
                        $("#sub").removeAttr('disabled');
                    },
                    success: function(data) {
                        layer.close(layerload);
                        $.kh.fromTips(data,2);
                        $("#sub").removeClass('disabled');
                        $("#sub").removeAttr('disabled');
                        if(data.status != 500){
                            setTimeout(function (){
                                location.replace(location.href);
                            }, 2000);
                        }
                    }
                });
            })
        }
       formSub('editForm');
    });
</script>
</body>
</html>