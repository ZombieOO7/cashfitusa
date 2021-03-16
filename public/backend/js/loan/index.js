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
            { "data": "checkbox", orderable: false, searchable: false },
            { "data": "created_at"},
            { "data": "first_name" },
            { "data": "middle_name" },
            { "data": "last_name" },
            // { "data": "email" },
            { "data": "account_number"},
            { "data": "document_status" },
            { "data": "status" },
            { "data": "action", orderable: false, searchable: false },
        ];
        var order_coloumns = [[1, "desc"]];
        oppenIpps._generateDataTable('loan_table', url, field_coloumns, order_coloumns);
    };
    window.oppenIppsAssessment = new oppenIppsAssessment();
})(jQuery);

$("#startDate").datepicker({
    // startDate: new Date(),
    autoclose: true,
    todayHighlight: true
}).on('changeDate', function (selected) {
    var minDate = new Date(selected.date.valueOf());
    $('#endDate').datepicker('setStartDate', minDate);
});

$("#endDate").datepicker({
    startDate: new Date(),
    autoclose: true,
    todayHighlight: true,
    endDate : new Date(),
}).on('changeDate', function (selected) {
});

$("#exportData").validate({
    rules: {
        from_date:{
            required:true,
        },
        to_date:{
            required:true,
        }
    },
    ignore: [],
    errorPlacement: function (error, element) {
        error.insertAfter(element);
    },
    submitHandler: function (form) {
        if (!this.beenSubmitted) {
            this.beenSubmitted = true;
            form.submit();
        }
    },
});