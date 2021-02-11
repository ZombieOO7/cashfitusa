$(document).ready(function () {
    /* Form Validation */
    $('input[name="ssn"]').keyup(function() {
        jQuery.validator.addMethod("alphanumeric", function(value, element) {
            return this.optional(element) || /^[+]*[(]{0,1}[0-9]{1,3}[)]{0,1}[-\s\./0-9]*$/i.test(value);
        }, "Numbers and dashes only");
    });
    $('input[name="ssn"]').keyup(function() {
        o = $(this).val();
        n = o.replace(/(\d{3})(\d{2})(\d{4})/, "$1-$2-$3");
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
            phone1: {
                required: !0,
                number: true,
                maxlength: rule.max_phone_length,
                minlength: rule.min_phone_length,
                noSpace: true,
            },
            phone2: {
                required: !0,
                number: true,
                maxlength: rule.max_phone_length,
                minlength: rule.min_phone_length,
                noSpace: true,
            },
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
            zip_code_length: {
                required: !0,
                maxlength: rule.zip_code_length,
                noSpace: true,
            },
            bank_name: {
                required: !0,
                maxlength: rule.name_length,
                noSpace: true,
            },
            account_type: {
                required: !0,
            },
            account_number: {
                required: !0,
                number: true,
                maxlength: rule.account_max_length,
                minlength: rule.account_min_length,
                noSpace: true,
            },
            routing_number: {
                required: !0,
                number: true,
                maxlength: rule.routing_max_length,
                minlength: rule.routing_max_length,
                noSpace: true,
                notEqualTo: "#account_number",
            },
            loan_amount:{
                required: !0,
                number: true,
                maxlength: rule.amount_length,
            },
            months :{
                required: !0,
                number: true,
            },
            months :{
                required: !0,
                number: true,
            },
            repayment_amount : {
                required: !0,
                number: true,
            },
            past_loan:{
                required: !0,
            },
            pending_loan:{
                required: !0,
            },
            pending_bill:{
                required: !0,
            },
            ssn:{
                required:true,
                maxlength: rule.ssn_length,
                minlength: rule.ssn_length,
                noSpace:true,
                alphanumeric: true
            },
            dob:{
                required:true,
                minAge: 18,
            },
            loan_type:{
                required:true,
            }
        },
        messages:{
            ssn:{
                maxlength:'Please enter no more than 9 characters.',
                minlength:'Please enter no more than 9 characters.',
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
    $("#m_form_2").validate({
        rules: {
            front_licence:{
                    required: function (element) {
                        if ($("#front_licence_url").attr('href') !=null) {
                            return false;
                        } else {
                            return true;
                        }
                    },
                    
            },
            back_licence:{
                    required: function (element) {
                        if ($("#back_licence_url").attr('href') !=null) {
                            return false;
                        } else {
                            return true;
                        }
                    },
                    
            },
            address_proof:{
                    required: function (element) {
                        if ($("#address_proof_url").attr('href') !=null) {
                            return false;
                        } else {
                            return true;
                        }
                    },
                    
            },
            selfie:{
                    required: function (element) {
                        if ($("#selfie_url").attr('href') !=null) {
                            return false;
                        } else {
                            return true;
                        }
                    },
                    
            },
            term_and_condition:{
                required: true,
            },
            identy:{
                required: true,
            }
        },
        ignore: [],
        errorPlacement: function (error, element) {
            console.log(element);
            if(element.attr("name") == 'front_licence')
                error.insertAfter('.frontLicence');
            else if(element.attr("name") == 'back_licence')
                error.insertAfter('.backLicence');
            else if(element.attr("name") == 'address_proof')
                error.insertAfter('.addressProof');
            else if(element.attr("name") == 'selfie')
                error.insertAfter('.selfieError');
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
        submitHandler: function (form) {
            if (!this.beenSubmitted) {
                this.beenSubmitted = true;
                form.submit();
            }
        },
    });
});

$('#addMore').on('click',function(){
    var i = $(document).find(".loanData").length;
    var loanData= $(".loanData").eq(0).clone();
    loanData.find('input').each(function() {
        this.name= this.name.replace('[0]', '['+i+']');
    });
    loanData.find('select').each(function() {
        this.name= this.name.replace('[0]', '['+i+']');
    });
    $(loanData).insertAfter($(".loanData").last());
    $(document).find($(".loanData").last()).addClass('mt-5');
});
$('#removeForm').on('click',function(){
    if($(document).find(".loanData").length > 1){
        $(document).find(".loanData").eq(0).remove();
    }
})

$('#m_form_1').submit(function(e){
    $('#m_form_1').validate();
    var user = $(document).find('input[name^="data"]');
    user.filter('input[name$="[loan_amount]"]').each(function() {
        $(this).rules("add", {
            required: !0,
            number: true,
            maxlength: rule.amount_length,
            messages: {
                required: "This field is required."
            }
        });
    });
    var select = $(document).find('select[name^="data"]');
    select.filter('select[name$="[months]"]').each(function() {
        $(this).rules("add", {
            required: true,
            messages: {
                required : 'This field is required.',
            }
        });
    });

    user.filter('input[name$="[repayment_amount]"]').each(function() {
        $(this).rules("add", {
            required: !0,
            number: true,
            maxlength: rule.amount_length,
            messages: {
                required : 'This field is required.',
            }
        });
    });

    user.filter('input[name$="[past_loan]"]').each(function() {
        $(this).rules("add", {
            required: !0,
            messages: {
                required : 'This field is required.',
            }
        });
    });

    user.filter('input[name$="[pending_loan]"]').each(function() {
        $(this).rules("add", {
            required: !0,
            messages: {
                required : 'This field is required.',
            }
        });
    });

    user.filter('input[name$="[past_bill]"]').each(function() {
        $(this).rules("add", {
            required: !0,
            messages: {
                required : 'This field is required.',
            }
        });
    });

    select.filter('select[name$="[status]"]').each(function() {
        $(this).rules("add", {
            required: !0,
            messages: {
                required : 'This field is required.',
            }
        });
    });

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

$("#flInp").change(function () {
    readURL(this,'#flicenceImg');
});
$("#blInp").change(function () {
    readURL(this,'#blicenceImg');
});
$("#adrInp").change(function () {
    readURL(this,'#addressImg');
});
$("#selfInp").change(function () {
    readURL(this,'#selfieImg');
});

$('.changeStatus').on('click',function(){
    id = $(this).attr('data-id');
    status = $(this).attr('data-value');
   swal({
        title: 'Are you sure?',
        text: 'You want to change status!',
        icon: "warning",
        buttons: true,
        dangerMode: true,
        closeOnClickOutside: false,
    }).then((isConfirm) => {
        if (isConfirm) {
            $.ajax({
                url: docUrl,
                method: "POST",
                data: {id: id, status: status},
                success: function (response) {
                    swal(response['msg'], {
                        icon: response['icon'],
                        closeOnClickOutside: false,
                    });
                    setTimeout(function(){
                        location.reload();
                    },2000);
                }
            })
        }
    });
})
$('#dob').datepicker({
    startDate: new Date('1920'),
    endDate: new Date(),
    autoclose: true, 
    todayHighlight: true
});
$('.stsBtn').on('click', function(){
    $('.stsBtn').addClass('disabled');
});