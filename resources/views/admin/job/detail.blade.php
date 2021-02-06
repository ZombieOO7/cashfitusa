@extends('admin.layouts.default')
@section('inc_css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.min.css"
    rel="stylesheet">
<style>
    label {
        font-weight: 600;
    }
</style>
@endsection
@section('content')
@php
if(isset($job)){
$title=__('formname.job.detail');
}
else{
$title=__('formname.job.detail');
}
if(URL::previous() == Request::fullUrl()){
    $backurl = route('job.index');
}else{
    $backurl = URL::previous();
}
@endphp

@section('title', $title)

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
                                        {{$title}}
                                    </h3>
                                </div>
                            </div>
                            <div class="m-portlet__head-tools">
                                <a href="{{$backurl}}"
                                    class="btn btn-secondary m-btn m-btn--air m-btn--custom">
                                    <span>
                                        <i class="la la-arrow-left"></i>
                                        <span>Back</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.job.title').' : ', null,['class'=>'col-form-label
                            col-lg-3
                            col-sm-12']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12 col-form-label">
                                {{@$job->title}}
                            </div>
                        </div>
                        <div class="form-group m-form__group row aaaaa">
                            {!! Form::label(__('formname.job.description').' : ',
                            null,['class'=>'col-form-label
                            col-lg-3 col-sm-12']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12 col-form-label">
                                {!! @$job->description !!}
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.job.machine').' : ', null,['class'=>'col-form-label
                            col-lg-3
                            col-sm-12']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12 col-form-label">
                                {{@$job->machine->title}}
                            </div>
                        </div>
                        <div class="form-group m-form__group row aaaaa">
                            {!! Form::label(__('formname.job.location').' : ',
                            null,['class'=>'col-form-label
                            col-lg-3 col-sm-12']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12 col-form-label">
                                {{@$job->location->title}}
                            </div>
                        </div>
                        <div class="form-group m-form__group row aaaaa">
                            {!! Form::label(__('formname.job.problem').' : ',
                            null,['class'=>'col-form-label
                            col-lg-3 col-sm-12']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12 col-form-label">
                                {{@$job->problem->title}}
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.job.requested_by').' : ', null,['class'=>'col-form-label
                            col-lg-3
                            col-sm-12']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12 col-form-label">
                                {{@$job->created_by_text}}
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label(__('formname.job.assigned_to').' : ', null,['class'=>'col-form-label
                            col-lg-3
                            col-sm-12']) !!}
                            <div class="col-lg-3 col-md-9 col-sm-12">
                                {!! Form::select('assigned_to', @$engineerList, @$job->assigned_to,
                                ['class' => 'form-control', 'id'=>'engineer', 'data-id'=>@$job->uuid ,'data-url'=>route('job.change.assignto') ]) !!}
                            </div>
                        </div>
                        <div class="form-group m-form__group row aaaaa">
                            {!! Form::label(__('formname.job.comment').' : ',
                            null,['class'=>'col-form-label
                            col-lg-3 col-sm-12']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12 col-form-label">
                                {!! @$job->comment !!}
                            </div>
                        </div>
                        <div class="form-group m-form__group row aaaaa">
                            {!! Form::label(__('formname.job.priority').' : ',
                            null,['class'=>'col-form-label
                            col-lg-3 col-sm-12']) !!}
                            {{-- <div class="col-lg-6 col-md-9 col-sm-12 col-form-label">
                                {{ @config('constant.priorites')[$job->priority] }}
                            </div> --}}
                            <div class="col-lg-3 col-md-9 col-sm-12">
                                {!! Form::select('priority', @$jobPriorityList, @$job->priority,
                                ['class' => 'form-control', 'id'=>'priority', 'data-id'=>@$job->uuid ,'data-url'=>route('job.change.priority') ]) !!}
                                @if ($errors->has('priority'))
                                <p style="color:red;">{{ $errors->first('priority') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row aaaaa">
                            {!! Form::label(__('formname.job.job_status').' : ',
                            null,['class'=>'col-form-label
                            col-lg-3 col-sm-12']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12 col-form-label" style="color:{{@config('constant.job_status_color')[$job->job_status_id]}}">
                                {{ @config('constant.job_status_text')[$job->job_status_id] }}
                            </div>
                        </div>
                        @if($jobImages)
                        <div class="form-group m-form__group row offset-md-3">
                            @forelse($jobImages as $key => $image)
                            @if(file_exists(base_path(@$image->path)) && @$image->path != null)
                            <div style="margin-left:5px;" id="job-{{$key}}">
                                <img id="blah" src="{{@$image->job_image }}" alt="" height="100px;" width="100px;"
                                    style="display:block;" />
                            </div>
                            @else
                            <img id="blah" src="{{asset('images/default.png') }}" alt="" height="100px;" width="100px;"
                                style="display:block;" />
                            @endif
                            @empty
                            @endforelse
                        </div>
                        @else
                        <img id="blah" src="" alt="" height="100px;" width="100px;" style="display:none;" />
                        @endif
                        {{-- <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions m-form__actions">
                                <br>
                                <div class="row">
                                    <div class="col-lg-9 ml-lg-auto">
                                        <a href="{{Route('job.index')}}"
                                            class="btn btn-info">{{__('formname.back')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('inc_script')
<script src="{{ asset('backend/js/job/create.js') }}" type="text/javascript"></script>
@endsection