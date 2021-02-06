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
                                <a href="{{route('job.index')}}"
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
                        @if(isset($job) || !empty($job))
                        {{ Form::model($job, ['route' => ['job.store', @$job->uuid], 'method' => 'PUT','id'=>'m_form_1','class'=>'m-form m-form--fit m-form--label-align-right','files' => true,'autocomplete' => "off", 'enctype'=>'multipart/form-data']) }}
                        @else
                        {{ Form::open(['route' => 'job.store','method'=>'post','class'=>'m-form m-form--fit m-form--label-align-right','id'=>'m_form_1','files' => true,'autocomplete' => "off", 'enctype'=>'multipart/form-data']) }}
                        @endif
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.job.title').'*', null,['class'=>'col-form-label
                            col-lg-3
                            col-sm-12']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!! Form::text('title',@$job->title,['class'=>'form-control
                                m-input
                                err_msg','maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.job.title')])
                                !!}
                                @if ($errors->has('title'))
                                <p style="color:red;">{{ $errors->first('title') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.job.description').'*', null,['class'=>'col-form-label
                            col-lg-3
                            col-sm-12']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <div class="input-group">
                                    {!!
                                    Form::textarea('description',@$job->description,['class'=>'form-control
                                    m-input','id'=>'editor1']) !!}
                                </div>
                                <span class="descriptionError">
                                    @if ($errors->has('description')) <p style="color:red;">
                                        {{ $errors->first('description') }}</p> @endif
                                </span>
                                <span class="m-form__help"></span>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.job.machine').'*', null,['class'=>'col-form-label col-lg-3
                            col-sm-12']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!! Form::select('machine_id', @$machineList, @$job->machine_id,
                                ['class' => 'form-control' ,'id'=>'machine_id' ]) !!}
                                @if ($errors->has('machine_id'))
                                <p style="color:red;">{{ $errors->first('machine_id') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.job.location').'*', null,['class'=>'col-form-label col-lg-3
                            col-sm-12']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!! Form::select('location_id', @$locationList, @$job->location_id,
                                ['class' => 'form-control' ,'id'=>'location_id' ]) !!}
                                @if ($errors->has('location_id'))
                                <p style="color:red;">{{ $errors->first('location_id') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.job.problem').'*', null,['class'=>'col-form-label col-lg-3
                            col-sm-12']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!! Form::select('problem_id', @$problemList, @$job->problem_id,
                                ['class' => 'form-control', 'id'=>'problem_id' ]) !!}
                                @if ($errors->has('problem_id'))
                                <p style="color:red;">{{ $errors->first('problem_id') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.job.assigned_to').'*', null,['class'=>'col-form-label col-lg-3
                            col-sm-12']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!! Form::select('assigned_to', @$engineerList, @$job->assigned_to,
                                ['class' => 'form-control', 'id'=>'assigned_to' ]) !!}
                                @if ($errors->has('assigned_to'))
                                <p style="color:red;">{{ $errors->first('assigned_to') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.job.comment').'', null,['class'=>'col-form-label
                            col-lg-3
                            col-sm-12']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <div class="input-group">
                                    {!!
                                    Form::textarea('comment',@$job->comment,['class'=>'form-control
                                    m-input','id'=>'editor2']) !!}
                                </div>
                                <span class="contentError">
                                    @if ($errors->has('comment')) <p style="color:red;">
                                        {{ $errors->first('comment') }}</p> @endif
                                </span>
                                <span class="m-form__help"></span>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.job.priority').'*', null,['class'=>'col-form-label col-lg-3
                            col-sm-12']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!! Form::select('priority', @$jobPriorityList, @$job->priority,
                                ['class' => 'form-control']) !!}
                                @if ($errors->has('priority'))
                                <p style="color:red;">{{ $errors->first('priority') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.job.job_status').'*', null,['class'=>'col-form-label col-lg-3
                            col-sm-12']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!! Form::select('job_status_id', @$jobStatusList, @$job->job_status_id,
                                ['class' => 'form-control', 'id'=>'job_status_id' ]) !!}
                                 @if ($errors->has('job_status_id'))
                                 <p style="color:red;">{{ $errors->first('job_status_id') }}</p>
                                 @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.job.images') .'*', null,['class'=>'col-form-label
                            col-lg-3 col-sm-12'])
                            !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!!Form::file('image[]',['id'=>'imgInput','class'=>'form-control m-input','accept' =>
                                'image/*','multiple'=>'true'])!!}
                                @if ($errors->has('image')) <p style="color:red;">
                                    {{ $errors->first('image') }}</p>
                                @endif
                            </div>
                        </div>
                        @if($jobImages)
                        <div class="form-group m-form__group row offset-md-3">
                            @forelse($jobImages as $key => $image)
                            @if(file_exists(base_path(@$image->path)) && @$image->path != null)
                            <div style="margin-left:5px;" id="job-{{$key}}">
                                <a class="deleteImage" href="javascript:;" id="{{@$image->uuid}}"
                                    data-url="{{route('image.delete')}}" data-key="job-{{$key}}" title="Delete Image">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                                <img src="{{@$image->job_image }}" alt="" height="100px;" width="100px;"
                                    style="display:block;" />
                            </div>
                            @else
                            <img src="{{asset('images/default.png') }}" alt="" height="100px;" width="100px;"
                                style="display:block;" />
                            @endif
                            @empty
                            @endforelse
                        </div>
                        @endif
                        <img id="blah" src="" data-count='{{isset($jobImages)?count($jobImages):0}}' alt="" height="100px;" width="100px;" style="display:none;" />
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.status').'*', null,['class'=>'col-form-label col-lg-3
                            col-sm-12']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!! Form::select('status', @$statusList, @$job->status,
                                ['class' => 'form-control' ]) !!}
                                 @if ($errors->has('status')) <p style="color:red;">
                                    {{ $errors->first('status') }}</p>
                                @endif
                            </div>
                        </div>
                        {!! Form::hidden('id',@$job->id ,['id'=>'id']) !!}
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions m-form__actions">
                                <br>
                                <div class="row">
                                    <div class="col-lg-9 ml-lg-auto">
                                        {!! Form::submit(__('formname.submit'), ['class' => 'btn btn-success'] )
                                        !!}
                                        <a href="{{Route('job.index')}}"
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
    var rule = $.extend({}, {!!json_encode(config('constant'), JSON_FORCE_OBJECT) !!});
var formname = $.extend({}, {!!json_encode(__('formname'), JSON_FORCE_OBJECT) !!});
var id = '{{@$job->id}}';
</script>
<script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>
<script src="{{ asset('backend/js/job/create.js') }}" type="text/javascript"></script>
@stop