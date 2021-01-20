<button style="margin: 0px;" id="exportMember" onclick="exportMember()" class="btn btn-primary" type="button">导出</button>
<script>
    function exportMember(){
        var searchForm = $("#searchForm").serialize();
        window.location.href='/qrCode/exportGoodsQrCode?'+ searchForm;
    }
</script>