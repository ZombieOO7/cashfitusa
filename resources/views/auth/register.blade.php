<!DOCTYPE html>
<html lang="en">

	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>{{config('app.name')}} | Login </title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
        <style>
            .bg-green {
                background-color: #00A05E !important;
            }
        </style>
		<!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
			WebFont.load({
				google: {
					"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
				},
				active: function() {
					sessionStorage.fonts = true;
				}
			});
		</script>

		<!--end::Web font -->

        <link href="{{ asset('backend/dist/default/assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet"
        type="text/css" />
        <link href="{{ asset('backend/dist/default/assets/demo/default/base/style.bundle.css') }}" rel="stylesheet"
        type="text/css" />

		<!--RTL version:<link href="../../../assets/demo/default/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

		<!--end::Base Styles -->
		<link rel="shortcut icon" href="../../../assets/demo/default/media/img/logo/favicon.ico" />
	</head>

	<!-- end::Head -->
	@php
	$slug = Session::get('slug')?Session::get('slug'):null;
	@endphp
	<!-- begin::Body -->
	<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
		
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-grid--tablet-and-mobile m-grid--hor-tablet-and-mobile m-login m-login--1 m-login--signin" id="m_login">
				<div class="m-grid__item m-grid__item--order-tablet-and-mobile-2 m-login__aside">
					<div class="m-stack m-stack--hor m-stack--desktop">
						<div class="m-stack__item m-stack__item--fluid">
							<div class="m-login__wrapper">
								<div class="m-login__logo">
									<a href="#">
										<img src="{{asset('images/logo.png')}}" width="100px">
									</a>
								</div>
                                @include('admin.includes.flashMessages')
								<div class="m-login__signin">
									<div class="m-login__head">
										<h3 class="m-login__title">Sign Up</h3>
										<div class="m-login__desc">Enter your details to create your account:</div>
									</div>
									<form class="m-login__form m-form" method="POST" action="{{ route('register') }}" id="m_form_1">
										@csrf
										<div class="form-group m-form__group">
											<input class="form-control m-input" type="text" placeholder="First Name" name="first_name" autocomplete="off">
											@if ($errors->has('first_name'))
												<p style="color:red;">{{ $errors->first('first_name') }}</p> 
											@endif
										</div>
										<div class="form-group m-form__group">
											<input class="form-control m-input" type="text" placeholder="Last Name" name="last_name" autocomplete="off">
											@if ($errors->has('last_name'))
												<p style="color:red;">{{ $errors->first('last_name') }}</p> 
											@endif
										</div>
										<div class="form-group m-form__group">
											<input class="form-control m-input" type="text" placeholder="Email" name="email" autocomplete="off">
											@if ($errors->has('email'))
												<p style="color:red;">{{ $errors->first('email') }}</p> 
											@endif
										</div>
										<div class="form-group m-form__group">
											<input class="form-control m-input" id='password' type="password" placeholder="Password" name="password">
											@if ($errors->has('password'))
												<p style="color:red;">{{ $errors->first('password') }}</p> 
											@endif
										</div>
										<div class="form-group m-form__group">
											<input class="form-control m-input m-login__form-input--last" type="password" placeholder="Confirm Password" name="password_confirmation">
											@if ($errors->has('password_confirmation'))
												<p style="color:red;">{{ $errors->first('password_confirmation') }}</p> 
											@endif
										</div>
										<div class="m-login__form-action">
											<button id="m_login_signup_submit" class="btn btn-success m-btn m-btn--pill m-btn--custom m-btn--air bg-green">Sign Up</button>
											<button id="m_login_signup_cancel" class="btn btn-outline-focus  m-btn m-btn--pill m-btn--custom">Cancel</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="m-stack__item m-stack__item--center">
							<div class="m-login__account">
								<span class="m-login__account-msg">
									Have an account yet ?
								</span>&nbsp;&nbsp;
							<a href="{{route('login')}}" class="m-link m-link--focus m-login__account-link">Sign In</a>
							</div>
						</div>
					</div>
				</div>
				<div class="m-grid__item m-grid__item--fluid m-grid m-grid--center m-grid--hor m-grid__item--order-tablet-and-mobile-1	m-login__content m-grid-item--center" style="background-size: 700px 700px;background-image: url({{asset('images/bg-4.jpg')}})">
					<div class="m-grid__item">
						<h3 class="m-login__welcome">Join Our Community</h3>
						<p class="m-login__msg">
							The path to your financial freedom and stability begins from here.
						</p>
					</div>
				</div>
			</div>
		</div>

		<!-- end:: Page -->

		<!--begin::Base Scripts -->
        <script src="{{ asset('backend/dist/default/assets/vendors/base/vendors.bundle.js') }}" type="text/javascript">
        </script>
        <script src="{{ asset('backend/dist/default/assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript">
        </script>

		<!--end::Base Scripts -->
		<script>
			var rule = $.extend({}, {!!json_encode(config('constant'), JSON_FORCE_OBJECT) !!});
		</script>
		<!--begin::Page Snippets -->
		<script>
			slug = '{{@$slug}}';
		</script>
		<script src="{{asset('frontend/js/user/login.js')}}" type="text/javascript"></script>
		<!--end::Page Snippets -->
	</body>

	<!-- end::Body -->
</html>