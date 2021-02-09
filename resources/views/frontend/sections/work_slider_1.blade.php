@section('front_css')
<link rel="stylesheet" href="{{asset('/frontend/css/newstyle.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/custom.css')}}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endsection
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
    </ol>

<div class="carousel-inner">
                <div class="slider_area item active">
                    <div class="single_slider d-flex align-items-center rem_slider_bg_1">
                        <div class="container">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-lg-7 col-md-6">
                                    <div class="slider_text">
                                        <h3 class="wow fadeInRight" data-wow-duration="1s" data-wow-delay=".1s">Working from the comfort of your couch and being financially independent is the new normal.</h3>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-6">
                                    <div class="payment_form white-bg wow fadeInDown" data-wow-duration="1.2s" data-wow-delay=".2s">
                                        <div class="info text-center">
                                            <h4>Start Remote Working TODAY!!</h4>
                                            {{-- <p>Get instant approved loans straight into your bank account.</p> --}}
                                        </div>
                                        
                                        {{-- <p>You have to pay: <span>$0</span></p> --}}
                                        <div class="submit_btn">
                                            <a href="{{route('earning')}}" class= 'boxed-btn3'>{{__('formname.loan.submit')}}</a>
                                            {{-- <button class="boxed-btn3" type="submit">Start Now</button> --}}
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slider_area item">
                    <div class="single_slider d-flex align-items-center rem_slider_bg_2">
                        <div class="container">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-lg-7 col-md-6">
                                    <div class="slider_text">
                                        <h3 class="wow fadeInRight" data-wow-duration="1s" data-wow-delay=".1s">RapidCashAmerica offers freedom and flexibility to its users for working remotely eliminating the global boundaries. </h3>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-6">
                                    <div class="payment_form white-bg wow fadeInDown" data-wow-duration="1.2s" data-wow-delay=".2s">
                                        <div class="info text-center">
                                            <h4>Start Remote Working TODAY!!</h4>
                                            {{-- <p>Get instant approved loans straight into your bank account.</p> --}}
                                        </div>
                                        
                                        {{-- <p>You have to pay: <span>$0</span></p> --}}
                                        <div class="submit_btn">
                                            <a href="{{route('earning')}}" class= 'boxed-btn3'>{{__('formname.loan.submit')}}</a>
                                            {{-- <button class="boxed-btn3" type="submit">Start Now</button> --}}
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" ></li>
        <li data-target="#myCarousel" data-slide-to="1" class="active"></li>
    </ol>

    <div class="carousel-inner">
        <!-- <div class="item active">
            <div class="slider-area slider-height" data-background="assets/img/hero/h1_hero.jpg">
                <div class="slider-active">
                    
                    <div class="single-slider">
                        <div class="slider-cap-wrapper">
                            <div class="hero__caption">
                                {{-- <p data-animation="fadeInLeft" data-delay=".2s">Achieve your financial goal</p> --}}
                                <h2 data-animation="fadeInLeft" data-delay=".5s">Working from the comfort of your couch and being financially independent is the new normal.</h2>
                                <h2 data-animation="fadeInLeft" data-delay=".5s">RapidCashAmerica offers freedom and flexibility to its users for working remotely eliminating the global boundaries.</h2>
                                
                                
                            </div>
                            <div class="hero__img">
                                <img src="{{asset('frontend/img/hero_img2.jpg')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>            
            </div>
        </div> -->
        <div class="item active">
            <div class="about-low-area section-padding2">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <!-- about-img -->
                            <div class="about-img ">
                                <div class="about-font-img d-none d-lg-block">
                                    <img src="{{asset('frontend/img/about2.png')}}" alt="">
                                </div>
                                <div class="about-back-img ">
                                    <img src="{{asset('frontend/img/hero_img.jpg')}}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="about-caption mb-50">
                                <div class="work-section-tittle mb-30">
                                    <h2 class="remslidtitle">You are Our Biggest Asset. And We are Here to Pay You for Exactly That.</h2>
                                    <p>Being in the financial industry has shown us that people are the biggest assets. Even if you don’t make an investment or commit your time to our operations, we would still like you to be a part of our earning family. We are on a mission to make earing an easy task for everyone in the world. And that begins with making earning easy for you – without making you leave your job, your room or even your PC.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
