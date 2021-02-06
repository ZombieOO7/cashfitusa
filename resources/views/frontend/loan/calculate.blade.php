@extends('frontend.layouts.default')
@section('content')
@section('title', 'Calculate')
    <!-- start loan_step section -->
    @include('frontend.sections.calculate_table')
    <!-- end of loan_step section -->

    <!-- start help section -->
    @include('frontend.sections.help')
    <!-- end of help section -->
    

    <!-- start how it work section -->
    @include('frontend.sections.work')
    <!-- end of how it work section -->

@endsection