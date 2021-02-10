@extends('frontend.layouts.default')
@php
$setting = setting();
if($setting){
$percentage = ($setting->percentage)?$setting->percentage:config('constant.default_pr');
}else{
$percentage = config('constant.default_pr');
}
$score = rand(50,100);
@endphp
@section('content')
@section('title', 'Apply For Loan')
@section('front_css')
<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
<link href="{{ asset('backend/dist/default/assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('backend/dist/default/assets/demo/default/base/style.bundle.css') }}" rel="stylesheet"
    type="text/css" />
{{-- <link rel="stylesheet" href="{{asset('frontend/css/custom.css')}}"> --}}
@endsection
<section class="loan-process-section section-padding pt-100">
    <div class="container">
        <div class="process-list">
            <div class="m-grid__item m-grid__item--fluid m-wrapper">
                <div class="maincol">
                    <div class="m-content">
                        <!--Begin::Main Portlet-->
                        <div class="m-portlet m-portlet--full-height">
                            <!--begin: Portlet Body-->
                            <div class="m-portlet__body m-portlet__body--no-padding">
                                <!--begin: Form Wizard-->
                                <div class="m-wizard m-wizard--4 m-wizard--brand" id="m_wizard">
                                    <div class="row m-row--no-padding">
                                        <div class="col-xl-3 m--padding-top-20 m--padding-bottom-15">
                                            <!--begin: Form Wizard Head -->
                                            <div class="m-wizard__head">
                                                <!--begin: Form Wizard Nav -->
                                                <div class="m-wizard__nav">
                                                    <div class="m-wizard__steps">
                                                        <div class="m-wizard__step m-wizard__step--done"
                                                            m-wizard-target="m_wizard_form_step_1">
                                                            <div class="m-wizard__step-info">
                                                                <a href="#" class="m-wizard__step-number">
                                                                    <span>
                                                                        <span>1</span>
                                                                    </span>
                                                                </a>
                                                                <div class="m-wizard__step-label">
                                                                    Personal Detail
                                                                </div>
                                                                <div class="m-wizard__step-icon">
                                                                    <i class="la la-check"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="m-wizard__step"
                                                            m-wizard-target="m_wizard_form_step_2">
                                                            <div class="m-wizard__step-info">
                                                                <a href="#" class="m-wizard__step-number">
                                                                    <span>
                                                                        <span>2</span>
                                                                    </span>
                                                                </a>
                                                                <div class="m-wizard__step-label">
                                                                    Bank Detail
                                                                </div>
                                                                <div class="m-wizard__step-icon">
                                                                    <i class="la la-check"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="m-wizard__step"
                                                            m-wizard-target="m_wizard_form_step_3">
                                                            <div class="m-wizard__step-info">
                                                                <a href="#" class="m-wizard__step-number">
                                                                    <span>
                                                                        <span>3</span>
                                                                    </span>
                                                                </a>
                                                                <div class="m-wizard__step-label">
                                                                    Loan Detail
                                                                </div>
                                                                <div class="m-wizard__step-icon">
                                                                    <i class="la la-check"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="m-wizard__step"
                                                            m-wizard-target="m_wizard_form_step_4">
                                                            <div class="m-wizard__step-info">
                                                                <a href="#" class="m-wizard__step-number">
                                                                    <span>
                                                                        <span>4</span>
                                                                    </span>
                                                                </a>
                                                                <div class="m-wizard__step-label">
                                                                    Loan Approval
                                                                </div>
                                                                <div class="m-wizard__step-icon">
                                                                    <i class="la la-check"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end: Form Wizard Nav -->
                                            </div>
                                            <!--end: Form Wizard Head -->
                                        </div>
                                        <div class="col-xl-9">
                                            <!--begin: Form Wizard Form-->
                                            <div class="m-wizard__form">
                                                <form class="m-form m-form--label-align-left- m-form--state-"
                                                    id="m_form">
                                                    {!! Form::hidden('id', @$user->id, ['id'=>'id']) !!}
                                                    <!--begin: Form Body -->
                                                    <div class="m-portlet__body m-portlet__body--no-padding">
                                                        <!--begin: Form Wizard Step 1-->
                                                        <div class="m-wizard__form-step m-wizard__form-step--current"
                                                            id="m_wizard_form_step_1">
                                                            <div class="m-form__section m-form__section--first">
                                                                <div class="m-form__heading section_title">
                                                                    <h2 class="m-form__heading-title"> Enter Personal
                                                                        Detail </h2>

                                                                </div>
                                                                <div class="form-group m-form__group row">
                                                                    <div class="col-lg-12 col-md-12 col-12">
                                                                        {!!
                                                                        Form::text('first_name',@$user->first_name,['class'=>'form-control
                                                                        m-input
                                                                        err_msg','maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.first_name').'*'])
                                                                        !!}
                                                                        <span class='first_name'></span>
                                                                        @if ($errors->has('first_name'))
                                                                        <p style="color:red;">
                                                                            {{ $errors->first('first_name') }}</p>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="form-group m-form__group row">
                                                                    <div class="col-lg-12 col-md-12 col-12">
                                                                        {!!
                                                                        Form::text('middle_name',@$user->middle_name,['class'=>'form-control
                                                                        m-input
                                                                        err_msg','maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.middle_name')])
                                                                        !!}
                                                                        <span class='middle_name'></span>
                                                                        @if ($errors->has('middle_name'))
                                                                        <p style="color:red;">
                                                                            {{ $errors->first('middle_name') }}</p>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="form-group m-form__group row">
                                                                    <div class="col-lg-12 col-md-12 col-12">
                                                                        {!!
                                                                        Form::text('last_name',@$user->last_name,['class'=>'form-control
                                                                        m-input
                                                                        err_msg','maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.last_name').'*'])
                                                                        !!}
                                                                        <span class='last_name'></span>
                                                                        @if ($errors->has('last_name'))
                                                                        <p style="color:red;">
                                                                            {{ $errors->first('last_name') }}</p>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="form-group m-form__group row">
                                                                    <div class="col-md-6 m-form__group-sub">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">
                                                                                    <i class="la la-phone"></i>
                                                                                </span>
                                                                            </div>
                                                                            {!!
                                                                            Form::text('phone1',@$user->phone1,['class'=>'form-control
                                                                            m-input
                                                                            err_msg','minlength'=>config('constant.min_phone_length'),'maxlength'=>config('constant.max_phone_length'),'placeholder'=>__('formname.user.phone1').'*'])
                                                                            !!}
                                                                            <span class='phone1'></span>
                                                                            @if ($errors->has('phone1'))
                                                                            <p style="color:red;">
                                                                                {{ $errors->first('phone1') }}</p>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 m-form__group-sub">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">
                                                                                    <i class="la la-phone"></i>
                                                                                </span>
                                                                            </div>
                                                                            {!!
                                                                            Form::text('phone2',@$user->phone2,['class'=>'form-control
                                                                            m-input
                                                                            err_msg','minlength'=>config('constant.min_phone_length'),'maxlength'=>config('constant.max_phone_length'),'placeholder'=>__('formname.user.phone2').'*'])
                                                                            !!}
                                                                            <span class='phone2'></span>
                                                                            @if ($errors->has('phone2'))
                                                                            <p style="color:red;">
                                                                                {{ $errors->first('phone2') }}</p>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group m-form__group row">
                                                                    <div class="col-md-6 m-form__group-sub">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">
                                                                                    <i class="fa fa-calendar-check"></i>
                                                                                </span>
                                                                            </div>
                                                                            {!!
                                                                            Form::text('dob',@$user->dob_text,['id'=>'dob','readonly'=>true,'class'=>'form-control
                                                                            m-input
                                                                            err_msg','maxlength'=>config('constant.phone_length'),'placeholder'=>__('formname.user.dob').'*'])
                                                                            !!}
                                                                            <span class='dob'></span>
                                                                            @if ($errors->has('dob'))
                                                                            <p style="color:red;">
                                                                                {{ $errors->first('dob') }}</p>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 m-form__group-sub">
                                                                        <div class="input-group">
                                                                            {!!
                                                                            Form::text('ssn',@$user->ssn,['class'=>'form-control
                                                                            m-input
                                                                            err_msg','id' => 'ssn','maxlength'=>config('constant.ssn_length'),'placeholder'=>__('formname.user.ssn').'*'])
                                                                            !!}
                                                                            <span class='ssn'></span>
                                                                            @if ($errors->has('ssn'))
                                                                            <p style="color:red;">
                                                                                {{ $errors->first('ssn') }}</p>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div
                                                                class="m-separator m-separator--dashed m-separator--lg">
                                                            </div>
                                                            <div class="m-form__section">

                                                                <div class="m-form__heading section_title">
                                                                    <h2 class="m-form__heading-title"> Home Address
                                                                    </h2>

                                                                </div>
                                                                <div class="form-group m-form__group row"
                                                                    id='locationField'>
                                                                    <div class="col-lg-12 col-md-12 col-12">
                                                                        {!!
                                                                        Form::text('address1',@$user->address1,['id'=>'autocomplete','class'=>'form-control
                                                                        m-input
                                                                        err_msg','maxlength'=>config('constant.text_length'),'placeholder'=>__('formname.user.address1').'*'])
                                                                        !!}
                                                                        <span class='address1'></span>
                                                                        @if ($errors->has('address1'))
                                                                        <p style="color:red;">
                                                                            {{ $errors->first('address1') }}</p>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="form-group m-form__group row">
                                                                    <div class="col-lg-12 col-md-12 col-12">
                                                                        {!!
                                                                        Form::text('address2',@$user->address2,['class'=>'form-control
                                                                        m-input
                                                                        err_msg','id'=>"route",'maxlength'=>config('constant.text_length'),'placeholder'=>__('formname.user.address2')])
                                                                        !!}
                                                                        <span class='address2'></span>
                                                                        @if ($errors->has('address2'))
                                                                        <p style="color:red;">
                                                                            {{ $errors->first('address2') }}</p>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="form-group m-form__group row">
                                                                    <div class="col-lg-6 m-form__group-sub">
                                                                        <div class="">
                                                                            {!!
                                                                            Form::text('city',@$user->city,['class'=>'form-control
                                                                            m-input
                                                                            err_msg','maxlength'=>config('constant.name_length'),
                                                                            'id'=>'locality','placeholder'=>__('formname.user.city').'*'])
                                                                            !!}
                                                                            <span class='city'></span>
                                                                            @if ($errors->has('city'))
                                                                            <p style="color:red;">
                                                                                {{ $errors->first('city') }}</p>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 m-form__group-sub">
                                                                        <div class="">
                                                                            {!!
                                                                            Form::text('state',@$user->state,['class'=>'form-control
                                                                            m-input
                                                                            err_msg','maxlength'=>config('constant.name_length'),
                                                                            'id'=>"administrative_area_level_1",'placeholder'=>__('formname.user.state').'*'])
                                                                            !!}
                                                                            <span class='state'></span>
                                                                            @if ($errors->has('state'))
                                                                            <p style="color:red;">
                                                                                {{ $errors->first('state') }}</p>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group m-form__group row">
                                                                    <div class="col-lg-6 m-form__group-sub">
                                                                        <div class="">
                                                                            {!!
                                                                            Form::text('zip_code',@$user->zip_code,['class'=>'form-control
                                                                            m-input err_msg',
                                                                            'id'=>"postal_code",'maxlength'=>config('constant.zip_code_length'),'placeholder'=>__('formname.user.zip_code').'*'])
                                                                            !!}
                                                                            <span class='zip_code'></span>
                                                                            @if ($errors->has('zip_code'))
                                                                            <p style="color:red;">
                                                                                {{ $errors->first('zip_code') }}</p>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 m-form__group-sub">
                                                                        <div class="">
                                                                            {!! Form::select('time_of_residency',
                                                                            @$yearList, null, ['class' => 'form-control
                                                                            m-input err_msg' ]) !!}
                                                                            <span class='time_of_residency'></span>
                                                                            @if ($errors->has('years'))
                                                                            <p style="color:red;">
                                                                                {{ $errors->first('years') }}</p>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @if(Auth::user()==null)
                                                            <div
                                                                class="m-separator m-separator--dashed m-separator--lg">
                                                            </div>
                                                            <div class="m-form__section">
                                                                <div class="m-form__heading section_title">
                                                                    <h2 class="m-form__heading-title">Create Account
                                                                    </h2>
                                                                </div>
                                                                <div class="form-group m-form__group row">
                                                                    <div class="col-lg-6 m-form__group-sub">
                                                                        <div class="">
                                                                            {!!
                                                                            Form::email('email',@$user->email,['id'=>'email','class'=>'form-control
                                                                            m-input
                                                                            err_msg','maxlength'=>config('constant.email_length'),'placeholder'=>__('formname.user.email')])
                                                                            !!}
                                                                            <span class='email'></span>
                                                                            @if ($errors->has('email'))
                                                                            <p style="color:red;">
                                                                                {{ $errors->first('email') }}</p>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 m-form__group-sub">
                                                                        <div class="">
                                                                            {!!
                                                                            Form::email('confirm_email',@$user->confirm_email,['class'=>'form-control
                                                                            m-input
                                                                            err_msg','maxlength'=>config('constant.email_length'),'placeholder'=>__('formname.user.confirm_email')])
                                                                            !!}
                                                                            <span class='confirm_email'></span>
                                                                            @if ($errors->has('confirm_email'))
                                                                            <p style="color:red;">
                                                                                {{ $errors->first('confirm_email') }}
                                                                            </p>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group m-form__group row">
                                                                    <div class="col-lg-6 m-form__group-sub">
                                                                        <div class="">
                                                                            {!! Form::password('password',['class'
                                                                            =>'form-control
                                                                            m-input','id'=>'password','placeholder'=>'Password','type'
                                                                            => 'password']) !!}
                                                                            <span class='password'></span>
                                                                            @if ($errors->has('password'))
                                                                            <p style="color:red;">
                                                                                {{ $errors->first('password') }}</p>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 m-form__group-sub">
                                                                        <div class="">
                                                                            {!!
                                                                            Form::password('confirm_password',['class'
                                                                            => 'form-control m-input','id'=>'password',
                                                                            'placeholder'=>'Confirm Password', 'type' =>
                                                                            'password']) !!}
                                                                            <span class='confirm_password'></span>
                                                                            @if ($errors->has('confirm_password'))
                                                                            <p style="color:red;">
                                                                                {{ $errors->first('confirm_password') }}
                                                                            </p>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <!--end: Form Wizard Step 1-->
                                                        <!--begin: Form Wizard Step 2-->
                                                        <div class="m-wizard__form-step" id="m_wizard_form_step_2">
                                                            <div class="m-form__section m-form__section--first">
                                                                <div class="m-form__heading section_title">
                                                                    <h2 class="m-form__heading-title"> Bank
                                                                        Detail </h2>

                                                                </div>
                                                                <div class="form-group m-form__group row">
                                                                    <div class="col-lg-6 m-form__group-sub">
                                                                        <div class="">
                                                                            {!!
                                                                            Form::text('bank_name',@$user->bank_name,['class'=>'form-control
                                                                            m-input
                                                                            err_msg','maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.bank.name').'*'])
                                                                            !!}
                                                                            <span class='bank_name'></span>
                                                                            @if ($errors->has('bank_name'))
                                                                            <p style="color:red;">
                                                                                {{ $errors->first('bank_name') }}</p>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 m-form__group-sub">
                                                                        <div class="input-group">
                                                                            {!!
                                                                            Form::select('account_type',@$accountTypeList,@$user->account_type,['class'=>'form-control']) !!}
                                                                        </div>
                                                                        <span class='account_type'></span>
                                                                        @if ($errors->has('account_type'))
                                                                        <p style="color:red;">
                                                                            {{ $errors->first('account_type') }}</p>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="form-group m-form__group row">
                                                                    <div class="col-lg-6 m-form__group-sub">
                                                                        <div class="">
                                                                            {!!
                                                                            Form::text('account_number',@$user->account_number,['class'=>'form-control
                                                                            m-input
                                                                            err_msg','id'=>'account_number','maxlength'=>config('constant.account_max_length'),'minlength'=>config('constant.account_min_length'),'placeholder'=>__('formname.bank.account_number').'*'])
                                                                            !!}
                                                                            <span class='account_number'></span>
                                                                            @if ($errors->has('account_number'))
                                                                            <p style="color:red;">
                                                                                {{ $errors->first('account_number') }}
                                                                            </p>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 m-form__group-sub">
                                                                        <div class="">
                                                                            {!!
                                                                            Form::text('routing_number',@$user->routing_number
                                                                            ,['class'=>'form-control
                                                                            m-input
                                                                            err_msg','maxlength'=>config('constant.routing_max_length'),'placeholder'=>__('formname.bank.routing_number').'*'])
                                                                            !!}
                                                                            <span class='routing_number'></span>
                                                                            @if ($errors->has('routing_number'))
                                                                            <p style="color:red;">
                                                                                {{ $errors->first('routing_number') }}
                                                                            </p>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group m-form__group row">
                                                                    <div class="col-lg-12 col-md-12 col-12">
                                                                        {!!
                                                                        Form::textarea('bank_address',@$user->bank_address,['class'=>'form-control
                                                                        m-input err_msg',
                                                                        'maxlength'=>config('constant.text_length'),'placeholder'=>__('formname.bank.address'),'rows'=>'2'])
                                                                        !!}
                                                                        <span class='bank_address'></span>
                                                                        @if ($errors->has('bank_address'))
                                                                        <p style="color:red;">
                                                                            {{ $errors->first('bank_address') }}</p>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end: Form Wizard Step 2-->
                                                        <!--begin: Form Wizard Step 3-->
                                                        <div class="m-wizard__form-step" id="m_wizard_form_step_3">
                                                            <div class="m-form__section m-form__section--first">
                                                                <div class="m-form__heading section_title">
                                                                    <h2 class="m-form__heading-title"> Loan
                                                                        Details </h2>

                                                                </div>
                                                                <div class="">
                                                                    <div class="form-group m-form__group row">
                                                                        <div class="col-md-12">
                                                                            <div class="col-lg-12 col-md-6 col-12">
                                                                                {!!
                                                                                Form::text('loan_amount',@$loanData['amount'],['class'=>'col-lg-12
                                                                                col-md-6 col-12 form-control m-input
                                                                                loan-input
                                                                                err_msg','maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.loan.loan_amount').'*'])
                                                                                !!}
                                                                                <span class='loan_amount'></span>
                                                                                @if ($errors->has('loan_amount'))
                                                                                <p style="color:red;">
                                                                                    {{ $errors->first('loan_amount') }}
                                                                                </p>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group m-form__group row">
                                                                        <div class="col-md-12">
                                                                            <div class="col-lg-12 col-md-12 col-12">
                                                                                <select name='months' class="form-control loan-input">
                                                                                    <option value=''>Tenure
                                                                                    </option>
                                                                                    <option
                                                                                        {{(@$loanData['months'] == 12)?'selected':''}}
                                                                                        value="12">12 Months[1 Year]
                                                                                    </option>
                                                                                    <option
                                                                                        {{(@$loanData['months'] == 24)?'selected':''}}
                                                                                        value="24">24 Months[2 Year]
                                                                                    </option>
                                                                                    <option
                                                                                        {{(@$loanData['months'] == 36)?'selected':''}}
                                                                                        value="36">36 Months[3 Year]
                                                                                    </option>
                                                                                    <option
                                                                                        {{(@$loanData['months'] == 48)?'selected':''}}
                                                                                        value="48">48 Months[4 Year]
                                                                                    </option>
                                                                                    <option
                                                                                        {{(@$loanData['months'] == 60)?'selected':''}}
                                                                                        value="60">60 Months[5 Year]
                                                                                    </option>
                                                                                </select>
                                                                                <span class='months'></span>
                                                                                @if ($errors->has('months'))
                                                                                <p style="color:red;">
                                                                                    {{ $errors->first('months') }}</p>
                                                                                @endif
                                                                            </div>
                                                                            {{-- {!! Form::text('months',@$loanData['months'],['class'=>'form-control m-input loan-input err_msg','maxlength'=>config('constant.name_length')]) !!} --}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group m-form__group row">
                                                                        <div class="col-lg-12">
                                                                            <div class="col-lg-12 col-md-6 col-12">
                                                                                {!!
                                                                                Form::text('repayment_amount',@$loanData['returnPerMonth'],['readonly'=>true
                                                                                ,'class'=>'col-lg-12 col-md-6 col-12
                                                                                form-control m-input loan-input
                                                                                err_msg','maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.loan.repayment_amount').'*'])
                                                                                !!}
                                                                                <span class='repayment_amount'></span>
                                                                                @if ($errors->has('repayment_amount'))
                                                                                <p style="color:red;">
                                                                                    {{ $errors->first('repayment_amount') }}
                                                                                </p>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group m-form__group row">
                                                                        <div class="col-md-12">
                                                                            <div class="col-lg-12 col-md-12 col-12">
                                                                                {!! Form::select('loan_type',@$loanTypes,@$user->loan_type,['class'=>'form-control  loan-input']) !!}
                                                                            </div>
                                                                            <span class='loan_type'></span>
                                                                            @if ($errors->has('loan_type'))
                                                                            <p style="color:red;">
                                                                                {{ $errors->first('loan_type') }}</p>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group m-form__group">
                                                                        <div class="col-lg-12 m-form__group-sub">
                                                                            <label class="form-control-label yesnolabel">Have you borrowed any loans in the past? *</label>
                                                                            <!-- 	<div class="m-radio-inline">
                                                                                <label class="m-radio m-radio--solid m-radio--brand">
                                                                                    <input type="radio" name="past_loan" checked="" value="1"> Yes
                                                                                    <span></span>
                                                                                </label>
                                                                                <label class="m-radio m-radio--solid m-radio--brand">
                                                                                    <input type="radio" name="past_loan" value="0"> No
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> -->
                                                                            <!-- yes no -->
                                                                            <div class="toggle">
                                                                                <input class="chekk" type="checkbox"
                                                                                name="past_loan" checked="" value="0">
                                                                                <label for="past_loan" class="onbtn">NO</label>
                                                                                <label for="past_loan" class="offbtn">YES</label>
                                                                            </div>
                                                                            <!-- yes no -->
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group m-form__group">
                                                                        <div class="col-lg-12 m-form__group-sub">
                                                                            <label class="form-control-label yesnolabel">Have you got a loan pending? *</label>
                                                                            <!-- 	<div class="m-radio-inline">
                                                                                <label class="m-radio m-radio--solid m-radio--brand">
                                                                                    <input type="radio" name="pending_loan" checked="" value="1"> Yes
                                                                                    <span></span>
                                                                                </label>
                                                                                <label class="m-radio m-radio--solid m-radio--brand">
                                                                                    <input type="radio" name="pending_loan" value="0"> No
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> -->
                                                                            <div class="toggle">
                                                                                <input class="chekk" type="checkbox"
                                                                                name="pending_loan" checked="" value="0">
                                                                                <label for="pending_loan" class="onbtn">NO</label>
                                                                                <label for="pending_loan" class="offbtn">YES</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group m-form__group">
                                                                        <div class="col-lg-12 m-form__group-sub">
                                                                            <label class="form-control-label yesnolabel">Do you have any outstanding credit card payments or medical bills? *</label>
                                                                            <!-- <div class="m-radio-inline">
                                                                                <label class="m-radio m-radio--solid m-radio--brand">
                                                                                    <input type="radio" name="past_bill" checked="" value="1"> Yes
                                                                                    <span></span>
                                                                                </label>
                                                                                <label class="m-radio m-radio--solid m-radio--brand">
                                                                                    <input type="radio" name="past_bill" value="0"> No
                                                                                    <span></span>
                                                                                </label>
                                                                            </div> -->
                                                                            <div class="toggle">
                                                                                <input class="chekk" type="checkbox"
                                                                                name="pending_bill" checked="" value="0">
                                                                                <label for="pending_bill" class="onbtn">NO</label>
                                                                                <label for="pending_bill" class="offbtn">YES</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end: Form Wizard Step 3-->
                                                        <!--begin: Form Wizard Step 4-->
                                                        <div class="m-wizard__form-step" id="m_wizard_form_step_4">
                                                            <div class="m-form__heading section_title">
                                                                <h2 class="m-form__heading-title"> Loan Approval </h2>
                                                            </div>
                                                            <div id='loader'
                                                                class="form-group m-form__group m-form__group--sm row">
                                                                <div class="col-xl-12">
                                                                    <div class="">
                                                                        {{-- <div class="pl pl-hourglass"></div> --}}
                                                                        <div
                                                                            class="datacontainer justify-content-md-center">
                                                                            <div class="box">
                                                                                <div class="chart"
                                                                                    data-percent="{{$score}}"
                                                                                    data-scale-color="#ffb400">
                                                                                    {{$score}}%</div>
                                                                            </div>
                                                                        </div>
                                                                        <div id="dynamic2"
                                                                            class="animated-progress progress-red mb-5">
                                                                            <span data-progress="{{$score}}"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id='creditScore'
                                                                class="row form-group m-form__group m-form__group--sm"
                                                                style="display:none;">
                                                                <div class="col-md-12 text-center"
                                                                    style="padding-left:10%;padding-right:10%;padding-top: 70px;padding-bottom: 70px;">
                                                                    <h5>Checking Credit Score</h5>
                                                                    <div id="dynamic"
                                                                        class="animated-progress progress-red">
                                                                        <span data-progress="{{$score}}"></span>
                                                                    </div>
                                                                    <h5 class="text-center">Your Credit Score is <span
                                                                            id="scoreLevel" class="text-success"></span>
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                            <div id='approvedLoan'
                                                                class="form-group m-form__group m-form__group--sm row"
                                                                style="display:none;">
                                                                <div class="col-xl-12 text-center">
                                                                    <img class=""
                                                                        src="{{asset('images/approved2.svg')}}" alt=""
                                                                        style="width:100px;height:100px;">
                                                                    <h3>Loan Application Approved</h3>
                                                                    <p>Nice, your loan has been sanctioned according to your credit score.</p>
                                                                    <p>Login to the Rapid Cash America Dashboard to transfer funds to your bank account that ends with 
                                                                        <strong><span id='acno'></span></strong>
                                                                    </p>
                                                                    @if(!Auth::guard('web')->user())
                                                                    <a href="{{route('login')}}"
                                                                        class="btn btn-success rounded-0 btn-xl w-25 bg-green">Login
                                                                        here</a>
                                                                    @else
                                                                    <a href="{{route('dashboard')}}"
                                                                        class="btn btn-success rounded-0 btn-xl w-25 bg-green">Go
                                                                        To Dashboard</a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end: Form Wizard Step 4-->
                                                    </div>
                                                    <!--end: Form Body -->
                                                    <!--begin: Form Actions -->
                                                    <div
                                                        class="m-portlet__foot m-portlet__foot--fit m--margin-top-40 m--margin-bottom-40">
                                                        <div class="m-form__actions">
                                                            <div class="row">
                                                                <div class="col-lg-6 m--align-left">
                                                                    <a href="#"
                                                                        class="btn btn-secondary bg-secondary rounded-0 btn-lg m-btn m-btn--custom m-btn--icon"
                                                                        data-wizard-action="prev">
                                                                        <span>

                                                                            <span><i class="la la-arrow-left"></i>
                                                                                &nbsp;&nbsp;Back</span>
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                                <div class="col-lg-6 m--align-right">
                                                                    <a href="#"
                                                                        class="btn btn-success rounded-0 btn-lg bg-green m-btn m-btn--custom m-btn--icon"
                                                                        data-wizard-action="submit">
                                                                        <span>
                                                                            <i class="la la-check"></i>&nbsp;&nbsp;
                                                                            <span>Submit</span>
                                                                        </span>
                                                                    </a>
                                                                    <a href="#"
                                                                        class="btn btn-success rounded-0 btn-lg bg-green m-btn m-btn--custom m-btn--icon"
                                                                        data-wizard-action="next">
                                                                        <span>
                                                                            <span>Save &amp; Continue&nbsp;&nbsp; <i
                                                                                    class="la la-arrow-right"></i></span>

                                                                        </span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end: Form Actions -->
                                                </form>
                                            </div>
                                            <!--end: Form Wizard Form-->
                                        </div>
                                    </div>
                                </div>
                                <!--end: Form Wizard-->
                            </div>
                            <!--end: Portlet Body-->
                        </div>
                        <!--End::Main Portlet-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end of help section -->
@endsection
@section('front_script')
<script src="{{ asset('backend/dist/default/assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/dist/default/assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript">
</script>
<script>
    var rule = $.extend({}, {!!json_encode(config('constant'), JSON_FORCE_OBJECT) !!});
    var url = "{{route('user.store')}}";
    var pr = parseInt('{{$percentage}}');
    var score = "{{$score}}";
    var validateEmailURL = "{{route('validate.email')}}";
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/easy-pie-chart/2.1.6/jquery.easypiechart.min.js"></script>
<script src="{{asset('frontend/js/user/create.js')}}"></script>
<script src="{{ asset('sweetalert/sweetalert.min.js') }}"></script>
<script type="text/javascript" src="{{ str_replace('public/', '', URL('resources/lang/js/en/message.js')) }}"></script>
@endsection