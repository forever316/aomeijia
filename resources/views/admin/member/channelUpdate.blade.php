<button style="margin: 0px;" id="channelUpdate" onclick="channelUpdate()" class="btn btn-primary" type="button">修改为渠道商</button>
<script type="text/javascript">
    function channelUpdate(){
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
            var url = '/member/channelUpdate';
            url = url + '?id=' + params_ids;
            location.href = url;
//            layer.open({
//                type: 2,
//                title: '查看收货地址',
//                shadeClose: true,
//                shade: 0.8,
//                area: ['90%', '90%'],
//                content: url //iframe的url
//            });
            return;
        }
        $.kh.fromTips(data,3);
    }
</script>