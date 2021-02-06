(function ($)
{
    var oppenIppsAssessment = function ()
    {
        //On class intialize call default
        $(document).ready(function() {
            c.intialize();
        });
    };
    var c = oppenIppsAssessment.prototype;

    //Page on load event
    c.intialize = function() {
        c.validateGeneralForm();
        c.validateMetaForm();
        c.changeEvent();
        c.changeEventFavicon();
    };

    c.validateGeneralForm = function() {
        $("#general_form_1").validate({
            rules: {
                title: {
                    required: true,
                    maxlength:rule.text_length,
                },
                max_amount_length: {
                    required: true,
                    maxlength:rule.phone_length,
                },
                percentage: {
                    required: true,
                    min:1,
                    max:100,
                },
                email: {
                    required: true,
                    email:true,
                    maxlength:rule.text_length,
                },
                web_logos: {
                    // required: function (element) {
                    //     if ($("#id").val().length > 0) {
                    //         return false;
                    //     } else {
                    //         return true;
                    //     }
                    // },
                    extension: "jpg|jpeg|png"
                },
            },
            ignore: [],
            invalidHandler: function (e, r) {
                mUtil.scrollTop()
            },
            submitHandler: function (form) {
                // Prevent double submission
                if (!this.beenSubmitted) {
                    this.beenSubmitted = true;
                    form.submit();
                }
            },
        });
        $("#general_form_2").validate({
            rules: {
                facebook_url: {
                    required: true,
                    maxlength:rule.text_length,
                },
                twitter_url: {
                    required: true,
                    maxlength:rule.text_length,
                },
                youtube_url:{
                    required: true,
                    maxlength:rule.text_length,
                }
            },
            ignore: [],
            invalidHandler: function (e, r) {
                mUtil.scrollTop()
            },
            submitHandler: function (form) {
                // Prevent double submission
                if (!this.beenSubmitted) {
                    this.beenSubmitted = true;
                    form.submit();
                }
            },
        });
    };

    c.validateMetaForm = function() {
        jQuery.validator.addMethod("matches", function(value, element) {
            return value.match(/^\+(?:[0-9] ?){6,14}[0-9]$/);
        }, "Please specify a valid phone number");
        $("#sms_form").validate({
            rules: {
                twilio_sid: {
                    required: true,
                },
                twilio_auth_token: {
                    required: true,
                },
                twilio_number:{
                    required: true,
                    matches: true,
                    minlength:12, 
                    maxlength:13
                }
            },
            ignore: [],
            invalidHandler: function (e, r) {
                mUtil.scrollTop()
            },
            submitHandler: function (form) {
                // Prevent double submission
                if (!this.beenSubmitted) {
                    this.beenSubmitted = true;
                    form.submit();
                }
            },
        });
    };

    c.changeEvent = function() {
        $("#image").change(function () {
            readURL(this);
        });
    };
    c.changeEventFavicon = function() {
        $("#images").change(function () {
            readsURL(this);
        });
    };
    window.oppenIppsAssessment = new oppenIppsAssessment();
})(jQuery);