<button style="margin: 0px;" id="resetPass" onclick="resetPass()" class="btn btn-primary" type="button">配置菜单</button>
<script type="text/javascript">
    function resetPass(){
        var ids = $('#dataTable').bootstrapTable('getSelections','');
        if(ids.length > 1){
            var data = {};
            data['type'] = 'all';
            data['msg'] = '一次只能配置一个公众号';
            data['status'] = 500;
            $.kh.fromTips(data,3);
        }else if(ids.length == 0){
            var data = {};
            data['type'] = 'all';
            data['msg'] = '请选择一个要配置的公众号';
            data['status'] = 500;
            $.kh.fromTips(data,3);
        }else{
            var id = ids[0].id;
                 $.ajax({
                    cache: true,
                    type: "POST",
                    url:'/wechatConfig/seeToken',
                    data:{id:id},
                    async: false,
                    dataType: "json",
                    success: function(data) {
                        var keys = data.access_key;
                        var ci = data.id;
                        layer.open({
                        type: 2,
                        title: '配置菜单',
                        shadeClose: true,
                        shade: 0.8,
                        area: ['90%', '90%'],
                        content: "/wechatMenu/wechatMenuList?keys="+keys //iframe的url
                    });
                    return;
                    }
                });
           
        }
    }
</script>