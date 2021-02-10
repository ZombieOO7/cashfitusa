@extends('frontend.layouts.default')
@section('content')
@section('title', 'Do Not Sell My Information')
<link rel="stylesheet" href="{{asset('/frontend/css/newstyle.css')}}">

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

        	<div class="row uploadimgrow">
        		<div class="col-lg-6 col-sm-6 col-12 uploadcol">
        			<div class="uploadbox">
        				 <div class="uploadimg">
        				 	<img src="{{asset('frontend/img/about/uploadimg.png')}}" alt="uploadimg">
        				 </div>
        				 <h6 class="uploadtitle">Upload Identity Card(FRONT)</h6>
        				 <div class="uploadbtn">
        				 	<button class="btn blue-btn">Browse</button>
        				 	<button class="btn green-btn">Upload</button>
        				 	
        				 </div>
        			</div>
        		</div>
        		<div class="col-lg-6 col-md-6 col-sm-6 col-12 uploadcol">
        			<div class="uploadbox">
        				 <div class="uploadimg">
        				 	<img src="{{asset('frontend/img/about/uploadimg2.png')}}" alt="uploadimg">
        				 </div>
        				 <h6 class="uploadtitle">Upload Identity Card(FRONT)</h6>
        				 <div class="uploadbtn">
        				 	<button class="btn blue-btn">Browse</button>
        				 	<button class="btn green-btn">Upload</button>
        				 	
        				 </div>
        			</div>
        		</div>
        		<div class="col-lg-6 col-md-6 col-sm-6 col-12 uploadcol">
        			<div class="uploadbox">
        				 <div class="uploadimg">
        				 	<img src="{{asset('frontend/img/about/uploadimg3.png')}}" alt="uploadimg">
        				 </div>
        				 <h6 class="uploadtitle">Upload Identity Card(FRONT)</h6>
        				 <div class="uploadbtn">
        				 	<button class="btn blue-btn">Browse</button>
        				 	<button class="btn green-btn">Upload</button>
        				 	
        				 </div>
        			</div>
        		</div>
        		<div class="col-lg-6 col-md-6 col-sm-6 col-12 uploadcol">
        			<div class="uploadbox">
        				 <div class="uploadimg">
        				 	<img src="{{asset('frontend/img/about/uploadimg4.png')}}" alt="uploadimg">
        				 </div>
        				 <h6 class="uploadtitle">Upload Identity Card(FRONT)</h6>
        				 <div class="uploadbtn">
        				 	<button class="btn blue-btn">Browse</button>
        				 	<button class="btn green-btn">Upload</button>
        				 	
        				 </div>
        			</div>
        		</div>
        	</div>

        </div>
</div>
@endsection