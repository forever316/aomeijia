<link rel="stylesheet" href="/assets/common/bootstrap-table/bootstrap-table.css">
<script src="/assets/common/bootstrap-table/bootstrap-table.js"></script>
<script src="/assets/common/bootstrap-table/locale/bootstrap-table-zh-CN.js"></script>
<style>
    .form-group{
        margin-bottom: 0px;
        overflow: hidden;
    }
</style>
<input type="hidden" class="form-control" id="modular_type" name="modular_type" value="modular_type2" />
<div class="form-group">
    <label class="col-sm-1 control-label">模块参考图</label>
    <div class="col-sm-10" style="width: 70%">
        <img src="/assets/admin/img/5.png" width="20%" height="20%" />
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    <label class="col-sm-1 control-label">模块内容</label>
    <div class="col-sm-10" style="width: 70%">
        <div class="tabs-container">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true">第一模块</a>
                </li>
                {{--<li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">第二模块</a>--}}
                {{--</li>--}}
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <div class="panel-body">
                        <div style="overflow:hidden;">
                            <label>图片：</label><br/>
                            <input type="hidden" name="img1" id="img1_val" @if(isset($homeModularContentList)) value="{{$homeModularContentList['img']}}" @endif />
                            <div style="width: 70%" id="img1">
                                @if(isset($homeModularContentList))
                                    <div id="img1layer-photos" class="layer-photos-demo" style="overflow:hidden;">
                                        <div class="l" id="img1_1">
                                            <div class="delImg"><span class="cancel" onclick="delImg('{{$homeModularContentList['img']}}','img1','img1_1')">删除</span></div>
                                            <img layer-pid="" layer-src="/{{$homeModularContentList['img']}}" src="/{{$homeModularContentList['img']}}" />
                                        </div>
                                    </div>
                                @endif
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
                                    $.kh.photos('img1layer-photos');
                                })
                            </script>
                        </div><br/>
                        <div style="overflow:hidden;">
                            <label>商品选择：</label>
                            <div style="overflow: hidden;">
                                <div style="float: left;overflow:hidden;margin-right: 20px;">
                                    <ul id="tree" class="ztree"></ul>
                                </div>
                                <div style="overflow:hidden;">
                                    <table id="dataTable"  style="border-bottom: 0px;">

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
                                            console.log($(this).val());
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
                $.kh.photos('img2layer-photos');
                q = 1;
            }
        }
    })
</script>