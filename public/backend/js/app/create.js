
$(document).ready(function () {
    /* Form Validation */
    $("#m_form_1").validate({
        rules: {
            'title': {
                required: true,
                maxlength: rule.name_length,
                noSpace: true,
            },
            status: {
                required: true,
            },
            image_file: {
                required: function (element) {
                    if ($("#stored_img_id").val() != "") {
                        return false;
                    } else {
                        return true;
                    }
                },
                extension: "jpg|jpeg|png",
            },
            video_file : {
                required: function (element) {
                    if ($("#stored_video_id").val() != "") {
                        return false;
                    } else {
                        return true;
                    }
                },
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
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
            $('#blah').css('display', 'block');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imgInput").change(function () {
    readURL(this);
});