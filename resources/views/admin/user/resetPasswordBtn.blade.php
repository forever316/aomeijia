<button style="margin: 0px;" id="resetPass" onclick="resetPass()" class="btn btn-primary" type="button">重置密码</button>
<script type="text/javascript">
    function resetPass(){
        var ids = $('#dataTable').bootstrapTable('getSelections','');
        var data = {};
        data['type'] = 'all';
        data['msg'] = '';
        data['status'] = 500;
        if(ids.length > 1){
            data['msg'] = '一次只能重置一个用户！';
            $.kh.fromTips(data,3);
        }else if(ids.length == 0){
            data['msg'] = '请选择一个要重置的用户！';
            $.kh.fromTips(data,3);
        }else if(ids.length == 1){
            layer.confirm('确定要重置密码?', {icon: 3, title:'提示'}, function(index){
                var id = ids[0].id;
                var layerload = layer.load(0, {
                    shadeClose:true,
                    shade:[0.3,'#000']
                });
                $("#resetPass").addClass('disabled');
                $("#resetPass").attr('disabled',true);
                $.ajax({
                    cache: true,
                    type: "POST",
                    url:'/user/resetPass',
                    data:{id:id},
                    async: false,
                    dataType: "json",
                    error: function(request) {
                        layer.close(layerload);
                        data['msg'] = '重置密码成功！';
                        $.kh.fromTips(data,2);
                        $("#resetPass").removeClass('disabled');
                        $("#resetPass").removeAttr('disabled');
                    },
                    success: function(data) {
                        layer.close(layerload);
                        $.kh.fromTips(data,2);
                        $("#resetPass").removeClass('disabled');
                        $("#resetPass").removeAttr('disabled');
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