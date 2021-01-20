<div class="form-group">
    <label class="col-sm-1 control-label">事件</label>
    <div class="col-sm-10" style="width: 70%" id="type">
      <label class="checkbox-inline i-checks hover">
            <div class="cl iradio_square-green hover " style="position: relative;">
                <input type="radio" name="type" value="1" style="position: absolute; opacity: 0;"  @if(isset($detailData->type)&&$detailData->type == 1) checked @endif>
                <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
            </div> <i></i>无事件
        </label>
        <label class="checkbox-inline i-checks hover">
            <div class="iradio_square-green hover" style="position: relative;" >
                <input type="radio" name="type" value="click" style="position: absolute; opacity: 0;" @if(isset($detailData->type)&&$detailData->type == 'click') checked @endif>
                <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
            </div> <i></i>推送事件
        </label>
         <label class="checkbox-inline i-checks hover">
            <div class="iradio_square-green hover" style="position: relative;">
                <input type="radio" name="type" value="view" style="position: absolute; opacity: 0;"  @if(isset($detailData->type)&&$detailData->type == 'view') checked @endif>
                <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
            </div> <i></i>链接
        </label>
    </div>
</div>

<div class="cl1" style="display:none">
    <div class="hr-line-dashed"></div>
    <div class="form-group"  >
        <label class="col-sm-1 control-label">标识</label>
            <div class="col-sm-10" style="width: 70%">
                <input type="text" class="form-control" id="key" name="key" value="@if(isset($detailData->key)){{$detailData->key}}@endif">
            </div>
    </div>
</div>

<div class="url" style="display:none">
    <div class="hr-line-dashed"></div>
    <div class="form-group"  >
        <label class="col-sm-1 control-label">URL地址</label>
            <div class="col-sm-10" style="width: 70%">
                <input type="text" class="form-control" id="key" name="url" value="@if(isset($detailData->url)){{$detailData->url}}@endif">
            </div>
    </div>
</div>


<script type="text/javascript">
check();
function check(){
 if($('#type input:radio:checked').val()=='click'){
        $(".cl1").show();
        $(".url").hide();
    }
     if($('#type input:radio:checked').val()==1){
         $(".url").hide();
        $(".cl1").hide();
    }
     if($('#type input:radio:checked').val()=='view'){
         $(".cl1").hide();
        $(".url").show();
    }
}
$('input:radio').on('ifChecked', function(event){
   check();
});
</script>