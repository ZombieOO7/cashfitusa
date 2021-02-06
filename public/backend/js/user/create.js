$(document).ready(function () {
    /* Form Validation */
    $("#m_form_1").validate({
        rules: {
            first_name: {
                required: true,
                maxlength: rule.name_length,
                noSpace: true,
            },
            last_name: {
                required: true,
                maxlength: rule.name_length,
                noSpace: true,
            },
            middle_name: {
                required: true,
                maxlength: rule.name_length,
                noSpace: true,
            },
            email: {
                required: !0,
                email: !0,
                maxlength: rule.email_length,
                noSpace: true,
            },
            confirm_email: {
                required: !0,
                email: !0,
                maxlength: rule.email_length,
                noSpace: true,
                equalTo: "#email",
            },
            password: {
                required: function (element) {
                    if ($("#id").val().length > 0) {
                        return false;
                    } else {
                        return true;
                    }
                },
                minlength: rule.password_min_length,
                maxlength: rule.password_max_length,
            },
            confirm_password: {
                required: function (element) {
                    if ($("#id").val().length > 0) {
                        return false;
                    } else {
                        return true;
                    }
                },
                minlength: rule.password_min_length,
                maxlength: rule.password_max_length,
                equalTo: "#password",
            },
            phone: {
                required: !0,
                maxlength: rule.max_phone_length,
                minlength: rule.min_phone_length,
                noSpace: true,
                number:true,
            },
            address: {
                required: !0,
                maxlength: rule.text_length,
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
        submitHandler: function (form) {
            if (!this.beenSubmitted) {
                this.beenSubmitted = true;
                form.submit();
            }
        },
    });
});
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#image_upload_preview').attr('src', e.target.result);
            $('#image_upload_preview').css('display', 'block');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imgInput").change(function () {
    readURL(this);
});
