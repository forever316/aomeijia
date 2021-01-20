<link rel="stylesheet" href="/assets/common/bootstrap-table/bootstrap-table.css">
<script src="/assets/common/bootstrap-table/bootstrap-table.js"></script>
<script src="/assets/common/bootstrap-table/locale/bootstrap-table-zh-CN.js"></script>
<div class="tongji" style="    margin-left: 35%;">
    <button  class="btn btn-primary" type="button">累计销售额:{{$detailData['xiaoshuo']}}元</button>
    <button  class="btn btn-primary" type="button">累计广告费:{{$detailData['guanggao']}}元</button>
    <button  class="btn btn-primary" type="button">今日营业额:{{$detailData['today']}}元</button>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label">销售额明细</label>
    <div class="col-sm-10" style="width: 70%">
        <table id="tenderTable"  style="border-bottom: 0px;">

        </table>
        {{--<button style="height: 38px;" class="btn btn-primary" type="button"><i class="fa fa-paste"></i> 选择文章</button>--}}
    </div>
    <script type="text/javascript">
        var $table = $('#tenderTable');
        $(function(){
            $table.bootstrapTable({
                url: "/storeOrder?store_id={{$detailData->id}}",
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
                        title: '订单编号',
                        field: 'order_sn',
                        align: 'center',
                        valign: 'middle',
                        sortable:true
                    },
                    {
                        title: '总价格',
                        field: 'goods_amount',
                        align: 'center',
                        valign: 'middle'
                    },
                    {
                        title: '宝分支付',
                        field: 'yuanbao_paid',
                        align: 'center',
                        valign: 'middle'
                    },
                    {
                        title: '付款金额',
                        field: 'money_paid',
                        align: 'center',
                        valign: 'middle'
                    },
                    {
                        title: '广告费',
                        field: 'plate_amount',
                        align: 'center',
                        valign: 'middle'
                    },

                    {
                        title: '订单生成时间',
                        field: 'add_time',
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
