<div class="form-group">
    <label class="col-sm-1 control-label">菜单权限配置</label>
    <div class="col-sm-10" style="width: 70%">
        <div class="tabs-container">

            <div class="tabs-left">
                <ul class="nav nav-tabs">
                    {{--*/ $i = 0 /*--}}
                    @foreach($authority as $key=>$item)
                        <li @if($i == 0) class="active" @endif>
                            <a data-toggle="tab" href="#{{$key}}">{{$item['title']}}</a>
                        </li>
                        {{--*/ $i = 1 /*--}}
                    @endforeach
                </ul>
                <div class="tab-content ">
                    {{--*/ $i = 0 /*--}}
                    @foreach($authority as $key=>$item)
                        <div id="{{$key}}" class="tab-pane @if($i == 0) active @endif">
                            <div class="panel-body">
                                @if(isset($item['menu']) && !empty($item['menu']))
                                    <strong>菜单</strong><br/>
                                    @foreach($item['menu'] as $k=>$menu)
                                        <label class="checkbox-inline i-checks"><input @if(isset($menu_return)) @if(in_array($k,$menu_return)) checked="true"  @endif @endif type="checkbox" name="menu[]" value="{{$k}}">&nbsp;{{$menu['title']}}</label>
                                    @endforeach
                                @endif
                                    <br/><br/>
                                    <button onclick="check2('{{$key}}','menu')" type="button" class="btn btn-sm btn-primary">全部选中</button>
                                    <button onclick="uncheck2('{{$key}}','menu')" type="button" class="btn btn-sm btn-default">取消选中</button>
                                <br/><br/>
                                @if(isset($item['resources']) && !empty($item['resources']))
                                    <strong>资源</strong><br/>
                                    @foreach($item['resources'] as $k=>$title)
                                        <label class="checkbox-inline i-checks"><input @if(isset($resources_return)) @if(in_array($k,$resources_return)) checked="true"  @endif @endif type="checkbox" name="resources[]" value="{{$k}}">&nbsp;{{$title}}</label>
                                    @endforeach
                                @endif
                                    <br/><br/>
                                    <button onclick="check2('{{$key}}','resources')" type="button" class="btn btn-sm btn-primary">全部选中</button>
                                    <button onclick="uncheck2('{{$key}}','resources')" type="button" class="btn btn-sm btn-default">取消选中</button>
                            </div>
                        </div>
                        {{--*/ $i = 1 /*--}}
                    @endforeach
                    <script>
                        function check2(id,sign){
                            $('#'+id+' :input[name="'+sign+'[]"]').iCheck('check');
                        }
                        function uncheck2(id,sign){
                            $('#'+id+' :input[name="'+sign+'[]"]').iCheck('uncheck');
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>