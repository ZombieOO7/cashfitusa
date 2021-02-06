@php
$setting = setting();
if($setting){
    $percentage = ($setting->percentage)?$setting->percentage:config('constant.default_pr');
}else{
    $percentage = config('constant.default_pr');
}
@endphp
<div class="application-area pt-150 pb-140" data-background="{{asset('frontend/img/section_bg03.jpg')}}" style='background-image: url({{asset('frontend/img/section_bg03.jpg')}});'>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-xl-6 col-md-12">
                <!-- Section Tittle -->
                <div class="section-tittle section-tittle2 text-center mb-45">
                    {{-- <h3 class="text-white">Apply in just few Steps</h3> --}}
                    {{-- <h2>Easy Application Process For Any Types of Loan</h2> --}}
                    <h2>Apply in Just a Few Simple Steps</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-9 col-xl-8">
                <!--Hero form -->
                {{ Form::open(['route' => 'apply-loan','method'=>'post','class'=>'search-box','id'=>'m_form_2']) }}
                    <div class="input-form">
                        <input type="text" placeholder="Initial Amount" name="loan_amount">
                    </div>
                    <div class="select-form">
                        <div class="select-itms">
                            <select name='months' class="nice-select form-control">
                                <option value=''>Tenure</option>
                                <option value="12">12 Months[1 Year]</option>
                                <option value="24">24 Months[2 Year]</option>
                                <option value="36">36 Months[3 Year]</option>
                                <option value="48">48 Months[4 Year]</option>
                                <option value="60">60 Months[5 Year]</option>
                            </select>
                        </div>
                    </div>
                    <div class="input-form">
                        <input type="text" placeholder="Monthly Instalments" name="repayment_amount" readonly>
                    </div>
                    <div class="search-form">
                        {{-- {{Form::button('Quick Calculate',['id'=>'calculateBtn'])}} --}}
                        <a href="javascript:;" onclick="calculate()">Calculate</a>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<script>
    var pr = parseInt('{{$percentage}}');
</script>
