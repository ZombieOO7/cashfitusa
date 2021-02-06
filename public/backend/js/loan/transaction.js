(function ($) {
    var oppenIppsAssessment = function () {
        $(document).ready(function () {
            c._initialize();
        });
    };
    var c = oppenIppsAssessment.prototype;

    c._initialize = function () {
        c._listingView();
    };

    c._listingView = function () {
        var field_coloumns = [
            { "data": "installment"},
            { "data": "loan_amount" },
            { "data": "month" },
            { "data": "amount" },
            { "data": "date"},
        ];
        var order_coloumns = [[2, "asc"]];
        oppenIpps._generateDataTable('loan_transaction_table', url, field_coloumns, order_coloumns);
    };
    window.oppenIppsAssessment = new oppenIppsAssessment();
})(jQuery);
function saveData(event,fieldname,primaryid){
    value = $('#'+event.target.id).val();
    $.ajax({
        url:saveUrl,
        method:'POST',
        global:false,
        data:{
            id:primaryid,
            column:fieldname,
            value:value,
        },
        success:function(response){
            $(document).find('#loan_transaction_table .transactionDate').datepicker({
                // startDate: new Date('1920'),
                startDate: new Date(),
                autoclose: true, 
                todayHighlight: true
            })
        },
        error:function(response){

        }
    })
}
