@extends('frontend.layouts.default')
@section('title','Remote Working')
@section('content')
<div class="loanpagemain">
    <!-- slider Area Start-->
    @include('frontend.sections.work_slider_1')
    <!-- slider Area End-->    

    <!-- About Law Start-->
    @include('frontend.sections.work_slider_2')
    <!-- About Law End-->

    <!-- start help section -->
    @include('frontend.sections.work_from_home_help')
    <!-- end of help section -->

    <!-- start loan_step section -->
    {{--  @include('frontend.sections.loan_steps') --}}
    <!-- end of loan_step section -->

    <!-- why_choose_us_start -->
    {{-- @include('frontend.sections.why_choose_us') --}}
    <!-- why_choose_us_end -->

    <section class="loan-process-section section-padding"  style="background-color:#fff;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section_title text-center mb-20">
                    <h3 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">Why Choose Us</h3>
                    <span class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s" style="background: #000 !important;"></span>
                </div>
            </div>
        </div>

        <div class="row process-list">
            <div class="col-lg-4 col-md-6 col-sm-6 col-12 process text-center">
                <div class="single-process">
                    <div class="proces-icon" style="border-radius: 10px;">
                        {{-- <span class="pe-7s-note"></span> --}}
                        <img src="{{asset('frontend/img/about/charges.png')}}" alt="">
                    </div>
                    <div class="content pl-1">
                        <h4 class="process-title">Simplified Earning Opportunity Tailored for You</h4>
                        <p>You don’t have to move from your job, desk or home. As far as you have little time, and you don’t even have to commit that for some, you can get a parallel earning stream with your job. If you have just been laid off, are a homemaker or a single mom or are in just need of some cash – this is the opportunity you have been looking for.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12 process text-center">
                <div class="single-process">
                    <div class="proces-icon" style="border-radius: 10px;">
                        {{-- <span class="pe-7s-id"></span> --}}
                        <img src="{{asset('frontend/img/about/paper.png')}}" alt="">
                    </div>
                    <div class="content">
                        <h4 class="process-title">Backed by a Financial Institution</h4>
                        <p>We make profits only if we are doing this for the long run. Hence, we will be here tomorrow and the days after it to help you find the right earning opportunity. Since we are in the lending business, we have to be very diligent about what we bring to you. This helps us stay focused and helps you get only the best earning opportunities.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12 process text-center">
                <div class="single-process">
                    <div class="proces-icon" style="border-radius: 10px;">
                        {{-- <span class="pe-7s-check"></span> --}}
                        <img src="{{asset('frontend/img/about/easy_approval.png')}}" alt="">
                    </div>
                    <div class="content">
                        <h4 class="process-title">Pay Nothing, Not Even Your Time Commitments</h4>
                        <p> You don’t have to sell products, hire distributors, or do anything that will be taxing on your health. We wouldn’t ask you to make any investments or commitments of time or resources. Just log into your dashboard and get directed to the most relevant earning opportunities.</p>
                    </div>
                </div>
            </div>
          
        </div>

    </div>
</section>

    <!-- start help section -->
    {{-- @include('frontend.sections.help') --}}
    <!-- end of help section -->

    <section class="loan-process-section loan-pro-sec here-help section-padding"  style="background-color:#fff;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section_title text-center mb-40">
                    <h3 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">Need Help? We are Here.</h3>
                    <span class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s" style="background: #000 !important;"></span>
                </div>
            </div>
        </div>

                <div class="row process-list">
                    <div class="left-col">
            <div class="col-lg-8 col-md-10 col-sm-12 col-12 process text-center">
                <div class="single-process">
                    <div class="proces-icon" style="border-radius: 10px;">
                        {{-- <span class="pe-7s-note"></span> --}}
                        <img src="{{asset('frontend/img/about/clockicon.png')}}" alt="">
                    </div>
                    <div class="content pl-1">
                        <h4 class="process-title">Always Available Customer Success Team</h4>
                        <p> Our business is dependent on your success. Hence, our team is always available to help you get your queries resolved via email, phone or video calling if necessary.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="right-col">
            <div class="col-lg-8 col-md-10 col-sm-12 col-12 process text-center">
                <div class="single-process">
                    <div class="proces-icon" style="border-radius: 10px;">
                        {{-- <span class="pe-7s-id"></span> --}}
                        <img src="{{asset('frontend/img/about/hereicon2.png')}}" alt="">
                    </div>
                    <div class="content">
                        <h4 class="process-title">Easy Money Transfer, No Prepayments</h4>
                        <p>You don’t pay us and you don’t work for us. We work with you to help you achieve financial freedom. Nothing gets in the way of our partnership. All the amount due to you for your work gets directly transferred into your bank account.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="center-col">
            <div class="col-lg-4 col-md-10 col-sm-8 col-12 process text-center">
                <div class="single-process">
                    <div class="proces-icon" style="border-radius: 10px;">
                        {{-- <span class="pe-7s-check"></span> --}}
                        <img src="{{asset('frontend/img/about/hereicon3.png')}}" alt="">
                    </div>
                    <div class="content">
                        <h4 class="process-title">No Limits On Earning</h4>
                        <p>You can practically earn as much as you want. As far as you adhere to our policies and are a part of our network, we will ensure that our work sourcing capabilities are in line with your ability to earn.</p>
                    </div>
                </div>
            </div>
        </div>

        </div>


    </div>
</section>



    <!-- why_choose_us_start -->
    <!-- @include('frontend.sections.work_from_home_why_choose_us') -->
    <!-- why_choose_us_end -->


    <!-- start how it work section -->
    @include('frontend.sections.work_2')
    <!-- end of how it work section -->

<!-- start testinomial section -->
@include('frontend.sections.testinomial')
<!-- en d of testinomial process section -->
</div>
@section('front_script')
<script src="https://unpkg.com/aksvideoplayer@1.0.0/dist/aksVideoPlayer.min.js"></script>
@endsection
@endsection