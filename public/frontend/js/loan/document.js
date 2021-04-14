$(document).ready(function () {
    $('#frontLicence').on('click',function(){
        $('#frontLicenceId').click();
    })
    $('#backLicence').on('click',function(){
        $('#backLicenceId').click();
    })
    $('#addressProof').on('click',function(){
        $('#addressProofId').click();
    })
    $('#selfieProof').on('click',function(){
        $('#selfieId').click();
    })
    /* Form Validation */
    $("#m_form_1").validate({
        rules: {
            front_licence:{
                    required: function (element) {
                        if ($("#flicenceImg").attr('src') != '') {
                            return false;
                        } else {
                            return true;
                        }
                    },
                    accept: "image/jpg,image/jpeg,image/png,application/pdf",
            },
            back_licence:{
                required: function (element) {
                    if ($("#blicenceImg").attr('src') != '') {
                        return false;
                    } else {
                        return true;
                    }
                },
                accept: "image/jpg,image/jpeg,image/png,application/pdf",
            },
            address_proof:{
                required: function (element) {
                    if ($("#addressImg").attr('src') != '') {
                        return false;
                    } else {
                        return true;
                    }
                },
                accept: "image/jpg,image/jpeg,image/png,application/pdf",
            },
            selfie:{
                required: function (element) {
                    if ($("#selfieImg").attr('src') != '') {
                        return false;
                    } else {
                        return true;
                    }
                },
                accept: "image/jpg,image/jpeg,image/png,application/pdf",
            },
            term_and_condition:{
                required: true,
            },
            
        },
        ignore: [],
        errorPlacement: function (error, element) {
            console.log(element);
            if(element.attr("name") == 'front_licence')
                error.insertAfter('.frontLicenceError');
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
            $('#exampleModal4').modal('show');
            setTimeout(function(){    
                this.beenSubmitted = true;
                form.submit();
            },5000);
        },
    })
});
$(".uploadLoanImg").change(function () {
    classId= $(this).attr('data-class');
    thisClassId= $(this).attr('data-this_class');
    readURL(this,classId,thisClassId);
});

$('.removeImg').click(function(){
    classId= $(this).attr('data-class');
    thisClassId= $(this).attr('data-this_class');
    imageId = $(this).attr('data-id');
    $('.'+classId).show();
    $('.'+thisClassId).hide();    
    $('#'+imageId).val('');
})

function readURL(input,id,className) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var file = input.files[0];
        if ( /\.(jpe?g|png|gif)$/i.test(file.name) ) {
            reader.onload = function (e) {
                $('#'+id).attr('src', e.target.result);
                $('#'+id).css('width','460px');
                // $(id).css('display', 'block');
                $('.'+id).show();
                $('.'+className).hide();
            }
            reader.readAsDataURL(input.files[0]);
        }else{
            $('#'+id).attr('src', defaultImg);
            $('#'+id).css('width','150px');
            $('.'+id).show();
            $('.'+className).hide();
        }
    }
}