$(document).ready(function () {
    $('input[name="ssn"]').keyup(function() {
        jQuery.validator.addMethod("alphanumeric", function(value, element) {
            return this.optional(element) || /^[+]*[(]{0,1}[0-9]{1,3}[)]{0,1}[-\s\./0-9]*$/i.test(value);
        }, "Numbers and dashes only");
    });
    $('input[name="ssn"]').keyup(function() {
        o = $(this).val();
        n = o.replace(/(\d{3})(\d{3})(\d{3})/, "$1-$2-$3");
        $(this).val(n);
    })
    $.validator.addMethod("minAge", function(value, element, min) {
        var today = new Date();
        var birthDate = new Date(value);
        var age = today.getFullYear() - birthDate.getFullYear();
        if (age > min+1) { return true; }
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) { age--; }
        return age >= min;
    }, "You must be at least 18 years of age.");
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
            // middle_name: {
            //     required: true,
            //     maxlength: rule.name_length,
            //     noSpace: true,
            // },
            address1: {
                required: !0,
                maxlength: rule.text_length,
            },
            city: {
                required: !0,
                maxlength: rule.name_length,
                noSpace: true,
            },
            state: {
                required: !0,
                maxlength: rule.name_length,
                noSpace: true,
            },
            zip_code: {
                required: !0,
                maxlength: rule.zip_code_length,
                noSpace: true,
            },
            front_licence:{
                    required: function (element) {
                        if ($("input[name=front_licence_name]").val() !=null) {
                            return false;
                        } else {
                            return true;
                        }
                    },
                    extension: "jpg|jpeg|png"
            },
            address_proof:{
                    required: function (element) {
                        if ($("input[name=address_proof_name]").val() !=null) {
                            return false;
                        } else {
                            return true;
                        }
                    },
                    extension: "jpg|jpeg|png"
            },
            ssn:{
                required:true,
                maxlength: rule.ssn_length,
                minlength: rule.ssn_length,
                noSpace:true,
                alphanumeric: true
            },
            app_id:{
                required:true,
            },
            user_id:{
                required:true,
            },
            dob:{
                required:true,
                minAge: 18,
            },
        },
        messages:{
            ssn:{
                maxlength:'Please enter no more than 9 characters.',
                minlength:'Please enter no more than 9 characters.',
            },
        },
        ignore: [],
        errorPlacement: function (error, element) {
            console.log(element);
            if(element.attr("name") == 'front_licence')
                error.insertAfter('.frontLicence');
            else if(element.attr("name") == 'address_proof')
                error.insertAfter('.addressProof');
            else if(element.attr("name") == 'term_and_condition'){
                error.insertAfter('.tnc');
            }else{
                error.insertAfter(element);
            }
        },
        invalidHandler: function (e, r) {
            $("#m_form_1_msg").removeClass("m--hide").show(),
                mUtil.scrollTop()
        },
        // submitHandler: function (form) {
            // if (!this.beenSubmitted) {
            //     this.beenSubmitted = true;
            //     form.submit();
            // }
        // },
    })
});
$("#dob").datepicker({    
    startDate: new Date('1920'),
    endDate: new Date(),
    autoclose: true, 
    todayHighlight: true
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
$("#imgInp").change(function () {
    readURL(this,'#flicenceImg');
});
$("#imgAddress").change(function () {
    readURL(this,'#addressImg');
});
$("#imgInp2").change(function () {
    readURL(this,'#blicenceImg');
});