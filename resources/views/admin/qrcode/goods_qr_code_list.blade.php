<button style="margin: 0px;" id="goods_qr_code_list" onclick="goods_qr_code_list()" class="btn btn-primary" type="button">查看相关二维码</button>
<script>
    function goods_qr_code_list(){
//        var searchForm = $("#searchForm").serialize();
        window.location.href='/qrCode/exportGoodsQrCode?'+ searchForm;

        var ids = $('#dataTable').bootstrapTable('getSelections','');
        var data = {};
        data['type'] = 'all';
        data['msg'] = '';
        data['status'] = 500;
        if(ids.length > 1){
            data['msg'] = '只能选择一个批次！';
            $.kh.fromTips(data,3);
        }else if(ids.length == 0){
            data['msg'] = '请选择一个批次！';
            $.kh.fromTips(data,3);
        }else if(ids.length == 1){
            var id = ids[0].batch;
            window.location.href='/qrCode/goodsQrCodeList?batchKey='+ id;
        }
    }
</script>