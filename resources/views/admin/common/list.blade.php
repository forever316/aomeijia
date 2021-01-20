<!DOCTYPE html>
<html>
<head>
    @include('admin.common.listresources')
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{$title}}</h5>
                </div>
                <div class="ibox-content">
                    <div id="ibox-content" class="table-responsive">
                        @if(isset($form['search']))
                        <div class="search form-horizontal" style="overflow:hidden;">
                            <form id="searchForm" method="post" action="" class="form-horizontal">
                                @foreach ($form['search'] as $key=>$item)
                                    <div class="form-group" style="float: left;overflow: hidden;width: auto; margin: 0px 0px 15px 0px;">
                                        <label class="col-sm-1 control-label" style="width: auto;padding-left: 0px;">{{$item['text']}}</label>
                                        <div class="col-sm-10" style="width: auto; padding-left: 0px;">
                                    @if($item['type'] == 'input')
                                            <input style="width: auto;" type="text" class="form-control" id="{{$key}}" name="{{$key}}"><!-- value="{{ old($key) }}" -->
                                    @elseif($item['type'] == 'select')
                                        <select id="{{$key}}" name="{{$key}}" style="width: auto;" class="form-control">
                                        @foreach ($item['value'] as $option_key=>$option)
                                            <option value="{{$option_key}}">{{$option}}</option>
                                            {{--@if(old($key) == $option_key)--}}
                                                {{--<option selected value="{{$option_key}}">{{$option}}</option>--}}
                                            {{--@else--}}
                                                {{--<option value="{{$option_key}}">{{$option}}</option>--}}
                                            {{--@endif--}}
                                        @endforeach
                                        </select>
                                    @elseif($item['type'] == 'dateTime')
                                        <input onclick="laydate({format: 'YYYY-MM-DD hh:mm:ss',istime: true})" style="width: auto;border: 1px solid #e5e6e7;height: 34px;" type="text" class="form-control layer-date laydate-icon" id="{{$key}}" name="{{$key}}">
                                    @elseif($item['type'] == 'date')
                                        <input onclick="laydate({format: 'YYYY-MM-DD'})" style="width: auto;border: 1px solid #e5e6e7;height: 34px;" type="text" class="form-control layer-date laydate-icon" id="{{$key}}" name="{{$key}}" @if(isset($item['value']) && !empty($item['value'])) value="{{$item['value']}}" @endif>
                                    @endif
                                        </div>
                                    </div>
                                @endforeach
                                <div class="form-group" style="float: left;overflow: hidden;width: auto; margin: 0px 0px 15px 0px;">
                                    <div class="col-sm-4 col-sm-offset-1" style="width: auto;padding-left: 0px;">
                                        <button id="searchBtn" class="btn btn-primary" type="button">搜索</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @endif
                            <div style="background-color: #F5F5F6;padding: 8px;border: 1px solid #dddddd;border-bottom: 0;">
                                @if(isset($form['button']))
                                    <?php

                                        //判断是否有按钮权限
                                        $authority = session('authority');
                                        foreach($form['button'] as $key=>$url){
                                            if($key == 'customButton'){
                                                foreach($url as $k=>$buttom){
                                                    if(!in_array(explode('?',$buttom['url'])[0],array_values($authority['resources']))){
                                                        unset($form['button'][$key][$k]);
                                                    }
                                                }
                                            }else{
                                                if(!in_array(explode('?',$url)[0],array_values($authority['resources']))){
                                                    unset($form['button'][$key]);
                                                }
                                            }
                                        }
                                    ?>
                                    @foreach ($form['button'] as $key=>$url)
                                        @if($key == 'add')
                                            <a href="{{$url}}" style="margin: 0px;" id="add" class="btn btn-primary" type="button">添加</a>
                                        @elseif($key == 'see')
                                            <button data-url="{{$url}}" style="margin: 0px;" id="see" class="btn btn-primary" type="button">查看</button>
                                        @elseif($key == 'update')
                                            @if(isset($change)&& $change== 'change')
                                            <button data-url="{{$url}}" style="margin: 0px;" id="update" class="btn btn-primary" type="button">审核</button>
                                            @else
                                            <button data-url="{{$url}}" style="margin: 0px;" id="update" class="btn btn-primary" type="button">修改</button>
                                            @endif
                                        @elseif($key == 'varify')
                                            <button data-url="{{$url}}" style="margin: 0px;" id="varify" class="btn btn-primary" type="button">审核</button>
                                            @elseif($key == 'settlement')
                                                <button data-url="{{$url}}" style="margin: 0px;" id="settlement" class="btn btn-primary" type="button">结算</button>
                                            @elseif($key == 'settleOne')
                                                <button data-url="{{$url}}" style="margin: 0px;" id="settleOne" class="btn btn-primary" type="button">一元结算</button>
                                        @elseif($key == 'delete')
                                            <button data-url="{{$url}}" style="margin: 0px;" id="delete" class="btn btn-primary" type="button">删除</button>
                                            @elseif($key == 'start')
                                                <button data-url="{{$url}}" style="margin: 0px;" id="start" class="btn btn-primary" type="button">启用</button>
                                            @elseif($key == 'stop')
                                                <button data-url="{{$url}}" style="margin: 0px;" id="stop" class="btn btn-primary" type="button">禁用</button>
                                        @elseif($key == 'export')
                                            <button data-url="{{$url}}" style="margin: 0px;" id="export" class="btn btn-primary" type="button">导出当前</button>
                                        @elseif($key == 'export_all')
                                            <button data-url="{{$url}}" style="margin: 0px;" id="export_all" class="btn btn-primary" type="button">导出全部</button>
                                        @elseif($key == 'customButton')
                                            @foreach($url as $buttom)
                                                @include($buttom['path'])
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                            <table id="dataTable" style="border-bottom: 0px;">
                                <thead>
                                    <tr>
                                        <th data-align="center" data-field="state" data-checkbox="true"></th>
                                        @foreach ($form['field'] as $key=>$item)
                                            <th data-sortable="true" data-align="center" key="{{$key}}" data-field="{{$key}}">{{$item['text']}}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $.kh.tableList('{{$form['data_url']}}');
        @if(Session::get('error'))
        var data = {};
        data['type'] = 'all';
        data['msg'] = '{{Session::get('error')}}';
        data['status'] = 500;
        $.kh.fromTips(data,3);
        @endif
    })
</script>
</body>
</html>