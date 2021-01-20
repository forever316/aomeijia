<!DOCTYPE html>
<html>
<head>
    @include('admin.common.listresources')
    <link rel="stylesheet" href="/assets/admin/ztree3/css/zTreeStyle/zTreeStyle.css" type="text/css">
    <script type="text/javascript" src="/assets/admin/ztree3/js/jquery.ztree.all.min.js"></script>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{$title}}</h5>
                </div>
                <div class="ibox-content" style="overflow: hidden;">
                    <div style="float: left;overflow:hidden;margin-right: 20px;">
                        <ul id="tree" class="ztree"></ul>
                    </div>
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
                                        <input onclick="laydate({format: 'YYYY-MM-DD'})" style="width: auto;border: 1px solid #e5e6e7;height: 34px;" type="text" class="form-control layer-date laydate-icon" id="{{$key}}" name="{{$key}}">
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
                                            <button data-url="{{$url}}" style="margin: 0px;" id="update" class="btn btn-primary" type="button">修改</button>
                                        @elseif($key == 'varify')
                                            <button data-url="{{$url}}" style="margin: 0px;" id="varify" class="btn btn-primary" type="button">审核</button>
                                        @elseif($key == 'delete')
                                            <button data-url="{{$url}}" style="margin: 0px;" id="delete" class="btn btn-primary" type="button">删除</button>
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
        var setting = {
            async: {
                enable: true,
                url:"/goodsType/ajaxGoodsTypeList"
                ,otherParam: {"status":'1'}
            },
            data:{
                simpleData:{
                    enable: true,
                    idKey: "id",
                    pIdKey: "pid"
                }
            },
            view:{
                showIcon:false,
                selectedMulti: false
            },
            callback: {
                onClick: zTreeOnClick
            }
        };
        function zTreeOnClick(event, treeId, treeNode) {
            var id = treeNode.id;
            var $table = $('#dataTable');
            $table.bootstrapTable('refresh', {url: '{{$form['data_url']}}?type_id='+id});
        };
        $.fn.zTree.init($("#tree"), setting);
    });
    function tableList(dataurl){
        var $table = $('#dataTable');
        $table.bootstrapTable({
            url: dataurl,
            dataType: "json",
            pagination: true,
            singleSelect: false,
            sidePagination: "server",
            idField:"id",
            queryParamsType:'',
            pageSize:10,
            pageList:[10],
            showPaginationSwitch:false,
            clickToSelect:true,
            sortOrder:'desc',
            queryParams:function(params){
                var arr = {};
                arr.page = params.pageNumber;
                arr.row = params.pageSize;
                arr.order = params.sortOrder;
                arr.sort = params.sortName;
                arr.searchText = params.searchText;

                var searchForm = $("#searchForm").serializeArray();
                $.each(searchForm, function(i, field){
                    arr[field.name] = field.value;
                });

                var zTree = $.fn.zTree.getZTreeObj("tree");
                var nodes = zTree.getSelectedNodes();
                if(nodes){
                    $.each(nodes,function(i,obj){
                        arr.type_id = obj.id;
                    });
                }
                return arr;
            }
        });

        $("#searchBtn").click(function(){
            $table.bootstrapTable('refresh', {url: dataurl});
        });

        //更新
        $("#ibox-content").on("click",'#update',function(){
            var ids = $('#dataTable').bootstrapTable('getSelections','');
            var data = {};
            data['type'] = 'all';
            data['msg'] = '';
            data['status'] = 500;
            if(ids.length == 0){
                data['msg'] = '请选择一条要修改的数据！';
            }else if(ids.length > 1){
                data['msg'] = '只能选择一条数据修改！';
            }else if(ids.length == 1){
                var params_ids = ids[0].id;
                var url = $('#update').attr('data-url');
                url = url + '?id=' + params_ids;
                location.href = url;
                return;
            }
            $.kh.fromTips(data,3);
        });

        //审核
        $("#ibox-content").on("click",'#varify',function(){
            var ids = $('#dataTable').bootstrapTable('getSelections','');
            var data = {};
            data['type'] = 'all';
            data['msg'] = '';
            data['status'] = 500;
            if(ids.length == 0){
                data['msg'] = '请选择一条要修改的数据！';
            }else if(ids.length > 1){
                data['msg'] = '只能选择一条数据修改！';
            }else if(ids.length == 1){
                var params_ids = ids[0].id;
                var url = $('#varify').attr('data-url');
                url = url + '?id=' + params_ids;
                location.href = url;
                return;
            }
            $.kh.fromTips(data,3);
        });

        //查看
        $("#ibox-content").on("click",'#see',function(){
            var ids = $('#dataTable').bootstrapTable('getSelections','');
            var data = {};
            data['type'] = 'all';
            data['msg'] = '';
            data['status'] = 500;
            if(ids.length == 0){
                data['msg'] = '请选择一条要查看的数据！';
            }else if(ids.length > 1){
                data['msg'] = '只能选择一条数据查看！';
            }else if(ids.length == 1){
                var params_ids = ids[0].id;
                var url = $('#see').attr('data-url');
                url = url + '?id=' + params_ids;
                layer.open({
                    type: 2,
                    title: '查看详情',
                    shadeClose: true,
                    shade: 0.8,
                    area: ['90%', '90%'],
                    content: url //iframe的url
                });
                return;
            }
            $.kh.fromTips(data,3);
        });

        //删除
        $("#ibox-content").on("click",'#delete',function(){
            var ids = $('#dataTable').bootstrapTable('getSelections','');
            var data = {};
            data['type'] = 'all';
            data['msg'] = '';
            data['status'] = 500;
            if(ids.length == 0){
                data['msg'] = '请选择要删除的数据！';
                $.kh.fromTips(data,3);
            }else if(ids.length > 0){
                var arrID = [];
                $.each(ids, function(name, value) {
                    arrID.push(value.id);
                });
                var params_ids = arrID.join(',');
                layer.confirm('确定删除这些数据?', {icon: 3, title:'提示'}, function(index){
                    layer.close(index);
                    var layerload = layer.load(0, {
                        shadeClose:true,
                        shade:[0.3,'#000']
                    });
                    $("#delete").addClass('disabled');
                    $("#delete").attr('disabled',true);
                    $.ajax({
                        cache: true,
                        type: "POST",
                        url:$('#delete').attr('data-url'),
                        data:{ids:params_ids},
                        async: false,
                        dataType: "json",
                        error: function(request) {
                            layer.close(layerload);
                            data['msg'] = '删除失败！';
                            $.kh.fromTips(data,2);
                            $("#delete").removeClass('disabled');
                            $("#delete").removeAttr('disabled');
                        },
                        success: function(data) {
                            layer.close(layerload);
                            $.kh.fromTips(data,2);
                            $("#delete").removeClass('disabled');
                            $("#delete").removeAttr('disabled');
                            if(data.status != 500){
                                setTimeout(function (){
                                    location.replace(location.href);
                                }, 2000);
                            }
                        }
                    });
                });
            }
        });
    }
    $(function(){
        tableList('{{$form['data_url']}}');
        @if(Session::get('error'))
        var data = {};
        data['type'] = 'all';
        data['msg'] = '{{Session::get('error')}}';
        data['status'] = 500;
        $.kh.fromTips(data,3);
        @endif
    });
</script>
</body>
</html>