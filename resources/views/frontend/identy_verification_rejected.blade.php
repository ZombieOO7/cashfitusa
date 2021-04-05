@extends('frontend.layouts.default')
@section('content')
@section('title', @$title)
<link rel="stylesheet" href="{{asset('/frontend/css/newstyle.css')}}">


<div class="innerpage">
<div class="container">
	<div class="row flex-row-reverse">
		<div class="col-lg-6 col-md-6 col-12 mb-3">
             <div class="verifi-img">
                 <img src="{{asset('frontend/img/idenverifirejimg.png')}}" alt="contactimg">
             </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
        	<div class="cmsCon seccmsCon">
        		<h3>Identity Verification</h3>
        		<h4><b>Rejected</b></h4>
        		<div class="clearfix"></div>
        		<p>The documents submitted by you for the verification of the process has been rejected.During the verification of the procedure our Rapid Cash America’s Verification Team found out that there is something missing / Invalid in the documents you have submitted.</p>
        		<p>In order to apply for loan, we advice you to re-submit the <b>VALID & CLEAR</b> documents in order to avoid rejection.</p>
        	</div>
        	<div class="resubmitmain">
        		<h4 class="resuntitle">Re-submit</h4>
        		<span class="wpcf7-list-item first"><label><input type="checkbox" name="services[]" value="Web Development"><span class="wpcf7-list-item-label">I here by accept all <b>Terms & Conditions</b></span></label></span>
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
