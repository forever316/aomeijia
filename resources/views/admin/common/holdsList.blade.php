@include('admin.common.list')
<script>
    console.log(123);

   {{--setInterval(function(){--}}
       {{--codes = 1,2;--}}
       {{--$.ajax({--}}
           {{--cache: true,--}}
           {{--type: "get",--}}
           {{--url:{{$form['data_url']}},--}}
           {{--data:{code:codes},--}}
           {{--async: false,--}}
           {{--dataType: "json",--}}
           {{--error: function(request) {--}}
               {{--layer.close(layerload);--}}
               {{--data['msg'] = '删除失败！';--}}
               {{--$.kh.fromTips(data,2);--}}
               {{--$("#delete").removeClass('disabled');--}}
               {{--$("#delete").removeAttr('disabled');--}}
           {{--},--}}
           {{--success: function(data) {--}}
               {{--layer.close(layerload);--}}
               {{--$.kh.fromTips(data,2);--}}
               {{--$("#delete").removeClass('disabled');--}}
               {{--$("#delete").removeAttr('disabled');--}}
               {{--if(data.status != 500){--}}
                   {{--setTimeout(function (){--}}
                       {{--location.replace(location.href);--}}
                   {{--}, 2000);--}}
               {{--}--}}
           {{--}--}}
       {{--});--}}

   {{--},5000);--}}
</script>