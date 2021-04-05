@extends('frontend.layouts.default')
@section('content')
@section('title', @$title)
<link rel="stylesheet" href="{{asset('/frontend/css/newstyle.css')}}">



<div class="innerpage">
<div class="container">
	<div class="row flex-row-reverse">
		<div class="col-lg-6 col-md-6 col-12 mb-3">
             <div class="verifi-img">
                 <img src="{{asset('frontend/img/linkbankimg.png')}}" alt="contactimg">
             </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
        	<div class="cmsCon seccmsCon">
        		<h3>Link Your Bank</h3>
        		<div class="clearfix"></div>
        		<p>To get your loan amount the user have to link their bank account with <b>Rapid Cash America</b>. This is a compulsary step to get your loan amount credited in your bank.</p>
        		<p>In order to Link your bank account, Fill the necessary details below. </p>
        	</div>
        </div>
	</div>
	<div class="formbankmain">
		<h3 class="formtitle">Link Bank</h3>
		<form class="formlinkbank">
	<div class="row formrow">
		<div class="col-md-6 col-12 formcol">
			<div class="form-group">
			    <label>Name of Bank</label>
			    <input type="text" name="bankname" class="form-control">
			</div>
		</div>
		<div class="col-md-6 col-12 formcol">
			<div class="form-group">
			    <label>Username</label>
			    <input type="text" name="name" class="form-control">
			</div>
		</div>
		<div class="col-md-6 col-12 formcol">
			<div class="form-group">
			    <label>Bank Account No.</label>
			    <input type="text" name="accnum" class="form-control">
			</div>
		</div>
		<div class="col-md-6 col-12 formcol">
			<div class="form-group">
			    <label>Password</label>
			    <input type="text" name="pass" class="form-control">
			</div>
		</div>
		<div class="col-md-6 col-12 formcol">
			<div class="form-group">
			    <label>Routing No.</label>
			    <input type="text" name="routingno" class="form-control">
			</div>
		</div>
		<div class="col-md-6 col-12 formcol">
			<div class="form-group">
			    <label>Security Questions</label>
			    <input type="text" name="secuques" class="form-control">
			</div>
		</div>
		<div class="col-md-6 col-12 formcol">
			<div class="form-group">
			    <label>Answers</label>
			    <input type="text" name="answer" class="form-control">
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
	<div class="bankcardopc">
		<div class="bankopc">
		<p>Do You Have Debit Card of <b>“Bank Name”</b> Account Number Ending With “xxxxx1234” ?</p>
			<div class="tabs_form">
				<div class="role-list">
                    <div class="pure-checkbox">
                    <input type="radio" id="md_checkbox" name="prepaid" class="filled-in chk-col-red" value="1" checked="">
                    <label class="p0 m0" for="md_checkbox"> <span class="checkbox-text-right">YES</span></label>                            
                    </div>
                </div>
                <div class="role-list">
                	<div class="pure-checkbox">
                        <input type="radio" id="md_default" name="prepaid" class="filled-in chk-col-red" value="1">
                        <label class="p0 m0" for="md_default"> <span class="checkbox-text-right">NO</span></label>                              
                    </div>
                </div>
			</div>
		</div>
		<div class="bankopc">
		<p>Do You Have Credi Card of <b>“Bank Name”</b> Under Your Name ?</p>
			<div class="tabs_form">
				<div class="role-list">
                    <div class="pure-checkbox">
                    <input type="radio" id="md_default1" name="prepaid" class="filled-in chk-col-red" value="1">
                    <label class="p0 m0" for="md_default1"> <span class="checkbox-text-right">YES</span></label>                            
                    </div>
                </div>
                <div class="role-list">
                	<div class="pure-checkbox">
                        <input type="radio" id="md_default2" name="prepaid" class="filled-in chk-col-red" value="1">
                        <label class="p0 m0" for="md_default2"> <span class="checkbox-text-right">NO</span></label>                              
                    </div>
                </div>
			</div>
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
