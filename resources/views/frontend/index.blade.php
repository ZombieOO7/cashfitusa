@extends('frontend.layouts.default')
@php
$setting = setting();
if($setting){
    $percentage = ($setting->percentage)?$setting->percentage:config('constant.default_pr');
}else{
    $percentage = config('constant.default_pr');
}
@endphp
@section('content')
@section('title', 'Loan')
<div class="loanpagemain">
    <!-- apply_for_loan_start -->
    @include('frontend.sections.apply_loan')
    <!-- apply_for_loan_end  -->
    
    <!-- why_choose_us_start -->
    @include('frontend.sections.why_choose_us')
    <!-- why_choose_us_end -->

    <!-- Calculate Area Start -->
    @include('frontend.sections.calculate')
    <!-- Calculate Area End -->

    <!-- start loan process section -->
    @include('frontend.sections.loan')
    <!-- end of loan process section -->

    <!-- start help section -->
    @include('frontend.sections.help')
    <!-- end of help section -->
    
    <!-- start how it work section -->
    @include('frontend.sections.work')
    <!-- end of how it work section -->

    <!-- start testinomial section -->
    {{-- @include('frontend.sections.testinomial') --}} 
    <!-- end of testinomial process section -->

    <div class="partnersmain section-padding">
        <div class="container">
            <div class="section_title text-center mb-40">
                    <h3 class="wow fadeInUp">Our Partners</h3>
                </div>

                <div class="verificationmain">
                    <div class="section_title mb-40">
                        <h5 class="wow fadeInUp">Our Verification & Funding Partners</h5>
                    </div>

                    <ul>
                        <li><img src="{{asset('frontend/img/partnersimg1.jpg')}}" alt="" /></li>
                        <li><img src="{{asset('frontend/img/partnersimg2.jpg')}}" alt="" /></li>
                        <li><img src="{{asset('frontend/img/partnersimg3.jpg')}}" alt="" /></li>
                        <li><img src="{{asset('frontend/img/partnersimg4.jpg')}}" alt="" /></li>
                        <li><img src="{{asset('frontend/img/partnersimg5.jpg')}}" alt="" /></li>
                    </ul>
                </div>

                <div class="bankingpartmain">
                    <div class="section_title mb-40">
                        <h5 class="wow fadeInUp">Our Banking Partners</h5>
                    </div>

                    <ul>
                        <li><img src="{{asset('frontend/img/verificationimg1.jpg')}}" alt="" /></li>
                        <li><img src="{{asset('frontend/img/verificationimg2.jpg')}}" alt="" /></li>
                        <li><img src="{{asset('frontend/img/verificationimg3.jpg')}}" alt="" /></li>
                        <li><img src="{{asset('frontend/img/verificationimg4.jpg')}}" alt="" /></li>
                        <li><img src="{{asset('frontend/img/verificationimg5.jpg')}}" alt="" /></li>
                        <li><img src="{{asset('frontend/img/verificationimg6.jpg')}}" alt="" /></li>
                    </ul>
                </div>
        </div>
    </div>

</div>
@endsection
