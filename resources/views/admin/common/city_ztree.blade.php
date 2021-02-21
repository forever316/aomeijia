<div class="form-group">
    <label class="col-sm-1 control-label">上级城市</label>
    <div class="col-sm-10" style="width: 70%">
        <ul id="tree" class="ztree"></ul>
        <input type="hidden" class="form-control" @if(isset($detailData)) value="{{$detailData->pid}}" @endif id="pid" name="pid"/>
        <input type="text" readonly class="form-control" id="pid_show" @if(isset($detailData)) value="{{$detailData->pname}}" @endif />
        <span class="help-block m-b-none">点击树形城市选择上级城市</span>
    </div>
    <script type="text/javascript">
        $(function(){
            var setting = {
                async: {
                    enable: true,
                    url:"/city/ajaxcityList?status=0"
                    @if(isset($detailData))
                        ,otherParam: {"id":'{{$detailData->id}}'}
                    @endif
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
                        var node = zTree.getNodeByParam("id",{{$detailData->pid}},null);
                        zTree.selectNode(node);
                        @endif

                    }
                }
            };
            function zTreeOnClick(event, treeId, treeNode) {
                var pathArray = treeNode.getPath();
                var path = '';
                $.each(pathArray,function(i,item){
                    if(path == ''){
                        path = path + item.id;
                    }else{
                        path = path + ','+item.id;
                    }
                });
//                if(!treeNode.isParent){
//                    if($("#typeDiv").is(':hidden')){
//                        $("#typeDiv :input").attr('disabled',false);
//                        $("#typeDiv").show();
//                        $("#typeDiv").after('<div class="hr-line-dashed"></div>');
//                    }
//                }else{
//                    if(!$("#typeDiv").is(':hidden')){
//                        $("#typeDiv").hide();
//                        $("#typeDiv :input").attr('disabled',true);
//                        var ns=$("#typeDiv").next();
//                        ns.remove();
//                    }
//                }
                $("#pid").val(treeNode.id);
                $("#pid_show").val(treeNode.name);
            };
            $.fn.zTree.init($("#tree"), setting);
        })
    </script>
</div>