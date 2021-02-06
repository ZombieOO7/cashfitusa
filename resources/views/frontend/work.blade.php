@extends('frontend.layouts.default')
@section('title','Work From Home')
@section('content')
    <!-- slider Area Start-->
    @include('frontend.sections.work_slider_1')
    <!-- slider Area End-->    

    <!-- About Law Start-->
    @include('frontend.sections.work_slider_2')
    <!-- About Law End-->

    <!-- start loan_step section -->
    @include('frontend.sections.loan_steps')
    <!-- end of loan_step section -->

    <!-- why_choose_us_start -->
    @include('frontend.sections.work_from_home_why_choose_us')
    <!-- why_choose_us_end -->


    <!-- start how it work section -->
    @include('frontend.sections.work_2')
    <!-- end of how it work section -->

    <!-- start help section -->
    @include('frontend.sections.work_from_home_help')
    <!-- end of help section -->

    <!-- start testinomial section -->
    @include('frontend.sections.testinomial')
    <!-- en d of testinomial process section -->
@endsection