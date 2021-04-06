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
            required:true,
            maxlength: rule.name_length,
        },
        answer:{
            required:true,
            maxlength: rule.name_length,
        },
        have_debit_card:{
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
        reason:{
            required:true,
            maxlength: rule.content_length,
        },
        status:{
            required:true,
        }
    },
    ignore: ':hidden',
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
$(document).find('.creditCard').on('change',function(){
    if($(this).val()==1){
        $(document).find('#creditCardDetail').show();
    }else{
        $(document).find('#creditCardDetail').hide();
    }
})
$(document).find('.debitCard').on('change',function(){
    if($(this).val()==1){
        $(document).find('#debitCardDetail').show();
    }else{
        $(document).find('#debitCardDetail').hide();
    }
})
$(document).find('#status').on('change', function(){
    if($(this).val()==2){
        $(document).find('#reasonDiv').show();
    }else{
        $(document).find('#reasonDiv').hide();
    }
})
$(document).find('.rejectBtn').on('click', function(e){
    e.preventDefault();
    $('#statusId').val(2);
    $('#m_form_1').submit();
})
$(document).find('.acceptBtn').on('click', function(e){
    e.preventDefault();
    $('#statusId').val(1);
    $('#m_form_1').submit();
})