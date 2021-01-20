<!DOCTYPE html>
<html>
<head>
    @include('admin.common.resources')
    <style>
        .layer-photos-demo img {
            width: 200px;
            height: 133.5px;
            margin-bottom: 5px;
            cursor:pointer;
        }
        li{
            overflow: hidden;
        }
        *{
            word-wrap:break-word;
            word-break:break-all;
        }
    </style>
</head>
<body>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-group">
                @foreach ($form['field'] as $key=>$item)
                    @if(isset($data[$key]))
                        @if ($item['type'] == 'span')
                            <li class="list-group-item">
                                <b>{{$item['text']}}：</b>{{$data[$key]}}
                            </li>
                        @endif

                        @if ($item['type'] == 'text')
                            <li class="list-group-item">
                                <b>{{$item['text']}}：</b><p style="text-indent:2em;margin:0px;">{{$data[$key]}}</p>
                            </li>
                        @endif

                        @if ($item['type'] == 'img')
                            <li class="list-group-item">
                                <b>{{$item['text']}}：</b>
                                <div id="{{$key}}layer-photos" class="layer-photos-demo">
                                    <img layer-pid="" layer-src="/{{$data[$key]}}" src="/{{$data[$key]}}" />
                                </div>
                                <script type="text/javascript">
                                    $(function(){
                                        $.kh.photos('{{$key}}layer-photos');
                                    })
                                </script>
                            </li>
                        @endif

                            @if ($item['type'] == 'webimg')
                                <li class="list-group-item">
                                    <b>{{$item['text']}}：</b>
                                    <div id="{{$key}}layer-photos" class="layer-photos-demo">
                                        <img layer-pid="" layer-src="{{$data[$key]}}" src="{{$data[$key]}}" />
                                    </div>
                                    <script type="text/javascript">
                                        $(function(){
                                            $.kh.photos('{{$key}}layer-photos');
                                        })
                                    </script>
                                </li>
                            @endif

                        @if ($item['type'] == 'imgs')
                            <li class="list-group-item">
                                <b>{{$item['text']}}：</b>
                                <div id="{{$key}}layer-photos" class="layer-photos-demo">
                                    @foreach($data[$key.'1'] as $k=>$url)
                                     <img layer-pid="" layer-src="/{{$url}}" src="/{{$url}}">
                                    @endforeach
                                </div>
                            </li>
                            <script type="text/javascript">
                                $(function(){
                                    $.kh.photos('{{$key}}layer-photos');
                                })
                            </script>
                        @endif

                        @if ($item['type'] == 'content')
                            <li class="list-group-item">
                                <b>{{$item['text']}}：</b><br/>
                                <div style="overflow: hidden;text-indent:2em;">
                                    {!!$data[$key]!!}
                                </div>
                            </li>
                        @endif

                        @if ($item['type'] == 'select')
                            <li class="list-group-item">
                                <b>{{$item['text']}}：</b>{{$item['value'][$data[$key]]}}
                            </li>
                        @endif
                    @else
                        <li class="list-group-item text-danger">
                            <b>错误：</b>您有一个字段错误（{{$key}}）！
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>
</body>
</html>