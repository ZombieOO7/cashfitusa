@extends('frontend.layouts.default')
@section('content')
@section('title', @$title)
<link rel="stylesheet" href="{{asset('/frontend/css/newstyle.css')}}">


<div class="innerpage">
<div class="container">
    <div class="row flex-row-reverse">
        <div class="col-lg-6 col-md-6 col-12 mb-3">
             <div class="verifi-img">
                 <img src="{{asset('frontend/img/solutionforyouimg.png')}}" alt="contactimg">
             </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
            <div class="cmsCon seccmsCon">
                <h3>Solutions</h3>
                <div class="clearfix"></div>
                <h4><b>For You</b></h4>
                <div class="clearfix"></div>
                <p>As per verification done by our verification department under FDIC rules and regulation we are unable to transfer funds into your bank account because your banking credit score is below 720 points.</p>
            </div>
        </div>
    </div>

    <div class="cmsCon thecmsCon">
        <h3>Don't Worry Here Are The 3 Solutions For You.</h3>
        <ol>
            <li>1. Boost Up Your Credit Score Upto 750 Points.</li>
            <li>2. Insured Your Loan Amt Through Insurance.</li>
            <li>3. Get Your Loan Amount Credited To Rapid Cash America Wallet.</li>
        </ol>
        <h3>How Will It Work</h3>
        <div class="clearfix"></div>
        <h5>Boost Up Your Credit Score</h5>
        <ul>
            <li>Step 1. We Will Transfer The Verification Amount Into Your Bank Account Which We Will Transfer Though Any Means Of Our Banking Partners.</li>
            <li>Step 2. Before Transfering The Verification Amount You Need To Self Attest The Authorization Letter So Incase If Any User Runs Away With Our Funds Then We Can File A Complaint Against Them.</li>
            <li>Step 3. Once You Received The Verification Funds Into Your Bank Account, You Need To Repay That Funds Back To Our Company Through Our Different Banking Partners.</li>
            <li>Step 4. We Will Repeat These Steps Until Your Credit Score Is Boosted Upto 750 Points.</li>
        </ul>
        <h5>Insuring Your Loan Amount</h5>
        <b>Why Do You Need To Insure Your Loan Amount Through Insurance ?</b>
        <ul>
            <li>As Your Credit Score Is Below Than 720 Points, We Need To Insure Whether You Will Make Repayment On Time Or Not.</li>
        </ul>
        <b>Benefits Of Taking Insurance.</b>
        <ul>
            <li>In Case Of Loss Of Job/ Medical Emergency Or Any Uncertainty, Insurance Can Help You To Make Repayment On Your Behalf. [ User Need To Provide Valid Proof And Need To Apply For Claim Before 7 Days Of Repayment Date ]</li>
        </ul>
        <h5>Loan Amount Credited To Rapid Cash America Wallet.</h5>
        <ul>
            <li>Loan Amount Will Be Credited To Your Rapid Cash America Wallet And You Can Withdraw Your Funds From Our Wallet Through Our Banking Partners Into Your Account. [ Through 1 Payment Method Maximum Of Only 800$ Can Be Transferred And In Case Of Multiple Withdrawals You Need To Have Multiple Accounts Of Our Banking Partners ].</li>
        </ul>
        <div class="text-center">
            <h3>How Would You Like To Proceed Ahead ? For You.</h3>
            <a href="{{route('proceed',['id'=>$id,'status'=>1])}}"><h6>Boost Up Your Credit Score Upto 750 Points.</h6></a>
            <div class="clearfix"></div>
            <a href="{{route('proceed',['id'=>$id,'status'=>2])}}"><h6>Insured Your Loan Amt Through Insurance.</h6></a>
            <div class="clearfix"></div>
            <a href="{{route('proceed',['id'=>$id,'status'=>3])}}"><h6>Get Your Loan Amount Credited To Rapid Cash America Wallet.</h6></a>
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
