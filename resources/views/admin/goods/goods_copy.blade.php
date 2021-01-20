<button style="margin: 0px;" id="goodsCopy" onclick="goodsCopy()" class="btn btn-primary" type="button">批量复制</button>
<script type="text/javascript">
    function goodsCopy(){
        var ids = $('#dataTable').bootstrapTable('getSelections','');
        var data = {};
        data['type'] = 'all';
        data['msg'] = '';
        data['status'] = 500;
        if(ids.length > 1){
            data['msg'] = '一次只能复制一种商品！';
            $.kh.fromTips(data,3);
        }else if(ids.length == 0){
            data['msg'] = '请选择一种商品！';
            $.kh.fromTips(data,3);
        }else if(ids.length == 1){
            var id = ids[0].id;
            layer.open({
                type: 2,
                title: '复制商品',
                shadeClose: true,
                shade: 0.8,
                area: ['90%', '90%'],
                content: "/goods/goodsCopy?id="+id,
                end: function () {
                    var $table = $('#dataTable');
                    $table.bootstrapTable('refresh');
                }
            });
        }
    }
    function closeLayer(){
        layer.closeAll();
    }
</script>