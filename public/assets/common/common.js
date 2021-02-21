$.ajaxSetup({
    headers: {
        'X-XSRF-TOKEN': $.cookie('XSRF-TOKEN')
    }
});
jQuery.kh = {
    //相册
    photos:function(element){
        layer.ready(function(){
            layer.photos({
                photos: '#'+element
            });
        });
    },
    //验证码
    getCaptcha:function(width,height,document) {
        $.ajax({
            url: '/getCaptcha',
            data: {'width': width, 'height': height,'document':document},
            type: "get",
            dataType: "html",
            success: function (data) {
                if (data == "0") {
                    var data = {};
                    data['type'] = 'all';
                    data['msg'] = '验证码获取失败！';
                    $.kh.fromTips(data,3);
                } else {
                    $("#"+document).html(data);
                }
            }
        });
    },
    //提示
    fromTips:function(data,direction) {
        if(data.type == "input"){
            $.each(data.msg, function (key, value) {
                layer.tips(value, '#'+key, {
                    tips: [direction, '#c00'],
                    time:3000,
                    tipsMore:true
                });
                $("#"+key).addClass('tips');
            });
            $('.tips').click(function(){
                layer.closeAll('tips');
            });
        }else if(data.type == "all"){
            if(data.status && data.status == 200){
                layer.msg(data.msg, {
                    icon: 1,
                    time:2000,
                    shade:[0.3,'#000']
                });
            }else{
                layer.msg(data.msg, {
                    icon: 5,
                    time:2000,
                    shade:[0.3,'#000']
                });
            }
        }
    },
    //删除文件
    fileDelete:function(fileUrl){
        var status;
        $.ajax({
            type: "POST",
            url:'/deleteFile',
            data:{fileUrl:fileUrl},
            async: false,
            dataType: "json",
            error: function(request) {},
            success: function(data) {
                status = data.success;
            }
        });
        return status;
    },
    //图片上传
    imgUpload:function(element,limit,folder){
        var $_element = WebUploader.create({
            headers:{'X-XSRF-TOKEN': $.cookie('XSRF-TOKEN')},

            formData:{folder:folder},

            // 选完文件后，是否自动上传。
            auto: true,

            // swf文件路径
            swf: '/assets/common/Uploader.swf',

            // 文件接收服务端。
            server: '/uploadImg',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: {
                id :'#'+element+'Picker',
                multiple: false
            },

            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/gif,image/bmp,image/jpg,image/jpeg,image/png'  //image/*
            },
            fileNumLimit: limit,
            disableGlobalDnd: true
        });
        var imgArray = [];

        //图片加入之前，验证是否超出限定文件个数
        $_element.on('beforeFileQueued',function(file){
            console.log('aaa',element);
            console.log($("#"+element+'_val'));
            var imgsUrl = $("#"+element+'_val').val();
            if(imgsUrl != ''){
                if(limit > 1){
                    var arr = imgsUrl.split(';');
                    if(arr.length >= limit){
                        this.trigger( 'error', 'Q_EXCEED_NUM_LIMIT', file );
                        return false;
                    }
                }else{
                    this.trigger( 'error', 'Q_EXCEED_NUM_LIMIT', file );
                    return false;
                }
            }
        });



        // 当有文件添加进来的时候
        $_element.on( 'fileQueued', function( file ) {
            file.rotation = 0;
            var $li = $(
                    '<div id="' + file.id + '" class="file-item thumbnail">' +
                    '<img>' +
                    '<div class="info">' + file.name + '</div>' +
                    '<div class="file-panel"><span class="cancel">删除</span></div>'+
                    '</div>'
                ),
                //<div class="file-panel"><span class="cancel">删除</span><span class="rotateRight">向右旋转</span><span class="rotateLeft">向左旋转</span></div>
                $img = $li.find('img');


            // $list为容器jQuery实例
            $("#"+element+"List").append( $li );

            // 创建缩略图
            // 如果为非图片文件，可以不用调用此方法。
            // thumbnailWidth x thumbnailHeight 为 100 x 100
            var thumbnailWidth = 150,thumbnailHeight = 150;
            $_element.makeThumb( file, function( error, src ) {
                if ( error ) {
                    $img.replaceWith('<span>不能预览</span>');
                    return;
                }

                $img.attr( 'src', src );
            }, thumbnailWidth, thumbnailHeight );

            //工具栏
            $li.on( 'mouseenter', function() {
                $("#"+file.id).find(".file-panel").stop().animate({height: 24});
            });

            $li.on( 'mouseleave', function() {
                $("#"+file.id).find(".file-panel").animate({height: 0});
            });
            $("#"+file.id).find(".file-panel").on( 'click', 'span', function() {
                var index = $(this).index();
                switch ( index ) {
                    case 0:
                        $_element.removeFile( file,true);
                        $li.remove();
                        return;
                    case 1:
                        file.rotation += 90;
                        break;
                    case 2:
                        file.rotation -= 90;
                        break;
                }
                deg = 'rotate(' + file.rotation + 'deg)';
                $img.css({
                    '-webkit-transform': deg,
                    '-mos-transform': deg,
                    '-o-transform': deg,
                    'transform': deg
                });
            });
        });
        // 文件上传过程中创建进度条实时显示。
        $_element.on( 'uploadProgress', function( file, percentage ) {
            var $li = $( '#'+file.id ),
                $percent = $li.find('.progress span');

            // 避免重复创建
            if ( !$percent.length ) {
                $percent = $('<p class="progress"><span></span></p>')
                    .appendTo( $li )
                    .find('span');
            }
            $percent.css( 'width', percentage * 100 + '%' );
        });

        // 文件上传成功，给item添加成功class, 用样式标记上传成功。
        $_element.on( 'uploadSuccess', function( file,response) {
            $("#"+file.id).find(".file-panel").css({'top':'4px'});
            $( '#'+file.id ).addClass('upload-state-done');
            if(limit > 1){
                var imgUrl = $("#"+element+'_val').val();
                if(imgUrl == ""){
                    $("#"+element+'_val').val(imgUrl+response.pic);
                }else{
                    if(imgUrl.substr(imgUrl .length-1,1) == ';'){
                        $("#"+element+'_val').val(imgUrl+response.pic);
                    }else{
                        $("#"+element+'_val').val(imgUrl+';'+response.pic);
                    }
                }
                console.log($("#"+element+'_val').val());
                imgArray[file.name] = response.pic;
            }else{
                $("#"+element+'_val').val(response.pic);
            }
        });

        //文件上传后返回执行（失败或者成功）
        $_element.on('uploadAccept',function(object,ret){
            if(!ret.success){
                return false;
            }
        });

        // 文件上传失败，显示上传出错。
        $_element.on( 'uploadError', function( file ) {
            var $li = $( '#'+file.id ),
                $error = $li.find('div.error');

            // 避免重复创建
            if ( !$error.length ) {
                $error = $('<div class="error"></div>').appendTo( $li );
            }
            $error.text('上传失败');
            $("#"+file.id).find(".file-panel").css({'top':'24px'});
        });

        // 完成上传完了，成功或者失败，先删除进度条。
        $_element.on( 'uploadComplete', function( file ) {
            $( '#'+file.id ).find('.progress').remove();
        });

        //错误
        $_element.on('error', function(handler) {
            if (handler == "Q_EXCEED_NUM_LIMIT") {
                var data = {};
                data['type'] = 'all';
                data['msg'] = '只能上传'+limit+'张图片！';
                $.kh.fromTips(data,3);
            }
        });

        function count(o){
            var t = typeof o;
            if(t == 'string'){
                return o.length;
            }else if(t == 'object'){
                var n = 0;
                for(var i in o){
                    n++;
                }
                return n;
            }
            return false;
        }

        //删除图片时同时删除服务器上的图片
        $_element.on('fileDequeued',function(file){
            if(limit > 1){
                var value = imgArray[file.name];
                if(value){
                    var url_str = $("#"+element+'_val').val();
                    url_str = url_str.replace(';'+value,'');
                    url_str = url_str.replace(value+';','');
                    url_str = url_str.replace(value,'');
                    $("#"+element+'_val').val(url_str);
                }
            }else{
                var imgUrl = $("#"+element+'_val').val();
                $("#"+element+'_val').val('');
            }
        })
    },
    formSub:function(index){
        $("#sub").on('click',function(){
            var layerload = layer.load(0, {
                shadeClose:true,
                shade:[0.3,'#000']
            });
            $(this).addClass('disabled');
            $(this).attr('disabled',true);
            $.ajax({
                cache: true,
                type: "POST",
                url:$('#'+index).attr('action'),
                data:$('#'+index).serialize(),
                async: false,
                dataType: "json",
                error: function(request) {
                    layer.close(layerload);
                    var data = {};
                    data['msg'] = '提交失败！';
                    data['status'] = 500;
                    data['type'] = 'all';
                    $.kh.fromTips(data,2);
                    $("#sub").removeClass('disabled');
                    $("#sub").removeAttr('disabled');
                },
                success: function(data) {
                    layer.close(layerload);
                    $.kh.fromTips(data,2);
                    $("#sub").removeClass('disabled');
                    $("#sub").removeAttr('disabled');
                    if(data.status != 500){
                        setTimeout(function (){
                            window.location.href=document.referrer;
                        }, 2000);
                    }
                }
            });
        })
    },
    tableList:function(dataurl){
        var $table = $('#dataTable');
        $table.bootstrapTable({
            url: dataurl,
            dataType: "json",
            pagination: true,
            singleSelect: false,
            sidePagination: "server",
            idField:"id",
            queryParamsType:'',
            pageSize:10,
            pageList:[10],
            showPaginationSwitch:false,
            clickToSelect:true,
            sortOrder:'desc',
            queryParams:function(params){
                var arr = {};
                arr.page = params.pageNumber;
                arr.row = params.pageSize;
                arr.order = params.sortOrder;
                arr.sort = params.sortName;
                arr.searchText = params.searchText;

                var searchForm = $("#searchForm").serializeArray();
                $.each(searchForm, function(i, field){
                    arr[field.name] = field.value;
                });
                return arr;
            }
        });

        $("#searchBtn").click(function(){
            $table.bootstrapTable('refresh', {url: dataurl});
        });

        //更新
        $("#ibox-content").on("click",'#update',function(){
            var ids = $('#dataTable').bootstrapTable('getSelections','');
            var data = {};
            data['type'] = 'all';
            data['msg'] = '';
            data['status'] = 500;
            if(ids.length == 0){
                data['msg'] = '请选择一条要修改的数据！';
            }else if(ids.length > 1){
                data['msg'] = '只能选择一条数据修改！';
            }else if(ids.length == 1){
                var params_ids = ids[0].id;
                var url = $('#update').attr('data-url');
                url = url + '?id=' + params_ids;
                location.href = url;
                return;
            }
            $.kh.fromTips(data,3);
        });

        //审核
        $("#ibox-content").on("click",'#varify',function(){
            var ids = $('#dataTable').bootstrapTable('getSelections','');
            var data = {};
            data['type'] = 'all';
            data['msg'] = '';
            data['status'] = 500;
            if(ids.length == 0){
                data['msg'] = '请选择一条要修改的数据！';
            }else if(ids.length > 1){
                data['msg'] = '只能选择一条数据修改！';
            }else if(ids.length == 1){
                var params_ids = ids[0].id;
                var url = $('#varify').attr('data-url');
                url = url + '?id=' + params_ids;
                location.href = url;
                return;
            }
            $.kh.fromTips(data,3);
        });

        //结算持仓
        $("#ibox-content").on("click",'#settlement',function(){
            var ids = $('#dataTable').bootstrapTable('getSelections','');
            var data = {};
            data['type'] = 'all';
            data['msg'] = '';
            data['status'] = 500;
            if(ids.length == 0){
                data['msg'] = '请选择一条要结算的数据！';
            }else if(ids.length > 1){
                data['msg'] = '只能选择一条数据结算！';
            }else if(ids.length == 1){
                var params_ids = ids[0].id;
                var url = $('#settlement').attr('data-url');
                url = url + '?id=' + params_ids;
                location.href = url;
                return;
            }
            $.kh.fromTips(data,3);
        });
        //一元结算
        $("#ibox-content").on("click",'#settleOne',function(){
            var ids = $('#dataTable').bootstrapTable('getSelections','');
            var data = {};
            data['type'] = 'all';
            data['msg'] = '';
            data['status'] = 500;
            if(ids.length == 0){
                data['msg'] = '请选择要一元结算的数据！';
                $.kh.fromTips(data,3);
            }else if(ids.length > 0){
                var arrID = [];
                $.each(ids, function(name, value) {
                    arrID.push(value.id);
                });
                var params_ids = arrID.join(',');
                layer.confirm('确定结算这些数据?', {icon: 3, title:'提示'}, function(index){
                    layer.close(index);
                    var layerload = layer.load(0, {
                        shadeClose:true,
                        shade:[0.3,'#000']
                    });
                    $("#settleOne").addClass('disabled');
                    $("#settleOne").attr('disabled',true);
                    $.ajax({
                        cache: true,
                        type: "POST",
                        url:$('#settleOne').attr('data-url'),
                        data:{ids:params_ids},
                        async: false,
                        dataType: "json",
                        error: function(request) {
                            layer.close(layerload);
                            data['msg'] = '一元结算失败！';
                            $.kh.fromTips(data,2);
                            $("#settleOne").removeClass('disabled');
                            $("#settleOne").removeAttr('disabled');
                        },
                        success: function(data) {
                            layer.close(layerload);
                            $.kh.fromTips(data,2);
                            $("#settleOne").removeClass('disabled');
                            $("#settleOne").removeAttr('disabled');
                            if(data.status != 500){
                                setTimeout(function (){
                                    location.replace(location.href);
                                }, 2000);
                            }
                        }
                    });
                });
            }
        });

        //启用
        $("#ibox-content").on("click",'#start',function(){
            var ids = $('#dataTable').bootstrapTable('getSelections','');
            var data = {};
            data['type'] = 'all';
            data['msg'] = '';
            data['status'] = 500;
            if(ids.length == 0){
                data['msg'] = '请选择要启用的数据！';
                $.kh.fromTips(data,3);
            }else if(ids.length > 0){
                var arrID = [];
                $.each(ids, function(name, value) {
                    arrID.push(value.id);
                });
                var params_ids = arrID.join(',');
                layer.confirm('确定启用这些数据?', {icon: 3, title:'提示'}, function(index){
                    layer.close(index);
                    var layerload = layer.load(0, {
                        shadeClose:true,
                        shade:[0.3,'#000']
                    });
                    $("#start").addClass('disabled');
                    $("#start").attr('disabled',true);
                    $.ajax({
                        cache: true,
                        type: "POST",
                        url:$('#start').attr('data-url'),
                        data:{ids:params_ids},
                        async: false,
                        dataType: "json",
                        error: function(request) {
                            layer.close(layerload);
                            data['msg'] = '启用失败！';
                            $.kh.fromTips(data,2);
                            $("#start").removeClass('disabled');
                            $("#start").removeAttr('disabled');
                        },
                        success: function(data) {
                            layer.close(layerload);
                            $.kh.fromTips(data,2);
                            $("#start").removeClass('disabled');
                            $("#start").removeAttr('disabled');
                            if(data.status != 500){
                                setTimeout(function (){
                                    location.replace(location.href);
                                }, 2000);
                            }
                        }
                    });
                });
            }
        });

        //禁用
        $("#ibox-content").on("click",'#stop',function(){
            var ids = $('#dataTable').bootstrapTable('getSelections','');
            var data = {};
            data['type'] = 'all';
            data['msg'] = '';
            data['status'] = 500;
            if(ids.length == 0){
                data['msg'] = '请选择要禁用的数据！';
                $.kh.fromTips(data,3);
            }else if(ids.length > 0){
                var arrID = [];
                $.each(ids, function(name, value) {
                    arrID.push(value.id);
                });
                var params_ids = arrID.join(',');
                layer.confirm('确定禁用这些数据?', {icon: 3, title:'提示'}, function(index){
                    layer.close(index);
                    var layerload = layer.load(0, {
                        shadeClose:true,
                        shade:[0.3,'#000']
                    });
                    $("#stop").addClass('disabled');
                    $("#stop").attr('disabled',true);
                    $.ajax({
                        cache: true,
                        type: "POST",
                        url:$('#stop').attr('data-url'),
                        data:{ids:params_ids},
                        async: false,
                        dataType: "json",
                        error: function(request) {
                            layer.close(layerload);
                            data['msg'] = '禁用失败！';
                            $.kh.fromTips(data,2);
                            $("#stop").removeClass('disabled');
                            $("#stop").removeAttr('disabled');
                        },
                        success: function(data) {
                            layer.close(layerload);
                            $.kh.fromTips(data,2);
                            $("#stop").removeClass('disabled');
                            $("#stop").removeAttr('disabled');
                            if(data.status != 500){
                                setTimeout(function (){
                                    location.replace(location.href);
                                }, 2000);
                            }
                        }
                    });
                });
            }
        });


        //查看
        $("#ibox-content").on("click",'#see',function(){
            var ids = $('#dataTable').bootstrapTable('getSelections','');
            var data = {};
            data['type'] = 'all';
            data['msg'] = '';
            data['status'] = 500;
            if(ids.length == 0){
                data['msg'] = '请选择一条要查看的数据！';
            }else if(ids.length > 1){
                data['msg'] = '只能选择一条数据查看！';
            }else if(ids.length == 1){
                var params_ids = ids[0].id;
                var url = $('#see').attr('data-url');
                url = url + '?id=' + params_ids;
                layer.open({
                    type: 2,
                    title: '查看详情',
                    shadeClose: true,
                    shade: 0.8,
                    area: ['90%', '90%'],
                    content: url //iframe的url
                });
                return;
            }
            $.kh.fromTips(data,3);
        });

        //删除
        $("#ibox-content").on("click",'#delete',function(){
            var ids = $('#dataTable').bootstrapTable('getSelections','');
            var data = {};
            data['type'] = 'all';
            data['msg'] = '';
            data['status'] = 500;
            if(ids.length == 0){
                data['msg'] = '请选择要删除的数据！';
                $.kh.fromTips(data,3);
            }else if(ids.length > 0){
                var arrID = [];
                $.each(ids, function(name, value) {
                    arrID.push(value.id);
                });
                var params_ids = arrID.join(',');
                layer.confirm('确定删除这些数据?', {icon: 3, title:'提示'}, function(index){
                    layer.close(index);
                    var layerload = layer.load(0, {
                        shadeClose:true,
                        shade:[0.3,'#000']
                    });
                    $("#delete").addClass('disabled');
                    $("#delete").attr('disabled',true);
                    $.ajax({
                        cache: true,
                        type: "POST",
                        url:$('#delete').attr('data-url'),
                        data:{ids:params_ids},
                        async: false,
                        dataType: "json",
                        error: function(request) {
                            layer.close(layerload);
                            data['msg'] = '删除失败！';
                            $.kh.fromTips(data,2);
                            $("#delete").removeClass('disabled');
                            $("#delete").removeAttr('disabled');
                        },
                        success: function(data) {
                            layer.close(layerload);
                            $.kh.fromTips(data,2);
                            $("#delete").removeClass('disabled');
                            $("#delete").removeAttr('disabled');
                            if(data.status != 500){
                                setTimeout(function (){
                                    location.replace(location.href);
                                }, 2000);
                            }
                        }
                    });
                });
            }
        });

        //var ids = [];

        ////分页
        //$('#ibox-content').on('click', '.pagination a', function (e) {
        //    var url = $(this).attr('href');
        //    $("#ibox-content").load(url+" #ibox-content");
        //    ids = [];
        //    return false;
        //});
        //
        ////选择
        //$("#ibox-content").on("click",'.choice',function(){
        //    var id = $(this).attr("data-id");
        //    var index = jQuery.inArray(id,ids);
        //    if(index == -1){
        //        ids.push(id);
        //        $(this).addClass('liAction');
        //    }else{
        //        ids.splice(index,1);
        //        $(this).removeClass('liAction');
        //    }
        //});

        ////更新
        //$("#ibox-content").on("click",'#update',function(){
        //    var data = {};
        //    data['type'] = 'all';
        //    data['msg'] = '';
        //    data['status'] = 500;
        //    if(ids.length == 0){
        //        data['msg'] = '请选择一条要修改的数据！';
        //    }else if(ids.length > 1){
        //        data['msg'] = '只能选择一条数据修改！';
        //    }else if(ids.length == 1){
        //        var params_ids = ids.join(',');
        //        var url = $('#update').attr('data-url');
        //        url = url + '?id=' + params_ids;
        //        location.href = url;
        //        return;
        //    }
        //    $.kh.fromTips(data,3);
        //});
        //
        // //审核
        //$("#ibox-content").on("click",'#varify',function(){
        //    var data = {};
        //    data['type'] = 'all';
        //    data['msg'] = '';
        //    data['status'] = 500;
        //    if(ids.length == 0){
        //        data['msg'] = '请选择一条要修改的数据！';
        //    }else if(ids.length > 1){
        //        data['msg'] = '只能选择一条数据修改！';
        //    }else if(ids.length == 1){
        //        var params_ids = ids.join(',');
        //        var url = $('#varify').attr('data-url');
        //        url = url + '?id=' + params_ids;
        //        location.href = url;
        //        return;
        //    }
        //    $.kh.fromTips(data,3);
        //});
        //
        ////查看
        //$("#ibox-content").on("click",'#see',function(){
        //    var data = {};
        //    data['type'] = 'all';
        //    data['msg'] = '';
        //    data['status'] = 500;
        //    if(ids.length == 0){
        //        data['msg'] = '请选择一条要查看的数据！';
        //    }else if(ids.length > 1){
        //        data['msg'] = '只能选择一条数据查看！';
        //    }else if(ids.length == 1){
        //        var params_ids = ids.join(',');
        //        var url = $('#see').attr('data-url');
        //        url = url + '?id=' + params_ids;
        //        layer.open({
        //            type: 2,
        //            title: '查看详情',
        //            shadeClose: true,
        //            shade: 0.8,
        //            area: ['90%', '90%'],
        //            content: url //iframe的url
        //        });
        //        return;
        //    }
        //    $.kh.fromTips(data,3);
        //});
        //
        ////删除
        //$("#ibox-content").on("click",'#delete',function(){
        //    var data = {};
        //    data['type'] = 'all';
        //    data['msg'] = '';
        //    data['status'] = 500;
        //    if(ids.length == 0){
        //        data['msg'] = '请选择要删除的数据！';
        //        $.kh.fromTips(data,3);
        //    }else if(ids.length > 0){
        //        var params_ids = ids.join(',');
        //        layer.confirm('确定删除这些数据?', {icon: 3, title:'提示'}, function(index){
        //            layer.close(index);
        //            var layerload = layer.load(0, {
        //                shadeClose:true,
        //                shade:[0.3,'#000']
        //            });
        //            $("#delete").addClass('disabled');
        //            $("#delete").attr('disabled',true);
        //            $.ajax({
        //                cache: true,
        //                type: "POST",
        //                url:$('#delete').attr('data-url'),
        //                data:{ids:params_ids},
        //                async: false,
        //                dataType: "json",
        //                error: function(request) {
        //                    layer.close(layerload);
        //                    data['msg'] = '删除失败！';
        //                    $.kh.fromTips(data,2);
        //                    $("#delete").removeClass('disabled');
        //                    $("#delete").removeAttr('disabled');
        //                },
        //                success: function(data) {
        //                    layer.close(layerload);
        //                    $.kh.fromTips(data,2);
        //                    $("#delete").removeClass('disabled');
        //                    $("#delete").removeAttr('disabled');
        //                    if(data.status != 500){
        //                        setTimeout(function (){
        //                            location.replace(location.href);
        //                        }, 2000);
        //                    }
        //                }
        //            });
        //        });
        //    }
        //});
    }
}