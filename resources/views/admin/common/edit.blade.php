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
                    <a href="javascript:window.location.href=document.referrer;" style="float: right;"><h5>返回</h5></a>
                </div>
                <div class="ibox-content" style="padding-top: 20px;">
                    <form id="editForm" method="post" action="{{$form['sub_url']}}" class="form-horizontal">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{$detailData->id}}" />
                        {{--通用表单开始--}}
                        @foreach ($form['field'] as $key=>$item)
                            {{--文本输出开始--}}
                            @if ($item['type'] == 'span')
                                <div class="form-group">
                                    <label class="col-lg-1 control-label">{{$item['text']}}</label>
                                    <div class="col-lg-10" style="width: 70%">
                                        <p class="form-control-static">{{$detailData[$key]}}</p>
                                    </div>
                                </div>
                                @endif
                            {{--文本输出结束--}}
                            @if ($item['type'] == 'content')
                                <div class="form-group">
                                    <label class="col-lg-1 control-label">{{$item['text']}}</label>
                                    <div class="col-lg-10" style="width: 70%">
                                        <p class="form-control-static">{!! $detailData[$key] !!}</p>
                                    </div>
                                </div>
                            @endif
                                {{--文本框开始--}}
                                @if ($item['type'] == 'input')
                                    <div class="form-group">
                                        <label class="col-sm-1 control-label">{{$item['text']}}</label>
                                        <div class="col-sm-10" style="width: 70%">
                                            <input type="text" class="form-control" id="{{$key}}" name="{{$key}}" value="{{$detailData[$key]}}" @if(isset($item['readonly']) && $item['readonly']==true)readonly @endif>
                                            @if(isset($item['desc']) && !empty($item['desc']))
                                                <span class="help-block m-b-none">{{$item['desc']}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    @endif
                                {{--文本框结束--}}

                            {{--<!-- 日期框开始 -->--}}
                            @if ($item['type'] == 'dateTime')
                                <div class="form-group">
                                    <label class="col-sm-1 control-label">{{$item['text']}}</label>
                                    <div class="col-sm-10" style="width: 70%">
                                        <input style="border: 1px solid #e5e6e7;height: 34px;" onclick="laydate({format: 'YYYY-MM-DD hh:mm:ss',istime: true})" type="text" class="form-control layer-date laydate-icon" id="{{$key}}" name="{{$key}}" value="{{$detailData[$key]}}">
                                        @if(isset($item['desc']) && !empty($item['desc']))
                                            <span class="help-block m-b-none">{{$item['desc']}}</span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            {{--<!-- 日期框结束 -->--}}

                            {{--<!-- 日期框开始 -->--}}
                            @if ($item['type'] == 'date')
                                <div class="form-group">
                                    <label class="col-sm-1 control-label">{{$item['text']}}</label>
                                    <div class="col-sm-10" style="width: 70%">
                                        <input style="border: 1px solid #e5e6e7;height: 34px;" onclick="laydate({format: 'YYYY-MM-DD'})" type="text" class="form-control layer-date laydate-icon" id="{{$key}}" name="{{$key}}" value="@if($detailData[$key]) {{$detailData[$key]}} @else @if(isset($item['value']) && !empty($item['value'])) {{$item['value']}} @endif @endif">
                                        @if(isset($item['desc']) && !empty($item['desc']))
                                            <span class="help-block m-b-none">{{$item['desc']}}</span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            {{--<!-- 日期框结束 -->--}}

                                    {{--密码框开始--}}
                                    @if ($item['type'] == 'password')
                                        <div class="form-group">
                                            <label class="col-sm-1 control-label">{{$item['text']}}</label>
                                            <div class="col-sm-10" style="width: 70%">
                                                <input type="password" class="form-control" id="{{$key}}" name="{{$key}}" value="{{$detailData[$key]}}">
                                                @if(isset($item['desc']) && !empty($item['desc']))
                                                    <span class="help-block m-b-none">{{$item['desc']}}</span>
                                                @endif
                                            </div>
                                        </div>
                                        @endif
                                    {{--密码框结束--}}

                                        {{--复选框开始--}}
                                        @if ($item['type'] == 'checkbox')
                                            <div class="form-group">
                                                <label class="col-sm-1 control-label">{{$item['text']}}</label>
                                                <div class="col-sm-10" style="width: 70%" id="{{$key}}">
                                                    @foreach ($item['value'] as $k=>$checkbox)
                                                        <label class="checkbox-inline i-checks">
                                                            <input @if(in_array($k,$detailData->$key))) checked="checked" @endif type="checkbox" name="{{$key}}[]" value="{{$k}}">&nbsp;{{$checkbox}}</label>
                                                    @endforeach
                                                    @if(isset($item['desc']) && !empty($item['desc']))
                                                        <span class="help-block m-b-none">{{$item['desc']}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            @endif
                                        {{--复选框结束--}}

                                            {{--单选框开始--}}
                                            @if ($item['type'] == 'radio')
                                                <div class="form-group">
                                                    <label class="col-sm-1 control-label">{{$item['text']}}</label>
                                                    <div class="col-sm-10" style="width: 70%" id="{{$key}}">
                                                        @foreach ($item['value'] as $k=>$radio)
                                                            <label class="checkbox-inline i-checks">
                                                                <input @if($k==$detailData[$key]) checked="checked" @endif type="radio" name="{{$key}}" value="{{$k}}"> <i></i>{{$radio}}</label>
                                                        @endforeach
                                                        @if(isset($item['desc']) && !empty($item['desc']))
                                                            <span class="help-block m-b-none">{{$item['desc']}}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                @endif
                                            {{--单选框结束--}}

                                                {{--下拉框开始--}}
                                                @if ($item['type'] == 'select')
                                                    <div class="form-group">
                                                        <label class="col-sm-1 control-label">{{$item['text']}}</label>
                                                        <div class="col-sm-10" style="width: 70%" id="{{$key}}">
                                                            <select class="form-control" id="{{$key}}" name="{{$key}}" @if(isset($item['readonly']) && $item['readonly']==true) disabled="disabled" @endif>
                                                                @foreach ($item['value'] as $k=>$option)
                                                                    <option @if($k==$detailData[$key]) selected="selected" @endif value="{{$k}}">{{$option}}</option>
                                                                @endforeach
                                                            </select>
                                                            @if(isset($item['desc']) && !empty($item['desc']))
                                                                <span class="help-block m-b-none">{{$item['desc']}}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    @endif
                                                {{--下拉框结束--}}
                                                    {{--图片上传开始(单图)--}}
                                                    @if ($item['type'] == 'img')
                                                        <div class="form-group">
                                                            <input type="hidden" name="{{$key}}" id="{{$key}}_val" value="{{$detailData[$key]}}" />
                                                            <label class="col-sm-1 control-label">{{$item['text']}}</label>
                                                            <div class="col-sm-10" style="width: 70%" id="{{$key}}">
                                                                @if(!empty($detailData[$key]))
                                                                <div id="{{$key}}layer-photos" class="layer-photos-demo" style="overflow:hidden;">
                                                                    <div class="l" id="{{$key}}_1">
                                                                        <div class="delImg"><span class="cancel" onclick="delImg('{{$detailData[$key]}}','{{$key}}','{{$key}}_1')">删除</span></div>
                                                                        <img layer-pid="" layer-src="/{{$detailData[$key]}}" src="/{{$detailData[$key]}}" />
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                <div class="uploader-demo">
                                                                    <!--用来存放item-->
                                                                    <div id="{{$key}}List" class="uploader-list"></div>
                                                                    <div id="{{$key}}Picker">选择图片</div>
                                                                </div>
                                                            </div>
                                                            <script type="text/javascript">
                                                                $(function(){
                                                                    var limit = 1,folder='images';
                                                                    @if(isset($item['folder']) && !empty($item['folder']))
                                                                    folder = '{{$item['folder']}}';
                                                                    @endif
                                                                    $.kh.imgUpload('{{$key}}',limit,folder);
                                                                    $.kh.photos('{{$key}}layer-photos');
                                                                })
                                                            </script>
                                                        </div>
                                                        @endif
                                                    {{--图片上传结束--}}

                                                    {{--图片上传开始（多图）--}}
                                                        @if ($item['type'] == 'imgs')
                                                            <div class="form-group">
                                                                <input type="hidden" name="{{$key}}" id="{{$key}}_val" value="{{$detailData[$key]}}" />
                                                                <label class="col-sm-1 control-label">{{$item['text']}}</label>
                                                                <div class="col-sm-10" style="width: 70%" id="{{$key}}">
                                                                    <div id="{{$key}}layer-photos" class="layer-photos-demo" style="overflow:hidden;">
                                                                        @foreach($item['value'] as $k=>$url)
                                                                            <div class="l" id="a_{{$k}}">
                                                                                <div class="delImg"><span class="cancel" onclick="delImg('{{$url}}','{{$key}}','a_{{$k}}')">删除</span></div>
                                                                                <img layer-pid="" layer-src="/{{$url}}" src="/{{$url}}">
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                    <div class="uploader-demo">
                                                                        <!--用来存放item-->
                                                                        <div id="{{$key}}List" class="uploader-list"></div>
                                                                        <div id="{{$key}}Picker">选择图片</div>
                                                                    </div>
                                                                </div>
                                                                <script type="text/javascript">
                                                                    $(function(){
                                                                        var limit = 10,folder='images';
                                                                        @if(isset($item['limit']) && !empty($item['limit']))
                                                                        limit = {{$item['limit']}};
                                                                        @endif
                                                                        @if(isset($item['folder']) && !empty($item['folder']))
                                                                        folder = '{{$item['folder']}}';
                                                                        @endif
                                                                        $.kh.imgUpload('{{$key}}',limit,folder);
                                                                        $.kh.photos('{{$key}}layer-photos');
                                                                    })
                                                                </script>
                                                            </div>
                                                            {{--<div class="form-group">--}}
                                                                {{--<input type="hidden" name="{{$key}}" id="{{$key}}_val" value="{{$detailData[$key]}}" />--}}
                                                                {{--<label class="col-sm-1 control-label">{{$item['text']}}</label>--}}
                                                                {{--<div class="col-sm-10" style="width: 70%">--}}
                                                                    {{--<div id="{{$key}}layer-photos" class="layer-photos-demo">--}}
                                                                        {{--<img layer-pid="" layer-src="/assets/admin/img/p3.jpg" src="/assets/admin/img/p3.jpg">--}}
                                                                        {{--<img layer-pid="" layer-src="/assets/admin/img/profile.jpg" src="/assets/admin/img/profile.jpg">--}}
                                                                        {{--<img layer-pid="" layer-src="/assets/admin/img/p1.jpg" src="/assets/admin/img/p1.jpg">--}}
                                                                        {{--<img layer-pid="" layer-src="/assets/admin/img/p_big3.jpg" src="/assets/admin/img/p_big3.jpg">--}}
                                                                    {{--</div>--}}
                                                                    {{--<div id="{{$key}}" class="wu-example">--}}
                                                                        {{--<div class="queueList" style="margin: 0px;">--}}
                                                                            {{--<div class="placeholder">--}}
                                                                                {{--<div id="{{$key}}filePicker"></div>--}}
                                                                                {{--<p>或将照片拖到这里，单次最多可选10张</p>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}
                                                                        {{--<div class="statusBar" style="display:none;">--}}
                                                                            {{--<div class="progress">--}}
                                                                                {{--<span class="text">0%</span>--}}
                                                                                {{--<span class="percentage"></span>--}}
                                                                            {{--</div><div class="info"></div>--}}
                                                                            {{--<div class="btns" style="overflow:hidden;">--}}
                                                                                {{--<div id="{{$key}}filePicker2" style="float: left;"></div>--}}
                                                                                {{--<div class="uploadBtn">开始上传</div>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}
                                                                    {{--</div>--}}
                                                                {{--</div>--}}
                                                                {{--<script type="text/javascript">--}}
                                                                    {{--$(function(){--}}
                                                                        {{--$.kh.imgsUpload('{{$key}}');--}}
                                                                        {{--$.kh.photos('{{$key}}layer-photos');--}}
                                                                    {{--})--}}
                                                                {{--</script>--}}
                                                            {{--</div>--}}
                                                            {{--图片上传结束--}}
                                                            @endif
                                                             {{--<!--自定义开始 -->--}}
                                                             @if($item['type'] == 'custom')
                                                                @include($item['value'])
                                                             @endif
                                                            {{--<!--自定义结束 -->--}}
                                                        {{--文本域开始--}}
                                                            @if ($item['type'] == 'textarea')
                                                                <div class="form-group">
                                                                    <label class="col-sm-1 control-label">{{$item['text']}}</label>
                                                                    <div class="col-sm-10" style="width: 70%">
                                                                        <textarea class="form-control" style="width: 100%;height: 150px;resize:none;" id="{{$key}}" name="{{$key}}">{{$detailData[$key]}}</textarea>
                                                                        @if(isset($item['desc']) && !empty($item['desc']))
                                                                            <span class="help-block m-b-none">{{$item['desc']}}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            {{--文本域结束--}}
															
															@if($item['type'] == 'ueditor')
                                <div class="form-group">
                                    <label class="col-sm-1 control-label">{{$item['text']}}</label>
                                    <div class="col-sm-10" style="width: 70%">
                                        <textarea style="height: 500px;" id="{{$key}}" name="{{$key}}">{{$detailData[$key]}}</textarea>
                                        @if(isset($item['desc']) && !empty($item['desc']))
                                            <span class="help-block m-b-none">{{$item['desc']}}</span>
                                        @endif
                                    </div>
                                    <script type="text/javascript">
                                        $(function(){
                                            UE.getEditor('{{$key}}');
                                        })
                                    </script>
                                </div>
                            @endif
															
                                                                <div class="hr-line-dashed"></div>
                                                                @endforeach
                                                                {{--通用表单结束--}}
                                                                <div class="form-group" @if(isset($detailData['has_varify'])&&$detailData['has_varify']) style="display: none;" @endif>
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
        $.kh.formSub('editForm');
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
</body>
</html>