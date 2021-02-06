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
                                <a href="{{route('review.index')}}"
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
                        @if(isset($review) || !empty($review))
                        {{ Form::model($review, ['route' => ['review.store', @$review->uuid], 'method' => 'PUT','id'=>'m_form_1','class'=>'m-form m-form--fit m-form--label-align-right','files' => true,'autocomplete' => "off"]) }}
                        @else
                        {{ Form::open(['route' => 'review.store','method'=>'post','class'=>'m-form m-form--fit m-form--label-align-right','id'=>'m_form_1','files' => true,'autocomplete' => "off"]) }}
                        @endif
                            <div class="form-group m-form__group row">
                                {!! Form::label(__('formname.review.name').'*', null,['class'=>'col-form-label
                                col-lg-3
                                col-sm-12']) !!}
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    {!! Form::text('name',@$review->name,['class'=>'form-control
                                    m-input err_msg','maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.review.name')]) !!}
                                    @if ($errors->has('name'))
                                        <p style="color:red;">{{ $errors->first('name') }}</p> 
                                    @endif
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                {!! Form::label(__('formname.review.image') .'*', null,['class'=>'col-form-label
                                col-lg-3 col-sm-12'])
                                !!}
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    {!!Form::file('image_file',['id'=>'imgInput','class'=>'form-control m-input','accept' => 'image/*'])!!}
                                    <input type="hidden" name="stored_img_name" id="stored_img_id" value="{{@$review->image_path}}">
                                    @if ($errors->has('image_file')) <p style="color:red;">
                                        {{ $errors->first('image_file') }}</p>
                                    @endif
                                    @if(@$review)
                                        <img id="blah" src="{{@$review->image_path }}" alt="" height="200px;" width="200px;"
                                        style="display:block;" />
                                    @else
                                    <img id="blah" src="" alt="" height="200px;" width="200px;"
                                        style="display:none;" />
                                    @endif
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                {!! Form::label(__('formname.review.review').'*', null,['class'=>'col-form-label
                                col-lg-3
                                col-sm-12']) !!}
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    {!! Form::textarea('review',@$review->review,['class'=>'form-control
                                    m-input err_msg','maxlength'=>config('constant.content_length'),'placeholder'=>__('formname.review.name')]) !!}
                                    @if ($errors->has('review'))
                                        <p style="color:red;">{{ $errors->first('title') }}</p> 
                                    @endif
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                {!! Form::label(__('formname.status').'*', null,['class'=>'col-form-label col-lg-3
                                col-sm-12']) !!}
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    {!! Form::select('status', @$statusList, @$review->status,
                                    ['class' =>
                                    'form-control' ]) !!}
                                </div>
                            </div>
                            {!! Form::hidden('id',@$review->id ,['id'=>'id']) !!}
                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions">
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-9 ml-lg-auto">
                                            {!! Form::submit(__('formname.submit'), ['class' => 'btn btn-success'] )
                                            !!}
                                            <a href="{{Route('review.index')}}"
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
var id = '{{@$review->id}}';
</script>
<script src="{{ asset('backend/js/review/create.js') }}" type="text/javascript"></script>
@stop