<!DOCTYPE html>
<html>
<head>
    @include('admin.common.resources')
    <style>
        .form-group{
            margin-bottom: 0px;
            overflow: hidden;
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
                        <form id="updateForm" method="post" action="{{$form['sub_url']}}" class="form-horizontal">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            {{--<!-- 通用表单开始 -->--}}
                            @foreach ($form['field'] as $key=>$item)

                            {{--<!-- 文本输出开始 -->--}}
                                @if ($item['type'] == 'span')
                            <div class="form-group">
                                <label class="col-lg-1 control-label">{{$item['text']}}</label>
                                <div class="col-lg-10" style="width: 70%">
                                    <p class="form-control-static">
                                        @if(isset($item['value']))
                                            {{$item['value']}}
                                        @endif
                                    </p>
                                </div>
                            </div>
                                 @endif
                            {{--<!-- 文本输出结束 -->--}}

                            {{--<!-- 文本框开始 -->--}}
                                    @if ($item['type'] == 'input')
                            <div class="form-group">
                                <label class="col-sm-1 control-label">{{$item['text']}}</label>
                                <div class="col-sm-10" style="width: 70%">
                                    <input type="text" class="form-control" id="{{$key}}" name="{{$key}}" @if(isset($item['value']) && !empty($item['value'])) value="{{$item['value']}}" @endif >
                                    @if(isset($item['desc']) && !empty($item['desc']))
                                    <span class="help-block m-b-none">{{$item['desc']}}</span>
                                    @endif
                                </div>
                            </div>
                                        @endif
                            {{--<!-- 文本框结束 -->--}}

                                {{--<!-- 日期框开始 -->--}}
                                @if ($item['type'] == 'dateTime')
                                    <div class="form-group">
                                        <label class="col-sm-1 control-label">{{$item['text']}}</label>
                                        <div class="col-sm-10" style="width: 70%">
                                            <input style="border: 1px solid #e5e6e7;height: 34px;" onclick="laydate({format: 'YYYY-MM-DD hh:mm:ss',istime: true})" type="text" class="form-control layer-date laydate-icon" id="{{$key}}" name="{{$key}}" @if(isset($item['value']) && !empty($item['value'])) value="{{$item['value']}}" @endif >
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
                                            <input style="border: 1px solid #e5e6e7;height: 34px;" onclick="laydate({format: 'YYYY-MM-DD'})" type="text" class="form-control layer-date laydate-icon" id="{{$key}}" name="{{$key}}" @if(isset($item['value']) && !empty($item['value'])) value="{{$item['value']}}" @endif>
                                            @if(isset($item['desc']) && !empty($item['desc']))
                                                <span class="help-block m-b-none">{{$item['desc']}}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                {{--<!-- 日期框结束 -->--}}

                            {{--<!-- 密码框开始 -->--}}
                                        @if ($item['type'] == 'password')
                            <div class="form-group">
                                <label class="col-sm-1 control-label">{{$item['text']}}</label>
                                <div class="col-sm-10" style="width: 70%">
                                    <input type="password" class="form-control" id="{{$key}}" name="{{$key}}" @if(isset($item['value']) && !empty($item['value'])) value="{{$item['value']}}" @endif>
                                    @if(isset($item['desc']) && !empty($item['desc']))
                                        <span class="help-block m-b-none">{{$item['desc']}}</span>
                                    @endif
                                </div>
                            </div>
                                            @endif
                            {{--<!-- 密码框结束 -->--}}

                            {{--<!-- 复选框开始 -->--}}
                                            @if ($item['type'] == 'checkbox')
                            <div class="form-group">
                                <label class="col-sm-1 control-label">{{$item['text']}}</label>
                                <div class="col-sm-10" style="width: 70%" id="{{$key}}">
                                    @foreach ($item['value'] as $k=>$checkbox)
                                        <label class="checkbox-inline i-checks">
                                        <input @if(isset($item['chage'])) @if(isset($item['chage'][$k])))  checked="checked" @endif @endif type="checkbox" name="{{$key}}[]" value="{{$k}}">&nbsp;{{$checkbox}}</label>
                                    @endforeach
                                        @if(isset($item['desc']) && !empty($item['desc']))
                                            <span class="help-block m-b-none">{{$item['desc']}}</span>
                                        @endif
                                </div>
                            </div>
                                                @endif
                            {{--<!-- 复选框结束 -->--}}

                            {{--<!-- 单选框开始 -->--}}
                                                @if ($item['type'] == 'radio')
                            <div class="form-group">
                                <label class="col-sm-1 control-label">{{$item['text']}}</label>
                                <div class="col-sm-10" style="width: 70%" id="{{$key}}">
                                    @foreach ($item['value'] as $k=>$radio)
                                        <label class="checkbox-inline i-checks">
                                        <input @if(isset($item['chage'])) @if($item['chage'] == $k)  checked="checked" @endif @endif type="radio" name="{{$key}}" value="{{$k}}"> <i></i>{{$radio}}</label>
                                    @endforeach
                                        @if(isset($item['desc']) && !empty($item['desc']))
                                            <span class="help-block m-b-none">{{$item['desc']}}</span>
                                        @endif
                                </div>
                            </div>
                                                    @endif
                            {{--<!-- 单选框结束 -->--}}

                            {{--<!-- 下拉框开始 -->--}}
                                                    @if ($item['type'] == 'select')
                            <div class="form-group">
                                <label class="col-sm-1 control-label">{{$item['text']}}</label>
                                <div class="col-sm-10" style="width: 70%" id="{{$key}}">
                                    <select class="form-control" id="{{$key}}" name="{{$key}}">
                                        @foreach ($item['value'] as $k=>$option)
                                            <option value="{{$k}}">{{$option}}</option>
                                        @endforeach
                                    </select>
                                    @if(isset($item['desc']) && !empty($item['desc']))
                                        <span class="help-block m-b-none">{{$item['desc']}}</span>
                                    @endif
                                </div>
                            </div>
                                                        @endif
                            {{--<!-- 下拉框结束 -->--}}
                                                        {{--<!-- 图片上传开始(单图) -->--}}
                                                        @if ($item['type'] == 'img')
                            <div class="form-group">
                                <input type="hidden" name="{{$key}}" id="{{$key}}_val" />
                                <label class="col-sm-1 control-label">{{$item['text']}}</label>
                                <div class="col-sm-10" style="width: 70%" id="{{$key}}">
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
                                    })
                                </script>
                            </div>
                                                            @endif
                                                        {{--<!-- 图片上传结束 -->--}}

                            {{--<!-- 图片上传开始（多图） -->--}}
                            @if ($item['type'] == 'imgs')
                                <div class="form-group">
                                    <input type="hidden" name="{{$key}}" id="{{$key}}_val" />
                                    <input type="hidden" id="{{$key}}_val_name" />
                                    <label class="col-sm-1 control-label">{{$item['text']}}</label>
                                    <div class="col-sm-10" style="width: 70%" id="{{$key}}">
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
                                        })
                                    </script>
                                </div>
                            {{--<!-- 图片上传结束 -->--}}
                            @endif

                            {{--<!-- 文本域开始 -->--}}
                            @if ($item['type'] == 'textarea')
                            <div class="form-group">
                                <label class="col-sm-1 control-label">{{$item['text']}}</label>
                                <div class="col-sm-10" style="width: 70%">
                                    <textarea class="form-control" style="width: 100%;height: 150px;resize:none;" id="{{$key}}" name="{{$key}}"></textarea>
                                    @if(isset($item['desc']) && !empty($item['desc']))
                                        <span class="help-block m-b-none">{{$item['desc']}}</span>
                                    @endif
                                </div>
                            </div>
                                @endif
                            {{--<!-- 文本域结束 -->--}}

                            {{--<!--自定义开始 -->--}}
                             @if($item['type'] == 'custom')
                                @include($item['value'])
                             @endif
                            {{--<!--自定义结束 -->--}}
                            
                            @if($item['type'] == 'ueditor')
                                <div class="form-group">
                                    <label class="col-sm-1 control-label">{{$item['text']}}</label>
                                    <div class="col-sm-10" style="width: 70%">
                                        <textarea style="height: 500px;" id="{{$key}}" name="{{$key}}"></textarea>
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
                            {{--<!-- 通用表单结束 -->--}}
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
            $.kh.formSub('updateForm');
        });
    </script>
</body>
</html>