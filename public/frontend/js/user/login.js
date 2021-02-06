$("#m_form_1").validate({
    rules:{
        first_name:{
            required:true,
            maxlength: rule.name_length,
        },
        last_name:{
            required:true,
            maxlength: rule.name_length,
        },
        email:{
            required:true,
            minlength:10,
            maxlength: rule.email_max_length,
        },
        password:{
            required:true,
            minlength: rule.password_min_length,
            maxlength: rule.password_max_length,
        },
        password_confirmation: {
            required:true,
            minlength: rule.password_min_length,
            maxlength: rule.password_max_length,
            equalTo: "#password",
        },
    },
    messages: {
        first_name:{
            required: 'Please enter first name', 
        },
        last_name:{
            required: 'Please enter last name', 
        },
        email: {
            required: 'Please enter valid email & it should be like xyz@example.com'
        },password: {
            required: 'Please enter password'
        },password_confirmation: {
            required: 'Please enter confirm password',
            equalTo: 'The confirm password and password must match.'
        }
    },
    errorPlacement: function (error, element) {
        error.insertAfter(element);
    },
});
// jQuery(document).ready(function(){FormControls.init()});
var SnippetLogin = function () {
    if(slug != null && slug != ''){
        $("#m_login").removeClass("m-login--forget-password"), 
        $("#m_login").removeClass("m-login--signin"), 
        $("#m_login").addClass("m-login--signup"); 
    }
    var e = $("#m_login"),
        i = function (e, i, a) {
            var l = $('<div class="m-alert m-alert--outline alert alert-' + i + ' alert-dismissible" role="alert">\t\t\t<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>\t\t\t<span></span>\t\t</div>');
            e.find(".alert").remove(), l.prependTo(e), mUtil.animateClass(l[0], "fadeIn animated"), l.find("span").html(a)
        },
        a = function () {
            e.removeClass("m-login--forget-password"), e.removeClass("m-login--signup"), e.addClass("m-login--signin"), mUtil.animateClass(e.find(".m-login__signin")[0], "flipInX animated")
        },
        l = function () {
            $("#m_login_signup").click(function (i) {
                i.preventDefault(), 
                e.removeClass("m-login--forget-password"), 
                e.removeClass("m-login--signin"), 
                e.addClass("m-login--signup"), 
                mUtil.animateClass(e.find(".m-login__signup")[0], "flipInX animated")
            }), $("#m_login_signup_cancel").click(function (e) {
                e.preventDefault(), a()
            })
        };
    return {
        init: function () {
            l(), $("#m_login_signin_submit").click(function (e) {
                e.preventDefault();
                var l = $(this).closest("form");
                l.validate({
                    rules: {
                        email: {
                            required: !0,
                            email: !0
                        },
                        password: {
                            required: !0
                        },
                        password_confirmation: {
                            required: !0
                        }
                    }
                });
                if(l.valid()){
                    l.submit();
                }
            }), $("#m_login_signup_submit").click(function (l) {
                l.preventDefault();
                var r = $(this).closest("form");
                r.validate({
                    rules: {
                        email: {
                            required: !0,
                            email: !0
                        },
                        password: {
                            required: !0
                        },
                        password_confirmation: {
                            required: !0
                        },
                    }
                });
                if(r.valid()){
                    r.submit();
                }
            }), $("#m_login_forget_password_submit").click(function (l) {
                l.preventDefault();
                var t = $(this),
                    r = $(this).closest("form");
                r.validate({
                    rules: {
                        email: {
                            required: !0,
                            email: !0
                        }
                    }
                }), r.valid() && (t.addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0), r.ajaxSubmit({
                    url: "",
                    success: function (l, s, n, o) {
                        setTimeout(function () {
                            t.removeClass("m-loader m-loader--right m-loader--light").attr("disabled", !1), r.clearForm(), r.validate().resetForm(), a();
                            var l = e.find(".m-login__signin form");
                            l.clearForm(), l.validate().resetForm(), i(l, "success", "Cool! Password recovery instruction has been sent to your email.")
                        }, 2e3)
                    }
                }))
            })
        }
    }
}();
jQuery(document).ready(function () {
    SnippetLogin.init()
});