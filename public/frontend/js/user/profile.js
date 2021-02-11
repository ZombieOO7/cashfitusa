$.validator.addMethod("noSpace", function (value, element) {
    return $.trim(value);
}, "This field is required");

$.ajaxSetup({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrfToken"]').attr('content')}
});
$("#m_form_1").validate({
    rules: {
        first_name:{
            required: true,
            maxlength: rule.name_length,
            noSpace: true,
        },
        // middle_name:{
        //     required: true,
        //     maxlength: rule.name_length,
        //     noSpace: true,
        // },
        last_name:{
            required: true,
            maxlength: rule.name_length,
            noSpace: true,
        },
        email:{
            required: true,
            maxlength: rule.name_length,
            noSpace: true,
        },
        password:{
            required:false,
            minlength: rule.password_min_length,
            maxlength: rule.password_max_length,
        },
        phone:{
            required:true,
            maxlength: rule.max_phone_length,
            minlength: rule.min_phone_length,
        },
        address:{
            required:false,
            maxlength: rule.text_length,
        }
    },
    ignore: [],
    errorPlacement: function (error, element) {
        if(element.attr('name')=='phone'){
            error.insertAfter('.phoneError');
        }else{
            error.insertAfter(element);
        }
    },
    submitHandler: function (form) {
        if (!this.beenSubmitted) {
            this.beenSubmitted = true;
            form.submit();
        }
    },
});

$(function(){
    $("#upload_link").on('click', function(e){
        e.preventDefault();
        $("#upload:hidden").trigger('click');
    });
});
$("#upload").change(function () {
    readURL(this,'#img-preview');
});
function readURL(input,id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(id).attr('src', e.target.result);
            $(id).css('display', 'block');
        }
        reader.readAsDataURL(input.files[0]);
    }
}