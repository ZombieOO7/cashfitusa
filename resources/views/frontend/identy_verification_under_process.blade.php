@extends('frontend.layouts.default')
@section('content')
@section('title', @$title)
<link rel="stylesheet" href="{{asset('/frontend/css/newstyle.css')}}">


<div class="innerpage">
<div class="container">
	<div class="row flex-row-reverse">
		<div class="col-lg-6 col-md-6 col-12 mb-3">
             <div class="verifi-img">
                 <img src="{{asset('frontend/img/idenverifiunderimg2.png')}}" alt="contactimg">
             </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
        	<div class="cmsCon seccmsCon">
        		<h3>Identity Verification</h3>
        		<h4><b>Under Process</b></h4>
        		<div class="clearfix"></div>
        		<p>The documents you <b>HAVE</b> submitted are under process of verification.<b>THIS PROCESS IS FOR VERIFYING</b> whether a real person is using the account and living on the same address provided to Us.</p>
        		<p>In order to verify the documents provided by user we have to undergo many verification steps hence the process sometimes may get time consuming.</p>
        	</div>
        </div>
	</div>
</div>
</div>

	<!-- start testinomial section -->
    @include('frontend.sections.testinomial') 
    <!-- end of testinomial process section -->



{{-- content start from here--}}
{{-- content end here --}}
@endsection
