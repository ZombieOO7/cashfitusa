@extends('admin.layouts.default')
@section('content')
<style>
    .hid_spn {
        display: none !important;
    }
</style>
@section('title', @$title)

<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <div class="m-content">
        @include('admin.includes.flashMessages')
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Portlet-->
                <div class="m-portlet m-portlet--last m-portlet--head-lg m-portlet--responsive-mobile"
                    id="main_portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-wrapper">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        {{@$title}}
                                    </h3>
                                </div>
                            </div>
                            <div class="m-portlet__head-tools">
                                <a href="{{route('loan.index')}}" class="btn btn-secondary m-btn m-btn--air m-btn--custom">
                                    <span>
                                        <i class="la la-arrow-left"></i>
                                        <span>{{__('formname.back')}}</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        @if(isset($user) || !empty($user))
                        {{ Form::model($user, ['route' => ['loan.store', @$user->uuid], 'method' => 'PUT','id'=>'m_form_1','class'=>'m-form m-form--fit ','files' => true,'autocomplete' => "off"]) }}
                        @else
                        {{ Form::open(['route' => 'loan.store','method'=>'post','class'=>'m-form m-form--fit ','id'=>'m_form_1','files' => true,'autocomplete' => "off"]) }}
                        @endif
                        <div class="m-form__heading">
                            <h3 class="m-form__heading-title">Personal Details</h3>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.user.email').'*', null,['class'=>'col-form-label col-lg-3
                            col-sm-12']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!! Form::select('user_id', @$userList, @$user->user_id,
                                ['class' => 'form-control' ]) !!}
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.user.first_name').'*',
                            null,['class'=>'col-md-3 col-form-label']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!!
                                Form::text('first_name',@$user->first_name,['class'=>'form-control m-input err_msg',
                                'maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.first_name')])
                                !!}
                                <span class='first_name'></span>
                                @if ($errors->has('first_name'))
                                <p style="color:red;">
                                    {{ $errors->first('first_name') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.user.middle_name').'*',
                            null,['class'=>'col-md-3 col-form-label']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
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
                            {!! Form::label(__('formname.user.last_name').'*',
                            null,['class'=>'col-md-3 col-form-label']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!!
                                Form::text('last_name',@$user->last_name,['class'=>'form-control
                                m-input
                                err_msg','maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.last_name')])
                                !!}
                                <span class='last_name'></span>
                                @if ($errors->has('last_name'))
                                <p style="color:red;">
                                    {{ $errors->first('last_name') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-md-3 col-form-label">{{__('formname.user.phone1')}}*</label>
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!! Form::text('phone1',@$user->phone1,['class'=>'form-control m-input
                                err_msg','maxlength'=>config('constant.phone_length'),'placeholder'=>__('formname.user.phone1')])!!}
                                <span class='phone1'></span>
                                @if ($errors->has('phone1'))
                                <p style="color:red;">
                                    {{ $errors->first('phone1') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-md-3 col-form-label">{{__('formname.user.phone2')}}*</label>
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!! Form::text('phone2',@$user->phone2,['class'=>'form-control
                                m-input
                                err_msg','maxlength'=>config('constant.phone_length'),'placeholder'=>__('formname.user.phone2')])
                                !!}
                                <span class='phone2'></span>
                                @if ($errors->has('phone2'))
                                <p style="color:red;">
                                    {{ $errors->first('phone2') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-md-3 col-form-label">{{__('formname.user.dob')}}*</label>
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!! Form::text('dob',@$user->dob_text,['class'=>'form-control m-input
                                err_msg','id'=>'dob','readonly'=>'true','maxlength'=>config('constant.phone_length'),'placeholder'=>__('formname.user.dob')])!!}
                                <span class='dob'></span>
                                @if ($errors->has('dob'))
                                <p style="color:red;">
                                    {{ $errors->first('dob') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-md-3 col-form-label">{{__('formname.user.ssn')}}*</label>
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!! Form::text('ssn',@$user->ssn,['class'=>'form-control
                                m-input
                                err_msg','minlength'=>config('constant.phone_length'),'maxlength'=>config('constant.phone_length'),'placeholder'=>__('formname.user.ssn')])
                                !!}
                                <span class='ssn'></span>
                                @if ($errors->has('ssn'))
                                <p style="color:red;">
                                    {{ $errors->first('ssn') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="m-form__heading">
                            <h3 class="m-form__heading-title">Home Address</h3>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.user.address1').'*',
                            null,['class'=>'col-form-label col-md-3']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!! Form::text('address1',@$user->address1,['class'=>'form-control m-input
                                err_msg','maxlength'=>config('constant.text_length'),'placeholder'=>__('formname.user.address1')])
                                !!}
                                <span class='address1'></span>
                                @if ($errors->has('address1'))
                                <p style="color:red;">
                                    {{ $errors->first('address1') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.user.address2').'*',
                            null,['class'=>'col-form-label col-md-3']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!!
                                Form::text('address2',@$user->address2,['class'=>'form-control
                                m-input
                                err_msg','maxlength'=>config('constant.text_length'),'placeholder'=>__('formname.user.address2')])
                                !!}
                                <span class='address2'></span>
                                @if ($errors->has('address2'))
                                <p style="color:red;">
                                    {{ $errors->first('address2') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.user.city').'*',
                            null,['class'=>'col-form-label col-md-3']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!!
                                Form::text('city',@$user->city,['class'=>'form-control
                                m-input
                                err_msg','maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.city')])
                                !!}
                                <span class='city'></span>
                                @if ($errors->has('city'))
                                <p style="color:red;">
                                    {{ $errors->first('city') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.user.state').'*',
                            null,['class'=>'col-form-label col-md-3']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!!
                                Form::text('state',@$user->state,['class'=>'form-control
                                m-input
                                err_msg','maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.state')])
                                !!}
                                <span class='state'></span>
                                @if ($errors->has('state'))
                                <p style="color:red;">
                                    {{ $errors->first('state') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!!
                            Form::label(__('formname.user.zip_code').'*',
                            null,['class'=>'col-form-label col-md-3']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!!
                                Form::text('zip_code',@$user->zip_code,['class'=>'form-control
                                m-input
                                err_msg','maxlength'=>config('constant.zip_code_length'),'placeholder'=>__('formname.user.zip_code')])
                                !!}
                                <span class='zip_code'></span>
                                @if ($errors->has('zip_code'))
                                <p style="color:red;">
                                    {{ $errors->first('zip_code') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.user.years').'*',
                            null,['class'=>'col-form-label col-md-3']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    {!! Form::select('time_of_residency', @$yearList, @$user->time_of_residency,
                                    ['class' => 'form-control' ]) !!}
                                </div>
                                <span class='time_of_residency'></span>
                                @if ($errors->has('years'))
                                <p style="color:red;">
                                    {{ $errors->first('years') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="m-form__heading">
                            <h3 class="m-form__heading-title">Bank Detail</h3>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.bank.name').'*',
                            null,['class'=>'col-form-label col-md-3']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!!
                                Form::text('bank_name',@$user->bank_name,['class'=>'form-control
                                m-input
                                err_msg','maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.bank.name')])
                                !!}
                                <span class='bank_name'></span>
                                @if ($errors->has('bank_name'))
                                <p style="color:red;">
                                    {{ $errors->first('bank_name') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-md-3">Type of Account *</label>
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!! Form::select('account_type',@$accountTypeList,@$user->account_type,['class'=>'selectpicker form-control
                                m-bootstrap-select
                                m_selectpicker']) !!}
                            </div>
                            <span class='account_type'></span>
                            @if ($errors->has('account_type'))
                            <p style="color:red;">
                                {{ $errors->first('account_type') }}</p>
                            @endif
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.bank.account_number').'*',
                            null,['class'=>'col-form-label col-md-3']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!!
                                Form::text('account_number',@$user->account_number,['class'=>'form-control
                                m-input
                                err_msg','id'=>'account_number','maxlength'=>config('constant.account_max_length'),'minlength'=>config('constant.account_min_length'),'placeholder'=>__('formname.bank.account_number')])
                                !!}
                                <span class='account_number'></span>
                                @if ($errors->has('account_number'))
                                <p style="color:red;">
                                    {{ $errors->first('account_number') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.bank.routing_number').'*',
                            null,['class'=>'col-form-label col-md-3']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!!
                                Form::text('routing_number',@$user->routing_number,['class'=>'form-control
                                m-input
                                err_msg','id'=>'routing_number','maxlength'=>config('constant.account_max_length'),'minlength'=>config('constant.account_min_length'),'placeholder'=>__('formname.bank.routing_number')])
                                !!}
                                <span class='routing_number'></span>
                                @if ($errors->has('routing_number'))
                                <p style="color:red;">
                                    {{ $errors->first('routing_number') }}</p>
                                @endif
                            </div>
                        </div>
                        {{-- <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.bank.confirm_account_number').'*',
                            null,['class'=>'col-form-label col-md-3']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!!
                                Form::text('confirm_account_number',@$user->account_number,['class'=>'form-control
                                m-input
                                err_msg','maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.bank.account_number')])
                                !!}
                                <span class='confirm_account_number'></span>
                                @if ($errors->has('confirm_account_number'))
                                <p style="color:red;">
                                    {{ $errors->first('confirm_account_number') }}</p>
                                @endif
                            </div>
                        </div> --}}
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.bank.address').'*',
                            null,['class'=>'col-form-label col-md-3']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!!
                                Form::textarea('bank_address',@$user->bank_address,['class'=>'form-control
                                m-input
                                err_msg','maxlength'=>config('constant.text_length'),'placeholder'=>__('formname.bank.address')])
                                !!}
                                <span class='bank_address'></span>
                                @if ($errors->has('bank_address'))
                                <p style="color:red;">
                                    {{ $errors->first('bank_address') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="m-form__heading">
                            <h3 class="m-form__heading-title">Loan Detail</h3>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.loan.loan_amount').'*',
                            null,['class'=>'col-form-label col-md-3']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!! Form::text('loan_amount',@$user->loan_amount,['class'=>'form-control m-input
                                err_msg','maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.loan.loan_amount')])
                                !!}
                                <span class='loan_amount'></span>
                                @if ($errors->has('loan_amount'))
                                <p style="color:red;">
                                    {{ $errors->first('loan_amount') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.loan.months').'*',
                            null,['class'=>'col-form-label col-md-3']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!! Form::select('months',months(),@$user->months,['class'=>'form-control']) !!}
                                <span class='months'></span>
                                @if ($errors->has('months'))
                                <p style="color:red;">
                                    {{ $errors->first('months') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.loan.repayment').'*',
                            null,['class'=>'col-form-label col-md-3']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!! Form::text('repayment_amount',@$user->repayment_amount,['readonly'=>false
                                ,'class'=>'form-control m-input
                                err_msg','maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.loan.repayment_amount')])
                                !!}
                                <span class='repayment_amount'></span>
                                @if ($errors->has('repayment_amount'))
                                <p style="color:red;">
                                    {{ $errors->first('repayment_amount') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.loan_type').'*',
                            null,['class'=>'col-form-label col-md-3']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!! Form::select('loan_type',@$loanTypes,@$user->loan_type,['class'=>'form-control  loan-input']) !!}
                                <span class='months'></span>
                                @if ($errors->has('months'))
                                <p style="color:red;">
                                    {{ $errors->first('months') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row col-md-12">
                            <label class="form-control-label col-md-4">Have you taken any loan in past ?</label>
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <div class="m-radio-inline">
                                    <label class="m-radio m-radio--solid m-radio--brand">
                                        <input type="radio" name="past_loan" {{(@$user->past_loan== 1)?'checked':''}} value="1"> Yes
                                        <span></span>
                                    </label>
                                    <label class="m-radio m-radio--solid m-radio--brand">
                                        <input type="radio" name="past_loan" {{(@$user->past_loan== 0)?'checked':''}} value="0"> No
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-form__group row col-md-12">
                            <label class="form-control-label col-md-4">Do you have any pending loan ?</label>
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <div class="m-radio-inline">
                                    <label class="m-radio m-radio--solid m-radio--brand">
                                        <input type="radio" name="pending_loan" {{(@$user->pending_loan== 1)?'checked':''}} value="1"> Yes
                                        <span></span>
                                    </label>
                                    <label class="m-radio m-radio--solid m-radio--brand">
                                        <input type="radio" name="pending_loan" {{(@$user->pending_loan== 0)?'checked':''}} value="0"> No
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-form__group row col-md-12">
                            <label class="form-control-label col-md-4">Do you have any credit cards, Medical bills
                                pending ?</label>
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <div class="m-radio-inline">
                                    <label class="m-radio m-radio--solid m-radio--brand">
                                        <input type="radio" name="pending_bill" {{(@$user->pending_bill== 1)?'checked':''}} value="1"> Yes
                                        <span></span>
                                    </label>
                                    <label class="m-radio m-radio--solid m-radio--brand">
                                        <input type="radio" name="pending_bill" {{(@$user->pending_bill== 0)?'checked':''}} value="0"> No
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="m-form__heading">
                            <h3 class="m-form__heading-title">Documents</h3>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">Upload State ID or Driving Licence Front *</label>
                            <div class="col-lg-6 col-md-9 col-sm-12 img_msg_scn">
                                <div class="input-group err_msg">
                                    {!! Form::file('front_licence', ['class'=>'custom-file-input' ,'id'=>'flInp',
                                    'accept' => 'image/*']) !!}
                                    {!! Form::label('Choose file', null,['class'=>'custom-file-label']) !!}
                                    <input type="hidden" name="front_licence_name" id="imgFront"
                                        value="{{@$frontLicence->image_path}}">
                                    </br>
                                </div>
                                @if ($errors->has('front_licence'))
                                <p style="color:red;">
                                    {{ $errors->first('front_licence') }}
                                </p>
                                @endif
                                @php
                                $ext = strtolower(pathinfo(@$frontLicence->image_path, PATHINFO_EXTENSION));
                                @endphp
                                @if($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg')
                                    <img id="flicenceImg" src="{{@$frontLicence->image_path}}" alt="" width= "150px";
                                    height= "150px"; style="{{ isset($frontLicence->image_path) ? 'display:block;' : 'display:none;' }}" />
                                @else
                                    <img id="flicenceImg" src="{{asset('images/pdf.jpeg')}}" alt="" width= "150px"; height= "150px"; style="{{ isset($frontLicence->image_path) ? 'display:block;' : 'display:none;' }}" />
                                @endif
                                @if($frontLicence != null && @$frontLicence->image_path != null)
                                <div class="mt-2">
                                <a href='{{@$frontLicence->image_path}}' role="button" class="btn m-btn--square  btn-outline-info m-btn m-btn--custom text-brand" title='Download' download><span class=" fa fa-download"></span></a>
                                <a href='javascript:;' data-value='1' style="display:{{($frontLicence->status==1)?'none':''}}" data-id='{{@$frontLicence->uuid}}' role="button" class="changeStatus btn m-btn--square  btn-outline-success m-btn m-btn--custom text-success" title='approve'><span class=" fa fa-check"></span></a>
                                <a href='javascript:;' data-value='2' style="display:{{($frontLicence->status==2)?'none':''}}" data-id='{{@$frontLicence->uuid}}' role="button" class="changeStatus btn m-btn--square  btn-outline-danger m-btn m-btn--custom text-danger" title='reject'><span class=" fa fa-times"></span></a>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">Upload State ID or Driving Licence Back *</label>
                            <div class="col-lg-6 col-md-9 col-sm-12 img_msg_scn">
                                <div class="input-group err_msg">
                                    {!! Form::file('back_licence', ['class'=>'custom-file-input' ,'id'=>'blInp',
                                    'accept' => 'image/*']) !!}
                                    {!! Form::label('Choose file', null,['class'=>'custom-file-label']) !!}
                                    <input type="hidden" name="back_licence_name" id="imgInp"
                                        value="{{@$backLicence->image_path}}">
                                    </br>
                                </div>
                                @if ($errors->has('back_licence'))
                                <p style="color:red;">
                                    {{ $errors->first('back_licence') }}
                                </p>
                                @endif
                                @php
                                    $ext2 = strtolower(pathinfo(@$frontLicence->image_path, PATHINFO_EXTENSION));
                                @endphp
                                @if($ext2 == 'jpg' || $ext2 == 'png' || $ext2 == 'jpeg')
                                    <img id="blicenceImg" src="{{@$backLicence->image_path}}" alt="" width= "150px";
                                    height= "150px"; style="{{ isset($backLicence->image_path) ? 'display:block;' : 'display:none;' }}" />
                                @else
                                    <img id="flicenceImg" src="{{asset('images/pdf.jpeg')}}" alt="" width= "150px"; height= "150px"; style="{{ isset($backLicence->image_path) ? 'display:block;' : 'display:none;' }}" />
                                @endif
                                @if($backLicence != null && @$backLicence->image_path)
                                <div class="mt-2">
                                    <a href='{{@$backLicence->image_path}}' role="button" class="btn m-btn--square  btn-outline-info m-btn m-btn--custom text-brand" title='Download' download><span class=" fa fa-download"></span></a>
                                    <a href='javascript:;' data-value='1' style="display:{{(@$backLicence->status==1)?'none':''}}" data-id='{{@$backLicence->uuid}}' role="button" class="changeStatus btn m-btn--square  btn-outline-success m-btn m-btn--custom text-success" title='approve'><span class=" fa fa-check"></span></a>
                                    <a href='javascript:;' data-value='2' style="display:{{(@$backLicence->status==2)?'none':''}}" data-id='{{@$backLicence->uuid}}' role="button" class="changeStatus btn m-btn--square  btn-outline-danger m-btn m-btn--custom text-danger" title='reject'><span class=" fa fa-times"></span></a>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">Address Proof *</label>
                            <div class="col-lg-6 col-md-9 col-sm-12 img_msg_scn">
                                <div class="input-group err_msg">
                                    {!! Form::file('address_proof', ['class'=>'custom-file-input' ,'id'=>'adrInp',
                                    'accept' => 'image/*']) !!}
                                    {!! Form::label('Choose file', null,['class'=>'custom-file-label']) !!}
                                    <input type="hidden" name="address_proof_name" id="imgInp"
                                        value="{{@$addressProof->image_path}}">
                                    </br>
                                </div>
                                @if ($errors->has('address_proof'))
                                <p style="color:red;">
                                    {{ $errors->first('address_proof') }}
                                </p>
                                @endif
                                @php
                                    $ext3 = strtolower(pathinfo(@$addressProof->image_path, PATHINFO_EXTENSION));
                                @endphp
                                @if($ext3 == 'jpg' || $ext3 == 'png' || $ext3 == 'jpeg')
                                    <img id="addressImg" src="{{@$addressProof->image_path}}" alt="" width= "150px";
                                    height= "150px"; style="{{ isset($addressProof->image_path) ? 'display:block;' : 'display:none;' }}" />
                                @else
                                    <img id="flicenceImg" src="{{asset('images/pdf.jpeg')}}" alt="" width= "150px"; height= "150px"; style="{{ isset($addressProof->image_path) ? 'display:block;' : 'display:none;' }}" />
                                @endif
                                @if($addressProof != null && $addressProof->image_path)
                                <div class="mt-2">
                                    <a href='{{@$addressProof->image_path}}' role="button" class="btn m-btn--square  btn-outline-info m-btn m-btn--custom text-brand" title='Download' download><span class=" fa fa-download"></span></a>
                                    <a href='javascript:;' data-value='1' style="display:{{($addressProof->status==1)?'none':''}}" data-id='{{@$addressProof->uuid}}' role="button" class="changeStatus btn m-btn--square  btn-outline-success m-btn m-btn--custom text-success" title='approve'><span class=" fa fa-check"></span></a>
                                    <a href='javascript:;' data-value='2' style="display:{{($addressProof->status==2)?'none':''}}" data-id='{{@$addressProof->uuid}}' role="button" class="changeStatus btn m-btn--square  btn-outline-danger m-btn m-btn--custom text-danger" title='reject'><span class=" fa fa-times"></span></a>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">Selfie *</label>
                            <div class="col-lg-6 col-md-9 col-sm-12 img_msg_scn">
                                <div class="input-group err_msg">
                                    {!! Form::file('selfie', ['class'=>'custom-file-input' ,'id'=>'selfInp',
                                    'accept' => 'image/*']) !!}
                                    {!! Form::label('Choose file', null,['class'=>'custom-file-label']) !!}
                                    <input type="hidden" name="selfie_name" id="imgInp"
                                        value="{{@$selfie->image_path}}">
                                    </br>
                                    @if ($errors->has('selfie')) <p style="color:red;">
                                        {{ $errors->first('selfie') }}</p> @endif
                                </div>
                                @if ($errors->has('selfie'))
                                <p style="color:red;">
                                    {{ $errors->first('selfie') }}
                                </p>
                                @endif
                                @php
                                    $ext4 = strtolower(pathinfo(@$selfie->image_path, PATHINFO_EXTENSION));
                                @endphp
                                @if($ext4 == 'jpg' || $ext4 == 'png' || $ext4 == 'jpeg')
                                    <img id="selfieImg" src="{{@$selfie->image_path}}" alt="" width= "150px";
                                    height= "150px"; style="{{ isset($selfie->image_path) ? 'display:block;' : 'display:none;' }}" />
                                @else
                                    <img id="flicenceImg" src="{{asset('images/pdf.jpeg')}}" alt="" width= "150px"; height= "150px"; style="{{ isset($selfie->image_path) ? 'display:block;' : 'display:none;' }}" />
                                @endif
                                @if($selfie != null && @$selfie->image_path)
                                <div class="mt-2">
                                    <a href='{{@$selfie->image_path}}' role="button" class="btn m-btn--square  btn-outline-info m-btn m-btn--custom text-brand" title='Download' download><span class=" fa fa-download"></span></a>
                                    <a href='javascript:;' data-value='1' style="display:{{($selfie->status==1)?'none':''}}" data-id='{{@$selfie->uuid}}' role="button" class="changeStatus btn m-btn--square  btn-outline-success m-btn m-btn--custom text-success" title='approve'><span class=" fa fa-check"></span></a>
                                    <a href='javascript:;' data-value='2' style="display:{{($selfie->status==2)?'none':''}}" data-id='{{@$selfie->uuid}}' role="button" class="changeStatus btn m-btn--square  btn-outline-danger m-btn m-btn--custom text-danger" title='reject'><span class=" fa fa-times"></span></a>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.loan.reason'),
                            null,['class'=>'col-md-3 col-form-label']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!!
                                Form::textarea('reason',@$user->reason,['class'=>'form-control
                                m-input
                                err_msg','maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.loan.reason')])
                                !!}
                                <span class='reason'></span>
                                @if ($errors->has('reason'))
                                <p style="color:red;">
                                    {{ $errors->first('reason') }}</p>
                                @endif
                            </div>
                        </div>
                        @if(!isset($user->uuid))
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.status').'*', null,['class'=>'col-form-label col-lg-3
                            col-sm-12']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!! Form::select('status', @$loanStatusList, @$user->status,
                                ['class' => 'form-control' ]) !!}
                            </div>
                        </div>
                        @endif
                        {!! Form::hidden('id',@$user->uuid ,['id'=>'id']) !!}
                        @php
                        $flag = true;
                        if(isset($user->loanDocuments) && count($user->loanDocuments)>0){
                            if(count($user->loanDocuments) == 4 && count($user->pendingDocuments) > 0)
                                $flag = false;
                            elseif(count($user->rejectedDocuments) > 0)
                                $flag = false;
                            else
                                $flag = true;
                        } else{
                            $flag = false;
                        }
                        @endphp
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions m-form__actions">
                                <br>
                                <div class="row">
                                    <div class="col-lg-9 ml-lg-auto">
                                        @isset($user->uuid)
                                        <a href="{{route('loan.approve',['uuid'=>@$user->uuid])}}" class="btn btn-success stsBtn {{($flag==true)?'':'disabled'}}">{{__('formname.approve')}}</a>
                                        <a href="{{route('loan.reject',['uuid'=>@$user->uuid])}}" class="btn btn-danger stsBtn">{{__('formname.reject')}}</a>
                                        @endisset
                                        {!! Form::submit(__('formname.submit'), ['class' => 'btn btn-primary'] )!!}
                                        <a href="{{route('loan.index')}}" class="btn btn-secondary">{{__('formname.cancel')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@stop
@section('inc_script')
<script>
    $(document).find('.selectpicker').selectpicker({  
        placeholder: "Select Paper Category",
        allowClear: true
    })
    // $(document).find("#paper_category").select2();
</script>
<script>
    var rule = $.extend({}, {!!json_encode(config('constant'), JSON_FORCE_OBJECT) !!});
    var formname = $.extend({}, {!!json_encode(__('formname'), JSON_FORCE_OBJECT) !!});
    var id = '{{@$user->id}}';
    var docUrl = '{{route("doc.status")}}';
</script>
<script src="{{ asset('backend/js/loan/create.js') }}" type="text/javascript"></script>
@stop