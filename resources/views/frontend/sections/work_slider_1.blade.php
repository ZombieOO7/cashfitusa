<link rel="stylesheet" href="{{asset('frontend/css/custom.css')}}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
    </ol>
    <div class="carousel-inner">
        <div class="item active">
            <div class="slider-area slider-height" data-background="assets/img/hero/h1_hero.jpg">
                <div class="slider-active">
                    <!-- Single Slider -->
                    <div class="single-slider">
                        <div class="slider-cap-wrapper">
                            <div class="hero__caption">
                                {{-- <p data-animation="fadeInLeft" data-delay=".2s">Achieve your financial goal</p> --}}
                                <h2 data-animation="fadeInLeft" data-delay=".5s">Working from the comfort of your couch and being financially independent is the new normal.</h2>
                                <h2 data-animation="fadeInLeft" data-delay=".5s">RapidCashAmerica offers freedom and flexibility to its users for working remotely eliminating the global boundaries.</h2>
                                <!-- Hero Btn -->
                                <a href="{{route('earning')}}" class="btn hero-btn" data-animation="fadeInLeft" data-delay=".8s">Start Now</a>
                            </div>
                            <div class="hero__img">
                                <img src="{{asset('frontend/img/hero_img2.jpg')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>            
            </div>
        </div>
        <div class="item">
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
                                    <h2><strong>You are Our Biggest Asset. And We are Here to Pay You for Exactly That.</strong>
                                    <br>Being in the financial industry has shown us that people are the biggest assets. Even if you don’t make an investment or commit your time to our operations, we would still like you to be a part of our earning family. We are on a mission to make earing an easy task for everyone in the world. And that begins with making earning easy for you – without making you leave your job, your room or even your PC.</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>