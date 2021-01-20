<!DOCTYPE html>
<html>
<head>
    @include('admin.common.listresources')
    <style>
        .pagination{
            margin: 0px;
            float: right;
        }
    </style>
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
                        </div>
                        @endif
                        <table class="table table-bordered table-condensed">
                            <thead>
                            @if(isset($form['button']))
                            <tr>
                                <td colspan="{{count($form['field'])+1}}">
                                    @foreach ($form['button'] as $key=>$url)
                                        @if($key == 'add')
                                            <a href="{{$url}}" style="margin: 0px;" id="add" class="btn btn-primary" type="button">添加</a>
                                         @elseif($key == 'delete')
                                            <button data-url="{{$url}}" style="margin: 0px;" id="delete1" class="btn btn-primary" type="button">删除</button>
                                        @elseif($key == 'customButton')
                                            @foreach($url as $buttom)
                                                @include($buttom)
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <th key="op">菜单名</th>
                                <th key="op">操作</th>
                            </tr>
                            </thead>
                            <tbody id="table_id">
                            @if(isset($form['array_data']['fmenu']) && $form['array_data']['fmenu'])
                                @foreach ($form['array_data']['fmenu'] as $key=>$item)
                                    <tr class="choice" data-id="{{$item['id']}}">
                                        @foreach ($item as $k=>$v)
                                        @if($k =='name' )
                                                <td><b>{{$v}}</b></td>
                                        @endif
                                        @endforeach
                                        <td>
                                            <a href="/wechatMenu/updateWechatMenu?id={{{$item['id']}}}" style="margin: 0px;" id="upd" data-id="{{$item['id']}}" class="btn btn-primary" type="button">修改</a>
                                        </td>
                                    </tr>
                                    @if(isset($item['cmenu']))
                                     @foreach ($item['cmenu'] as $j=>$p)
                                    <tr class="choice" data-id="{{$p['id']}}">
                                        @foreach ($p as $k=>$v)
                                                 @if($k =='name' )
                                                <td>&nbsp;&nbsp;&nbsp;&nbsp;◆{{$v}}</td>
                                                @endif
                                        @endforeach
                                        <td>
                                            <a href="/wechatMenu/updateWechatMenu?id={{$p['id']}}}" style="margin: 0px;" id="upd" data-id="{{$item['id']}}" class="btn btn-primary" type="button">修改</a>
                                        </td>
                                    </tr>
                                     @endforeach
                                    @endif
                                @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>

                                    {{-- */$i=0;/* --}}
                                    @foreach ($form['search'] as $k=>$v)
                                        {{-- */$search_params[$k]=old($k);/* --}}
                                    @endforeach
                                    <td colspan="{{count($form['field'])+1}}">
                                        <span style="float: left;display: inline-block;padding: 6px 8px 0px 0px;">总共：{{$form['data']->total()}}条数据</span>
                                        {{$form['data']->appends($search_params)->render()}}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $.kh.tableList();
        @if(Session::get('error'))
        var data = {};
        data['type'] = 'all';
        data['msg'] = '{{Session::get('error')}}';
        data['status'] = 500;
        $.kh.fromTips(data,3);
        @endif
    })
    var ids = [];
    //选择
    $("#ibox-content").on("click",'.choice',function(){
        var id = $(this).attr("data-id");
        var index = jQuery.inArray(id,ids);
        if(index == -1){
            ids.push(id);
            $(this).addClass('liAction');
        }else{
            ids.splice(index,1);
            $(this).removeClass('liAction');
        }

    });


    $("#ibox-content").on("click",'#delete1',function(){
        var data = {};
        data['type'] = 'all';
        data['msg'] = '';
        data['status'] = 500;
        alert(ids.length);
        if(ids.length == 0){
            data['msg'] = '请选择要删除的数据！';
            $.kh.fromTips(data,3);
        }else if(ids.length > 0){
            var params_ids = ids.join(',');
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
                    url:'/wechatMenu/deleteWechatMenu',
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
</script>
</body>
</html>