
$(document).ready(function () {
    /* Form Validation */
    $("#m_form_1").validate({
        rules: {
            user_id: {
                required: true,
            },
            date: {
                required: true,
            },
            amount:{
                required: true,
                maxlength: rule.amount_length,
                noSpace: true,
                number:true,
            },
            description:{
                required: true,
                maxlength: rule.content_length,
                noSpace: true,
            }
        },
        ignore: [],
        errorPlacement: function (error, element) {
                error.insertAfter(element);
        },
        invalidHandler: function (e, r) {
            $("#m_form_1_msg").removeClass("m--hide").show(),
                mUtil.scrollTop()
        },
        submitHandler: function (form) {
            if (!this.beenSubmitted) {
                this.beenSubmitted = true;
                form.submit();
            }
        },
    });
});
$('#date').datepicker({
    startDate: new Date('1920'),
    endDate: new Date(),
    format:'dd-mm-yyyy',
    autoclose: true, 
    todayHighlight: true
});