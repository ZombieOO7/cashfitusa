$(document).ready(function () {

    /* Form Validation */
    $("#m_form_1").validate({
        rules: {
            app_id:{
                required:true,
            },
            user_id:{
                required:true,
            },
            amount:{
                required:true,
                number:true,
            },
            date:{
                required:true,
            },
            status:{
                required:true,
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
$('#appId').on('change',function(){
    $.ajax({
        url: url,
        method:'post',
        data: {
            app_id: $(this).val(),
        },
        success: function (response) {
            $.each(response.earningUser,function(key,value){
                $('#user_id').append(new Option(value, key))
                // $('#appId').append($("<option></option>")
                // .attr("value", key)
                // .text(value));
            });
        }
    })
});