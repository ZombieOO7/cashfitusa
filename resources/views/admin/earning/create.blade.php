@extends('admin.layouts.default')
@section('content')
@section('title', @$title)

<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <div class="m-content">
        @include('admin.includes.flashMessages')
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
                                <a href="{{route('earning.index')}}"
                                    class="btn btn-secondary m-btn m-btn--air m-btn--custom">
                                    <span>
                                        <i class="la la-arrow-left"></i>
                                        <span>{{__('formname.back')}}</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        @if(isset($earning) || !empty($earning))
                        {{ Form::model($earning, ['route' => ['earning.store', @$earning->uuid], 'method' => 'PUT','id'=>'m_form_1','class'=>'m-form m-form--fit m-form--label-align-right','files' => true,'autocomplete' => "off"]) }}
                        @else
                        {{ Form::open(['route' => 'earning.store','method'=>'post','id'=>'m_form_1','class'=>'m-form m-form--fit m-form--label-align-right','files' => true,'autocomplete' => "off"]) }}
                        @endif
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.earning.app_id').'*', null,['class'=>'col-form-label col-lg-3
                            col-sm-12']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!! Form::select('app_id', @$appList, @$earning->app_id,
                                ['class' => 'form-control' ]) !!}
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.earning.user_id').'*', null,['class'=>'col-form-label col-lg-3
                            col-sm-12']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!! Form::select('user_id', @$userList, @$earning->user_id,
                                ['class' => 'form-control' ]) !!}
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.user.first_name').'*', null,['class'=>'col-form-label col-lg-3 col-sm-12']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!! Form::text('first_name',@$earning->first_name,['class'=>'form-control err_msg',
                                'maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.first_name')])!!}
                                <span class='first_name'></span>
                                @if ($errors->has('first_name'))
                                <p style="color:red;">
                                    {{ $errors->first('first_name') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.user.middle_name').'*',
                            null,['class'=>'col-form-label col-lg-3
                            col-sm-12']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!! Form::text('middle_name',@$earning->middle_name,['class'=>'form-control err_msg',
                                'maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.middle_name')])
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
                            null,['class'=>'col-form-label col-lg-3 col-sm-12']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!!Form::text('last_name',@$earning->last_name,['class'=>'form-control err_msg',
                                'maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.last_name')])
                                !!}
                                <span class='last_name'></span>
                                @if ($errors->has('last_name'))
                                <p style="color:red;">
                                    {{ $errors->first('last_name') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.user.dob').'*',null,['class'=>'col-form-label col-lg-3
                                col-sm-12']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!! Form::text('dob',@$earning->proper_dob,['class'=>'form-control err_msg','readonly'=>true,'id'=>'dob',
                                    'maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.dob')])
                                !!}
                                <span class='dob'></span>
                                @if ($errors->has('dob'))
                                <p style="color:red;">
                                    {{ $errors->first('dob') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.user.ssn').'*',null,['class'=>'col-form-label col-lg-3 col-sm-12']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!! Form::text('ssn',@$earning->ssn,['class'=>'form-control err_msg',
                                'maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.ssn')])
                                !!}
                                <span class='ssn'></span>
                                @if ($errors->has('ssn'))
                                <p style="color:red;">
                                    {{ $errors->first('ssn') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.user.address1').'*', null,['class'=>'col-form-label col-lg-3
                            col-sm-12']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!! Form::text('address1',@$earning->address1,['class'=>'form-control err_msg',
                                'maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.address1')])
                                !!}
                                <span class='address1'></span>
                                @if ($errors->has('address1'))
                                <p style="color:red;">
                                    {{ $errors->first('address1') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.user.address2').'*', null,['class'=>'col-form-label col-lg-3
                            col-sm-12']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!! Form::text('address2',@$earning->address2,['class'=>'form-control err_msg',
                                'maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.address2')])
                                !!}
                                <span class='address2'></span>
                                @if ($errors->has('address2'))
                                <p style="color:red;">
                                    {{ $errors->first('address2') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.user.city').'*',null,['class'=>'col-form-label col-lg-3 col-sm-12']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!! Form::text('city',@$earning->city,['class'=>'form-control err_msg',
                                    'maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.city')])
                                !!}
                                <span class='city'></span>
                                @if ($errors->has('city'))
                                <p style="color:red;">
                                    {{ $errors->first('city') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.user.state').'*',null,['class'=>'col-form-label col-lg-3 col-sm-12']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!! Form::text('state',@$earning->state,['class'=>'form-control err_msg',
                                'maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.state')])
                                !!}
                                <span class='state'></span>
                                @if ($errors->has('state'))
                                <p style="color:red;">
                                    {{ $errors->first('state') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.user.zip_code').'*',null,['class'=>'col-form-label col-lg-3 col-sm-12']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!! Form::text('zip_code',@$earning->zip_code,['class'=>'form-control err_msg',
                                    'maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.zip_code')])
                                !!}
                                <span class='zip_code'></span>
                                @if ($errors->has('zip_code'))
                                <p style="color:red;">
                                    {{ $errors->first('zip_code') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">Upload State ID or Driving Licence Front *</label>
                            <div class="col-lg-6 col-md-9 col-sm-12 img_msg_scn">
                                <div class="input-group err_msg">
                                    {!! Form::file('front_licence', ['class'=>'custom-file-input' ,'id'=>'imgInp',
                                    'accept' => 'image/*']) !!}
                                    {!! Form::label('Choose file', null,['class'=>'custom-file-label']) !!}
                                    <input type="hidden" name="front_licence_name" id="imgFront"
                                        value="{{@$earning->front_licence}}">
                                    </br>
                                    @if ($errors->has('front_licence')) <p style="color:red;">
                                        {{ $errors->first('front_licence') }}</p> @endif
                                </div>
                                @if ($errors->has('front_licence'))
                                <p style="color:red;">
                                    {{ $errors->first('front_licence') }}
                                </p>
                                @endif
                                @php
                                $ext = strtolower(pathinfo(@$earning->front_licence_path, PATHINFO_EXTENSION));
                                @endphp
                                @if($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg')
                                <img id="flicenceImg" src="{{@$earning->front_licence_path}}" alt="" width= "150px";
                                height= "150px" style="{{ isset($earning->front_licence_path) ? 'display:block;' : 'display:none;' }}" />
                                @else
                                    <img id="flicenceImg" src="{{asset('images/pdf.jpeg')}}" alt="" width= "150px"; height= "150px"; style="{{ isset($earning->front_licence_path) ? 'display:block;' : 'display:none;' }}" />
                                @endif
                                @if(@$earning->front_licence_path != null)
                                <div class="mt-2">
                                <a href='{{@$earning->front_licence_path}}' role="button" class="btn m-btn--square  btn-outline-info m-btn m-btn--custom text-brand" title='Download' download><span class=" fa fa-download"></span></a>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">Upload State ID or Driving Licence Back *</label>
                            <div class="col-lg-6 col-md-9 col-sm-12 img_msg_scn">
                                <div class="input-group err_msg">
                                    {!! Form::file('back_licence', ['class'=>'custom-file-input' ,'id'=>'imgInp2',
                                    'accept' => 'image/*']) !!}
                                    {!! Form::label('Choose file', null,['class'=>'custom-file-label']) !!}
                                    <input type="hidden" name="back_licence_name" id="imgBack"
                                        value="{{@$earning->back_licence}}">
                                    </br>
                                    @if ($errors->has('back_licence')) <p style="color:red;">
                                        {{ $errors->first('back_licence') }}</p> @endif
                                </div>
                                @if ($errors->has('back_licence'))
                                <p style="color:red;">
                                    {{ $errors->first('back_licence') }}
                                </p>
                                @endif
                                @php
                                    $ext = strtolower(pathinfo(@$earning->back_licence_path, PATHINFO_EXTENSION));
                                @endphp
                                @if($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg')
                                    <img id="blicenceImg" src="{{@$earning->back_licence_path}}" alt="" width= "150px";
                                    height= "150px" style="{{ isset($earning->back_licence_path) ? 'display:block;' : 'display:none;' }}" />
                                @else
                                    <img id="blicenceImg" src="{{asset('images/pdf.jpeg')}}" alt="" width= "150px"; height= "150px"; style="{{ isset($earning->back_licence_path) ? 'display:block;' : 'display:none;' }}" />
                                @endif
                                @if(@$earning->back_licence_path != null)
                                    <div class="mt-2">
                                        <a href='{{@$earning->back_licence_path}}' role="button" class="btn m-btn--square  btn-outline-info m-btn m-btn--custom text-brand" title='Download' download><span class=" fa fa-download"></span></a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">Address Proof *</label>
                            <div class="col-lg-6 col-md-9 col-sm-12 img_msg_scn">
                                <div class="input-group err_msg">
                                    {!! Form::file('address_proof', ['class'=>'custom-file-input' ,'id'=>'imgAddress',
                                    'accept' => 'image/*']) !!}
                                    {!! Form::label('Choose file', null,['class'=>'custom-file-label']) !!}
                                    <input type="hidden" name="address_proof_name" id="imgInp"
                                        value="{{@$earnong->address_proof}}">
                                    </br>
                                    @if ($errors->has('address_proof')) <p style="color:red;">
                                        {{ $errors->first('address_proof') }}</p> @endif
                                </div>
                                @if ($errors->has('address_proof'))
                                <p style="color:red;">
                                    {{ $errors->first('address_proof') }}
                                </p>
                                @endif
                                @php
                                    $ext = strtolower(pathinfo(@$earning->address_proof_path, PATHINFO_EXTENSION));
                                @endphp
                                @if($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg')
                                <img id="addressImg" src="{{@$earning->address_proof_path}}" alt="" width= "150px";
                                height= "150px";
                                    style="{{ isset($earning->address_proof_path) ? 'display:block;' : 'display:none;' }}" />
                                @else
                                    <img id="addressImg" src="{{asset('images/pdf.jpeg')}}" alt="" width= "150px"; height= "150px"; style="{{ isset($earning->address_proof_path) ? 'display:block;' : 'display:none;' }}" />
                                @endif
                                @if(@$earning->address_proof_path != null)
                                    <div class="mt-2">
                                        <a href='{{@$earning->address_proof_path}}' role="button" class="btn m-btn--square  btn-outline-info m-btn m-btn--custom text-brand" title='Download' download><span class=" fa fa-download"></span></a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.status').'*', null,['class'=>'col-form-label col-lg-3
                            col-sm-12']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!! Form::select('status', @$statusList, @$earning->status,
                                ['class' => 'form-control' ]) !!}
                            </div>
                        </div>
                        {!! Form::hidden('id',@$earning->uuid ,['id'=>'id']) !!}
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions m-form__actions">
                                <br>
                                <div class="row">
                                    <div class="col-lg-9 ml-lg-auto">
                                        {!! Form::submit(__('formname.submit'), ['class' => 'btn btn-success'] )
                                        !!}
                                        <a href="{{Route('earning.index')}}"
                                            class="btn btn-secondary">{{__('formname.cancel')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
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
var id = '{{@$earning->id}}';
</script>
<script src="{{asset('backend/js/earning/create.js')}}"></script>
@stop