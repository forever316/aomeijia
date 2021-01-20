<link rel="stylesheet" href="/assets/common/bootstrap-table/bootstrap-table.css">
<script src="/assets/common/bootstrap-table/bootstrap-table.js"></script>
<script src="/assets/common/bootstrap-table/locale/bootstrap-table-zh-CN.js"></script>
<div class="form-group">
    <label class="col-sm-1 control-label">文章选择</label>
    <div class="col-sm-10" style="width: 70%">
        <table id="dataTable"  style="border-bottom: 0px;">

        </table>
        {{--<button style="height: 38px;" class="btn btn-primary" type="button"><i class="fa fa-paste"></i> 选择文章</button>--}}
    </div>
    <script type="text/javascript">
        var $table = $('#dataTable');
        $(function(){
            $table.bootstrapTable({
                url: "/article/ajaxArticleList/3",
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
                        title: 'ID',
                        field: 'id',
                        align: 'center',
                        valign: 'middle',
                        sortable:true
                    },
                    {
                        title: '标题',
                        field: 'title',
                        align: 'center',
                        valign: 'middle'
                    },
                    {
                        title: '描述',
                        field: 'describe'
                    }
                ],
                onClickRow:function(row,tr,field){
                    onClickRow(row,tr,field);
                }
            });
            $("#link").bind("keydown", function() {
                $('#dataTable').bootstrapTable('uncheckAll',{});
            });
            function onClickRow(row,tr,field){
                $("#link").val(row.id);
            }
        });
    </script>
</div>