<div class="form-group">
    <label class="col-sm-1 control-label">商品类型</label>
    <div class="col-sm-10" style="width: 70%">
        <ul id="tree" class="ztree"></ul>
        <input type="hidden" class="form-control" @if(isset($detailData)) value="{{$detailData->type_id}}" @endif id="type_id" name="type_id"/>
        <input type="text" readonly class="form-control" id="type_id_show" @if(isset($detailData)) value="{{$detailData->typeName}}" @endif />
        <span class="help-block m-b-none">点击选择商品分类</span>
    </div>
    <script type="text/javascript">
        $(function(){
            var setting = {
                async: {
                    enable: true,
                    url:"/goodsType/ajaxGoodsTypeList?type={{$type}}",
                    otherParam: {"status":'1'}
                },
                data:{
                    simpleData:{
                        enable: true,
                        idKey: "id",
                        pIdKey: "pid"
                    }
                },
                view:{
                    showIcon:false,
                    selectedMulti: false
                },
                callback: {
                    onClick: zTreeOnClick,
                    onAsyncSuccess:function(event, treeId, treeNode, msg){

                        @if(isset($detailData))
                        var zTree = $.fn.zTree.getZTreeObj(""+treeId);
                        var node = zTree.getNodeByParam("id",{{$detailData->type_id}},null);
                        zTree.selectNode(node);
                        @endif

                    }
                }
            };
            function zTreeOnClick(event, treeId, treeNode) {
                $("#guyou").html('');
                if(treeNode.id != 0){
                    if(!treeNode.isParent){
                        $.ajax({
                            cache: true,
                            type: "POST",
                            url:'/goodsType/ajaxGoodsTypeAttribute',
                            data:{typeID:treeNode.id},
                            async: false,
                            dataType: "json",
                            error: function(request) {
                                data['msg'] = '发生错误了！';
                                $.kh.fromTips(data,2);
                            },
                            success: function(data) {
                                if(data.status == 500){
                                    $.kh.fromTips(data,2);
                                }else{
                                    if(data.msg.length != 0){
                                        $.each(data.msg, function(i, obj) {
                                            var str = '<div style="overflow:hidden;width: 100%;margin-bottom: 5px;"><input class="form-control" readonly="readonly" name="guyou['+i+']" value="'+obj+'" placeholder="属性名称" style="width: 30%;float: left;margin-right: 20px;">' +
                                                      '<input class="form-control" name="guyou_value['+i+']" placeholder="属性值" style="width: 30%;float: left;margin-right: 20px;"></div>';
                                            $("#guyou").append(str);
                                        });
                                    }
                                }
                            }
                        });
                        $("#type_id").val(treeNode.id);
                        $("#type_id_show").val(treeNode.name);
                    }
                }
            };
            var zTree = $.fn.zTree.init($("#tree"), setting);
        })
    </script>
</div>