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
        		<h4><b>Rejected</b></h4>
        		<div class="clearfix"></div>
        		<p>The Bank Details submitted by you for the verification of the process has been rejected.During the verification of the procedure our Rapid Cash America’s Verification Team found out that there is something missing / Invalid in the Bank Details you have submitted.</p>
        	</div>
        	<div class="resubmitmain">
        		<a href="{{route('link.bank',['id'=>$id])}}"><h4 class="resuntitle">Re-Submit</h4></a>
        		<form id='myForm1'>
					<span class="wpcf7-list-item first">
						<label>
							<input type="checkbox" name="term_and_condition" >
							<span class="wpcf7-list-item-label">I here by accept all <b>Terms & Conditions</b></span>
						</label>
					</span>
					<span class="tnc"></span>
				</form>
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