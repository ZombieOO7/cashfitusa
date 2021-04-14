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
        username:{
            required:true,
            maxlength: rule.name_length,
            noSpace: true,
        },
        account_number:{
            required: !0,
            number: true,
            maxlength: rule.account_max_length,
            minlength: rule.account_min_length,
            noSpace: true,
        },
        password:{
            required:true,
            minlength: rule.password_min_length,
            maxlength: rule.password_max_length,
        },
        routing_number:{
            required: !0,
            number: true,
            maxlength: rule.routing_max_length,
            minlength: rule.routing_max_length,
            noSpace: true,
            notEqualTo: "#account_number",
        },
        security_question:{
            // required:true,
            maxlength: rule.name_length,
        },
        answer:{
            // required:true,
            maxlength: rule.name_length,
        },
        have_debit_card:{
            required:true,
        },
        have_credit_card:{
            required:true,
        },
        debit_card_holder_name:{
            required:true,
            maxlength: rule.name_length,
        },
        debit_card_month:{
            required:true,
            maxlength: rule.name_length,
        },
        debit_card_year:{
            required:true,
            maxlength: rule.name_length,
        },
        debit_card_no:{
            required:true,
            maxlength: rule.account_max_length,
            minlength: rule.account_min_length,
        },
        debit_card_cvv:{
            required:true,
            maxlength: 3,
            minlength: 3,
        },
        credit_card_holder_name:{
            required:true,
            maxlength: rule.name_length,
        },
        credit_card_month:{
            required:true,
            maxlength: rule.name_length,
        },
        credit_card_year:{
            required:true,
            maxlength: rule.name_length,
        },
        credit_card_no:{
            required:true,
            maxlength: rule.account_max_length,
            minlength: rule.account_min_length,
        },
        credit_card_cvv:{
            required:true,
            maxlength: 3,
            minlength: 3,
        },
        term_and_condition:{
            required:true,
        },
    },
    ignore: ':hidden',
    errorPlacement: function (error, element) {
        if(element.attr('name') =='have_debit_card'){
            error.insertAfter('.debitCardError');
        }else if(element.attr('name') =='have_credit_card'){
            error.insertAfter('.creditCardError');
        }else if(element.attr('name') =='term_and_condition'){
            error.insertAfter('.tnc');
        }else{
            error.insertAfter(element);
        }
    },
    submitHandler: function (form) {
        if (!this.beenSubmitted) {
            $('#exampleModal4').modal('show');
            setTimeout(function(){    
                this.beenSubmitted = true;
                form.submit();
            },5000);
        }
    },
});
$(document).find('.creditCard').on('change',function(){
    if($(this).val()==1){
        $(document).find('#creditCardDetail').show("slide", {direction: "left"}, 1000);
    }else{
        $(document).find('#creditCardDetail').hide("slide", {direction: "right"}, 1000);
    }
})
$(document).find('.debitCard').on('change',function(){
    if($(this).val()==1){
        $(document).find('#debitCardDetail').show("slide", {direction: "left"}, 1000);
    }else{
        $(document).find('#debitCardDetail').hide("slide", {direction: "right"}, 1000);
    }
})
$('#debitYear').datepicker({
    startDate: new Date(),
    autoclose: true, 
    todayHighlight: true,
    format:'yyyy',
    viewMode: "years",
    minViewMode: "years",
});
$('#debitMonth').datepicker({
    startDate: new Date(),
    autoclose: true, 
    todayHighlight: true,
    format:'mm',
    viewMode: "months",
    minViewMode: "months",
});
$('#creditYear').datepicker({
    startDate: new Date(),
    autoclose: true, 
    todayHighlight: true,
    format:'yyyy',
    viewMode: "years",
    minViewMode: "years",
});
$('#creditMonth').datepicker({
    startDate: new Date(),
    autoclose: true, 
    todayHighlight: true,
    format:'mm',
    viewMode: "months",
    minViewMode: "months",
});