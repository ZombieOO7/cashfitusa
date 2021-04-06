@extends('frontend.layouts.default')
@section('content')
@section('title', @$title)
<link rel="stylesheet" href="{{asset('/frontend/css/newstyle.css')}}">


<div class="innerpage">
<div class="container">
	<div class="row flex-row-reverse">
		<div class="col-lg-6 col-md-6 col-12 mb-3">
             <div class="verifi-img">
                 <img src="{{asset('frontend/img/bankverifiunderimg.png')}}" alt="contactimg">
             </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
        	<div class="cmsCon seccmsCon">
        		<h3>Bank Account Verification</h3>
        		<h4><b>Under Process</b></h4>
        		<div class="clearfix"></div>
        		<p>The Bank details provided by you is under process of verification. Once our Rapid Cash America Verification Team successfully verifies your Bank details you will be notified.</p>
        		<p>This process ensures that the bank details provided by the user is Valid and Legal in all terms.</p>
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
