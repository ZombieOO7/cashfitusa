@extends('admin.layouts.default')
@section('inc_css')

@section('content')
@php
if(isset($role)){
$title=__('formname.role_update');
}
else{
$title=__('formname.role_create');
}
@endphp

@section('title', $title)

<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <div class="m-content">
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
                                        {{$title}}
                                    </h3>
                                </div>
                            </div>
                            <div class="m-portlet__head-tools">
                                <a href="{{route('role_index')}}"
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
                        @if(isset($role) || !empty($role))
                        {{ Form::model($role, ['route' => ['role_store', $role->id], 'method' => 'PUT','id'=>'m_form_1','class'=>'m-form m-form--fit m-form--label-align-right']) }}
                        @else
                        {{ Form::open(['route' => 'role_store','method'=>'POST','class'=>'m-form m-form--fit m-form--label-align-right','id'=>'m_form_1']) }}
                        @endif
                        <div class="m-portlet__body">
                            <div class="m-form__content">
                                <div class="m-alert m-alert--icon alert alert-danger m--hide" role="alert"
                                    id="m_form_1_msg">
                                    <div class="m-alert__icon">
                                        <i class="la la-warning"></i>
                                    </div>
                                    <div class="m-alert__text">
                                        {{__('admin/messages.required_alert')}}
                                    </div>
                                    <div class="m-alert__close">
                                        <button type="button" class="close" data-close="alert" aria-label="Close">
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                {!! Form::label(__('formname.role_name').'*', null,['class'=>'col-form-label
                                col-lg-3
                                col-sm-12']) !!}
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    {!!
                                    Form::text('name',isset($role)?$role->name:'',['class'=>'form-control
                                    m-input','maxlength'=>config('constant.text_length'),'placeholder'=>__('formname.role_name')]) !!}
                                    @if ($errors->has('name')) <p style="color:red;">
                                        {{ $errors->first('name') }}</p> @endif
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                {!! Form::label(__('formname.permissions').'*', null,['class'=>'col-form-label
                                col-lg-3 col-sm-12'])
                                !!}
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    <div class="input-group">
                                        @if(isset($role))
                                        @php $rolePermission = $role->permissions()->orderBy('name',
                                        'DESC')->get();@endphp
                                        @else
                                        @php $rolePermission =[];@endphp
                                        @endif
                                        {!!
                                        Form::select('permission[]',$permission,$rolePermission,['class'=>'selectpicker
                                        form-control
                                        m-bootstrap-select m_selectpicker','id'=>'permission','multiple'=>true
                                        ,'data-none-selected-text' => __('formname.select_permission') ])!!}
                                        @if ($errors->has('permission.*')) <p style="color:red;">
                                            {{ $errors->first('permission.*') }}</p> @endif
                                    </div>
                                    <span class="permissionError">
                                        @if($errors->has('permission'))
                                        <p class="errors">{{$errors->first('permission')}}</p>
                                        @endif
                                    </span>
                                    <span class="m-form__help"></span>
                                </div>
                            </div>

                            {!! Form::hidden('id',isset($role)?$role->id:'' ,['id'=>'id']) !!}
                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions">
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-9 ml-lg-auto">
                                            {!! Form::submit(__('formname.submit'), ['class' => 'btn btn-success'] )
                                            !!}
                                            <a href="{{Route('role_index')}}"
                                                class="btn btn-secondary">{{__('formname.cancel')}}</a>
                                        </div>
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
    var rule = $.extend({}, {!!json_encode(config('constant'), JSON_FORCE_OBJECT) !!});
</script>
<script src="{{ asset('backend/js/role/create.js') }}" type="text/javascript"></script>
@stop