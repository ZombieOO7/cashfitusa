$(document).ready(function () {
    if($("#m_form_1").length > 0){
        $("#m_form_1").validate({
            rules: {
                amount:{
                    required:true,
                    number:true,
                    min:500,
                    max:7800,
                    maxlength:rule.amount_length,
                },
                year:{
                    required:true,
                }
            },
            ignore: [],
            errorPlacement: function (error, element) {
                if (element.attr("name") == "year")
                    error.insertAfter(".yearError");
                else
                    error.insertAfter(element);
            },
            invalidHandler: function (e, r) {
                // $("#m_form_1_msg").removeClass("m--hide").show(),
                // mUtil.scrollTop()
            },
        });
    }
    if($("#m_form_2").length > 0){
        $("#m_form_2").validate({
            rules: {
                amount:{
                    required:true,
                    number:true,
                    min:500,
                    max:7800,
                    maxlength:rule.amount_length,
                },
                year:{
                    required:true,
                }
            },
            ignore: [],
            errorPlacement: function (error, element) {
                if (element.attr("name") == "year")
                    error.insertAfter(".yearError");
                else
                    error.insertAfter(element);
            },
            invalidHandler: function (e, r) {
                // $("#m_form_1_msg").removeClass("m--hide").show(),
                // mUtil.scrollTop()
            },
        });
    }
});
if($('#loan_table').length > 0){

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
                { "data": "created_at"},
                { "data": "auto_account_number" },
                { "data": "loan_amount" },
                { "data": "months" },
                { "data": "repayment_amount" },
                { "data": "document_status" },
                { "data": "status" },
                { "data": "action", orderable: false, searchable: false },
            ];
            var order_coloumns = [[0, "desc"]];
            var user_id = id;
            oppenIpps._generateDataTable('loan_table', url, field_coloumns, order_coloumns,user_id);
        };
        window.oppenIppsAssessment = new oppenIppsAssessment();
    })(jQuery);
}