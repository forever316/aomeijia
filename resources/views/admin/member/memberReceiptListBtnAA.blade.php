<button style="margin: 0px;" id="wechatMemberReceiptListAA" onclick="wechatMemberReceiptListAA()" class="btn btn-primary" type="button">审核</button>
<script type="text/javascript">
    function wechatMemberReceiptListAA(){
        var ids = $('#dataTable').bootstrapTable('getSelections','');
        var data = {};
        data['type'] = 'all';
        data['msg'] = '';
        data['status'] = 500;
        if(ids.length == 0){
            data['msg'] = '请选择要查看的用户！';
        }else if(ids.length > 1){
            data['msg'] = '只能选择一个用户！';
        }else if(ids.length == 1){
            var params_ids = ids[0].id;
            var url = '/finance/integralWithdrawalsAudit';
            url = url + '?id=' + params_ids;
            layer.open({
                type: 2,
                title: '宝分审核',
                shadeClose: true,
                shade: 0.8,
                area: ['90%', '90%'],
                content: url //iframe的url
            });
            return;
        }
        $.kh.fromTips(data,3);
    }
</script>