<script src="/assets/common/jquery.cityselect.js"></script>
<div class="form-group">
    <label class="col-sm-1 control-label">拥有城市</label>
    <div class="col-sm-10" style="width: 70%">
        <div id="ziduanContent">
            <div id="chengshi_1" style="overflow:hidden;width: 100%;">
                <select class="form-control prov" name="province" placeholder="省份" style="width: 30%;float: left;margin-right: 20px;"></select>
                <select class="form-control city" name="city" placeholder="城市" style="width: 30%;float: left;margin-right: 20px;"></select>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function(){
            $("#chengshi_1").citySelect({nodata:"none",required:false @if(isset($detailData)),prov:"{{$detailData['province']}}", city:"{{$detailData['city']}}"@endif});
        });
    </script>
</div>