
$(document).ready(function () {
    /* Form Validation */
    $("#m_form_1").validate({
        rules: {
            user_id: {
                required: true,
            },
            wallet_ballance: {
                required: true,
                maxlength: rule.amount_length,
                noSpace: true,
                number:true,
            },
            transfer_amount:{
                required: true,
                maxlength: rule.amount_length,
                noSpace: true,
                number:true,
            },
            withdrawal_amount:{
                required: true,
                maxlength: rule.amount_length,
                noSpace: true,
                number:true,
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
