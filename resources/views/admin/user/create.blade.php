@extends('admin.layouts.default')
@section('content')
<style>
    .hid_spn{
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
                                <a href="{{route('user.index')}}" class="btn btn-secondary m-btn m-btn--air m-btn--custom">
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
                        {{ Form::model($user, ['route' => ['loan.user.store', @$user->uuid], 'method' => 'PUT','id'=>'m_form_1','class'=>'m-form m-form--fit ','files' => true,'autocomplete' => "off"]) }}
                        @else
                        {{ Form::open(['route' => 'loan.user.store','method'=>'post','class'=>'m-form m-form--fit ','id'=>'m_form_1','files' => true,'autocomplete' => "off"]) }}
                        @endif
                        {{-- <div class="m-form__heading">
                            <h3 class="m-form__heading-title">Account Detail</h3>
                        </div> --}}
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.user.first_name').'*',
                            null,['class'=>'col-form-label col-md-3']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!!
                                Form::text('first_name',@$user->first_name,['id'=>'first_name','class'=>'form-control
                                m-input
                                err_msg','maxlength'=>config('constant.first_name_length'),'placeholder'=>__('formname.user.first_name')])
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
                            null,['class'=>'col-form-label col-md-3']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!!
                                Form::text('middle_name',@$user->middle_name,['id'=>'middle_name','class'=>'form-control
                                m-input
                                err_msg','maxlength'=>config('constant.middle_name_length'),'placeholder'=>__('formname.user.middle_name')])
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
                            null,['class'=>'col-form-label col-md-3']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!!
                                Form::text('last_name',@$user->last_name,['id'=>'last_name','class'=>'form-control
                                m-input
                                err_msg','maxlength'=>config('constant.last_name_length'),'placeholder'=>__('formname.user.last_name')])
                                !!}
                                <span class='last_name'></span>
                                @if ($errors->has('last_name'))
                                <p style="color:red;">
                                    {{ $errors->first('last_name') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.user.phone1').'*',
                            null,['class'=>'col-form-label col-md-3']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!!
                                Form::text('phone',@$user->phone,['class'=>'form-control
                                m-input
                                err_msg','maxlength'=>config('constant.phone_length'),'placeholder'=>__('formname.user.phone1')])
                                !!}
                                <span class='phone'></span>
                                @if ($errors->has('phone'))
                                <p style="color:red;">
                                    {{ $errors->first('phone') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.user.address1').'*',
                            null,['class'=>'col-form-label col-md-3']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!!
                                Form::textarea('address',@$user->address,['class'=>'form-control m-input err_msg',
                                'maxlength'=>config('constant.text_length'),'rows'=>3,'placeholder'=>__('formname.user.phone1')])
                                !!}
                                <span class='address'></span>
                                @if ($errors->has('address'))
                                <p style="color:red;">
                                    {{ $errors->first('address') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.user.email').'*',
                            null,['class'=>'col-form-label col-md-3']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!!
                                Form::email('email',@$user->email,['id'=>'email','class'=>'form-control
                                m-input err_msg','readonly'=>isset($user)?true:false,'maxlength'=>config('constant.email_length'),'placeholder'=>__('formname.user.email')])
                                !!}
                                <span class='email'></span>
                                @if ($errors->has('email'))
                                <p style="color:red;">
                                    {{ $errors->first('email') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!!
                            Form::label(__('formname.user.password').'*',
                            null,['class'=>'col-form-label col-md-3']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!! Form::password('password',['class' =>'form-control m-input','id'=>'password','type'
                                => 'password']) !!}
                                <span class='password'></span>
                                @if ($errors->has('password'))
                                <p style="color:red;">
                                    {{ $errors->first('password') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!!
                            Form::label(__('formname.user.confirm_password').'*', null,['class'=>'col-form-label
                            col-md-3']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!! Form::password('confirm_password',['class' => 'form-control
                                m-input','id'=>'password','type' => 'password']) !!}
                                <span class='confirm_password'></span>
                                @if ($errors->has('confirm_password'))
                                <p style="color:red;">
                                    {{ $errors->first('confirm_password') }}
                                </p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label('image', null,array('class'=>'col-form-label col-lg-3 col-sm-12')) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <div class="input-group">
                                    {!! Form::file('image_file', array('class'=>'custom-file-input' ,'id'=>'imgInput', 'accept' => 'image/png,image/jpeg')) !!}
                                    {!! Form::label('Choose file', null,array('class'=>'custom-file-label')) !!}
                                    <input type="hidden" name="stored_img_name" value="{{isset($user)?$user->image:''}}">
                                </div>
                                @error('image') <p class="errors">{{$errors->first('image')}}</p> @enderror
                                <span class="m-form__help">@lang('setting.image_msg')</span>
                            </div>
                        </div>
                        <div class="form-group m-form__group row image-block"  style="display:{{ isset($user->image)  ? 'flex':'none'}} ">
                            {!! Form::label('', null,array('class'=>'col-form-label col-lg-3 col-sm-12')) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <div class="input-group">
                                    <img id="image_upload_preview" src="{{ @$user->image_names }}" height="100" width="100"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.status').'*', null,['class'=>'col-form-label col-lg-3
                            col-sm-12']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!! Form::select('status', @$statusList, @$user->status,
                                ['class' =>
                                'form-control' ]) !!}
                            </div>
                        </div>
                        {!! Form::hidden('id',@$user->id ,['id'=>'id']) !!}
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions m-form__actions">
                                <br>
                                <div class="row">
                                    <div class="col-lg-9 ml-lg-auto">
                                        {!! Form::submit(__('formname.submit'), ['class' => 'btn btn-success'] )
                                        !!}
                                        <a href="{{Route('user.index')}}"
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
    var url = "{{ route('loan.datatable') }}";
</script>
<script src="{{ asset('backend/js/user/create.js') }}" type="text/javascript"></script>
@stop