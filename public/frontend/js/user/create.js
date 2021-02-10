$.validator.addMethod("noSpace", function (value, element) {
    return $.trim(value);
}, "This field is required");
$('#ssn').keyup(function() {
    jQuery.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^[+]*[(]{0,1}[0-9]{1,3}[)]{0,1}[-\s\./0-9]*$/i.test(value);
    }, "Numbers and dashes only");
});
$('#ssn').keyup(function() {
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
$('#dob').datepicker({
    startDate: new Date('1920'),
    endDate: new Date(),
    autoclose: true, 
    todayHighlight: true
});
/*
t = m_wizard
*/
var zombie =null;
var mWizard2 = function (t, e) {
    var a = this,
        n = mUtil.get(t);
    mUtil.get("body");
    if (n) {
        var o = {
                startStep: 1,
                manualStepForward: !1
            },
            l = {
                construct: function (t) {
                    return mUtil.data(n).has("wizard") ? a = mUtil.data(n).get("wizard") : (l.init(t), l.build(), mUtil.data(n).set("wizard", a)), a
                },
                init: function (t) {
                    a.element = n, a.events = [], a.options = mUtil.deepExtend({}, o, t), a.steps = mUtil.findAll(n, ".m-wizard__step"), a.progress = mUtil.find(n, ".m-wizard__progress .progress-bar"), a.btnSubmit = mUtil.find(n, '[data-wizard-action="submit"]'), a.btnNext = mUtil.find(n, '[data-wizard-action="next"]'), a.btnPrev = mUtil.find(n, '[data-wizard-action="prev"]'), a.btnLast = mUtil.find(n, '[data-wizard-action="last"]'), a.btnFirst = mUtil.find(n, '[data-wizard-action="first"]'), a.events = [], a.currentStep = 1, a.stopped = !1, a.totalSteps = a.steps.length -1 , a.options.startStep > 1 && l.goTo(a.options.startStep), l.updateUI()
                },
                build: function () {
                    mUtil.addEvent(a.btnNext, "click", function (t) {
                        t.preventDefault(), l.goNext()
                    }), mUtil.addEvent(a.btnPrev, "click", function (t) {
                        t.preventDefault(), l.goPrev()
                    }), mUtil.addEvent(a.btnFirst, "click", function (t) {
                        t.preventDefault(), l.goFirst()
                    }), mUtil.addEvent(a.btnLast, "click", function (t) {
                        t.preventDefault(), l.goLast()
                    }), mUtil.on(n, ".m-wizard__step a.m-wizard__step-number", "click", function () {
                        for (var t, e = this.closest(".m-wizard__step"), n = mUtil.parents(this, ".m-wizard__steps"), o = mUtil.findAll(n, ".m-wizard__step"), i = 0, r = o.length; i < r; i++)
                            if (e === o[i]) {
                                t = i + 1;
                                break
                            } t && (!1 === a.options.manualStepForward ? t < a.currentStep && l.goTo(t) : l.goTo(t))
                    })
                },
                goTo: function (t) {
                    if(zombie != null){
                        t = 2;
                        a.currentStep = 1;
                    }
                    if (!(t === a.currentStep || t > a.totalSteps || t < 0)) {
                        var e;
                        zombie = null;
                        if (e = (t = t ? parseInt(t) : l.getNextStep()) > a.currentStep ? l.eventTrigger("beforeNext") : l.eventTrigger("beforePrev"), !0 !== a.stopped) return !1 !== e && (l.eventTrigger("beforeChange"), a.currentStep = t, l.updateUI(), l.eventTrigger("change")), t > a.startStep ? l.eventTrigger("afterNext") : l.eventTrigger("afterPrev"), a;
                        a.stopped = !1
                    }
                },
                setStepClass: function () {
                    l.isLastStep() ? mUtil.addClass(n, "m-wizard--step-last") : mUtil.removeClass(n, "m-wizard--step-last"), l.isFirstStep() ? mUtil.addClass(n, "m-wizard--step-first") : mUtil.removeClass(n, "m-wizard--step-first"), l.isBetweenStep() ? mUtil.addClass(n, "m-wizard--step-between") : mUtil.removeClass(n, "m-wizard--step-between")
                },
                updateUI: function (t) {
                    l.updateProgress(), l.handleTarget(), l.setStepClass();
                    for (var e = 0, n = a.steps.length; e < n; e++) mUtil.removeClass(a.steps[e], "m-wizard__step--current m-wizard__step--done");
                    for (e = 1; e < a.currentStep; e++) mUtil.addClass(a.steps[e - 1], "m-wizard__step--done");
                    mUtil.addClass(a.steps[a.currentStep - 1], "m-wizard__step--current")
                },
                stop: function () {
                    a.stopped = !0
                },
                start: function () {
                    a.stopped = !1
                },
                isLastStep: function () {
                    return a.currentStep === a.totalSteps
                },
                isFirstStep: function () {
                    return 1 === a.currentStep
                },
                isBetweenStep: function () {
                    return !1 === l.isLastStep() && !1 === l.isFirstStep()
                },
                goNext: function () {
                    return l.goTo(l.getNextStep())
                },
                goPrev: function () {
                    return l.goTo(l.getPrevStep())
                },
                goLast: function () {
                    return l.goTo(a.totalSteps)
                },
                goFirst: function () {
                    return l.goTo(1)
                },
                updateProgress: function () {
                    if (a.progress)
                        if (mUtil.hasClass(n, "m-wizard--1")) {
                            var t = a.currentStep / a.totalSteps * 100,
                                e = mUtil.find(n, ".m-wizard__step-number"),
                                o = parseInt(mUtil.css(e, "width"));
                            mUtil.css(a.progress, "width", "calc(" + t + "% + " + o / 2 + "px)")
                        } else if (mUtil.hasClass(n, "m-wizard--2")) {
                        a.currentStep;
                        var i = (a.currentStep - 1) * (1 / (a.totalSteps - 1) * 100);
                        mUtil.isInResponsiveRange("minimal-desktop-and-below") ? mUtil.css(a.progress, "height", i + "%") : mUtil.css(a.progress, "width", i + "%")
                    } else {
                        t = a.currentStep / a.totalSteps * 100;
                        mUtil.css(a.progress, "width", t + "%")
                    }
                },
                handleTarget: function () {
                    var t = a.steps[a.currentStep - 1],
                        e = mUtil.get(mUtil.attr(t, "m-wizard-target")),
                        o = mUtil.find(n, ".m-wizard__form-step--current");
                    mUtil.removeClass(o, "m-wizard__form-step--current"), mUtil.addClass(e, "m-wizard__form-step--current")
                },
                getNextStep: function () {
                    return a.totalSteps >= a.currentStep + 1 ? a.currentStep + 1 : a.totalSteps
                },
                getPrevStep: function () {
                    return a.currentStep - 1 >= 1 ? a.currentStep - 1 : 1
                },
                eventTrigger: function (t) {
                    for (i = 0; i < a.events.length; i++) {
                        var e = a.events[i];
                        e.name == t && (1 == e.one ? 0 == e.fired && (a.events[i].fired = !0, e.handler.call(this, a)) : e.handler.call(this, a))
                    }
                },
                addEvent: function (t, e, n) {
                    return a.events.push({
                        name: t,
                        handler: e,
                        one: n,
                        fired: !1
                    }), a
                }
            };
        return a.setDefaults = function (t) {
            o = t
        }, a.goNext = function () {
            return l.goNext()
        }, a.goPrev = function () {
            return l.goPrev()
        }, a.goLast = function () {
            return l.goLast()
        }, a.stop = function () {
            return l.stop()
        }, a.start = function () {
            return l.start()
        }, a.goFirst = function () {
            return l.goFirst()
        }, a.goTo = function (t) {
            return l.goTo(t)
        }, a.getStep = function () {
            return a.currentStep
        }, a.isLastStep = function () {
            return l.isLastStep()
        }, a.isFirstStep = function () {
            return l.isFirstStep()
        }, a.on = function (t, e) {
            return l.addEvent(t, e)
        }, a.one = function (t, e) {
            return l.addEvent(t, e, !0)
        }, l.construct.apply(a, [e]), a
    }
};

$.ajaxSetup({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrfToken"]').attr('content')}
});

$('input[name="loan_amount"]').on('change',function(){
    calculate();
})

$('select[name="months"]').on('change',function(){
    calculate();
})

function calculate(){
    var amount = parseInt($('input[name="loan_amount"]').val());
    var months = parseInt($('select[name="months"]').val());
    var years = months /12;
    principle = amount * (pr*years) / 100;
    months = months;
    returnPerMonth = (amount + principle) / months;
    $('input[name="repayment_amount"]').val(returnPerMonth.toFixed(1));
}

var WizardDemo = function () {
    $("#m_wizard");
    var e, r, i = $("#m_form");
    return {
        init: function () {
            var n;
            $("#m_wizard"), i = $("#m_form"), (r = new mWizard2("m_wizard", {
                startStep: 1,
            })).on("beforeNext", function (r) {
                !0 !== e.form() && r.stop()
            }), r.on("change", function (e) {
                mUtil.scrollTop()
            }),
             e = i.validate({
                ignore: ":hidden",
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
                        remote: {
                            url: validateEmailURL,
                            type: "POST",
                            global: false,
                            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                            data: {
                                value: function () {
                                    return $("#email").val();
                                },
                            }
                        },
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
                        maxlength: rule.max_phone_length,
                        minlength: rule.min_phone_length,
                        number:true,
                        noSpace: true,
                    },
                    phone2: {
                        required: !0,
                        maxlength: rule.max_phone_length,
                        minlength: rule.min_phone_length,
                        number:true,
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
                    zip_code: {
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
                        maxlength: rule.name_length,
                        minlength: rule.account_min_length,
                        noSpace: true,
                        notEqualTo: "#account_number",
                    },
                    loan_amount:{
                        required: !0,
                        number: true,
                        min:500,
                        max:7800,
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
                    // past_loan:{
                    //     required: !0,
                    // },
                    // pending_loan:{
                    //     required: !0,
                    // },
                    // past_bill:{
                    //     required: !0,
                    // },
                    dob:{
                        required:true,
                        minAge: 18,
                    },
                    ssn:{
                        required:true,
                        maxlength: rule.ssn_length,
                        noSpace:true,
                        alphanumeric: true,
                        minlength: rule.ssn_length,
                        // number: true
                    },
                    loan_type:{
                        required:true,
                    }
                },
                messages: {
                    "account_communication[]": {
                        required: "You must select at least one communication option"
                    },
                    accept: {
                        required: "You must accept the Terms and Conditions agreement!"
                    },
                    email: {
                        remote: 'This email is already taken',
                    },
                    ssn:{
                        maxlength:'Please enter no more than 9 characters.',
                        minlength:'Please enter no more than 9 characters.',
                    },
                },
                invalidHandler: function (e, r) {
                    mUtil.scrollTop();
                },
                submitHandler: function (e) {}
            }), 
            (n = i.find('[data-wizard-action="submit"]')).on("click", function (r) {
                r.preventDefault(), e.form() && (mApp.progress(n), i.ajaxSubmit({
                    url: url,
                    method:'POST',
                    data : $("form").serialize(),
                    success: function (response) {
                        mApp.unprogress(n);
                        if(response.errors){
                            mUtil.scrollTop();
                            $('#m_wizard').removeClass('m-wizard--step-last');
                            $('#m_wizard').addClass('m-wizard--step-first');
                            $('div[m-wizard-target=m_wizard_form_step_1]').removeClass('m-wizard__step--done')
                            $('div[m-wizard-target=m_wizard_form_step_2]').removeClass('m-wizard__step--done')
                            $('div[m-wizard-target=m_wizard_form_step_3]').removeClass('m-wizard__step--done')
                            $('div[m-wizard-target=m_wizard_form_step_4]').removeClass('m-wizard__step--done')
                            $('div[ m-wizard-target=m_wizard_form_step_3]').removeClass( 'm-wizard__step--current');
                            $('div[ m-wizard-target=m_wizard_form_step_1]').addClass( 'm-wizard__step--current');
                            $('#m_wizard_form_step_3').removeClass('m-wizard__form-step--current');
                            $('#m_wizard_form_step_1').addClass('m-wizard__form-step--current');

                            WizardDemo.init();
                            r = new mWizard2("m_wizard", {
                                startStep: 1,
                            });
                            zombie = 1;
                            var errors = response.errors;
                            $.each(errors, function(key, value){
                                $('.'+key).empty();
                                $('#'+key+'-error').remove();
                                $('<div id="'+key+'-error" class="text-danger">'+value+'</div>').insertAfter('.'+key);
                            });
                        }else{
                            mUtil.scrollTop();
                            $('.m-portlet__foot').hide();
                            $( 'div[ m-wizard-target=m_wizard_form_step_3]' ).addClass('m-wizard__step--done');
                            $( 'div[ m-wizard-target=m_wizard_form_step_3]' ).removeClass( 'm-wizard__step--current' );
                            $( 'div[ m-wizard-target=m_wizard_form_step_4]' ).addClass( 'm-wizard__step--current' );
                            $('#m_wizard_form_step_3').removeClass('m-wizard__form-step--current');
                            $('#m_wizard_form_step_4').addClass('m-wizard__form-step--current');
                            $("#dynamic2 span").each(function () {
                                $(this).animate(
                                  {
                                    width: score + "%",
                                  },
                                  3000
                                );
                                // $(this).text(score + "%");
                            });
                            $('.chart').easyPieChart({
                                size: 160,
                                barColor: function(percent) {
                                var ctx = this.renderer.getCtx();
                                var canvas = this.renderer.getCanvas();
                                // var gradient = ctx.createLinearGradient(150,60,canvas.width,0);
                                 var gradient = ctx.createLinearGradient(140,-80,canvas.width,10);
                                    gradient.addColorStop(1, "#3D46DC");
                                    gradient.addColorStop(0, "#FA0B7E");
                                return gradient;
                              },
                                scaleLength: 0,
                                lineWidth: 15,
                                trackColor: "#E1E5EB",
                                lineCap: "circle",
                                animate: 2000,
                            });
                            setTimeout(function(){
                                $('#loader').hide();
                                $('#creditScore').show();
                                var scoreStatus = '';
                                var current_progress = 0;
                                $(".animated-progress span").each(function () {
                                    $(this).animate(
                                      {
                                        width: score + "%",
                                      },
                                      3000
                                    );
                                    $(this).text(score + "%");
                                    if(score < 40){
                                        scoreStatus = 'Low';
                                    }else if(score > 40 && score < 70){
                                        scoreStatus = 'Average';
                                    }else{
                                        scoreStatus = 'Excellent';
                                    }
                                });
                                $('#scoreLevel').text(scoreStatus);
                                // var interval = setInterval(function() {
                                //     current_progress += 10;
                                //     if(current_progress <= score){
                                //         $(".animated-progress span").each(function () {
                                //             $(this).animate(
                                //               {
                                //                 width: current_progress + "%",
                                //               },
                                //               3000
                                //             );
                                //             $(this).text(current_progress + "%");
                                //         });
                                //         if (current_progress >= 100){
                                //             clearInterval(interval);
                                //         }
                                //     }
                                //     if(score <50){
                                //         $('#scoreLevel').text('Low');
                                //     }else if((score > 50 && score < 70)){
                                //         $('#scoreLevel').text('Medium');
                                //     }else{
                                //         $('#scoreLevel').text('Good');
                                //     }
                                // }, 5000);


                                setTimeout(function(){
                                    $('#creditScore').hide();
                                    $('#approvedLoan').show();
                                    var acno = $('#account_number').val();
                                    var fourDigit =  'X'.repeat(acno.length - 4) + acno.slice(-4)
                                    console.log(fourDigit);
                                    $( 'div[ m-wizard-target=m_wizard_form_step_4]' ).addClass('m-wizard__step--done');
                                    $('#acno').text(fourDigit);
                                },6000);
                            },8000);
                        }
                    },
                    fail:function(response){
                        console.log(response);
                    }
                }))
            })
        }
    }
}();
jQuery(document).ready(function () {
    WizardDemo.init()
});
