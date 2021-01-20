<div class="form-group">
    <label class="col-sm-1 control-label">{{$item['text']}}</label>
    <div class="col-sm-10" style="width: 70%">
        <select class="form-control" id="attr_type" name="attr_type">
            <option value="">请选择</option>
        </select>
        <div id="attr_content" style="overflow:hidden;width: 100%;margin-top: 10px;">

        </div>
    </div>
    <script>
        var biaojiCount = 0;
        $(function(){
            var goodsAttrList = {};
            $.ajax({
                cache: true,
                type: "POST",
                url:'/goodsNorms/ajaxGoodsNormsList',
                data:{'1':'1'},
                dataType: "json",
                async: false,
                error: function(request) {
                    var data = {};
                    data['msg'] = '数据错误，请刷新页面！';
                    data['status'] = 500;
                    data['type'] = 'all';
                    $.kh.fromTips(data,2);
                },
                success: function(data) {
                    $.each(data.msg,function(i,v){
                        $("#attr_type").append("<option value='"+ v.id+"'>"+ v.name+"</option>");
                    });
                    $.ajax({
                        cache: true,
                        type: "POST",
                        url:'/goodsNorms/ajaxGoodsAttrList',
                        data:{'goods_id':'{{$detailData->id}}'},
                        dataType: "json",
                        async: false,
                        error: function(request) {
                            var data = {};
                            data['msg'] = '数据错误，请刷新页面！';
                            data['status'] = 500;
                            data['type'] = 'all';
                            $.kh.fromTips(data,2);
                        },
                        success: function(data1) {
                            goodsAttrList = data1.msg;
                        }
                    });
                }
            });
            $("#attr_type").change(function(){
                var attr_type = $("#attr_type").val();
                if(attr_type == ''){
                    $("#attr_content").html('');
                }else{
                    $.ajax({
                        cache: true,
                        type: "POST",
                        url:'/goodsNorms/ajaxNormsAttrList',
                        data:{'attr_type_id':attr_type},
                        async: false,
                        dataType: "json",
                        error: function(request) {
                            var data = {};
                            data['msg'] = '数据错误，请刷新页面！';
                            data['status'] = 500;
                            data['type'] = 'all';
                            $.kh.fromTips(data,2);
                        },
                        success: function(data) {
                            $("#attr_content").html('');
                            $.each(data.msg,function(i,v){
                                var q = 0;
                                var b = 0;
                                $.each(goodsAttrList,function(l,k){
                                    if(k.attr_type_attr_id == v.id){
                                        b = 1;
                                        if(q == 0){
                                            $("#attr_content").append('<div id="neirong'+i+'" style="overflow: hidden;width: 100%;margin-bottom: 10px;">'+
                                            '<label class="col-sm-1 control-label"><span style="cursor: pointer" onclick="guigetianjia(\''+ v.id+'\',\''+i+'\',\''+ v.name+'\')">[+]</span>&nbsp;'+ v.name+'</label>'+
                                            '<input type="hidden" name="attr_id_list['+biaojiCount+']" value="'+ v.id+'">'+
                                            '<input type="hidden" name="old_id_list['+biaojiCount+']" value="'+ k.id+'">'+
                                            '<input class="form-control" name="attr_value_list['+biaojiCount+']" placeholder="值" value="'+ k.attr_value+'" style="width: 30%;float: left;margin-right: 20px;">'+
                                            '<input class="form-control" name="attr_price_list['+biaojiCount+']" placeholder="增加价格" value="'+ k.attr_price+'" style="width: 30%;float: left;margin-right: 20px;">'+
                                            '</div>');
                                        }else{
                                            $("#attr_content").append('<div style="overflow: hidden;width: 100%;margin-bottom: 10px;">'+
                                            '<label class="col-sm-1 control-label"><span style="cursor: pointer" onclick="guigejianshao(this)">[-]</span>&nbsp;'+ v.name+'</label>'+
                                            '<input type="hidden" name="attr_id_list['+biaojiCount+']" value="'+ v.id+'">'+
                                            '<input type="hidden" name="old_id_list['+biaojiCount+']" value="'+ k.id+'">'+
                                            '<input class="form-control" name="attr_value_list['+biaojiCount+']" placeholder="值" value="'+ k.attr_value+'" style="width: 30%;float: left;margin-right: 20px;">'+
                                            '<input class="form-control" name="attr_price_list['+biaojiCount+']" placeholder="增加价格" value="'+ k.attr_price+'" style="width: 30%;float: left;margin-right: 20px;">'+
                                            '</div>');
                                        }
                                        q = 1;
                                    }
                                    biaojiCount  = biaojiCount + 1;
                                });
                                if(b == 0){
                                    $("#attr_content").append('<div id="neirong'+i+'" style="overflow: hidden;width: 100%;margin-bottom: 10px;">'+
                                    '<label class="col-sm-1 control-label"><span style="cursor: pointer" onclick="guigetianjia(\''+ v.id+'\',\''+i+'\',\''+ v.name+'\')">[+]</span>&nbsp;'+ v.name+'</label>'+
                                    '<input type="hidden" name="attr_id_list['+biaojiCount+']" value="'+ v.id+'">'+
                                    '<input class="form-control" name="attr_value_list['+biaojiCount+']" placeholder="值" style="width: 30%;float: left;margin-right: 20px;">'+
                                    '<input class="form-control" name="attr_price_list['+biaojiCount+']" placeholder="增加价格" style="width: 30%;float: left;margin-right: 20px;">'+
                                    '</div>');
                                }
                                biaojiCount  = biaojiCount + 1;
                            });
                        }
                    });
                }
            });
            $("#attr_type").val("{{$detailData->attr_type}}");
            $("#attr_type").change();
        });

        function guigetianjia(id,index,name){
            $("#neirong"+index).after('<div style="overflow: hidden;width: 100%;margin-bottom: 10px;">'+
            '<label class="col-sm-1 control-label"><span style="cursor: pointer" onclick="guigejianshao(this)">[-]</span>&nbsp;'+ name+'</label>'+
            '<input type="hidden" name="attr_id_list['+biaojiCount+']" value="'+ id+'">'+
            '<input class="form-control" name="attr_value_list['+biaojiCount+']" placeholder="值" style="width: 30%;float: left;margin-right: 20px;">'+
            '<input class="form-control" name="attr_price_list['+biaojiCount+']" placeholder="增加价格" style="width: 30%;float: left;margin-right: 20px;">'+
            '</div>');
            biaojiCount  = biaojiCount + 1;
        }

        function guigejianshao(i){
            $(i).parent().parent().remove();
        }
    </script>
</div>