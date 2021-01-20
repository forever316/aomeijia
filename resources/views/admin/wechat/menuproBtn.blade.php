<button style="margin: 0px;" id="resetPass" onclick="resetPass()" class="btn btn-primary" type="button">发布菜单</button>
<script type="text/javascript">
    function resetPass(){
        var length = $("#table_id").find('.liAction').length;

            layer.confirm('确定要发布菜单?', {icon: 3, title:'提示'}, function(index){
                var id = $("#table_id").find('.liAction').eq(0).attr('data-id');
                var layerload = layer.load(0, {
                    shadeClose:true,
                    shade:[0.3,'#000']
                });
                $("#resetPass").addClass('disabled');
                $("#resetPass").attr('disabled',true);
                $.ajax({
                    cache: true,
                    type: "POST",
                    url:'/wechatMenu/publish',
                    data:{id:id},
                    async: false,
                    dataType: "json",
                    error: function(request) {
                        layer.close(layerload);
                        data['msg'] = '发布成功！';
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
</script>