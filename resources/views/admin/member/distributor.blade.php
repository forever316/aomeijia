<link rel="stylesheet" href="/assets/common/bootstrap-table/bootstrap-table.css">
<script src="/assets/common/bootstrap-table/bootstrap-table.js"></script>
<script src="/assets/common/bootstrap-table/locale/bootstrap-table-zh-CN.js"></script>
<div class="form-group">
    <label class="col-sm-1 control-label">经销商选择</label>
    <div class="col-sm-10" style="width: 70%">
        <table id="dataTable"  style="border-bottom: 0px;">

        </table>
        <input type="hidden" @if(isset($detailData)) value="{{$detailData->distributor_id}}" @endif class="form-control" id="distributor_id" name="distributor_id" />
        <input type="text" @if(isset($detailData)) value="{{$detailData->distributor}}" @endif class="form-control" id="distributor" name="distributor" />
        {{--<button style="height: 38px;" class="btn btn-primary" type="button"><i class="fa fa-paste"></i> 选择文章</button>--}}
    </div>
    <script type="text/javascript">
        var $table = $('#dataTable');
        $(function(){
            $table.bootstrapTable({
                url: "/member/ajaxDistributorList",
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
                        title: '编号',
                        field: 'id',
                        align: 'center',
                        valign: 'middle',
                        sortable:true
                    },
                    {
                        title: '经销商名称',
                        field: 'nickname',
                        align: 'center',
                        valign: 'middle'
                    },
                    {
                        title: '地区',
                        field: 'city',
                        align: 'center',
                        valign: 'middle'
                    }
                ],
                onClickRow:function(row,tr,field){
                    onClickRow(row,tr,field);
                }
            });
            function onClickRow(row,tr,field){
                $("#distributor_id").val(row.id);
                $("#distributor").val(row.nickname);
            }
        });
    </script>
</div>