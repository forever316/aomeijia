<div class="form-group">
    <label class="col-sm-1 control-label">所属部门</label>
    <div class="col-sm-10" style="width: 70%">
        <ul id="tree" class="ztree"></ul>
        <input type="hidden" class="form-control" @if(isset($detailData)) value="{{$detailData->dept_id}}" @endif id="dept_id" name="dept_id"/>
        <input type="text" readonly class="form-control" id="dept_id_show" @if(isset($detailData)) value="{{$detailData->dept_name}}" @endif />
        <span class="help-block m-b-none">点击树形部门选择上级部门</span>
    </div>
    <script type="text/javascript">
        $(function(){
            var setting = {
                async: {
                    enable: true,
                    url:"/department/ajaxDepartmentList"
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
                        var node = zTree.getNodeByParam("id",{{$detailData->dept_id}},null);
                        zTree.selectNode(node);
                        @endif

                    }
                }
            };
            function zTreeOnClick(event, treeId, treeNode) {
                if(treeNode.id != 0){
                    $("#dept_id").val(treeNode.id);
                    $("#dept_id_show").val(treeNode.name);
                }
            };
            $.fn.zTree.init($("#tree"), setting);
        })
    </script>
</div>