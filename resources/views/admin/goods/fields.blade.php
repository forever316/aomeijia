<div class="form-group">
    <label class="col-sm-1 control-label">产品参数</label>
    <div class="col-sm-10" style="width: 70%">
        <div id="guyou">

        </div>
        <div id="ziduanContent">
            @if(!empty($detailData->fieldArray))
                @foreach($detailData->fieldArray as $key=>$item)
                    <div id="ziduan_{{$key}}" style="overflow:hidden;width: 100%;">
                        <input class="form-control" name="field[{{$key}}]" value="{{$item['name']}}" placeholder="属性名称" style="width: 30%;float: left;margin-right: 20px;">
                        <input class="form-control" name="value[{{$key}}]" value="{{$item['value']}}" placeholder="属性值" style="width: 30%;float: left;margin-right: 20px;">
                        <button class="btn btn-primary" style="float: left;" onclick="fieldDelete({{$key}})" type="button">删除</button>
                    </div>
                @endforeach
            @else
                @if(!isset($detailData))
                    <div id="ziduan_{{$endCount}}" style="overflow:hidden;width: 100%;">
                        <input class="form-control" name="field[1]" placeholder="属性名称" style="width: 30%;float: left;margin-right: 20px;">
                        <input class="form-control" name="value[1]" placeholder="属性值" style="width: 30%;float: left;margin-right: 20px;">
                        <button class="btn btn-primary" style="float: left;" onclick="fieldDelete(1)" type="button">删除</button>
                    </div>
                @endif
            @endif
        </div>
        <button class="btn btn-primary" type="button" onclick="addZiduan()">增加</button>
    </div>
    <script type="text/javascript">
        var ziduanCount = {{$endCount}};
        function fieldDelete(id){
            $("#ziduan_"+id).remove();
        }
        function addZiduan(){
            ziduanCount = ziduanCount +1;
            var str = '<div id="ziduan_'+ziduanCount+'" style="overflow:hidden;width: 100%;">'
                            +'<input class="form-control" name="field['+ziduanCount+']" placeholder="属性名称" style="width: 30%;float: left;margin-right: 20px;">'
                            +'<input class="form-control" name="value['+ziduanCount+']" placeholder="属性值" style="width: 30%;float: left;margin-right: 20px;">'
                            +'<button class="btn btn-primary" style="float: left;" onclick="fieldDelete('+ziduanCount+')" type="button">删除</button>'
                        +'</div>';
            $("#ziduanContent").append(str);
        }
    </script>
</div>