<div class="form-group">
    <label class="col-sm-1 control-label">模块类型</label>
    <div class="col-sm-10" style="width: 70%" id="modular_type">
            {{--<label class="checkbox-inline i-checks">--}}
                {{--<input  type="radio" name="modular_type" id="modular_type5" value="modular_type5"> <i></i>类型5</label>--}}
        <label class="checkbox-inline i-checks">
            <input  type="radio" name="modular_type" id="modular_type4" value="4"> <i></i>类型4</label>
        <label class="checkbox-inline i-checks">
            <input   type="radio" name="modular_type" id="modular_type2" value="2"> <i></i>类型2</label>
    </div>
    <script>
        $(function(){
            $('input:radio[name="modular_type"]').on('ifChanged', function(event){
                $.ajaxSetup ({ cache: false });
                switch ($(this).val()){
                    case 'modular_type5':
                        $( "#modular_type_content").html('');
                        $( "#modular_type_content" ).load("/home_modular5?r="+Math.random());
                        break;
                    case '4':
                        $( "#modular_type_content").html('');
                        $("#5img").show();
                        $("#2img").hide();
                        $( "#modular_type_content" ).load("/home_modular4?r="+Math.random());
                        break;
                    case '2':
                        $( "#modular_type_content").html('');
                            $("#2img").show();
                        $("#5img").hide();
                        $( "#modular_type_content" ).load("/home_modular2?r="+Math.random());
                        break;
                }
            });
            $('#modular_type5').iCheck('check');
        });
    </script>
</div>
<div class="form-group" id="2img" style="display: none">
    <label class="col-sm-1 control-label">模块参考图</label>
    <div class="col-sm-10" style="width: 70%">
        <img src="/assets/admin/img/4.png" width="20%" height="20%" />
    </div>
</div>
<div class="form-group" id="5img" style="display: none">
    <label class="col-sm-1 control-label">模块参考图</label>
    <div class="col-sm-10" style="width: 70%">
        <img src="/assets/admin/img/5.png" width="20%" height="20%" />
    </div>
</div>
<div class="hr-line-dashed"></div>
<div id="modular_type_content">
    
</div>