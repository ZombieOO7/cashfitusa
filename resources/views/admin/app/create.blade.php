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
                                <a href="{{route('app.index')}}"
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
                        {{ Form::model($app, ['route' => ['app.store', @$app->uuid], 'method' => 'PUT','id'=>'m_form_1','class'=>'m-form m-form--fit m-form--label-align-right','files' => true,'autocomplete' => "off"]) }}
                        @else
                        {{ Form::open(['route' => 'app.store','method'=>'post','class'=>'m-form m-form--fit m-form--label-align-right','id'=>'m_form_1','files' => true,'autocomplete' => "off"]) }}
                        @endif
                            <div class="form-group m-form__group row">
                                {!! Form::label(__('formname.app.name').'*', null,['class'=>'col-form-label
                                col-lg-3 col-sm-12']) !!}
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    {!! Form::text('title',@$app->title,['class'=>'form-control
                                    m-input err_msg','maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.app.name')]) !!}
                                    @if ($errors->has('title'))
                                        <p style="color:red;">{{ $errors->first('title') }}</p> 
                                    @endif
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                {!! Form::label(__('formname.app.description').'*', null,['class'=>'col-form-label
                                col-lg-3 col-sm-12']) !!}
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    {!! Form::textarea('description',@$app->description,['class'=>'form-control
                                    m-input err_msg','maxlength'=>config('constant.content_length'),'placeholder'=>__('formname.app.description')]) !!}
                                    @if ($errors->has('description'))
                                        <p style="color:red;">{{ $errors->first('description') }}</p> 
                                    @endif
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                {!! Form::label(__('formname.app.image') .'*', null,['class'=>'col-form-label
                                col-lg-3 col-sm-12'])
                                !!}
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    {!!Form::file('image_file',['id'=>'imgInput','class'=>'form-control m-input','accept' => 'image/*'])!!}
                                    <input type="hidden" name="stored_img_name" id="stored_img_id" value="{{@$app->image}}">
                                    @if ($errors->has('image_file')) <p style="color:red;">
                                        {{ $errors->first('image_file') }}</p>
                                    @endif
                                    @if(@$app)
                                        <img id="blah" src="{{@$app->image_path }}" alt="" height="200px;" width="200px;"
                                        style="display:block;" />
                                    @else
                                    <img id="blah" src="" alt="" height="200px;" width="200px;"
                                        style="display:none;" />
                                    @endif
                                </div>
                            </div>
                            {{-- <div class="form-group m-form__group row">
                                {!! Form::label(__('formname.app.video') .'*', null,['class'=>'col-form-label
                                col-lg-3 col-sm-12'])
                                !!}
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    {!!Form::file('video_file',['id'=>'imgInput','class'=>'form-control m-input','accept' => 'video/*'])!!}
                                    <input type="hidden" name="stored_video_name" id="stored_video_id" value="{{@$app->video}}">
                                    @if ($errors->has('video_file')) <p style="color:red;">
                                        {{ $errors->first('video_file') }}</p>
                                    @endif
                                    @if(@$app)
                                        <video id="blah2" alt="" height="200px;" width="400px;"style="display:block;" controls>
                                            <source src="{{@$app->video_path }}">
                                        </video>
                                    @else
                                    <img id="blah2" src="" alt="" height="200px;" width="200px;"
                                        style="display:none;" />
                                    @endif
                                </div>
                            </div> --}}
                            <div class="form-group m-form__group row">
                                {!! Form::label(__('formname.status').'*', null,['class'=>'col-form-label col-lg-3
                                col-sm-12']) !!}
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    {!! Form::select('status', @$statusList, @$app->status,
                                    ['class' =>
                                    'form-control' ]) !!}
                                </div>
                            </div>
                            {!! Form::hidden('id',@$app->id ,['id'=>'id']) !!}
                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions">
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-9 ml-lg-auto">
                                            {!! Form::submit(__('formname.submit'), ['class' => 'btn btn-success'] )
                                            !!}
                                            <a href="{{Route('app.index')}}"
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
<script src="{{ asset('backend/js/app/create.js') }}" type="text/javascript"></script>
@stop