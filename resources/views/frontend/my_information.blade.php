@extends('frontend.layouts.default')
@section('content')
@section('front_css')
<link href="{{ asset('backend/dist/default/assets/demo/default/base/style.bundle.css') }}" rel="stylesheet"
    type="text/css" />
@endsection
@section('title', 'Documents')
<div class="container">
        <div class="cmsCon">
        	
        	<h3>Verify Yourself</h3>

        	<div class="row flex-row-reverse align-items-center">
        		<div class="col-lg-5 col-md-6 col-12 mb-3">
        			<div class="con-img conimg">
        				<img src="{{asset('frontend/img/about/cmsconimg.png')}}" alt="cmsconimg">
        			</div>
        		</div>
        		<div class="col-lg-7 col-md-6 col-12 conleft">
        			<p>The Verification shows other Us that you are a “real” person who lives in a “real” house, both of which have verified by <b>RAPIDCASH AMERICA.</b> You will now be know as a trustworthy member,increasing your chances of getting loans.</p>
        			<p>In order to Verify Yourself, upload <b>your Driving License(Front and Back), proof of Address,and your selfie.</b> </p>
        		</div>
        	</div>

        	<h3>Quick Tips for Successful Verification</h3><br>

        	<h5>Identity Card</h5>
        	<div class="con-img identimg">
        		<img src="{{asset('frontend/img/about/identitycardimg.png')}}" alt="identitycardimg">
        	</div>
        	<br>

        	<h5>Selfie</h5>
        	<div class="con-img identimg">
        		<img src="{{asset('frontend/img/about/selfieimg.png')}}" alt="selfieimg">
        	</div>
        	<br>
        	<h3>Upload Documents Here.</h3>
			<form id='m_form_1' method="post" enctype="multipart/form-data" action="{{route('user.document.store')}}">
				@csrf
				<div class="row uploadimgrow">
					<div class="col-lg-6 col-sm-6 col-12 uploadcol">
						<div class="uploadbox">
							<div class="flicenceImg" style="display:{{isset($frontLicence)?'':'none'}};">
								@if($frontLicence)
									@php
										$ext = strtolower(pathinfo(@$frontLicence->image_path, PATHINFO_EXTENSION));
									@endphp
									@if($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg')
										<img id='flicenceImg' src="{{@$frontLicence->image_path}}" alt="uploadimg" style="width: 500px;height: 150px;">
									@else
										<img id="flicenceImg" src="{{asset('images/pdf.jpeg')}}" alt="uploadimg" style="width: 150px;height: 150px;">
									@endif
								@else
									<img id="flicenceImg" src="" alt="uploadimg" style="width: 500px;height: 150px;">
								@endif
									<div class="uploadbtn mt-2">
										<button type="button" class="btn btn-danger removeImg" data-class='flicenceUpldImg' data-this_class='flicenceImg' data-id='frontLicenceId'>Remove</button>
									</div>
							</div>
							<div class="flicenceUpldImg" style="display:{{isset($frontLicence)?'none':''}};">
								<div class="uploadimg">
									<img src="{{asset('frontend/img/about/uploadimg.png')}}" alt="uploadimg">
								</div>
								<h6 class="uploadtitle">Upload Identity Card (Front)</h6>
								<div class="uploadbtn">
									<button type="button" class="btn blue-btn" id='frontLicence'>Browse</button>
									<input type="file" name="front_licence" id='frontLicenceId' data-this_class='flicenceUpldImg' data-class='flicenceImg' class="uploadLoanImg d-none">
								</div>
							</div>
						</div>
						@if ($errors->has('front_licence'))
							<p style="color:red;">
							{{ $errors->first('front_licence') }}</p>
						@endif
						<span class="frontLicenceError"></span>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-12 uploadcol">
						<div class="uploadbox">
							<div class="blicenceImg" style="display:{{isset($backLicence)?'':'none'}};">
								@if(@$backLicence)
									@php
										$ext = strtolower(pathinfo(@$backLicence->image_path, PATHINFO_EXTENSION));
									@endphp
									@if($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg')
										<img id='blicenceImg' src="{{@$backLicence->image_path}}" alt="uploadimg" style="width: 500px;height: 150px;">
									@else
										<img id="blicenceImg" src="{{asset('images/pdf.jpeg')}}" alt="uploadimg" style="width: 150px;height: 150px;">
									@endif
								@else
									<img id="blicenceImg" src="" alt="uploadimg" style="width: 500px;height: 150px;">
								@endif
									<div class="uploadbtn mt-2">
										<button type="button" class="btn btn-danger removeImg" data-class='blicenceUpldImg' data-this_class='blicenceImg' data-id='backLicenceId'>Remove</button>
									</div>
							</div>
							<div class="blicenceUpldImg" style="display:{{isset($backLicence)?'none':''}};">
								<div class="uploadimg">
									<img src="{{asset('frontend/img/about/uploadimg2.png')}}" alt="uploadimg">
								</div>
								<h6 class="uploadtitle">Upload Identity Card (Back)</h6>
								<div class="uploadbtn">
									<button type="button" class="btn blue-btn" id='backLicence'>Browse</button>
									{{-- <button class="btn green-btn">Upload</button> --}}
									<input type="file" name="back_licence" id='backLicenceId' data-this_class='blicenceUpldImg' data-class='blicenceImg' class="uploadLoanImg d-none">
								</div>
							</div>
						</div>
						@if ($errors->has('back_licence'))
							<p style="color:red;">
							{{ $errors->first('back_licence') }}</p>
						@endif
						<span class="backLicence"></span>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-12 uploadcol">
						<div class="uploadbox">
							<div class="addressImg" style="display:{{isset($addressProof)?'':'none'}};">
								@if(@$addressProof)
									@php
										$ext = strtolower(pathinfo(@$addressProof->image_path, PATHINFO_EXTENSION));
									@endphp
									@if($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg')
										<img id='addressImg' src="{{@$addressProof->image_path}}" alt="uploadimg" style="width: 500px;height: 150px;">
									@else
										<img id="addressImg" src="{{asset('images/pdf.jpeg')}}" alt="uploadimg" style="width: 150px;height: 150px;">
									@endif
								@else
									<img id="addressImg" src="" alt="uploadimg" style="width: 500px;height: 150px;">
								@endif
									<div class="uploadbtn mt-2">
										<button type="button" class="btn btn-danger removeImg" data-class='addressUpldImg' data-this_class='addressImg' data-id='addressProofId'>Remove</button>
									</div>
							</div>
							<div class="addressUpldImg" style="display:{{isset($addressProof)?'none':''}};">
								<div class="uploadimg">
									<img src="{{asset('frontend/img/about/uploadimg3.png')}}" alt="uploadimg">
								</div>
								<h6 class="uploadtitle">Upload Proof of Address</h6>
								<div class="uploadbtn">
									<button type="button" class="btn blue-btn" id='addressProof'>Browse</button>
									{{-- <button class="btn green-btn">Upload</button> --}}
									<input type="file" name="address_proof" id='addressProofId' data-this_class='addressUpldImg' data-class='addressImg' class="uploadLoanImg d-none">
								</div>
							</div>
						</div>
						@if ($errors->has('address_proof'))
							<p style="color:red;">
							{{ $errors->first('address_proof') }}</p>
						@endif
						<span class="addressProof"></span>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-12 uploadcol">
						<div class="uploadbox">
							<div class="selfieImg" style="display:{{isset($selfie)?'':'none'}};">
								@if(@$selfie)
									@php
										$ext = strtolower(pathinfo(@$selfie->image_path, PATHINFO_EXTENSION));
									@endphp
									@if($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg')
										<img id='selfieImg' src="{{@$selfie->image_path}}" alt="uploadimg" style="width: 500px;height: 150px;">
									@else
										<img id="selfieImg" src="{{asset('images/pdf.jpeg')}}" alt="uploadimg" style="width: 150px;height: 150px;">
									@endif
								@else
									<img id="selfieImg" src="" alt="uploadimg" style="width: 500px;height: 150px;">
								@endif
									<div class="uploadbtn mt-2">
										<button type="button" class="btn btn-danger removeImg" data-class='selfieUpldImg' data-this_class='selfieImg' data-id='selfieId'>Remove</button>
									</div>
							</div>
							<div class="selfieUpldImg" style="display:{{isset($selfie)?'none':''}};">
								<div class="uploadimg">
									<img src="{{asset('frontend/img/about/uploadimg4.png')}}" alt="uploadimg">
								</div>
								<h6 class="uploadtitle">Upload a Selfie of Yourself</h6>
								<div class="uploadbtn">
									<button type="button" class="btn blue-btn" id='selfieProof'>Browse</button>
									{{-- <button class="btn green-btn">Upload</button> --}}
									<input type="file" name="selfie" id='selfieId' data-this_class='selfieUpldImg' data-class='selfieImg' class="uploadLoanImg d-none">
								</div>
							</div>
						</div>
						@if ($errors->has('selfie'))
							<p style="color:red;">
							{{ $errors->first('selfie') }}</p>
						@endif
						<span class="selfieError"></span>
					</div>
				</div>
				<input type="hidden" name="loan_id" value="{{@$loan_id}}">
				<div class="m-form__group form-group row">
					<div class="col-md-5"></div>
					<div class="m-checkbox-list">
						<label class="m-checkbox">
							<input type="checkbox" name="term_and_condition"> Accept Loan 
							<a href="{{route('terms-of-use')}}">Terms and conditions</a>
							<span></span>
							<span class="tnc"></span>   
						</label>
					</div>
				</div>
				<div class="text-center">
					<button class="col-md-2 rounded-0 btn btn-success bg-green mb-3" type="submit">Continue</a>
					{{-- <a href="" class="col-md-2 rounded-0 btn btn-success bg-green" role="button">Continue</a> --}}
				</div>
			</form>

        </div>
</div>
@php
    $loanId = @$loan_id;
	$user = Auth::guard('web')->user();
	$defaultImg= asset('images/pdf.jpeg');
@endphp
@endsection
@section('front_script')
<script>
    var loanId = '{{$loanId}}';
    var url = "{{route('application')}}";
	var defaultImg = "{{$defaultImg}}";
</script>
<script src="{{ asset('js/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/scripts.bundle.js') }}" type="text/javascript"></script>
{{-- <script src="{{asset('js/dropzone.js')}}"></script> --}}
<script src="{{ asset('frontend/js/loan/document.js')}}"></script>
@endsection
