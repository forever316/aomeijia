<div class="form-group">
    <label class="col-sm-1 control-label">模块参考图</label>
    <div class="col-sm-10" style="width: 70%">
        <img src="/assets/admin/img/zhutiqu.jpg" width="40%" height="40%" />
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    <label class="col-sm-1 control-label">模块内容</label>
    <div class="col-sm-10" style="width: 70%">
        <div class="tabs-container">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true">第一模块</a>
                </li>
                <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">第二模块</a>
                </li>
                <li class=""><a data-toggle="tab" href="#tab-3" aria-expanded="false">第三模块</a>
                </li>
                <li class=""><a data-toggle="tab" href="#tab-4" aria-expanded="false">第四模块</a>
                </li>
                <li class=""><a data-toggle="tab" href="#tab-5" aria-expanded="false">第五模块</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <div class="panel-body">
                        <div style="overflow:hidden;">
                            <label>标题：</label>
                            <input type="text" class="form-control" name="title1"  />
                        </div><br/>
                        <div style="overflow:hidden;">
                            <label>描述：</label>
                            <input type="text" class="form-control" name="desc1"  />
                        </div><br/>
                        <div style="overflow:hidden;">
                            <label>商品类型：</label><br/>
                            @foreach ($goodsTypeList as $k=>$radio)
                                <label class="checkbox-inline i-checks">
                                    <input type="radio" name="goods_type1_id" value="{{$radio->id}}"> <i></i>{{$radio->name}}</label>
                            @endforeach
                        </div><br/>
                        <div style="overflow:hidden;">
                            <label>图片：</label><br/>
                            <input type="hidden" name="img1" id="img1_val" />
                            <div style="width: 70%" id="img1">
                                <div class="uploader-demo">
                                    <!--用来存放item-->
                                    <div id="img1List" class="uploader-list"></div>
                                    <div id="img1Picker">选择图片</div>
                                </div>
                            </div>
                            <script type="text/javascript">
                                $(function(){
                                    var limit = 1,folder='homeModularC';
                                    $.kh.imgUpload('img1',limit,folder);
                                })
                            </script>
                        </div>
                    </div>
                </div>
                <div id="tab-2" class="tab-pane">
                    <div class="panel-body">
                        <div style="overflow:hidden;">
                            <label>标题：</label>
                            <input type="text" class="form-control" name="title2"  />
                        </div><br/>
                        <div style="overflow:hidden;">
                            <label>描述：</label>
                            <input type="text" class="form-control" name="desc2"  />
                        </div><br/>
                        <div style="overflow:hidden;">
                            <label>商品类型：</label><br/>
                            @foreach ($goodsTypeList as $k=>$radio)
                                <label class="checkbox-inline i-checks">
                                    <input type="radio" name="goods_type2_id" value="{{$radio->id}}"> <i></i>{{$radio->name}}</label>
                            @endforeach
                        </div><br/>
                        <div style="overflow:hidden;">
                            <label>图片：</label><br/>
                            <input type="hidden" name="img2" id="img2_val" />
                            <div style="width: 70%" id="img2">
                                <div class="uploader-demo">
                                    <!--用来存放item-->
                                    <div id="img2List" class="uploader-list"></div>
                                    <div id="img2Picker">选择图片</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab-3" class="tab-pane">
                    <div class="panel-body">
                        <div style="overflow:hidden;">
                            <label>标题：</label>
                            <input type="text" class="form-control" name="title3"  />
                        </div><br/>
                        <div style="overflow:hidden;">
                            <label>描述：</label>
                            <input type="text" class="form-control" name="desc3"  />
                        </div><br/>
                        <div style="overflow:hidden;">
                            <label>商品类型：</label><br/>
                            @foreach ($goodsTypeList as $k=>$radio)
                                <label class="checkbox-inline i-checks">
                                    <input type="radio" name="goods_type3_id" value="{{$radio->id}}"> <i></i>{{$radio->name}}</label>
                            @endforeach
                        </div><br/>
                        <div style="overflow:hidden;">
                            <label>图片：</label><br/>
                            <input type="hidden" name="img3" id="img3_val" />
                            <div style="width: 70%" id="img3">
                                <div class="uploader-demo">
                                    <!--用来存放item-->
                                    <div id="img3List" class="uploader-list"></div>
                                    <div id="img3Picker">选择图片</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab-4" class="tab-pane">
                    <div class="panel-body">
                        <div style="overflow:hidden;">
                            <label>标题：</label>
                            <input type="text" class="form-control" name="title4"  />
                        </div><br/>
                        <div style="overflow:hidden;">
                            <label>描述：</label>
                            <input type="text" class="form-control" name="desc4"  />
                        </div><br/>
                        <div style="overflow:hidden;">
                            <label>商品类型：</label><br/>
                            @foreach ($goodsTypeList as $k=>$radio)
                                <label class="checkbox-inline i-checks">
                                    <input type="radio" name="goods_type4_id" value="{{$radio->id}}"> <i></i>{{$radio->name}}</label>
                            @endforeach
                        </div><br/>
                        <div style="overflow:hidden;">
                            <label>图片：</label><br/>
                            <input type="hidden" name="img4" id="img4_val" />
                            <div style="width: 70%" id="img4">
                                <div class="uploader-demo">
                                    <!--用来存放item-->
                                    <div id="img4List" class="uploader-list"></div>
                                    <div id="img4Picker">选择图片</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab-5" class="tab-pane">
                    <div class="panel-body">
                        <div style="overflow:hidden;">
                            <label>标题：</label>
                            <input type="text" class="form-control" name="title5"  />
                        </div><br/>
                        <div style="overflow:hidden;">
                            <label>描述：</label>
                            <input type="text" class="form-control" name="desc5"  />
                        </div><br/>
                        <div style="overflow:hidden;" class="bh">
                            <label>商品类型：</label><br/>
                            @foreach ($goodsTypeList as $k=>$radio)
                                <label class="checkbox-inline i-checks">
                                    <input type="radio" name="goods_type5_id" value="{{$radio->id}}"> <i></i>{{$radio->name}}</label>
                            @endforeach
                        </div><br/>
                        <div style="overflow:hidden;">
                            <label>图片：</label><br/>
                            <input type="hidden" name="img5" id="img5_val" />
                            <div style="width: 70%" id="img5">
                                <div class="uploader-demo">
                                    <!--用来存放item-->
                                    <div id="img5List" class="uploader-list"></div>
                                    <div id="img5Picker">选择图片</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#modular_type_content .i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green'
    });
    var q = 0, w = 0, t = 0,r = 0;
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        if(e.target.text == '第二模块'){
            if(q == 0){
                $.kh.imgUpload('img2',1,'homeModularC');
                q = 1;
            }
        }
        if(e.target.text == '第三模块'){
            if(w == 0){
                $.kh.imgUpload('img3',1,'homeModularC');
                w = 1;
            }
        }

        if(e.target.text == '第四模块'){
            if(t == 0){
                $.kh.imgUpload('img4',1,'homeModularC');
                t = 1;
            }
        }

        if(e.target.text == '第五模块'){
            if(r == 0){
                $.kh.imgUpload('img5',1,'homeModularC');
                r = 1;
            }
        }
    })
</script>