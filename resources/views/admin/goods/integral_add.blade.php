<!DOCTYPE html>
<html>
<head>
    @include('admin.common.resources')
    <link rel="stylesheet" href="/assets/common/bootstrap-table/bootstrap-table.css">
    <script src="/assets/common/bootstrap-table/bootstrap-table.js"></script>
    <script src="/assets/common/bootstrap-table/locale/bootstrap-table-zh-CN.js"></script>
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
                    <div class="row">
                        <div class="col-sm-6" style="width: 100%;padding-right: 7px;padding-left: 7px;">
                            <div class="tabs-container">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true">手动添加</a>
                                    </li>
                                    <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">从商品中选择</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tab-1" class="tab-pane active">
                                        <div class="panel-body">
                                            <form id="updateForm" method="post" action="/integral/goodsAdd" class="form-horizontal">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="sub_type" value="1">

                                                <div class="form-group">
                                                    <label class="col-sm-1 control-label">商品名称</label>
                                                    <div class="col-sm-10" style="width: 70%">
                                                        <input type="text" class="form-control" id="name" name="name">
                                                    </div>
                                                </div>
                                                <div class="hr-line-dashed"></div>

                                                <div class="form-group">
                                                    <label class="col-sm-1 control-label">所需积分</label>
                                                    <div class="col-sm-10" style="width: 70%">
                                                        <input type="text" class="form-control" id="integral" name="integral">
                                                    </div>
                                                </div>
                                                <div class="hr-line-dashed"></div>

                                                <div class="form-group">
                                                    <label class="col-sm-1 control-label">原始价格</label>
                                                    <div class="col-sm-10" style="width: 70%">
                                                        <input type="text" class="form-control" id="amount" name="amount">
                                                    </div>
                                                </div>
                                                <div class="hr-line-dashed"></div>

                                                <div class="form-group">
                                                    <input type="hidden" name="thumbnail" id="thumbnail_val" />
                                                    <label class="col-sm-1 control-label">缩略图</label>
                                                    <div class="col-sm-10" style="width: 70%" id="thumbnail">
                                                        <div class="uploader-demo">
                                                            <!--用来存放item-->
                                                            <div id="thumbnailList" class="uploader-list"></div>
                                                            <div id="thumbnailPicker">选择图片</div>
                                                        </div>
                                                    </div>
                                                    <script type="text/javascript">
                                                        $(function(){
                                                            var limit = 1,folder='integralGoods';
                                                            $.kh.imgUpload('thumbnail',limit,folder);
                                                        })
                                                    </script>
                                                </div>
                                                <div class="hr-line-dashed"></div>

                                                <div class="form-group">
                                                    <input type="hidden" name="banner_pic" id="banner_pic_val" />
                                                    <input type="hidden" id="banner_pic_val_name" />
                                                    <label class="col-sm-1 control-label">轮播图</label>
                                                    <div class="col-sm-10" style="width: 70%" id="banner_pic">
                                                        <div class="uploader-demo">
                                                            <!--用来存放item-->
                                                            <div id="banner_picList" class="uploader-list"></div>
                                                            <div id="banner_picPicker">选择图片</div>
                                                        </div>
                                                    </div>
                                                    <script type="text/javascript">
                                                        $(function(){
                                                            var limit = 5,folder='integralGoods';
                                                            $.kh.imgUpload('banner_pic',limit,folder);
                                                        })
                                                    </script>
                                                </div>
                                                <div class="hr-line-dashed"></div>

                                                @include('admin.goods.integral_goods_fields')
                                                <div class="hr-line-dashed"></div>

                                                <div class="form-group">
                                                    <label class="col-sm-1 control-label">商品介绍</label>
                                                    <div class="col-sm-10" style="width: 70%">
                                                        <textarea style="height: 500px;" id="article" name="article"></textarea>
                                                    </div>
                                                    <script type="text/javascript">
                                                        $(function(){
                                                            UE.getEditor('article');
                                                        })
                                                    </script>
                                                </div>
                                                <div class="hr-line-dashed"></div>

                                                <div class="form-group">
                                                    <label class="col-sm-1 control-label">上下架</label>
                                                    <div class="col-sm-10" style="width: 70%" id="status">
                                                        <label class="checkbox-inline i-checks">
                                                            <input type="radio" name="status" value="1"> <i></i>上架</label>
                                                        <label class="checkbox-inline i-checks">
                                                            <input type="radio" name="status" value="2"> <i></i>下架</label>
                                                    </div>
                                                </div>
                                                <div class="hr-line-dashed"></div>

                                                <div class="form-group">
                                                    <div class="col-sm-4 col-sm-offset-1">
                                                        <button id="sub1" class="btn btn-primary" type="button">保存内容</button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                    <div id="tab-2" class="tab-pane">
                                        <div class="panel-body">
                                            <form id="updateForm2" method="post" action="" class="form-horizontal">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="sub_type" value="2">
                                                <div class="form-group">
                                                    <label class="col-sm-1 control-label" style="margin-top: 10px;">经销商选择</label>
                                                    <div class="col-sm-10" style="width: 70%">
                                                        <div style="float: left;overflow:hidden;margin-right: 20px;margin-top: 10px;">
                                                            <ul id="tree" class="ztree"></ul>
                                                        </div>
                                                        <div style="overflow:hidden;margin-right: 20px;">
                                                            <table id="dataTable"  style="border-bottom: 0px;">

                                                            </table>
                                                            <input type="hidden" @if(isset($detailData)) value="{{$detailData->distributor_id}}" @endif class="form-control" id="goods_id" name="goods_id" />
                                                            <input type="text" @if(isset($detailData)) value="{{$detailData->distributor}}" @endif class="form-control" id="goods_name" name="goods_name" />
                                                        </div>
                                                    </div>
                                                    <script type="text/javascript">
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
                                                                $table.bootstrapTable('refresh', {url: '/goods/ajaxGoodsList?type_id='+id});
                                                            };
                                                            $.fn.zTree.init($("#tree"), setting);
                                                        });
                                                        var $table = $('#dataTable');
                                                        $(function(){
                                                            $table.bootstrapTable({
                                                                url: "/goods/ajaxGoodsList",
                                                                dataType: "json",
                                                                pagination: true, //分页
                                                                singleSelect: false,
                                                                search: true, //显示搜索框
                                                                sidePagination: "server", //服务端处理分页
                                                                idField:"id",
                                                                queryParamsType:'',
                                                                pageSize:5,
                                                                pageList:[5],
                                                                showPaginationSwitch:false,
                                                                clickToSelect:true,
                                                                singleSelect:true,
                                                                sortOrder:'desc',
                                                                queryParams:function(params){
                                                                    var arr = {};
                                                                    arr.page = params.pageNumber;
                                                                    arr.row = params.pageSize;
                                                                    arr.order = params.sortOrder;
                                                                    arr.sort = params.sortName;
                                                                    arr.title = params.searchText;
                                                                    return arr;
                                                                },
                                                                columns: [

                                                                    {
                                                                        title: 'ID',
                                                                        field: 'id',
                                                                        align: 'center',
                                                                        valign: 'middle'
                                                                    },
                                                                    {
                                                                        title: '商品编号',
                                                                        field: 'number',
                                                                        align: 'center',
                                                                        valign: 'middle'
                                                                    },
                                                                    {
                                                                        title: '商品类型',
                                                                        field: 'type_id',
                                                                        align: 'center',
                                                                        valign: 'middle'
                                                                    },
                                                                    {
                                                                        title: '商品名称',
                                                                        field: 'name',
                                                                        align: 'center',
                                                                        valign: 'middle'
                                                                    },
                                                                    {
                                                                        title: '商品金额',
                                                                        field: 'amount',
                                                                        align: 'center',
                                                                        valign: 'middle'
                                                                    },
                                                                    {
                                                                        title: '是否上架',
                                                                        field: 'status',
                                                                        align: 'center',
                                                                        valign: 'middle'
                                                                    }
                                                                ],
                                                                onClickRow:function(row,tr,field){
                                                                    onClickRow(row,tr,field);
                                                                }
                                                            });
                                                            function onClickRow(row,tr,field){
                                                                $("#goods_id").val(row.id);
                                                                $("#goods_name").val(row.name);
                                                            }
                                                        });
                                                    </script>
                                                </div>
                                                <div class="hr-line-dashed"></div>
                                                <div class="form-group">
                                                    <label class="col-sm-1 control-label">所需积分</label>
                                                    <div class="col-sm-10" style="width: 70%">
                                                        <input type="text" class="form-control" id="integral" name="integral">
                                                    </div>
                                                </div>
                                                <div class="hr-line-dashed"></div>
                                                <div class="form-group">
                                                    <div class="col-sm-4 col-sm-offset-1">
                                                        <button id="sub2" class="btn btn-primary" type="button">保存内容</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    function formSub1(index){
        $("#sub1").on('click',function(){
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
                    $("#sub1").removeClass('disabled');
                    $("#sub1").removeAttr('disabled');
                },
                success: function(data) {
                    layer.close(layerload);
                    $.kh.fromTips(data,2);
                    $("#sub1").removeClass('disabled');
                    $("#sub1").removeAttr('disabled');
                    if(data.status != 500){
                        setTimeout(function (){
                            window.location.href=document.referrer;
                        }, 2000);
                    }
                }
            });
        })
    }

    function formSub2(index){
        $("#sub2").on('click',function(){
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
                    $("#sub2").removeClass('disabled');
                    $("#sub2").removeAttr('disabled');
                },
                success: function(data) {
                    layer.close(layerload);
                    $.kh.fromTips(data,2);
                    $("#sub2").removeClass('disabled');
                    $("#sub2").removeAttr('disabled');
                    if(data.status != 500){
                        setTimeout(function (){
                            window.location.href=document.referrer;
                        }, 2000);
                    }
                }
            });
        })
    }

    $(function(){
        formSub1('updateForm');
        formSub2('updateForm2');
    });
</script>
</body>
</html>