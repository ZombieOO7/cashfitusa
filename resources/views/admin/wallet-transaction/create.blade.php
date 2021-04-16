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
                                <a href="{{route('wallet-transaction.index')}}"
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
                        @if(isset($app) || !empty($app))
                        {{ Form::model($app, ['route' => ['wallet-transaction.store', @$app->uuid], 'method' => 'PUT','id'=>'m_form_1','class'=>'m-form m-form--fit m-form--label-align-right','files' => true,'autocomplete' => "off"]) }}
                        @else
                        {{ Form::open(['route' => 'wallet-transaction.store','method'=>'post','class'=>'m-form m-form--fit m-form--label-align-right','id'=>'m_form_1','files' => true,'autocomplete' => "off"]) }}
                        @endif
                            <div class="form-group m-form__group row mt-3">
                                {!! Form::label(__('formname.earning.user_id').'*', null,['class'=>'col-form-label col-lg-3
                                col-sm-12']) !!}
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    {!! Form::select('user_id', @$userList, @$earning->earnin_user_id,
                                    ['class' => 'form-control', 'id'=>'user_id' ]) !!}
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                {!! Form::label(__('formname.date').'*', null,['class'=>'col-form-label
                                col-lg-3 col-sm-12']) !!}
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    {!!
                                        Form::text('date',@$app->proper_date_text,['class'=>'form-control m-input err_msg','id'=>'date',
                                        'placeholder'=>__('formname.date'),'readonly'=>true])
                                    !!}
                                    @if ($errors->has('date'))
                                        <p style="color:red;">{{ $errors->first('date') }}</p> 
                                    @endif
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                {!! Form::label(__('formname.amount').'*', null,['class'=>'col-form-label
                                col-lg-3 col-sm-12']) !!}
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    {!!
                                        Form::text('amount',@$app->amount,['class'=>'form-control m-input err_msg',
                                        'maxlength'=>config('constant.amount_length'),'placeholder'=>__('formname.amount')])
                                    !!}
                                    @if ($errors->has('amount'))
                                        <p style="color:red;">{{ $errors->first('description') }}</p> 
                                    @endif
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                {!! Form::label(__('formname.description').'*', null,['class'=>'col-form-label
                                col-lg-3 col-sm-12']) !!}
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    {!!
                                        Form::textarea('description',@$app->description,['class'=>'form-control m-input err_msg',
                                        'maxlength'=>config('constant.content_length'),'placeholder'=>__('formname.description')])
                                    !!}
                                    @if ($errors->has('description'))
                                        <p style="color:red;">{{ $errors->first('description') }}</p> 
                                    @endif
                                </div>
                            </div>
                            {!! Form::hidden('id',@$app->uuid ,['id'=>'id']) !!}
                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions">
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-9 ml-lg-auto">
                                            {!! Form::submit(__('formname.submit'), ['class' => 'btn btn-success'] )
                                            !!}
                                            <a href="{{Route('wallet-transaction.index')}}"
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
var id = '{{@$app->id}}';
</script>
<script src="{{ asset('backend/js/wallet-transaction/create.js') }}" type="text/javascript"></script>
@stop