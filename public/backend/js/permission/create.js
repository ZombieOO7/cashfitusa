$(document).ready(function () {
    $("#m_form_1").validate({
        rules: {
            name: {
                required: true,
                maxlength:rule.name_length,
                noSpace: true,
            },
        },
        ignore: [],
        errorPlacement: function (error, element) {

            error.insertAfter(element);
        },
        invalidHandler: function (e, r) {
            $("#m_form_1_msg").removeClass("m--hide").show(),
                mUtil.scrollTop()
        },
    });
}); 