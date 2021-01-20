<link rel="stylesheet" href="/assets/common/bootstrap-table/bootstrap-table.css">
<script src="/assets/common/bootstrap-table/bootstrap-table.js"></script>
<script src="/assets/common/bootstrap-table/locale/bootstrap-table-zh-CN.js"></script>
<div class="form-group">
    <label class="col-sm-1 control-label">商品信息</label>
    <div class="col-sm-10" style="width: 70%">
        <table id="tenderTable"  style="border-bottom: 0px;">

        </table>
        {{--<button style="height: 38px;" class="btn btn-primary" type="button"><i class="fa fa-paste"></i> 选择文章</button>--}}
    </div>
    <script type="text/javascript">
        var $table = $('#tenderTable');
        $(function(){
            $table.bootstrapTable({
                url: "/order/goodList?id={{$detailData->id}}",
                dataType: "json",
                pagination: true, //分页
                singleSelect: false,
                search: false, //显示搜索框
                sidePagination: "server", //服务端处理分页
                idField:"id",
                queryParamsType:'',
                pageSize:10,
                pageList:[10],
                showPaginationSwitch:false,
                clickToSelect:false,
                singleSelect:true,
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
                        field: 'state',
                        checkbox: true

                    },
                    {
                        title: '商品名称',
                        field: 'goods_name',
                        align: 'center',
                        valign: 'middle',
                        sortable:true
                    },
//                    {
//                        title: '商品编号',
//                        field: 'goods_sn',
//                        align: 'center',
//                        valign: 'middle'
//                    },
                    {
                        title: '商品价格',
                        field: 'goods_price',
                        align: 'center',
                        valign: 'middle'
                    },
                    {
                        title: '数量',
                        field: 'goods_number',
                        align: 'center',
                        valign: 'middle'
                    },
                    {
                        title: '属性',
                        field: 'goods_attr',
                        align: 'center',
                        valign: 'middle'
                    },
                    {
                        title: '小计',
                        field: 'all_amount',
                        align: 'center',
                        valign: 'middle'
                    },
                ],

            });
        });
        {{--$("#tenderTable").on("click",'.tender',function(){--}}
            {{--var tender_id = $(this).attr('data-id');--}}
            {{--layer.confirm('确定选中这个标?', {icon: 3, title:'提示'}, function(index){--}}
                {{--layer.close(index);--}}
                {{--var layerload = layer.load(0, {--}}
                    {{--shadeClose:true,--}}
                    {{--shade:[0.3,'#000']--}}
                {{--});--}}
                {{--$.ajax({--}}
                    {{--cache: true,--}}
                    {{--type: "POST",--}}
                    {{--url:'/logistics/tonedTender',--}}
                    {{--data:{--}}
                        {{--id:tender_id,--}}
                        {{--order:{{$detailData->logistics_num}},--}}
                    {{--},--}}
                    {{--async: false,--}}
                    {{--dataType: "json",--}}
                    {{--error: function(request) {--}}
                        {{--layer.close(layerload);--}}
                        {{--var data = {};--}}
                        {{--data['msg'] = '提交失败！';--}}
                        {{--data['status'] = 500;--}}
                        {{--data['type'] = 'all';--}}
                        {{--$.kh.fromTips(data,2);--}}
                        {{--return false;--}}
                    {{--},--}}
                    {{--success: function(data) {--}}
                        {{--layer.close(layerload);--}}
                        {{--if(data.status != 500){--}}
                            {{--var data = {};--}}
                            {{--data['msg'] = '操作成功！';--}}
                            {{--data['status'] = 200;--}}
                            {{--data['type'] = 'all';--}}
                            {{--$.kh.fromTips(data,2);--}}
                            {{--setTimeout(function (){--}}
                                {{--location.reload();--}}
                            {{--}, 1000);--}}
                        {{--}else {--}}
                            {{--var data = {};--}}
                            {{--data['msg'] = '提交失败！';--}}
                            {{--data['status'] = 500;--}}
                            {{--data['type'] = 'all';--}}
                            {{--$.kh.fromTips(data,2);--}}
                            {{--return false;--}}
                        {{--}--}}
                    {{--}--}}
                {{--});--}}
            {{--});--}}

        {{--});--}}

        {{--$("#tenderTable").on("click",'.zuofei',function(){--}}
            {{--var zuofei_id = $(this).attr('data-id');--}}
            {{--$.ajax({--}}
                {{--cache: true,--}}
                {{--type: "POST",--}}
                {{--url:'/logistics/invalidTender',--}}
                {{--data:{--}}
                    {{--id:zuofei_id--}}
                {{--},--}}
                {{--async: false,--}}
                {{--dataType: "json",--}}
                {{--error: function(request) {--}}
                    {{--layer.close(layerload);--}}
                    {{--var data = {};--}}
                    {{--data['msg'] = '提交失败！';--}}
                    {{--data['status'] = 500;--}}
                    {{--data['type'] = 'all';--}}
                    {{--$.kh.fromTips(data,2);--}}
                    {{--return false;--}}
                {{--},--}}
                {{--success: function(data) {--}}
                    {{--$table.bootstrapTable('refresh', {url: "/logistics/tenderList?orders={{$detailData->logistics_num}}"});--}}
                {{--}--}}
            {{--});--}}
        {{--});--}}
    </script>

</div>