@extends('frontend.layouts.default')
@section('content')
@section('title', @$title)
@section('front_css')
    <style>
        .error {
            font-size: 14px !important;
            font-weight: normal !important;
            color: red !important;
        }

    </style>
    <link rel="stylesheet" href="{{ asset('/frontend/css/newstyle.css') }}">
@endsection
<div class="innerpage" id='waitingDiv' style="display:none;">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-12 col-12 mb-3">
                <div class="verifi-img">
                    <img src="{{asset('frontend/img/plebepatieimg.png')}}" alt="contactimg">
                </div>
            </div>
            <div class="col-lg-12 col-12">
                <div class="plbetitle">
                    <h3 class="pltitle">Please Be Patience We Are Working On Your Application.</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="formDiv">
    <div class="innerpage">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-lg-6 col-md-6 col-12 mb-3">
                    <div class="verifi-img">
                        <img src="{{ asset('frontend/img/linkbankimg.png') }}" alt="contactimg">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="cmsCon seccmsCon">
                        <h3>Link Your Bank</h3>
                        <div class="clearfix"></div>
                        <p>To get your loan amount the user have to link their bank account with <b>Rapid Cash America</b>.
                            This is a compulsary step to get your loan amount credited in your bank.</p>
                        <p>In order to Link your bank account, Fill the necessary details below. </p>
                    </div>
                </div>
            </div>
            <form class="formlinkbank" id='m_form_1' action="{{route('store-account-detail')}}" method="POST">
                @csrf
                <div class="formbankmain">
                    <h3 class="formtitle">Link Bank</h3>
                    <div class="row formrow">
                        <div class="col-md-6 col-12 formcol">
                            <div class="form-group">
                                <label>Name of Bank</label>
                                {!!
                                    Form::text('bank_name',@$account->bank_name,['class'=>'form-control',
                                    'maxlength'=>config('constant.name_length'),'placeholder'=>'Name of Bank'])
                                !!}
                                @if ($errors->has('bank_name'))
                                <p style="color:red;">
                                    {{ $errors->first('bank_name') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 col-12 formcol">
                            <div class="form-group">
                                <label>Username</label>
                                {!!
                                    Form::text('username',@$account->username,['class'=>'form-control',
                                    'maxlength'=>config('constant.name_length'),'placeholder'=>'User Name'])
                                !!}
                                @if ($errors->has('username'))
                                <p style="color:red;">
                                    {{ $errors->first('username') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 col-12 formcol">
                            <div class="form-group">
                                <label>Bank Account No.</label>
                                {!!
                                    Form::text('account_number',@$account->account_number,['class'=>'form-control',
                                    'maxlength'=>config('constant.name_length'),'placeholder'=>'Bank Account Number'])
                                !!}
                                @if ($errors->has('account_number'))
                                <p style="color:red;">
                                    {{ $errors->first('account_number') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 col-12 formcol">
                            <div class="form-group">
                                <label>Password</label>
                                {!!
                                    Form::text('password',@$account->password,['class'=>'form-control',
                                    'maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.password')])
                                !!}
                                @if ($errors->has('password'))
                                <p style="color:red;">
                                    {{ $errors->first('password') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 col-12 formcol">
                            <div class="form-group">
                                <label>Routing No.</label>
                                {!!
                                    Form::text('routing_number',@$account->routing_number,['class'=>'form-control',
                                    'maxlength'=>config('constant.name_length'),'placeholder'=>'Routing No.'])
                                !!}
                                @if ($errors->has('routing_number'))
                                <p style="color:red;">
                                    {{ $errors->first('routing_number') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 col-12 formcol">
                            <div class="form-group">
                                <label>Security Questions</label>
                                {!!
                                    Form::text('security_question',@$account->security_question,['class'=>'form-control',
                                    'maxlength'=>config('constant.name_length'),'placeholder'=>'Security Question'])
                                !!}
                                @if ($errors->has('security_question'))
                                <p style="color:red;">
                                    {{ $errors->first('security_question') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 col-12 formcol">
                            <div class="form-group">
                                <label>Answers</label>
                                {!!
                                    Form::text('answer',@$account->answer,['class'=>'form-control',
                                    'maxlength'=>config('constant.name_length'),'placeholder'=>'Answer'])
                                !!}
                                @if ($errors->has('answer'))
                                <p style="color:red;">
                                    {{ $errors->first('answer') }}</p>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="formbankmain" id="debitCardDetail" style="display:{{(@$account->have_credit_card== 1)?'unset':'none'}}">
                        <h3 class="formtitle">Link Debit Card</h3>
                        <div class="row formrow">
                            <div class="col-md-6 col-12 formcol">
                                <div class="form-group">
                                    <label>Cardholder Name</label>
                                    {!!
                                        Form::text('debit_card_holder_name',@$account->debit_card_holder_name,['class'=>'form-control',
                                        'maxlength'=>config('constant.name_length'),'placeholder'=>'Card Holder Name'])
                                    !!}
                                    @if ($errors->has('debit_card_holder_name'))
                                        <p style="color:red;">
                                            {{ $errors->first('debit_card_holder_name') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-12 formcol">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Date of Expiry</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <span>Month</span>
                                            {!!
                                                Form::text('debit_card_month',@$account->debit_card_month,['class'=>'form-control  input-textmon',
                                                'maxlength'=>config('constant.name_length'),'placeholder'=>'Month','id'=>'debitMonth','readonly'=>true])
                                            !!}
                                            @if ($errors->has('debit_card_month'))
                                            <p style="color:red;">
                                                {{ $errors->first('debit_card_month') }}</p>
                                            @endif
                                        </div>
                                        <div class="col-md-4">
                                            <span>Year</span>
                                            {!!
                                                Form::text('debit_card_year',@$account->debit_card_year,['class'=>'form-control input-textyear',
                                                'maxlength'=>config('constant.name_length'),'placeholder'=>'Year','id'=>'debitYear','readonly'=>true])
                                            !!}
                                            @if ($errors->has('debit_card_year'))
                                            <p style="color:red;">
                                                {{ $errors->first('debit_card_year') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12 formcol">
                                <div class="form-group">
                                    <label>Debit Card No.</label>
                                    {!!
                                        Form::text('debit_card_no',@$account->debit_card_no,['class'=>'form-control',
                                        'maxlength'=>config('constant.name_length'),'placeholder'=>'debit Card No'])
                                    !!}
                                    @if ($errors->has('debit_card_no'))
                                    <p style="color:red;">
                                        {{ $errors->first('debit_card_no') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-12 formcol">
                                <div class="form-group">
                                    <label>CVV</label>
                                    {!!
                                        Form::text('debit_card_cvv',@$account->debit_card_cvv,['class'=>'form-control inupt-textcvv',
                                        'maxlength'=>config('constant.name_length'),'placeholder'=>'CVV'])
                                    !!}
                                    @if ($errors->has('debit_card_cvv'))
                                    <p style="color:red;">
                                        {{ $errors->first('debit_card_cvv') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="formbankmain" id="creditCardDetail" style="display:{{(@$account->have_credit_card== 1)?'unset':'none'}}">
                        <h3 class="formtitle">Link Credit Card</h3>
                        <div class="row formrow">
                            <div class="col-md-6 col-12 formcol">
                                <div class="form-group">
                                    <label>Cardholder Name</label>
                                    {!!
                                        Form::text('credit_card_holder_name',@$account->credit_card_holder_name,['class'=>'form-control',
                                        'maxlength'=>config('constant.name_length'),'placeholder'=>'Card Holder Name'])
                                    !!}
                                    @if ($errors->has('credit_card_holder_name'))
                                    <p style="color:red;">
                                        {{ $errors->first('credit_card_holder_name') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-12 formcol">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Date of Expiry</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <span>Month</span>
                                                {!!
                                                    Form::text('credit_card_month',@$account->credit_card_month,['class'=>'form-control input-textmon',
                                                    'maxlength'=>config('constant.name_length'),'placeholder'=>'Month','id'=>'creditMonth','readonly'=>true])
                                                !!}
                                                @if ($errors->has('credit_card_month'))
                                                <p style="color:red;">
                                                    {{ $errors->first('credit_card_month') }}</p>
                                                @endif
                                        </div>
                                        <div class="col-md-4">
                                            <span>Year</span>
                                            {!!
                                                Form::text('credit_card_year',@$account->credit_card_year,['class'=>'form-control input-textyear',
                                                'maxlength'=>config('constant.name_length'),'placeholder'=>'Year','id'=>'creditYear','readonly'=>true])
                                            !!}
                                            @if ($errors->has('credit_card_year'))
                                            <p style="color:red;">
                                                {{ $errors->first('credit_card_year') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12 formcol">
                                <div class="form-group">
                                    <label>Credit Card No.</label>
                                    {!!
                                        Form::text('credit_card_no',@$account->credit_card_no,['class'=>'form-control',
                                        'maxlength'=>config('constant.name_length'),'placeholder'=>'Credit Card No'])
                                    !!}
                                    @if ($errors->has('credit_card_no'))
                                    <p style="color:red;">
                                        {{ $errors->first('credit_card_no') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-12 formcol">
                                <div class="form-group">
                                    <label>CVV</label>
                                    {!!
                                        Form::text('credit_card_cvv',@$account->credit_card_cvv,['class'=>'form-control  inupt-textcvv',
                                        'maxlength'=>config('constant.name_length'),'placeholder'=>'CVV'])
                                    !!}
                                    @if ($errors->has('credit_card_cvv'))
                                        <p style="color:red;">
                                            {{ $errors->first('credit_card_cvv') }}</p>
                                    @endif
                                </div>
                            </div>
                            {!! Form::hidden('loan_id',@$loanDetail->id ,['id'=>'loan_id']) !!}
                            {!! Form::hidden('user_id',@$loanDetail->user_id ,['id'=>'user_id']) !!}
                        </div>
                    </div>
                    <div class="bankcardopc">
                        <div class="bankopc">
                            <p>Do You Have Debit Card of <b>“Bank Name”</b> Account Number Ending With “xxxxx1234” ?</p>
                            <div class="tabs_form">
                                <div class="role-list">
                                    <div class="pure-checkbox">
                                        <input type="radio" id="md_checkbox" name="have_debit_card"
                                            class="filled-in chk-col-red debitCard" {{(@$account->have_debit_card== 1)?'checked':''}} value="1">
                                        <label class="p0 m0" for="md_checkbox"> <span
                                                class="checkbox-text-right">YES</span></label>
                                    </div>
                                </div>
                                <div class="role-list">
                                    <div class="pure-checkbox">
                                        <input type="radio" id="md_default" name="have_debit_card"
                                            class="filled-in chk-col-red debitCard" {{(@$account->have_debit_card== 0)?'checked':''}} value="0">
                                        <label class="p0 m0" for="md_default"> <span
                                                class="checkbox-text-right">NO</span></label>
                                    </div>
                                </div>
                            </div>
                            <span class="debitCardError"></span>
                        </div>
                        <div class="bankopc">
                            <p>Do You Have Credi Card of <b>“Bank Name”</b> Under Your Name ?</p>
                            <div class="tabs_form">
                                <div class="role-list">
                                    <div class="pure-checkbox">
                                        <input type="radio" id="md_default1" name="have_credit_card"
                                            class="filled-in chk-col-red creditCard" {{(@$account->have_credit_card== 1)?'checked':''}} value="1">
                                        <label class="p0 m0" for="md_default1"> <span
                                                class="checkbox-text-right">YES</span></label>
                                    </div>
                                </div>
                                <div class="role-list">
                                    <div class="pure-checkbox">
                                        <input type="radio" id="md_default2" name="have_credit_card"
                                            class="filled-in chk-col-red creditCard" {{(@$account->have_credit_card== 0)?'checked':''}} value="0">
                                        <label class="p0 m0" for="md_default2"> <span
                                                class="checkbox-text-right">NO</span></label>
                                    </div>
                                </div>
                            </div>
                            <span class="creditCardError"></span>
                        </div>
                    </div>
                    <div class="resubmitmain">
                        <span class="wpcf7-list-item first">
                            <label>
                                <input type="checkbox" name="term_and_condition" id='agree' value="0">
                                <span class="wpcf7-list-item-label">I here by accept all <b>Terms & Conditions</b></span>
                            </label>
                        </span>
                        <span class="tnc"></span>
                    </div>
                    <div class="subbtn">
                        <button type="submit" class="btn btn-green">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- start testinomial section -->
    @include('frontend.sections.testinomial')
    <!-- end of testinomial process section -->
</div>
@stop
@section('front_script')
<script src="{{ asset('backend/dist/default/assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/dist/default/assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script>
    var rule = $.extend({}, {!! json_encode(config('constant'), JSON_FORCE_OBJECT) !!});
</script>
<script src="{{ asset('frontend/js/loan/account.js') }}"></script>
@endsection
