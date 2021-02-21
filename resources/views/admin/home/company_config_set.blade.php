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
        input:enabled{
            width: 30%;
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
                    <form id="editForm" method="post" action="/home/companyConfigSet" class="form-horizontal">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label class="col-sm-1 control-label">公司名称</label>
                            <div class="col-sm-10" style="width: 70%">
                                <input name="company_name" type="text" @if(isset($detailData) && !empty($detailData)) value="{{$detailData['company_name']}}"  @endif class="form-control" />
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <input type="hidden" name="header_logo" id="header_logo_val" @if(isset($detailData) && !empty($detailData)) @if(!empty($detailData['header_logo'])) value="{{$detailData['header_logo']}}" @else value="" @endif @else value="" @endif />
                            <label class="col-sm-1 control-label">公司顶部logo图片</label>
                            <div class="col-sm-10" style="width: 70%" id="header_logo">
                                @if(isset($detailData) && !empty($detailData))
                                    @if(!empty($detailData['header_logo']))
                                        <div id="header_logolayer-photos" class="layer-photos-demo" style="overflow:hidden;">
                                            <div class="l" id="header_logo_1">
                                                <div class="delImg"><span class="cancel" onclick="delImg('{{$detailData['header_logo']}}','header_logo','header_logo_1')">删除</span></div>
                                                <img layer-pid="" layer-src="/{{$detailData['header_logo']}}" src="/{{$detailData['header_logo']}}" />
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                <div class="uploader-demo">
                                    <!--用来存放item-->
                                    <div id="header_logoList" class="uploader-list"></div>
                                    <div id="header_logoPicker">选择图片</div>
                                </div>
                            </div>
                            <script type="text/javascript">
                                $(function(){
                                    var limit = 1,folder='img';
                                    $.kh.imgUpload('header_logo',limit,folder);
                                    $.kh.photos('header_logolayer-photos');

                                    $.kh.imgUpload('footer_logo',limit,folder);
                                    $.kh.photos('footer_logolayer-photos');

                                    $.kh.imgUpload('wechat1_img',limit,folder);
                                    $.kh.photos('wechat1_imglayer-photos');

                                    $.kh.imgUpload('wechat2_img',limit,folder);
                                    $.kh.photos('wechat2_imglayer-photos');

                                    //工具栏
                                    $('.l').on( 'mouseenter', function() {
                                        $(this).find(".delImg").stop().animate({height: 24});
                                    });

                                    $('.l').on( 'mouseleave', function() {
                                        $(this).find(".delImg").animate({height: 0});
                                    });
                                });
                                //删除原有图片
                                function delImg(url,id,id2){
                                    var url_str = $("#"+id+'_val').val();
                                    url_str = url_str.replace(';'+url,'');
                                    url_str = url_str.replace(url+';','');
                                    url_str = url_str.replace(url,'');
                                    $("#"+id+'_val').val(url_str);
                                    $("#"+id2).remove();
                                }
                            </script>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <input type="hidden" name="footer_logo" id="footer_logo_val" @if(isset($detailData) && !empty($detailData)) @if(!empty($detailData['footer_logo'])) value="{{$detailData['footer_logo']}}" @else value="" @endif @else value="" @endif />
                            <label class="col-sm-1 control-label">公司底部logo</label>
                            <div class="col-sm-10" style="width: 70%" id="footer_logo">
                                @if(isset($detailData) && !empty($detailData))
                                    @if(!empty($detailData['footer_logo']))
                                        <div id="footer_logolayer-photos" class="layer-photos-demo" style="overflow:hidden;">
                                            <div class="l" id="footer_logo_1">
                                                <div class="delImg"><span class="cancel" onclick="delImg('{{$detailData['footer_logo']}}','footer_logo','footer_logo_1')">删除</span></div>
                                                <img layer-pid="" layer-src="/{{$detailData['footer_logo']}}" src="/{{$detailData['footer_logo']}}" />
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                <div class="uploader-demo">
                                    <!--用来存放item-->
                                    <div id="footer_logoList" class="uploader-list"></div>
                                    <div id="footer_logoPicker">选择图片</div>
                                </div>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <input type="hidden" name="wechat1_img" id="wechat1_img_val" @if(isset($detailData) && !empty($detailData)) @if(!empty($detailData['wechat1_img'])) value="{{$detailData['wechat1_img']}}" @else value="" @endif @else value="" @endif />
                            <label class="col-sm-1 control-label">澳美家海外微信公众号</label>
                            <div class="col-sm-10" style="width: 70%" id="wechat1_img">
                                @if(isset($detailData) && !empty($detailData))
                                    @if(!empty($detailData['wechat1_img']))
                                        <div id="wechat1_imglayer-photos" class="layer-photos-demo" style="overflow:hidden;">
                                            <div class="l" id="wechat1_img_1">
                                                <div class="delImg"><span class="cancel" onclick="delImg('{{$detailData['wechat1_img']}}','wechat1_img','wechat1_img_1')">删除</span></div>
                                                <img layer-pid="" layer-src="/{{$detailData['wechat1_img']}}" src="/{{$detailData['wechat1_img']}}" />
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                <div class="uploader-demo">
                                    <!--用来存放item-->
                                    <div id="wechat1_imgList" class="uploader-list"></div>
                                    <div id="wechat1_imgPicker">选择图片</div>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <input type="hidden" name="wechat2_img" id="wechat2_img_val" @if(isset($detailData) && !empty($detailData)) @if(!empty($detailData['wechat2_img'])) value="{{$detailData['wechat2_img']}}" @else value="" @endif @else value="" @endif />
                            <label class="col-sm-1 control-label">财富管理公众号</label>
                            <div class="col-sm-10" style="width: 70%" id="wechat2_img">
                                @if(isset($detailData) && !empty($detailData))
                                    @if(!empty($detailData['wechat2_img']))
                                        <div id="wechat2_imglayer-photos" class="layer-photos-demo" style="overflow:hidden;">
                                            <div class="l" id="wechat2_img_1">
                                                <div class="delImg"><span class="cancel" onclick="delImg('{{$detailData['wechat2_img']}}','wechat2_img','wechat2_img_1')">删除</span></div>
                                                <img layer-pid="" layer-src="/{{$detailData['wechat2_img']}}" src="/{{$detailData['wechat2_img']}}" />
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                <div class="uploader-demo">
                                    <!--用来存放item-->
                                    <div id="wechat2_imgList" class="uploader-list"></div>
                                    <div id="wechat2_imgPicker">选择图片</div>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                       
                        <div class="form-group">
                            <label class="col-sm-1 control-label">公司简介</label>
                            <div class="col-sm-10" style="width: 70%">
                                <textarea class="form-control" style="width: 100%;height: 150px;resize:none;" name="synopsis">@if(isset($detailData) && !empty($detailData)) {{$detailData['synopsis']}} @endif</textarea>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-1 control-label">客服电话</label>
                            <div class="col-sm-10" style="width: 70%">
                                <input name="custom_service_phone" type="text" @if(isset($detailData) && !empty($detailData)) value="{{$detailData['custom_service_phone']}}"  @endif class="form-control" />
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-1 control-label">宣传视频链接</label>
                            <div class="col-sm-10" style="width: 70%">
                                <input name="video" type="text" @if(isset($detailData) && !empty($detailData)) value="{{$detailData['video']}}"  @endif class="form-control" />
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-1 control-label">版权所有</label>
                            <div class="col-sm-10" style="width: 70%">
                                <input name="copyright" type="text" @if(isset($detailData) && !empty($detailData)) value="{{$detailData['copyright']}}"  @endif class="form-control" />
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

    function clearNoNum(obj) {
//        if(obj.value>100){
//            obj.value=100;
//        }
        obj.value = obj.value.replace(/[^\d.]/g, "");//清除“数字”和“.”以外的字符
        obj.value = obj.value.replace(/^\./g, "");//验证第一个字符是数字而不是.
        obj.value = obj.value.replace(/\.{2,}/g, ".");//只保留第一个. 清除多余的.
        obj.value = obj.value.replace(".", "$#$").replace(/\./g,"").replace("$#$", ".");

    }
</script>
</body>
</html>