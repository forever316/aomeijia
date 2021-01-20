<button style="margin: 0px;" id="deliverGoodsSet" onclick="deliverGoodsSet()" class="btn btn-primary" type="button">设置为已发货</button>
<script type="text/javascript">
    function deliverGoodsSet(){
        var ids = $('#dataTable').bootstrapTable('getSelections','');
        var data = {};
        data['type'] = 'all';
        data['msg'] = '';
        data['status'] = 500;
        if(ids.length > 1){
            data['msg'] = '一次只能设置一份订单！';
            $.kh.fromTips(data,3);
        }else if(ids.length == 0){
            data['msg'] = '请选择一份要设置的订单！';
            $.kh.fromTips(data,3);
        }else if(ids.length == 1){
            layer.confirm('确定要设置为已发货吗？', {icon: 3, title:'提示'}, function(index){
                var id = ids[0].id;
                var layerload = layer.load(0, {
                    shadeClose:true,
                    shade:[0.3,'#000']
                });
                $("#deliverGoodsSet").addClass('disabled');
                $("#deliverGoodsSet").attr('disabled',true);
                $.ajax({
                    cache: true,
                    type: "POST",
                    url:'/order/deliverGoodsSet',
                    data:{id:id},
                    async: false,
                    dataType: "json",
                    error: function(request) {
                        layer.close(layerload);
                        data['msg'] = '设置失败！';
                        $.kh.fromTips(data,2);
                        $("#deliverGoodsSet").removeClass('disabled');
                        $("#deliverGoodsSet").removeAttr('disabled');
                    },
                    success: function(data) {
                        layer.close(layerload);
                        $.kh.fromTips(data,2);
                        $("#deliverGoodsSet").removeClass('disabled');
                        $("#deliverGoodsSet").removeAttr('disabled');
                        if(data.status != 500){
                            setTimeout(function (){
                                location.replace(location.href);
                            }, 2000);
                        }
                    }
                });
            });
        }
    }
</script>