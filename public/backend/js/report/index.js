
var today = new Date();
var minDate = new Date();
var dateOption = {
    orientation: 'bottom auto',
    format: 'yyyy',
    todayHighlight:'TRUE',
    autoclose: true,
    viewMode: "years", 
    minViewMode: "years",
    startDate : '1980',
    endDate: today,
}
$('#year').datepicker(dateOption);
$(document).find("#month").select2();
$(document).find("#date").select2();
$(document).find("#status").select2();
// form validation
$(document).ready(function () {
    $("#m_form_1").validate({
        rules: {
            year:{
                required:true,
            }
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        invalidHandler: function (e, r) {
            $("#m_form_1_msg").removeClass("m--hide").show(),
                mUtil.scrollTop()
        },
    });
})
// view job report data
$('#viewReport').on('click',function(){
    var year = $('#year').val();
    var month = $('#month').val();
    var date = $('#date').val();
    var status = $('#status').val();
    if($("#m_form_1").valid()){
        $.ajax({
            url: url,
            method: "POST",
            datatype: "html",
            data: {
                year:year,
                month:month,
                date:date,
                status:status,
            },
            global:false,
            async: false,
            success: function (response) {
                if(response.msg !=undefined){
                    $('#tableContent').empty();
                    swal(response['msg'], {
                        icon: response['icon'],
                        closeOnClickOutside: false,
                    });
                }else{
                    $('#tableContent').html(response);
                }
            }
        });
    }
})
// clear inputs value and reset job detail
$('#clearBtn').on('click', function(){
    $('#tableContent').empty();
    $('input:text').val('');
    $('#month').val('').change();
    $('#date').val('').change();
})