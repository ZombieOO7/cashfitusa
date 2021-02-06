@section('front_script')
<link rel="stylesheet" href="{{asset('frontend/css/custom.css')}}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endsection
    <!-- apply_for_loan_start -->
    <div class="">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
            </ol>

            <div class="carousel-inner">
                <div class="slider_area item active">
                    <div class="single_slider d-flex align-items-center slider_bg_1">
                        <div class="container">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-lg-7 col-md-6">
                                    <div class="slider_text">
                                        <h3 class="wow fadeInRight" data-wow-duration="1s" data-wow-delay=".1s">Looking For Short-Term Loans of Higher Amounts?</h3>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-6">
                                    <div class="payment_form white-bg wow fadeInDown" data-wow-duration="1.2s" data-wow-delay=".2s">
                                        <div class="info text-center">
                                            <h4>Get instant approved loans straight into your bank account.</h4>
                                            {{-- <p>Get instant approved loans straight into your bank account.</p> --}}
                                        </div>
                                        @include('admin.includes.flashMessages')
                                        {{ Form::open(['route' => 'apply-loan','method'=>'post','class'=>'','id'=>'m_form_1']) }}
                                        @csrf
                                        <div class="form">
                                            <div class="row">
                                                <div class="col-lg-12 mb-3">
                                                    <div class="single_input">
                                                        {!! Form::text('amount',null,['class'=>"form-control",'maxlength'=>config('constant.amount_length'),'placeholder'=>'Enter The Amount']) !!}
                                                    </div>
                                                    @if ($errors->has('amount'))
                                                    <p style="color:red;">{{ $errors->first('amount') }}</p> 
                                                    @endif
                                                </div>
                                                {{-- <div class="col-lg-12 mb-3">
                                                    <div class="single_input">
                                                        <select name='year' class="form-control">
                                                            <option value=''>Select Months</option>
                                                            <option value="1">12 Months[1 Year]</option>
                                                            <option value="2">24 Months[2 Year]</option>
                                                            <option value="3">36 Months[3 Year]</option>
                                                            <option value="4">48 Months[4 Year]</option>
                                                            <option value="5">60 Months[5 Year]</option>
                                                        </select>
                                                    </div>
                                                    <span class="yearError">
                                                        @if ($errors->has('year')) <p style="color:red;">
                                                            {{ $errors->first('year') }}</p> 
                                                        @endif
                                                    </span>
                                                </div> --}}
                                            </div>
                                        </div>
                                        {{-- <p>You have to pay: <span>$0</span></p> --}}
                                        <div class="submit_btn">
                                            {!! Form::submit(__('formname.loan.submit'), ['class' => 'boxed-btn3'] )!!}
                                            {{-- <button class="boxed-btn3" type="submit">Apply For Loan</button> --}}
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slider_area item">
                    <div class="single_slider d-flex align-items-center slider_bg_2">
                        <div class="container">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-lg-7 col-md-6">
                                    <div class="slider_text">
                                        <h3 class="wow fadeInRight" data-wow-duration="1s" data-wow-delay=".1s"> Get Instant Loans for expanding your business or startup</h3>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-6">
                                    <div class="payment_form white-bg wow fadeInDown" data-wow-duration="1.2s" data-wow-delay=".2s">
                                        <div class="info text-center">
                                            <h4>Get instant approved loans straight into your bank account.</h4>
                                            {{-- <p>Get instant approved loans straight into your bank account.</p> --}}
                                        </div>
                                        @include('admin.includes.flashMessages')
                                        {{ Form::open(['route' => 'apply-loan','method'=>'post','class'=>'','id'=>'m_form_1']) }}
                                        @csrf
                                        <div class="form">
                                            <div class="row">
                                                <div class="col-lg-12 mb-3">
                                                    <div class="single_input">
                                                        {!! Form::text('amount',null,['class'=>"form-control",'maxlength'=>config('constant.amount_length'),'placeholder'=>'Enter The Amount']) !!}
                                                    </div>
                                                    @if ($errors->has('amount'))
                                                    <p style="color:red;">{{ $errors->first('amount') }}</p> 
                                                    @endif
                                                </div>
                                                {{-- <div class="col-lg-12 mb-3">
                                                    <div class="single_input">
                                                        <select name='year' class="form-control">
                                                            <option value=''>Select Months</option>
                                                            <option value="1">12 Months[1 Year]</option>
                                                            <option value="2">24 Months[2 Year]</option>
                                                            <option value="3">36 Months[3 Year]</option>
                                                            <option value="4">48 Months[4 Year]</option>
                                                            <option value="5">60 Months[5 Year]</option>
                                                        </select>
                                                    </div>
                                                    <span class="yearError">
                                                        @if ($errors->has('year')) <p style="color:red;">
                                                            {{ $errors->first('year') }}</p> 
                                                        @endif
                                                    </span>
                                                </div> --}}
                                            </div>
                                        </div>
                                        {{-- <p>You have to pay: <span>$0</span></p> --}}
                                        <div class="submit_btn">
                                            {!! Form::submit(__('formname.loan.submit'), ['class' => 'boxed-btn3'] )!!}
                                            {{-- <button class="boxed-btn3" type="submit">Apply For Loan</button> --}}
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
    </div>
    <!-- apply_for_loan_end -->
    @section('front_script')
    <script>
    var rule = $.extend({}, {!!json_encode(config('constant'), JSON_FORCE_OBJECT) !!});
    </script>
    <script src="{{asset('frontend/js/loan/index.js')}}"></script>
    @endsection