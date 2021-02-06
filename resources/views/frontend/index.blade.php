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
    @include('frontend.sections.testinomial')
    <!-- end of testinomial process section -->
@endsection
