<link rel="stylesheet" href="/assets/common/bootstrap-table/bootstrap-table.css">
<script src="/assets/common/bootstrap-table/bootstrap-table.js"></script>
<script src="/assets/common/bootstrap-table/locale/bootstrap-table-zh-CN.js"></script>
<style>
    .form-group{
        margin-bottom: 0px;
        overflow: hidden;
    }
</style>
<div class="form-group">
    <label class="col-sm-1 control-label">模块内容</label>
    <div class="col-sm-10" style="width: 70%">
        <div class="tabs-container">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true">第一模块</a>
                </li>
                {{--<li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">第二模块</a>--}}
                {{--</li>--}}
                {{--<li class=""><a data-toggle="tab" href="#tab-3" aria-expanded="false">第三模块</a>--}}
                {{--</li>--}}
                {{--<li class=""><a data-toggle="tab" href="#tab-4" aria-expanded="false">第四模块</a>--}}
                {{--</li>--}}
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <div class="panel-body">
                        <div style="overflow:hidden;">
                            <label>图片：</label><br/>
                            <input type="hidden" name="img1" id="img1_val" />
                            <div style="width: 70%" id="img1">
                                <div class="uploader-demo">
                                    <!--用来存放item-->
                                    <div id="img1List" class="uploader-list"></div>
                                    <div id="img1Picker">选择图片</div>
                                </div>
                            </div>
                            <script type="text/javascript">
                                $(function(){
                                    var limit = 1,folder='homeModularC';
                                    $.kh.imgUpload('img1',limit,folder);
                                })
                            </script>
                        </div><br/>
                        <div style="overflow:hidden;">
                            <label>商品选择：</label>
                            <div style="overflow: hidden;">
                                <div style="float: left;overflow:hidden;margin-right: 20px;">
                                    <ul id="tree" class="ztree"></ul>
                                </div>
                                <div style="overflow:hidden;" id="value">
                                    <table id="dataTable"  style="border-bottom: 0px;" >

                                    </table>
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

                                        var t = 0;
                                        $(".list [type='hidden']").each(function(i,n){
                                            if(row.id == $(this).val()){
                                                t=1;
                                            }
                                        })
                                        if(t==0){
                                            $("#value").append( " <div class='list'><input type='hidden' class='form-control' class='goods_id' name='goods_id[]' value='"+row.id+"'/> <input type='text' style='width: 30%;display: inline;' class='form-control' class='goods_name' name='goods_name' value='"+row.name+"'/><button  class='btn btn-primary del' type='button'>删除</button></div>");
                                        }
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>
                {{--<div id="tab-2" class="tab-pane">--}}
                    {{--<div class="panel-body">--}}
                        {{--<div style="overflow:hidden;">--}}
                            {{--<label>图片：</label><br/>--}}
                            {{--<input type="hidden" name="img2" id="img2_val" />--}}
                            {{--<div id="img2">--}}
                                {{--<div class="uploader-demo">--}}
                                    {{--<!--用来存放item-->--}}
                                    {{--<div id="img2List" class="uploader-list"></div>--}}
                                    {{--<div id="img2Picker">选择图片</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div><br/>--}}
                        {{--<div style="overflow:hidden;">--}}
                            {{--<label>商品选择：</label>--}}
                            {{--<div style="overflow: hidden;">--}}
                                {{--<div style="float: left;overflow:hidden;margin-right: 20px;">--}}
                                    {{--<ul id="tree2" class="ztree"></ul>--}}
                                {{--</div>--}}
                                {{--<div style="overflow:hidden;">--}}
                                    {{--<table id="dataTable2"  style="border-bottom: 0px;">--}}

                                    {{--</table>--}}
                                    {{--<input type="hidden" class="form-control" id="goods_id2" name="goods_id2" />--}}
                                    {{--<input type="text" class="form-control" id="goods_name2" name="goods_name2" />--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<script type="text/javascript">--}}
                                {{--$(function(){--}}
                                    {{--var setting = {--}}
                                        {{--async: {--}}
                                            {{--enable: true,--}}
                                            {{--url:"/goodsType/ajaxGoodsTypeList"--}}
                                            {{--,otherParam: {"status":'1'}--}}
                                        {{--},--}}
                                        {{--data:{--}}
                                            {{--simpleData:{--}}
                                                {{--enable: true,--}}
                                                {{--idKey: "id",--}}
                                                {{--pIdKey: "pid"--}}
                                            {{--}--}}
                                        {{--},--}}
                                        {{--view:{--}}
                                            {{--showIcon:false,--}}
                                            {{--selectedMulti: false--}}
                                        {{--},--}}
                                        {{--callback: {--}}
                                            {{--onClick: zTreeOnClick--}}
                                        {{--}--}}
                                    {{--};--}}
                                    {{--function zTreeOnClick(event, treeId, treeNode) {--}}
                                        {{--var id = treeNode.id;--}}
                                        {{--var $table = $('#dataTable2');--}}
                                        {{--$table.bootstrapTable('refresh', {url: '/goods/ajaxGoodsList?type_id='+id});--}}
                                    {{--};--}}
                                    {{--$.fn.zTree.init($("#tree2"), setting);--}}
                                {{--});--}}
                                {{--var $table2 = $('#dataTable2');--}}
                                {{--$(function(){--}}
                                    {{--$table2.bootstrapTable({--}}
                                        {{--url: "/goods/ajaxGoodsList",--}}
                                        {{--dataType: "json",--}}
                                        {{--pagination: true, //分页--}}
                                        {{--singleSelect: false,--}}
                                        {{--search: true, //显示搜索框--}}
                                        {{--sidePagination: "server", //服务端处理分页--}}
                                        {{--idField:"id",--}}
                                        {{--queryParamsType:'',--}}
                                        {{--pageSize:5,--}}
                                        {{--pageList:[5],--}}
                                        {{--showPaginationSwitch:false,--}}
                                        {{--clickToSelect:true,--}}
                                        {{--singleSelect:true,--}}
                                        {{--sortOrder:'desc',--}}
                                        {{--queryParams:function(params){--}}
                                            {{--var arr = {};--}}
                                            {{--arr.page = params.pageNumber;--}}
                                            {{--arr.row = params.pageSize;--}}
                                            {{--arr.order = params.sortOrder;--}}
                                            {{--arr.sort = params.sortName;--}}
                                            {{--arr.title = params.searchText;--}}
                                            {{--return arr;--}}
                                        {{--},--}}
                                        {{--columns: [--}}

                                            {{--{--}}
                                                {{--title: 'ID',--}}
                                                {{--field: 'id',--}}
                                                {{--align: 'center',--}}
                                                {{--valign: 'middle'--}}
                                            {{--},--}}
                                            {{--{--}}
                                                {{--title: '商品编号',--}}
                                                {{--field: 'number',--}}
                                                {{--align: 'center',--}}
                                                {{--valign: 'middle'--}}
                                            {{--},--}}
                                            {{--{--}}
                                                {{--title: '商品类型',--}}
                                                {{--field: 'type_id',--}}
                                                {{--align: 'center',--}}
                                                {{--valign: 'middle'--}}
                                            {{--},--}}
                                            {{--{--}}
                                                {{--title: '商品名称',--}}
                                                {{--field: 'name',--}}
                                                {{--align: 'center',--}}
                                                {{--valign: 'middle'--}}
                                            {{--},--}}
                                            {{--{--}}
                                                {{--title: '商品金额',--}}
                                                {{--field: 'amount',--}}
                                                {{--align: 'center',--}}
                                                {{--valign: 'middle'--}}
                                            {{--},--}}
                                            {{--{--}}
                                                {{--title: '是否上架',--}}
                                                {{--field: 'status',--}}
                                                {{--align: 'center',--}}
                                                {{--valign: 'middle'--}}
                                            {{--}--}}
                                        {{--],--}}
                                        {{--onClickRow:function(row,tr,field){--}}
                                            {{--onClickRow(row,tr,field);--}}
                                        {{--}--}}
                                    {{--});--}}
                                    {{--function onClickRow(row,tr,field){--}}
                                        {{--$("#goods_id2").val(row.id);--}}
                                        {{--$("#goods_name2").val(row.name);--}}
                                    {{--}--}}
                                {{--});--}}
                            {{--</script>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div id="tab-3" class="tab-pane">--}}
                    {{--<div class="panel-body">--}}
                        {{--<div style="overflow:hidden;">--}}
                            {{--<label>图片：</label><br/>--}}
                            {{--<input type="hidden" name="img3" id="img3_val" />--}}
                            {{--<div id="img3">--}}
                                {{--<div class="uploader-demo">--}}
                                    {{--<!--用来存放item-->--}}
                                    {{--<div id="img3List" class="uploader-list"></div>--}}
                                    {{--<div id="img3Picker">选择图片</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div><br/>--}}
                        {{--<div style="overflow:hidden;">--}}
                            {{--<label>商品选择：</label>--}}
                            {{--<div style="overflow: hidden;">--}}
                                {{--<div style="float: left;overflow:hidden;margin-right: 20px;">--}}
                                    {{--<ul id="tree3" class="ztree"></ul>--}}
                                {{--</div>--}}
                                {{--<div style="overflow:hidden;">--}}
                                    {{--<table id="dataTable3"  style="border-bottom: 0px;">--}}

                                    {{--</table>--}}
                                    {{--<input type="hidden" class="form-control" id="goods_id3" name="goods_id3" />--}}
                                    {{--<input type="text" class="form-control" id="goods_name3" name="goods_name3" />--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<script type="text/javascript">--}}
                                {{--$(function(){--}}
                                    {{--var setting = {--}}
                                        {{--async: {--}}
                                            {{--enable: true,--}}
                                            {{--url:"/goodsType/ajaxGoodsTypeList"--}}
                                            {{--,otherParam: {"status":'1'}--}}
                                        {{--},--}}
                                        {{--data:{--}}
                                            {{--simpleData:{--}}
                                                {{--enable: true,--}}
                                                {{--idKey: "id",--}}
                                                {{--pIdKey: "pid"--}}
                                            {{--}--}}
                                        {{--},--}}
                                        {{--view:{--}}
                                            {{--showIcon:false,--}}
                                            {{--selectedMulti: false--}}
                                        {{--},--}}
                                        {{--callback: {--}}
                                            {{--onClick: zTreeOnClick--}}
                                        {{--}--}}
                                    {{--};--}}
                                    {{--function zTreeOnClick(event, treeId, treeNode) {--}}
                                        {{--var id = treeNode.id;--}}
                                        {{--var $table = $('#dataTable3');--}}
                                        {{--$table.bootstrapTable('refresh', {url: '/goods/ajaxGoodsList?type_id='+id});--}}
                                    {{--};--}}
                                    {{--$.fn.zTree.init($("#tree3"), setting);--}}
                                {{--});--}}
                                {{--var $table3 = $('#dataTable3');--}}
                                {{--$(function(){--}}
                                    {{--$table3.bootstrapTable({--}}
                                        {{--url: "/goods/ajaxGoodsList",--}}
                                        {{--dataType: "json",--}}
                                        {{--pagination: true, //分页--}}
                                        {{--singleSelect: false,--}}
                                        {{--search: true, //显示搜索框--}}
                                        {{--sidePagination: "server", //服务端处理分页--}}
                                        {{--idField:"id",--}}
                                        {{--queryParamsType:'',--}}
                                        {{--pageSize:5,--}}
                                        {{--pageList:[5],--}}
                                        {{--showPaginationSwitch:false,--}}
                                        {{--clickToSelect:true,--}}
                                        {{--singleSelect:true,--}}
                                        {{--sortOrder:'desc',--}}
                                        {{--queryParams:function(params){--}}
                                            {{--var arr = {};--}}
                                            {{--arr.page = params.pageNumber;--}}
                                            {{--arr.row = params.pageSize;--}}
                                            {{--arr.order = params.sortOrder;--}}
                                            {{--arr.sort = params.sortName;--}}
                                            {{--arr.title = params.searchText;--}}
                                            {{--return arr;--}}
                                        {{--},--}}
                                        {{--columns: [--}}

                                            {{--{--}}
                                                {{--title: 'ID',--}}
                                                {{--field: 'id',--}}
                                                {{--align: 'center',--}}
                                                {{--valign: 'middle'--}}
                                            {{--},--}}
                                            {{--{--}}
                                                {{--title: '商品编号',--}}
                                                {{--field: 'number',--}}
                                                {{--align: 'center',--}}
                                                {{--valign: 'middle'--}}
                                            {{--},--}}
                                            {{--{--}}
                                                {{--title: '商品类型',--}}
                                                {{--field: 'type_id',--}}
                                                {{--align: 'center',--}}
                                                {{--valign: 'middle'--}}
                                            {{--},--}}
                                            {{--{--}}
                                                {{--title: '商品名称',--}}
                                                {{--field: 'name',--}}
                                                {{--align: 'center',--}}
                                                {{--valign: 'middle'--}}
                                            {{--},--}}
                                            {{--{--}}
                                                {{--title: '商品金额',--}}
                                                {{--field: 'amount',--}}
                                                {{--align: 'center',--}}
                                                {{--valign: 'middle'--}}
                                            {{--},--}}
                                            {{--{--}}
                                                {{--title: '是否上架',--}}
                                                {{--field: 'status',--}}
                                                {{--align: 'center',--}}
                                                {{--valign: 'middle'--}}
                                            {{--}--}}
                                        {{--],--}}
                                        {{--onClickRow:function(row,tr,field){--}}
                                            {{--onClickRow(row,tr,field);--}}
                                        {{--}--}}
                                    {{--});--}}
                                    {{--function onClickRow(row,tr,field){--}}
                                        {{--$("#goods_id3").val(row.id);--}}
                                        {{--$("#goods_name3").val(row.name);--}}
                                    {{--}--}}
                                {{--});--}}
                            {{--</script>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div id="tab-4" class="tab-pane">--}}
                    {{--<div class="panel-body">--}}
                        {{--<div style="overflow:hidden;">--}}
                            {{--<label>图片：</label><br/>--}}
                            {{--<input type="hidden" name="img4" id="img4_val" />--}}
                            {{--<div id="img4">--}}
                                {{--<div class="uploader-demo">--}}
                                    {{--<!--用来存放item-->--}}
                                    {{--<div id="img4List" class="uploader-list"></div>--}}
                                    {{--<div id="img4Picker">选择图片</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div><br/>--}}
                        {{--<div style="overflow:hidden;">--}}
                            {{--<label>商品选择：</label>--}}
                            {{--<div style="overflow: hidden;">--}}
                                {{--<div style="float: left;overflow:hidden;margin-right: 20px;">--}}
                                    {{--<ul id="tree4" class="ztree"></ul>--}}
                                {{--</div>--}}
                                {{--<div style="overflow:hidden;">--}}
                                    {{--<table id="dataTable4"  style="border-bottom: 0px;">--}}

                                    {{--</table>--}}
                                    {{--<input type="hidden" class="form-control" id="goods_id4" name="goods_id4" />--}}
                                    {{--<input type="text" class="form-control" id="goods_name4" name="goods_name4" />--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<script type="text/javascript">--}}
                                {{--$(function(){--}}
                                    {{--var setting = {--}}
                                        {{--async: {--}}
                                            {{--enable: true,--}}
                                            {{--url:"/goodsType/ajaxGoodsTypeList"--}}
                                            {{--,otherParam: {"status":'1'}--}}
                                        {{--},--}}
                                        {{--data:{--}}
                                            {{--simpleData:{--}}
                                                {{--enable: true,--}}
                                                {{--idKey: "id",--}}
                                                {{--pIdKey: "pid"--}}
                                            {{--}--}}
                                        {{--},--}}
                                        {{--view:{--}}
                                            {{--showIcon:false,--}}
                                            {{--selectedMulti: false--}}
                                        {{--},--}}
                                        {{--callback: {--}}
                                            {{--onClick: zTreeOnClick--}}
                                        {{--}--}}
                                    {{--};--}}
                                    {{--function zTreeOnClick(event, treeId, treeNode) {--}}
                                        {{--var id = treeNode.id;--}}
                                        {{--var $table = $('#dataTable4');--}}
                                        {{--$table.bootstrapTable('refresh', {url: '/goods/ajaxGoodsList?type_id='+id});--}}
                                    {{--};--}}
                                    {{--$.fn.zTree.init($("#tree4"), setting);--}}
                                {{--});--}}
                                {{--var $table4 = $('#dataTable4');--}}
                                {{--$(function(){--}}
                                    {{--$table4.bootstrapTable({--}}
                                        {{--url: "/goods/ajaxGoodsList",--}}
                                        {{--dataType: "json",--}}
                                        {{--pagination: true, //分页--}}
                                        {{--singleSelect: false,--}}
                                        {{--search: true, //显示搜索框--}}
                                        {{--sidePagination: "server", //服务端处理分页--}}
                                        {{--idField:"id",--}}
                                        {{--queryParamsType:'',--}}
                                        {{--pageSize:5,--}}
                                        {{--pageList:[5],--}}
                                        {{--showPaginationSwitch:false,--}}
                                        {{--clickToSelect:true,--}}
                                        {{--singleSelect:true,--}}
                                        {{--sortOrder:'desc',--}}
                                        {{--queryParams:function(params){--}}
                                            {{--var arr = {};--}}
                                            {{--arr.page = params.pageNumber;--}}
                                            {{--arr.row = params.pageSize;--}}
                                            {{--arr.order = params.sortOrder;--}}
                                            {{--arr.sort = params.sortName;--}}
                                            {{--arr.title = params.searchText;--}}
                                            {{--return arr;--}}
                                        {{--},--}}
                                        {{--columns: [--}}

                                            {{--{--}}
                                                {{--title: 'ID',--}}
                                                {{--field: 'id',--}}
                                                {{--align: 'center',--}}
                                                {{--valign: 'middle'--}}
                                            {{--},--}}
                                            {{--{--}}
                                                {{--title: '商品编号',--}}
                                                {{--field: 'number',--}}
                                                {{--align: 'center',--}}
                                                {{--valign: 'middle'--}}
                                            {{--},--}}
                                            {{--{--}}
                                                {{--title: '商品类型',--}}
                                                {{--field: 'type_id',--}}
                                                {{--align: 'center',--}}
                                                {{--valign: 'middle'--}}
                                            {{--},--}}
                                            {{--{--}}
                                                {{--title: '商品名称',--}}
                                                {{--field: 'name',--}}
                                                {{--align: 'center',--}}
                                                {{--valign: 'middle'--}}
                                            {{--},--}}
                                            {{--{--}}
                                                {{--title: '商品金额',--}}
                                                {{--field: 'amount',--}}
                                                {{--align: 'center',--}}
                                                {{--valign: 'middle'--}}
                                            {{--},--}}
                                            {{--{--}}
                                                {{--title: '是否上架',--}}
                                                {{--field: 'status',--}}
                                                {{--align: 'center',--}}
                                                {{--valign: 'middle'--}}
                                            {{--}--}}
                                        {{--],--}}
                                        {{--onClickRow:function(row,tr,field){--}}
                                            {{--onClickRow(row,tr,field);--}}
                                        {{--}--}}
                                    {{--});--}}
                                    {{--function onClickRow(row,tr,field){--}}
                                        {{--$("#goods_id4").val(row.id);--}}
                                        {{--$("#goods_name4").val(row.name);--}}
                                    {{--}--}}
                                {{--});--}}
                            {{--</script>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
</div>
<script>
    $('#modular_type_content .i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green'
    });
    var q = 0, w = 0, t = 0,r = 0;
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        if(e.target.text == '第二模块'){
            if(q == 0){
                $.kh.imgUpload('img2',1,'homeModularC');
                q = 1;
            }
        }
        if(e.target.text == '第三模块'){
            if(w == 0){
                $.kh.imgUpload('img3',1,'homeModularC');
                w = 1;
            }
        }
        if(e.target.text == '第四模块'){
            if(t == 0){
                $.kh.imgUpload('img4',1,'homeModularC');
                t = 1;
            }
        }
    })
    $("#value").on("click", ".del", function() {
        $(this).parent('.list').remove();
    });
</script>