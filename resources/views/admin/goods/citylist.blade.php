<script src="/assets/common/jquery.cityselect.js"></script>
<div class="form-group">
    <label class="col-sm-1 control-label">拥有城市</label>
    <div class="col-sm-10" style="width: 70%">
        <div id="ziduanContent">
            <div id="chengshi_1" style="overflow:hidden;width: 100%;">
                <select class="form-control prov" name="province[1]" placeholder="省份" style="width: 30%;float: left;margin-right: 20px;"></select>
                <select class="form-control city" name="city[1]" placeholder="城市" style="width: 30%;float: left;margin-right: 20px;"></select>
                <button class="btn btn-primary" style="float: left;" type="button">必填</button>
            </div>
        </div>
        <button class="btn btn-primary" type="button" onclick="addZiduan2()">增加</button>
    </div>
    <script type="text/javascript">
        $(function(){
            $("#chengshi_1").citySelect({nodata:"none",required:false});
        });
        var ziduanCount = 1;
        function fieldDelete2(id){
            $("#chengshi_"+id).remove();
        }
        function addZiduan2(){
            ziduanCount = ziduanCount +1;
            var str = '<div id="chengshi_'+ziduanCount+'" style="overflow:hidden;width: 100%;">'
                    +'<select class="form-control prov" name="province['+ziduanCount+']" placeholder="省份" style="width: 30%;float: left;margin-right: 20px;"></select>'
                    +'<select class="form-control city" name="city['+ziduanCount+']" placeholder="城市" style="width: 30%;float: left;margin-right: 20px;"></select>'
                    +'<button class="btn btn-primary" style="float: left;" onclick="fieldDelete2('+ziduanCount+')" type="button">删除</button>'
                    +'</div>';
            $("#ziduanContent").append(str);
            $("#chengshi_"+ziduanCount).citySelect({nodata:"none",required:false});
        }
    </script>
</div>