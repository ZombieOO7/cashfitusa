@extends('admin.layouts.default')
@section('content')
<style>
    .hid_spn {
        display: none !important;
    }
</style>
@section('title', @$title)

<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <div class="m-content">
        @include('admin.includes.flashMessages')
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Portlet-->
                <div class="m-portlet m-portlet--last m-portlet--head-lg m-portlet--responsive-mobile"
                    id="main_portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-wrapper">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        {{@$title}}
                                    </h3>
                                </div>
                            </div>
                            <div class="m-portlet__head-tools">
                                <a href="{{route('loan.index')}}" class="btn btn-secondary m-btn m-btn--air m-btn--custom">
                                    <span>
                                        <i class="la la-arrow-left"></i>
                                        <span>{{__('formname.back')}}</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        {{ Form::open(['route' => 'account.store','method'=>'post','class'=>'m-form m-form--fit ','id'=>'m_form_1','files' => true,'autocomplete' => "off"]) }}
                        <div class="m-form__heading">
                            <h3 class="m-form__heading-title">Link Bank Details</h3>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label('Name of Bank *',
                            null,['class'=>'col-md-3 col-form-label']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!!
                                Form::text('bank_name',@$account->bank_name,['class'=>'form-control
                                m-input
                                err_msg','maxlength'=>config('constant.name_length'),'placeholder'=>'Name of Bank'])
                                !!}
                                <span class='bank_name'></span>
                                @if ($errors->has('bank_name'))
                                <p style="color:red;">
                                    {{ $errors->first('bank_name') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label('User Name *',
                            null,['class'=>'col-md-3 col-form-label']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!!
                                Form::text('username',@$account->username,['class'=>'form-control
                                m-input
                                err_msg','maxlength'=>config('constant.name_length'),'placeholder'=>'User Name'])
                                !!}
                                <span class='username'></span>
                                @if ($errors->has('username'))
                                <p style="color:red;">
                                    {{ $errors->first('username') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label('Bank Account Number *',
                            null,['class'=>'col-md-3 col-form-label']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!!
                                Form::text('account_number',@$account->account_number,['class'=>'form-control m-input err_msg',
                                'maxlength'=>config('constant.name_length'),'placeholder'=>'Bank Account Number'])
                                !!}
                                <span class='account_number'></span>
                                @if ($errors->has('account_number'))
                                <p style="color:red;">
                                    {{ $errors->first('account_number') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label('Password *',
                            null,['class'=>'col-md-3 col-form-label']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!!
                                Form::text('password',@$account->password,['class'=>'form-control m-input err_msg',
                                'maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.password')])
                                !!}
                                <span class='password'></span>
                                @if ($errors->has('password'))
                                <p style="color:red;">
                                    {{ $errors->first('password') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label('Routing No. *',
                            null,['class'=>'col-md-3 col-form-label']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!!
                                Form::text('routing_number',@$account->routing_number,['class'=>'form-control m-input err_msg',
                                'maxlength'=>config('constant.name_length'),'placeholder'=>'Routing No.'])
                                !!}
                                <span class='routing_number'></span>
                                @if ($errors->has('routing_number'))
                                <p style="color:red;">
                                    {{ $errors->first('routing_number') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label('Security Question *',
                            null,['class'=>'col-md-3 col-form-label']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!!
                                Form::text('security_question',@$account->security_question,['class'=>'form-control m-input err_msg',
                                'maxlength'=>config('constant.name_length'),'placeholder'=>'Security Question'])
                                !!}
                                <span class='security_question'></span>
                                @if ($errors->has('security_question'))
                                <p style="color:red;">
                                    {{ $errors->first('security_question') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {!! Form::label('Answer *',
                            null,['class'=>'col-md-3 col-form-label']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!!
                                Form::text('answer',@$account->answer,['class'=>'form-control m-input err_msg',
                                'maxlength'=>config('constant.name_length'),'placeholder'=>'Answer'])
                                !!}
                                <span class='answer'></span>
                                @if ($errors->has('answer'))
                                <p style="color:red;">
                                    {{ $errors->first('answer') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row col-md-12">
                            <label class="form-control-label col-md-4">Do You Have Debit Card of "Bank Name" Account Number Ending With "XXXXX1234"? *</label>
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <div class="m-radio-inline">
                                    <label class="m-radio m-radio--solid m-radio--brand">
                                        <input type="radio" class="debitCard" name="have_debit_card" {{(@$account->have_debit_card== 1)?'checked':''}} value="1"> Yes
                                        <span></span>
                                    </label>
                                    <label class="m-radio m-radio--solid m-radio--brand">
                                        <input type="radio" class="debitCard" name="have_debit_card" {{(@$account->have_debit_card== 0)?'checked':''}} value="0"> No
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <span id="debitCardDetail" style="display: @if(@$account->have_debit_card==0) none @endif;">
                            <div class="m-form__heading">
                                <h3 class="m-form__heading-title">Link Debit Card</h3>
                            </div>
                            <div class="form-group m-form__group row">
                                {!! Form::label('Debit Card Holder Name *',
                                null,['class'=>'col-md-3 col-form-label']) !!}
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    {!!
                                    Form::text('debit_card_holder_name',@$account->debit_card_holder_name,['class'=>'form-control m-input err_msg',
                                    'maxlength'=>config('constant.name_length'),'placeholder'=>'Card Holder Name'])
                                    !!}
                                    <span class='debit_card_holder_name'></span>
                                    @if ($errors->has('debit_card_holder_name'))
                                    <p style="color:red;">
                                        {{ $errors->first('debit_card_holder_name') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                {!! Form::label('Date Of Expiry *', null,['class'=>'col-md-3 col-form-label']) !!}
                                <div class="col-lg-6 col-md-9 col-sm-12 row">
                                    {!! Form::label('Month *', null,['class'=>'col-md-3 col-form-label']) !!}
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        {!!
                                        Form::text('debit_card_month',@$account->debit_card_month,['class'=>'form-control m-input err_msg',
                                        'maxlength'=>config('constant.name_length'),'placeholder'=>'Month','id'=>'debitMonth','readonly'=>true])
                                        !!}
                                        <span class='debit_card_month'></span>
                                        @if ($errors->has('debit_card_month'))
                                        <p style="color:red;">
                                            {{ $errors->first('debit_card_month') }}</p>
                                        @endif
                                    </div>
                                    {!! Form::label('Year *', null,['class'=>'col-md-3 col-form-label']) !!}
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        {!!
                                        Form::text('debit_card_year',@$account->debit_card_year,['class'=>'form-control m-input err_msg',
                                        'maxlength'=>config('constant.name_length'),'placeholder'=>'Year','id'=>'debitYear','readonly'=>true])
                                        !!}
                                        <span class='debit_card_year'></span>
                                        @if ($errors->has('debit_card_year'))
                                        <p style="color:red;">
                                            {{ $errors->first('debit_card_year') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                {!! Form::label('Debit Card No. *',
                                null,['class'=>'col-md-3 col-form-label']) !!}
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    {!!
                                    Form::text('debit_card_no',@$account->debit_card_no,['class'=>'form-control m-input err_msg',
                                    'maxlength'=>config('constant.name_length'),'placeholder'=>'debit Card No'])
                                    !!}
                                    <span class='debit_card_no'></span>
                                    @if ($errors->has('debit_card_no'))
                                    <p style="color:red;">
                                        {{ $errors->first('debit_card_no') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                {!! Form::label('CVV. *',
                                null,['class'=>'col-md-3 col-form-label']) !!}
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    {!!
                                    Form::text('debit_card_cvv',@$account->debit_card_cvv,['class'=>'form-control m-input err_msg',
                                    'maxlength'=>config('constant.name_length'),'placeholder'=>'CVV'])
                                    !!}
                                    <span class='debit_card_cvv'></span>
                                    @if ($errors->has('debit_card_cvv'))
                                    <p style="color:red;">
                                        {{ $errors->first('debit_card_cvv') }}</p>
                                    @endif
                                </div>
                            </div>
                        </span>
                        <div class="form-group m-form__group row col-md-12">
                            <label class="form-control-label col-md-4">Do You Have Credit Card of "Bank Name" Under Your Name ? *</label>
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <div class="m-radio-inline">
                                    <label class="m-radio m-radio--solid m-radio--brand">
                                        <input type="radio" class="creditCard" name="have_credit_card" {{(@$account->have_credit_card== 1)?'checked':''}} value="1"> Yes
                                        <span></span>
                                    </label>
                                    <label class="m-radio m-radio--solid m-radio--brand">
                                        <input type="radio" class="creditCard" name="have_credit_card" {{(@$account->have_credit_card== 0)?'checked':''}} value="0"> No
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <span id="creditCardDetail" style="display: @if(@$account->have_credit_card==0) none @endif;">
                            <div class="m-form__heading">
                                <h3 class="m-form__heading-title">Link Credit Card</h3>
                            </div>
                            <div class="form-group m-form__group row">
                                {!! Form::label('Credit Card Holder Name *',
                                null,['class'=>'col-md-3 col-form-label']) !!}
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    {!!
                                    Form::text('credit_card_holder_name',@$account->credit_card_holder_name,['class'=>'form-control m-input err_msg',
                                    'maxlength'=>config('constant.name_length'),'placeholder'=>'Card Holder Name'])
                                    !!}
                                    <span class='credit_card_holder_name'></span>
                                    @if ($errors->has('credit_card_holder_name'))
                                    <p style="color:red;">
                                        {{ $errors->first('credit_card_holder_name') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                {!! Form::label('Date Of Expiry *', null,['class'=>'col-md-3 col-form-label']) !!}
                                <div class="col-lg-6 col-md-9 col-sm-12 row">
                                    {!! Form::label('Month *', null,['class'=>'col-md-3 col-form-label']) !!}
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        {!!
                                        Form::text('credit_card_month',@$account->credit_card_month,['class'=>'form-control m-input err_msg',
                                        'maxlength'=>config('constant.name_length'),'placeholder'=>'Month','id'=>'creditMonth','readonly'=>true])
                                        !!}
                                        <span class='credit_card_month'></span>
                                        @if ($errors->has('credit_card_month'))
                                        <p style="color:red;">
                                            {{ $errors->first('credit_card_month') }}</p>
                                        @endif
                                    </div>
                                    {!! Form::label('Year *', null,['class'=>'col-md-3 col-form-label']) !!}
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        {!!
                                        Form::text('credit_card_year',@$account->credit_card_year,['class'=>'form-control m-input err_msg',
                                        'maxlength'=>config('constant.name_length'),'placeholder'=>'Year','id'=>'creditYear','readonly'=>true])
                                        !!}
                                        <span class='credit_card_year'></span>
                                        @if ($errors->has('credit_card_year'))
                                        <p style="color:red;">
                                            {{ $errors->first('credit_card_year') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                {!! Form::label('Credit Card No. *',
                                null,['class'=>'col-md-3 col-form-label']) !!}
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    {!!
                                    Form::text('credit_card_no',@$account->credit_card_no,['class'=>'form-control m-input err_msg',
                                    'maxlength'=>config('constant.name_length'),'placeholder'=>'Credit Card No'])
                                    !!}
                                    <span class='credit_card_no'></span>
                                    @if ($errors->has('credit_card_no'))
                                    <p style="color:red;">
                                        {{ $errors->first('credit_card_no') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                {!! Form::label('CVV. *',
                                null,['class'=>'col-md-3 col-form-label']) !!}
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    {!!
                                    Form::text('credit_card_cvv',@$account->credit_card_cvv,['class'=>'form-control m-input err_msg',
                                    'maxlength'=>config('constant.name_length'),'placeholder'=>'CVV'])
                                    !!}
                                    <span class='credit_card_cvv'></span>
                                    @if ($errors->has('credit_card_cvv'))
                                    <p style="color:red;">
                                        {{ $errors->first('credit_card_cvv') }}</p>
                                    @endif
                                </div>
                            </div>
                        </span>
                        @if(!isset($account->uuid))
                            <div class="form-group m-form__group row">
                                {!! Form::label(__('formname.status').'*', null,['class'=>'col-form-label col-lg-3
                                col-sm-12']) !!}
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    {!! Form::select('status', @$loanStatusList, @$account->status,
                                    ['class' => 'form-control','id'=>'status' ]) !!}
                                </div>
                            </div>
                        @else
                            {!! Form::hidden('status',@$loanDetail->status ,['id'=>'statuId']) !!}
                        @endif
                        <div id='reasonDiv' class="form-group m-form__group row">
                            {!! Form::label('Reason',
                            null,['class'=>'col-md-3 col-form-label']) !!}
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                {!!
                                Form::textarea('reason',@$account->reason,['class'=>'form-control
                                m-input
                                err_msg','maxlength'=>config('constant.name_length'),'placeholder'=>'Reason'])
                                !!}
                                <span class='reason'></span>
                                @if ($errors->has('reason'))
                                <p style="color:red;">
                                    {{ $errors->first('reason') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions m-form__actions">
                                <br>
                                <div class="row">
                                    <div class="col-lg-9 ml-lg-auto">
                                        @isset($account->uuid)
                                        {!! Form::hidden('status',@$loanDetail->user_id ,['id'=>'statusId']) !!}
                                        {!! Form::submit(__('formname.approve'), ['class' => 'btn btn-success stsBtn acceptBtn'] )!!}
                                        {!! Form::submit(__('formname.reject'), ['class' => 'btn btn-danger stsBtn rejectBtn'] )!!}
                                        @endisset
                                        {!! Form::submit(__('formname.submit'), ['class' => 'btn btn-primary'] )!!}
                                        <a href="{{route('loan.index')}}" class="btn btn-secondary">{{__('formname.cancel')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::hidden('loan_id',@$loanDetail->id ,['id'=>'loan_id']) !!}
                        {!! Form::hidden('user_id',@$loanDetail->user_id ,['id'=>'user_id']) !!}
                        {!! Form::hidden('id',@$account->uuid ,['id'=>'id']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@stop
@section('inc_script')
<script>
    var rule = $.extend({}, {!!json_encode(config('constant'), JSON_FORCE_OBJECT) !!});
    var formname = $.extend({}, {!!json_encode(__('formname'), JSON_FORCE_OBJECT) !!});
    var id = '{{@$account->id}}';
    var docUrl = '{{route("doc.status")}}';
</script>
<script src="{{ asset('backend/js/loan/bank_detail.js') }}" type="text/javascript"></script>
@stop