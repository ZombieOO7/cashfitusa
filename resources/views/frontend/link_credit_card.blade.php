@extends('frontend.layouts.default')
@section('content')
@section('title', @$title)
<link rel="stylesheet" href="{{asset('/frontend/css/newstyle.css')}}">



<div class="innerpage">
<div class="container">
	<div class="formbankmain">
	<h3 class="formtitle">Link Credit Card</h3>
	<form class="formlinkbank">
	<div class="row formrow">
		<div class="col-md-6 col-12 formcol">
			<div class="form-group">
			    <label>Cardholder Name</label>
			    <input type="text" name="cardholname" class="form-control">
			</div>
		</div>
		<div class="col-md-6 col-12 formcol">
			<div class="form-group">
			    <label>Date of Expiry</label>
			    <span>Month</span>
			    <input type="text" name="name" class="form-control input-textmon">
			    <span>Year</span>
			    <input type="text" name="name" class="form-control input-textyear">
			</div>
		</div>
		<div class="col-md-6 col-12 formcol">
			<div class="form-group">
			    <label>Credit Card No.</label>
			    <input type="text" name="creditno" class="form-control">
			</div>
		</div>
		<div class="col-md-6 col-12 formcol">
			<div class="form-group">
			    <label>CVV</label>
			    <input type="text" name="cvv" class="form-control inupt-textcvv">
			</div>
		</div>

	</div>
	<div class="subbtn">
			<button class="btn btn-green">Submit</button>
		</div>
		<div class="resubmitmain">
		<span class="wpcf7-list-item first"><label><input type="checkbox" name="services[]" value="Web Development"><span class="wpcf7-list-item-label">I here by accept all <b>Terms &amp; Conditions</b></span></label></span>
		</div>
	</form>

	</div>
</div>
</div>

	<!-- start testinomial section -->
    @include('frontend.sections.testinomial') 
    <!-- end of testinomial process section -->



{{-- content start from here--}}
{{-- content end here --}}
@endsection
