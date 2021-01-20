<div class="form-group">
    <label class="col-sm-1 control-label">等级价格</label>
    <div class="col-sm-10" style="width: 70%">
        @foreach($distributorLevelList as $key=>$item)
        <div  style="overflow:hidden;width: 100%;@if($key != 0) margin-top: 5px; @endif">
            <input class="form-control" name="level[{{$item->id}}]" readonly="true" value="{{$item->name}}" style="width: 30%;float: left;margin-right: 20px;">
            <input class="form-control" name="level_amount[{{$item->id}}]" @if(isset($levelList[$item->id])) value="{{$levelList[$item->id]}}" @endif placeholder="价格" style="width: 30%;float: left;margin-right: 20px;">
        </div>
        @endforeach
    </div>
</div>