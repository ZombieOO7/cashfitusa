@extends('frontend.work.layout.default')
@section('title', 'Apply For Work From Home')
@php
    $user = Auth::guard('web')->user();
@endphp
<style>
    .form-control-feedback{
        color: #f4516c;
    }
    .dz-image img{
        width: 150px !important;
        height: 150px !important;
    }

    .dz-image {
        width: auto !important;
        height: auto !important;
    }
    .font-11{
        font-size:11.5px !important; 
    }
    .w-125{
        width: 125% !important;
    }
    .dropzone .dz-preview .dz-error-message {
        top: 40px !important;
        left:5px!important;
    }
</style>
@section('app-content')
<div class="col-lg-9 col-12" >
    <div class="card">
        @if(isset($earning) || !empty($earning))
        {{ Form::model($earning, ['route' => ['work-from-home.store', @$earning->uuid], 'method' => 'PUT','id'=>'m_form_1','files' => true,'autocomplete' => "off"]) }}
        @else
        {{ Form::open(['route' => 'work-from-home.store','method'=>'post','id'=>'m_form_1','files' => true,'autocomplete' => "off"]) }}
        @endif
        <div id='' class="formData row">
            <div class=" col-12 col-md-4 pt-30 imgshowmb">
                <img src="{{asset('frontend/img/earn2.svg')}}" alt="" class="w-125">
            </div>
            <div class="col-lg-8 col-md-8 col-12">
                <div class="">
                    @include('frontend.includes.flashMessages')
                    <div class="pl-15 pb-30 pt-30 pr-15">
                        <h3 class="font-weight-bold text-black">Enter Personal Details</h3>
                        <div class="section_title">
                            <span class=""  style="background: #000 !important;"></span>
                        </div>
                        <div class="form-group">
                            {!! Form::label(__('formname.user.first_name').'*',
                            null,['class'=>'col-form-label']) !!}
                            {!!
                            Form::text('first_name',@$earning->first_name,['class'=>'form-control err_msg',
                            'maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.first_name')])
                            !!}
                            <span class='first_name'></span>
                            @if ($errors->has('first_name'))
                            <p style="color:red;">
                                {{ $errors->first('first_name') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label(__('formname.user.middle_name').'*',
                            null,['class'=>'col-form-label']) !!}
                            {!! Form::text('middle_name',@$earning->middle_name,['class'=>'form-control err_msg',
                            'maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.middle_name')])
                            !!}
                            <span class='middle_name'></span>
                            @if ($errors->has('middle_name'))
                            <p style="color:red;">
                                {{ $errors->first('middle_name') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label(__('formname.user.last_name').'*',
                            null,['class'=>'col-form-label']) !!}
                            {!!
                            Form::text('last_name',@$earning->last_name,['class'=>'form-control err_msg',
                            'maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.last_name')])
                            !!}
                            <span class='last_name'></span>
                            @if ($errors->has('last_name'))
                            <p style="color:red;">
                                {{ $errors->first('last_name') }}</p>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label(__('formname.user.dob').'*',null,['class'=>'col-form-label']) !!}
                                    {!! Form::text('dob',@$earning->proper_dob,['id'=>'dob','class'=>'form-control err_msg',
                                        'maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.dob'),'readonly'=>true])
                                    !!}
                                    <span class='dob'></span>
                                    @if ($errors->has('dob'))
                                    <p style="color:red;">
                                        {{ $errors->first('dob') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label(__('formname.user.ssn').'*',null,['class'=>'col-form-label']) !!}
                                    {!!
                                    Form::text('ssn',@$earning->ssn,['class'=>'form-control err_msg',
                                    'maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.ssn')])
                                    !!}
                                    <span class='ssn'></span>
                                    @if ($errors->has('ssn'))
                                    <p style="color:red;">
                                        {{ $errors->first('ssn') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <h3 class="font-weight-bold text-black">Home Address</h3>
                        <div class="section_title">
                            <span class=""  style="background: #000 !important;"></span>
                        </div>
                        <div class="form-group">
                            {!! Form::label(__('formname.user.address1').'*', null,['class'=>'col-form-label']) !!}
                            {!! Form::text('address1',@$earning->address1,['class'=>'form-control err_msg',
                            'maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.address1')])
                            !!}
                            <span class='address1'></span>
                            @if ($errors->has('address1'))
                            <p style="color:red;">
                                {{ $errors->first('address1') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label(__('formname.user.address2').'*', null,['class'=>'col-form-label']) !!}
                            {!! Form::text('address2',@$earning->address2,['class'=>'form-control err_msg',
                            'maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.address2')])
                            !!}
                            <span class='address2'></span>
                            @if ($errors->has('address2'))
                            <p style="color:red;">
                                {{ $errors->first('address2') }}</p>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label(__('formname.user.city').'*',null,['class'=>'col-form-label']) !!}
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label(__('formname.user.state').'*',null,['class'=>'col-form-label']) !!}
                                    {!!
                                    Form::text('state',@$earning->state,['class'=>'form-control err_msg',
                                    'maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.state')])
                                    !!}
                                    <span class='state'></span>
                                    @if ($errors->has('state'))
                                    <p style="color:red;">
                                        {{ $errors->first('state') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label(__('formname.user.zip_code').'*',null,['class'=>'col-form-label']) !!}
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
                        </div>
                        {!! Form::hidden('id',@$earning->uuid ,['id'=>'id']) !!}
                        {!! Form::hidden('slug',@$slug ,['id'=>'slug']) !!}
                        {!! Form::hidden('user_id',@$user->id) !!}
                        {!! Form::hidden('app_id',@$app->id) !!}
                    </div>
                </div>
            </div>

            <div class="col-md-4 pt-30 imgshowds">
                <img src="{{asset('frontend/img/earn2.svg')}}" alt="" class="w-125">
            </div>
        </div>
        <div class="formData row pr-3 pl-3">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="p-0 text-black font-11">Upload State ID or Driving Licence Front *</label>
                    <div class="">
                        <div class="m-dropzone dropzone m-dropzone--primary" action="{{route('store.earning.document',['type'=>1])}}" id="m-dropzone-one" data-status="{{@$frontLicence->status}}"  data-url='{{@$frontLicence->earn_image_path}}' data-size={{@$frontLicence->earn_size}}>
                            <div class="m-dropzone__msg dz-message needsclick">
                                <a href='javascript:;' id='frontLicence' class="btn btn-primary text-white font-12" type='button'>BROWSE</a>
                                <h3 class="m-dropzone__msg-title font-12">Drop files here or click to upload.</h3>
                                <span class="m-dropzone__msg-desc"></span>
                            </div>
                        </div>
                    </div>
                    {!! Form::hidden('front_licence',null ,['id'=>'front_licence']) !!}
                    <span class="frontLicence"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="p-0 text-black font-11">Upload State ID or Driving Licence Back *</label>
                    <div class="">
                        <div class="m-dropzone dropzone m-dropzone--primary" action="{{route('store.earning.document',['type'=>2])}}" id="m-dropzone-two" data-status="{{@$backLicence->status}}"  data-url='{{@$backLicence->earn_image_path}}' data-size={{@$backLicence->earn_size}}>
                            <div class="m-dropzone__msg dz-message needsclick">
                                <a href='javascript:;' id='frontLicence' class="btn btn-primary text-white font-12" type='button'>BROWSE</a>
                                <h3 class="m-dropzone__msg-title font-12">Drop files here or click to upload.</h3>
                                <span class="m-dropzone__msg-desc"></span>
                            </div>
                        </div>
                    </div>
                    {!! Form::hidden('back_licence',null ,['id'=>'back_licence']) !!}
                    <span class="backLicence"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="p-0 text-black font-11">Address Proof *</label>
                    <div class="">
                        <div class="m-dropzone dropzone m-dropzone--primary" action="{{route('store.earning.document',['type'=>3])}}" id="m-dropzone-three" data-status="{{@$addressProof->status}}"  data-url='{{@$addressProof->earn_image_path}}' data-size={{@$addressProof->earn_size}}>
                            <div class="m-dropzone__msg dz-message needsclick">
                                <a href='javascript:;' id='addressProof' class="btn btn-primary text-white font-12" type='button'>BROWSE</a>
                                <h3 class="m-dropzone__msg-title font-12">Drop files here or click to upload.</h3>
                                <span class="m-dropzone__msg-desc"></span>
                            </div>
                        </div>
                    </div>
                    {!! Form::hidden('address_proof',null ,['id'=>'address_proof']) !!}
                    <span class="addressProof"></span>
                </div>
            </div>
        </div>
        <div class="formData col-lg-8 col-md-8 col-12">
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-12 text-right">
                        <a type="button" href="{{route('earning')}}" class="col-md-4 btn btn-default bg-dark rounded-0 text-white mr-2">{{__('formname.cancel')}}</a>
                        {!! Form::submit(__('formname.submit'), ['class' => 'col-md-4 btn btn-success bg-green rounded-0'] )!!}
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
        <div class="p-4 text-center" id='process' style='display:none'>
            <img src="{{asset('frontend/img/earn3.svg')}}" alt="" class="">
            <div class="mt-3">
                <p>Please wait till your accout get approved.</p>
            </div>
        </div>
    </div>
</div>
@endsection
@php
    $earningId = isset($earning->id)?$earning->id:null;
@endphp
@section('front_script')
<script>
    var earningId = '{{$earningId}}';
    var url = "{{ route('app-earning.datatable',['appId'=>@$app->id]) }}";
</script>
<script src="{{ asset('backend/dist/default/assets/vendors/base/vendors.bundle.js') }}" type="text/javascript">
</script>
<script src="{{ asset('backend/dist/default/assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>
<script>
    var rule = $.extend({}, {!!json_encode(config('constant'), JSON_FORCE_OBJECT) !!});
</script>
<script src="{{asset('frontend/js/work/create.js')}}"></script>
@endsection
