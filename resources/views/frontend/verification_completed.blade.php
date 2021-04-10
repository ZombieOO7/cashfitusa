@extends('frontend.layouts.default')
@section('content')
@section('title', @$title)
<link rel="stylesheet" href="{{asset('/frontend/css/newstyle.css')}}">

<div class="innerpage">
<div class="container">
	<div class="row flex-row-reverse">
		<div class="col-lg-6 col-md-6 col-12 mb-3">
             <div class="verifi-img">
                 <img src="{{asset('frontend/img/bankverificompimg.png')}}" alt="contactimg">
             </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
        	<div class="cmsCon seccmsCon">
        		<h3>Bank Account Verification</h3>
        		<h4><b>Completed</b></h4>
        		<div class="clearfix"></div>
        		<p>Congratulations! We are Happy to inform you  that our Rapid Cash America Verification Team has successfully verified your Bank Details and soon the Loan amount will be transferred to your Bank Account.</p>
				<p>In order to process ahead with your applicaion please click on button given below.</p>
        	</div>
			<div class="resubmitmain">
				{{-- <a class="continue" href="#"><h4 class="resuntitle">Continue</h4></a> --}}
				{{-- <form id='myForm1'>
					<span class="wpcf7-list-item first">
						<label>
							<input type="checkbox" name="term_and_condition" id='agree'>
							<span class="wpcf7-list-item-label">I here by accept all <b>Terms & Conditions</b></span>
						</label>
					</span>
					<span class="tnc"></span>
				</form> --}}
			</div>
        </div>
	</div>
</div>
</div>
<!-- start testinomial section -->
@include('frontend.sections.testinomial') 
<!-- end of testinomial process section -->
@stop
@section('front_script')
<script>
	$('#myForm1').validate({
		rules:{
            term_and_condition:{
                required: true,
            },
		},
        ignore: [],
		errorPlacement: function (error, element) {
			error.insertAfter('.tnc');
		}
	})
	$(document).on('click','.continue',function(e){
		debugger;
		if($('#myForm1').valid()){
		}else{
			e.preventDefault();
		}
	})
</script>
@endsection