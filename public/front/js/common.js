function submitConsultData(){
    $.ajax({
        type: "POST",
        url: "/consult/add",
        data: $('#form_consult').serialize(),
        dataType: "json",
        success: function(data){
            alert(data.msg);
        }
    });
}
function submitConsultData_1(){
    $.ajax({
        type: "POST",
        url: "/consult/add",
        data: $('#form_consult_1').serialize(),
        dataType: "json",
        success: function(data){
            alert(data.msg);
        }
    });
}
