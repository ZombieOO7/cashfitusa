@extends('admin.layouts.default')
@section('inc_css')

@section('content')
@php
if(isset($permission)){
$title=__('formname.permission_update');
}
else{
$title=__('formname.web_setting.name');
}

@endphp
@section('title', $title)

<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<div class="m-content">
		@include('admin.includes.flashMessages')
		<div class="row">
			<div class="col-lg-12">
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
							{{-- <div class="m-portlet__head-tools">
								<a href="{{route('web_setting_index')}}"
									class="btn btn-secondary m-btn m-btn--air m-btn--custom">
									<span>
										<i class="la la-arrow-left"></i>
										<span>Back</span>
									</span>
								</a>
							</div> --}}
						</div>
					</div>
					<div class="m-portlet__body">
						<div class="m-wizard__form-step m-wizard__form-step--current" id="web_setting_form_step">
							<div class="row">
								<div class="col-xl-12">
									<ul class="nav nav-tabs m-tabs-line--2x m-tabs-line m-tabs-line--danger"
										role="tablist">
										<li class="nav-item m-tabs__item">
											<a class="nav-link m-tabs__link active"
												data-toggle="tab" href="#general_tab"
												role="tab">{{__('formname.web_setting.general')}}</a>
										</li>
										{{-- <li class="nav-item m-tabs__item">
											<a class="nav-link m-tabs__link "
												data-toggle="tab" href="#social_tab"
												role="tab">{{__('formname.web_setting.social_media_links')}}</a>
										</li> --}}
									</ul>
									<div class="tab-content m--margin-top-40">
										<div class="tab-pane active" id="general_tab" role="tabpanel">
											<div class="m-form__section m-form__section--first">
												@if(isset($setting) || !empty($setting))
												{{ Form::model($setting, [ 'enctype'=>'multipart/form-data','route' => ['general_setting_store', $setting->id], 'method' => 'PUT','id'=>'general_form_1','class'=>'m-form m-form--fit m-form--label-align-right']) }}
												@else
												{{ Form::open(['enctype'=>'multipart/form-data','route' => 'general_setting_store','method'=>'POST','class'=>'m-form m-form--fit m-form--label-align-right','id'=>'general_form_1']) }}
												@endif
												<div class="m-portlet__body">
													{!! Form::hidden('id',(isset($webSettings) ? @$webSettings->id : '') ,['id'=>'id']) !!}
													@csrf
													<div class="form-group m-form__group row">
														{!! Form::label(trans('setting.title') .'*', null,array('class'=>'col-form-label col-lg-3 col-sm-12'))!!}
														<div class="col-lg-6 col-md-9 col-sm-12">
															{!! Form::text('app_name',(isset($webSettings) ? @$webSettings->app_name : env('APP_NAME')),array('class'=>'form-control m-input','maxlength'=>config('constant.name_length'))) !!}
															@error('app_name') <p class="errors">{{$errors->first('app_name')}}</p> @enderror
														</div>
													</div>
													<div class="form-group m-form__group row">
															{!! Form::label(trans('setting.email') .'*', null,array('class'=>'col-form-label col-lg-3 col-sm-12'))!!}
														<div class="col-lg-6 col-md-9 col-sm-12">
															{!! Form::email('email',@$webSettings->email??env('MAIL_FROM_ADDRESS'),['class'=>'form-control m-input', 'maxlength'=>config('constant.email_length')]) !!}
															@error('email') <p class="errors">{{$errors->first('email')}}</p> @enderror
														</div>
													</div>
													{{-- <div class="form-group m-form__group row">
														{!! Form::label(trans('formname.web_setting.work_video').'', null,array('class'=>'col-form-label col-lg-3 col-sm-12')) !!}
														<div class="col-lg-6 col-md-9 col-sm-12">
															<div class="input-group">
																{!! Form::file('work_video', array('class'=>'custom-file-input' ,'id'=>'video', 'accept' => 'video/*')) !!}
																{!! Form::label('Choose file', null,array('class'=>'custom-file-label')) !!}
																<input type="hidden" name="stored_video_name" value="{{isset($webSettings)?$webSettings->video:''}}">
															</div>
															@error('work_video') <p class="errors">{{$errors->first('work_video')}}</p> @enderror
															<span class="m-form__help">@lang('setting.image_msg')</span>
														</div>
													</div> --}}
													{{-- <div class="form-group m-form__group row image-block"  style="display:{{ isset($webSettings->logo)  ? 'flex':'none'}} ">
														{!! Form::label('', null,array('class'=>'col-form-label col-lg-3 col-sm-12')) !!}
														<div class="col-lg-6 col-md-9 col-sm-12">
															<div class="input-group">
																<video id="video_upload_preview" width="320" height="240" controls>
																	<source src="{{ @$webSettings->video_names }}" type="video/mp4">
																</video>
															</div>
														</div>
													</div> --}}
													<div class="form-group m-form__group row">
														{!! Form::label(trans('setting.image').'', null,array('class'=>'col-form-label col-lg-3 col-sm-12')) !!}
														<div class="col-lg-6 col-md-9 col-sm-12">
															<div class="input-group">
																{!! Form::file('web_logos', array('class'=>'custom-file-input' ,'id'=>'image', 'accept' => 'image/png,image/jpeg')) !!}
																{!! Form::label('Choose file', null,array('class'=>'custom-file-label')) !!}
																<input type="hidden" name="stored_img_name" value="{{isset($webSettings)?$webSettings->logo:''}}">
															</div>
															@error('web_logos') <p class="errors">{{$errors->first('web_logos')}}</p> @enderror
															<span class="m-form__help">@lang('setting.image_msg')</span>
														</div>
													</div>
													<div class="form-group m-form__group row image-block"  style="display:{{ isset($webSettings->logo)  ? 'flex':'none'}} ">
														{!! Form::label('', null,array('class'=>'col-form-label col-lg-3 col-sm-12')) !!}
														<div class="col-lg-6 col-md-9 col-sm-12">
															<div class="input-group">
																<img id="image_upload_preview" src="{{ @$webSettings->image_names }}" height="60" width="100"/>
															</div>
														</div>
													</div>
													<div class="m-portlet__foot m-portlet__foot--fit">
														<div class="m-form__actions m-form__actions">
															<br>
															<div class="row">
																<div class="col-lg-9 ml-lg-auto">
																		{!! Form::submit(trans('formname.submit'), ['class' => 'btn btn-success'] ) !!}
																</div>
															</div>
														</div>
													</div>
												</div>
												{!! Form::close() !!}
											</div>
										</div>
										<div class="tab-pane " id="social_tab" role="tabpanel">
											<div class="m-form__section m-form__section--first">
												@if(isset($setting) || !empty($setting))
												{{ Form::model($setting, [ 'enctype'=>'multipart/form-data','route' => ['social_setting_store', $setting->id], 'method' => 'PUT','id'=>'general_form_2','class'=>'m-form m-form--fit m-form--label-align-right']) }}
												@else
												{{ Form::open(['enctype'=>'multipart/form-data','route' => 'social_setting_store','method'=>'POST','class'=>'m-form m-form--fit m-form--label-align-right','id'=>'general_form_2']) }}
												@endif
												<div class="m-portlet__body">
													{!! Form::hidden('id',(isset($webSettings) ? @$webSettings->id : '') ,['id'=>'id']) !!}
													@csrf
													<div class="form-group m-form__group row">
														{!! Form::label(trans('setting.facebook') .'*', null,array('class'=>'col-form-label col-lg-3 col-sm-12'))!!}
														<div class="col-lg-6 col-md-9 col-sm-12">
															{!! Form::text('facebook_url',@$webSettings->facebook_url ,array('class'=>'form-control m-input','maxlength'=>config('constant.text_length'))) !!}
															@error('facebook_url') <p class="errors">{{$errors->first('facebook_url')}}</p> @enderror
														</div>
													</div>
													<div class="form-group m-form__group row">
															{!! Form::label(trans('setting.twitter') .'*', null,array('class'=>'col-form-label col-lg-3 col-sm-12'))!!}
														<div class="col-lg-6 col-md-9 col-sm-12">
															{!! Form::text('twitter_url',@$webSettings->twitter_url,['class'=>'form-control m-input', 'maxlength'=>config('constant.text_length')]) !!}
															@error('twitter_url') <p class="errors">{{$errors->first('twitter_url')}}</p> @enderror
														</div>
													</div>
													<div class="form-group m-form__group row">
														{!! Form::label(trans('setting.youtube') .'*', null,array('class'=>'col-form-label col-lg-3 col-sm-12'))!!}
														<div class="col-lg-6 col-md-9 col-sm-12">
															{!! Form::text('youtube_url',@$webSettings->youtube_url,['class'=>'form-control m-input', 'maxlength'=>config('constant.text_length')]) !!}
															@error('youtube_url') <p class="errors">{{$errors->first('youtube_url')}}</p> @enderror
														</div>
													</div>
												</div>
												<div class="m-portlet__foot m-portlet__foot--fit">
													<div class="m-form__actions m-form__actions">
														<br>
														<div class="row">
															<div class="col-lg-9 ml-lg-auto">
																	{!! Form::submit(trans('formname.submit'), ['class' => 'btn btn-success'] ) !!}
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
				</div>
			</div>
		</div>
	</div>
</div>
@stop
@section('inc_script')
<script>
	var rule = $.extend({}, {!!json_encode(config('constant'), JSON_FORCE_OBJECT) !!});
	$(document).find('.cd-stts').on('click',function(){
		if($(this).attr('data-status') == 1) {
			$(this).find("i").removeClass('fas fa-toggle-on');
			$(this).find("i").addClass('fas fa-toggle-off');
			$(this).attr('data-status',0);
			$(this).find("input").val(0);
		} else {
			$(this).find("i").removeClass('fas fa-toggle-off');
			$(this).find("i").addClass('fas fa-toggle-on');
			$(this).attr('data-status',1);
			$(this).find("input").val(1);
		}
	});
</script>
<script src="{{ asset('backend/js/websetting/create.js') }}" type="text/javascript"></script>
@stop