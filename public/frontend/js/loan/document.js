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
    $('#aselfieId').on('click',function(){
        $('#selfieId').click();
    })
    /* Form Validation */
    $("#m_form_1").validate({
        rules: {
            front_licence:{
                    required: function (element) {
                        if ($("#m-dropzone-one .dz-preview").length > 0) {
                            return false;
                        } else {
                            return true;
                        }
                    },
            },
            back_licence:{
                    required: function (element) {
                        if ($("#m-dropzone-two .dz-preview").length > 0) {
                            return false;
                        } else {
                            return true;
                        }
                    },
            },
            address_proof:{
                    required: function (element) {
                        if ($("#m-dropzone-three .dz-preview").length > 0) {
                            return false;
                        } else {
                            return true;
                        }
                    },
            },
            selfie:{
                    required: function (element) {
                        if ($("#m-dropzone-four .dz-preview").length > 0) {
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
                // form.submit();
                // Simulate an HTTP redirect:
                window.location.replace(url);
            }
        },
    })
});