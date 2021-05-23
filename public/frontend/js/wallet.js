$.validator.addMethod("noSpace", function (value, element) {
    return $.trim(value);
}, "This field is required");
$("#m_form_1").validate({
    rules: {
        bank_name:{
            required:true,
            maxlength: rule.name_length,
            noSpace: true,
        },
        month:{
            required:true,
            maxlength: rule.name_length,
        },
        year:{
            required:true,
            maxlength: rule.name_length,
        },
        debit_card_no:{
            required:true,
            maxlength: rule.account_max_length,
            minlength: rule.account_min_length,
        },
        cvv:{
            required:true,
            maxlength: 3,
            minlength: 3,
        },
        amount:{
            required:true,
            maxlength:5,
        }
    },
    ignore: ':hidden',
    errorPlacement: function (error, element) {
            error.insertAfter(element);
    },
    submitHandler: function (form) {
        if (!this.beenSubmitted) {
            $('#exampleModal').modal('hide');
            // setTimeout(function(){
            //     $('#exampleModal1').modal('show');
            // },3000);
            // setTimeout(function(){    
                this.beenSubmitted = true;
                form.submit();
            // },5000);
        }
    },
});