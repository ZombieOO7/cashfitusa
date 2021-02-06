@extends('frontend.layouts.default')
@section('front_css')
<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
<script>
    WebFont.load({
        google: {
            "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
        },
        active: function() {
            sessionStorage.fonts = true;
        }
    });
</script>
{{-- <link href="{{ asset('backend/dist/default/assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet"
    type="text/css" /> --}}
{{-- <link href="{{ asset('backend/dist/default/assets/demo/default/base/style.bundle.css') }}" rel="stylesheet"
    type="text/css" /> --}}
@endsection
@section('content')
@section('title', 'Dashboard')
    <script src="https://rawgit.com/kimmobrunfeldt/progressbar.js/1.0.0/dist/progressbar.js"></script>
    <style>
        .list-group-item:hover{
            background-color: #eef5ff !important; 
            border-right: 3px solid blue !important;
        }
        .list-group-item.active{
            background-color: #eef5ff !important; 
            border-right: 3px solid blue !important;
            color: blue !important; 
        }
        .nav-pills .nav-link.active, .nav-pills .show > .nav-link{
            background: #2171d3 !important;
        }
        .progressbar-text{
            bottom:20px !important;
            color: #007bff !important;
        }
        .datacontainer {
            display: grid;
            grid-template-columns: repeat(1, 160px);
            grid-gap: 80px;
            margin: auto 0;
        }

        .datacontainer .box .chart {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            font-size: 36px;
            line-height: 160px;
            height: 160px;
            color: #000;
        }

        .datacontainer .box canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            width: 100%;
        }
    </style>
<section class="loan-process-section section-padding pt-50">
    <div class="col-md-12">
        <div class="mb-2">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="mb-35">
                        <ul class="nav nav-pills nav-fill" role="tablist">
                            <li class="nav-item">
                                <a style="border-top-right-radius: 0 !important;border-bottom-right-radius: 0 !important;" class="nav-link active" data-toggle="tab" href="#m_tabs_1_1">Loan</a>
                            </li>
                            <li class="nav-item">
                                <a style="border-top-left-radius: 0 !important;border-bottom-left-radius: 0 !important;" class="nav-link" data-toggle="tab" href="#m_tabs_1_2">Earning</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="tab-content">
                    {{-- Start Loan tab panel --}}
                    <div id="m_tabs_1_1" role="tabpanel" class="tab-pane active show">
                        <div class="row">
                            <div class="col-12 col-sm-3 col-md-3 col-lg-3 coldashmenu">


                                <div class="">
                                    <div class="card">
                                        <div class="filter-content rounded">
                                            <div class="list-group " id="list-tab" role="tablist">
                                                <div class="mt-3"></div>
                                                <a class="border-0 list-group-item list-group-item-action text-dark active"  data-toggle="tab" href="#m_tabs_2_1">
                                                    <span class="fas fa-pie-chart mr-2"></span> Dashboard
                                                </a>
                                                <a class="border-0 list-group-item list-group-item-action text-dark" href="{{route('loan.detail')}}">
                                                    <span class="fas fa-plus mr-2"></span> New Application
                                                </a>
                                                <a class="border-0 list-group-item list-group-item-action text-dark" href="{{route('application')}}">
                                                    <span class="fas fa-eye mr-2"></span> View Application
                                                </a>
                                                <a class="border-0 list-group-item list-group-item-action text-dark" data-toggle="tab" href="#m_tabs_2_2">
                                                    <span class="fas fa-user mr-3"></span>Account
                                                </a>
                                                <div class="eef5ff mb-3"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-9 col-md-9 col-lg-9">
                                <div class="tab-content">
                                    <div id="m_tabs_2_1" role="tabpanel" class="tab-pane active show">
                                        <div class="row">
                                            <div class="col-md-4 colcardbox mb-20">
                                                <div class="card card-body">
                                                    <div class="row">
                                                        <div class="col-md-9 col-9">
                                                            <label for="" class="text-black text-bold">Total Loan Amount</label>
                                                            <div class="h5 count">
                                                            {{config('constant.currency_symbol').@$totalLoanAmount}}
                                                            </div>
                                                        </div>
                                                        <div class="col-3 col-md-3 mt-3 p-0">
                                                            <img src="{{asset('images/d-1.svg')}}" alt="" class="h-75">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 colcardbox mb-20">
                                                <div class="card card-body">
                                                    <div class="row">
                                                        <div class="col-md-9 col-9">
                                                            <label for="" class="text-black text-bold">Paid Amount</label>
                                                            <div class="h5 count">
                                                                {{config('constant.currency_symbol').@$paidAmount}}
                                                            </div>
                                                        </div>
                                                        <div class="col-3 col-md-3 mt-3 p-0">
                                                            <img src="{{asset('images/d-2.svg')}}" alt="" class="h-75">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 colcardbox">
                                                <div class="card card-body">
                                                    <div class="row">
                                                        <div class="col-md-9 col-9">
                                                            <label for="" class="text-black text-bold">Remaining Repayment</label>
                                                            <div class="h5 count">
                                                                {{config('constant.currency_symbol').@$leftToPay}}
                                                            </div>
                                                        </div>
                                                        <div class="col-3 col-md-3 mt-3 p-0">
                                                            <img src="{{asset('images/d3.svg')}}" alt="" class="h-75">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-5 col-md-5 col-12 imgdashcolmb">
                                                <img src="{{asset('images/dashboardimage.svg')}}" alt="dashboardimage">
                                            </div>

                                            <div class="col-lg-4 col-md-6 grphcol">
                                                <div class="card card-body h-100 grphbox">
                                                    <div class="col-md-12">
                                                        {{-- <div id="containercircle" class="col-md-12 p-3"></div> --}}
                                                        <div class="datacontainer justify-content-md-center col-md-12 p-3">
                                                            <div class="box">
                                                                <div class="chart" data-percent="{{@$loanRatio}}" data-scale-color="#ffb400">{{@$loanRatio ?? 0}}%</div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label for="" class="col-6 form-label h6  p-0 text-black">Loan Type</label>
                                                            <label for="" class="col-6 form-label h6  p-0 text-black">{{@config('constant.loan_type')[$lastLoan->loan_type]}}</label>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label for="" class="col-6 form-label h6 p-0 text-black">Status</label>
                                                            <label for="" class="col-6 form-label h6 text-black p-0">Active</label>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label for="" class="col-6 form-label h6 p-0 text-black">No of Emis</label>
                                                            <label for="" class="col-6 form-label h6 text-black p-0 count2">{{@$totalLoan}}</label>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label for="" class="col-6 form-label h6 p-0 text-black">Monthly Instalments Due</label>
                                                            <label for="" class="col-6 form-label h6 text-black p-0">{{$user->dueInstallments->count()}}</label>
                                                        </div>
                                                        {{-- <div class="row">
                                                            <label for="" class="col-6 form-label h6 text-primary p-0">Last Date</label>
                                                            <label for="" class="col-6 form-label h6 text-dark p-0">{{$lastDate}}</label>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 histcol">
                                                <div class="card card-body  h-100 histbox">
                                                    <label for="" class="form-lable text-bold text-black">Transaction History</label>
                                                    <table class="w-100">
                                                        <thead class="border-0">
                                                            <tr>
                                                                <th class="text-black">Date</th>
                                                                <th class="text-right text-black">Amount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse(@$loanTransactions as $transaction)
                                                                <tr>
                                                                    <td class='form-label text-dark'>{{$transaction->proper_date}}</td>
                                                                    <td class='form-label text-dark text-right'> {{$transaction->proper_amount}}</td>
                                                                </tr>
                                                            @empty
                                                            <tr>
                                                                <td>No Records Found</td>
                                                            </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 col-md-5 col-12 imgdashcol">
                                                <img src="{{asset('images/dashboardimage.svg')}}" alt="dashboardimage">
                                            </div>


                                        </div>
                                    </div>
                                    <div id="m_tabs_2_2" role="tabpanel" class="tab-pane">
                                        <div class="row">
                                            <div class="col-md-4 mb-20">
                                                <div class="card card-body accocard">
                                                    <div class="rowaccount">
                                                        <div class="accocardcon">
                                                            <label for="" class="text-black text-bold">Total Loan Amount</label>
                                                            <div class="h5 count">
                                                            {{config('constant.currency_symbol').@$totalLoanAmount}}
                                                            </div>
                                                        </div>
                                                        <div class="acoicon">
                                                           <!--  <img src="{{asset('images/d-1.svg')}}" alt="" class="h-75"> -->
                                                            <i class="fa fa-hand-holding-usd"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-20">
                                                <div class="card card-body accocard">
                                                    <div class="rowaccount">
                                                        <div class="accocardcon">
                                                            <label for="" class="text-black text-bold">Paid Amount</label>
                                                            <div class="h5 count">
                                                                {{config('constant.currency_symbol').@$paidAmount}}
                                                            </div>
                                                        </div>
                                                        <div class="acoicon acoicongreen">
                                                            <!-- <img src="{{asset('images/d-2.svg')}}" alt="" class="h-75"> -->
                                                             <i class="fa fa-check"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 ">
                                                <div class="card card-body accocard">
                                                    <div class="rowaccount">
                                                        <div class="accocardcon">
                                                            <label for="" class="text-black text-bold">Left to Pay</label>
                                                            <div class="h5 count">
                                                                {{config('constant.currency_symbol').@$leftToPay}}
                                                            </div>
                                                        </div>
                                                        <div class="acoicon acoiconred">
                                                            <!-- <img src="{{asset('images/d3.svg')}}" alt="" class="h-75"> -->
                                                            <i class="fa fa-clock"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row pt-3">
                                            <div class="col-md-12">
                                                <div class="card card-body">
                                                    <div class="m-form__heading section_title p-4">
                                                        <h3 class="m-form__heading-title"> Personal Information </h3>
                                                        <span class="wow fadeInUp" data-wow-duration="0s"
                                                            data-wow-delay="0s"
                                                            style="background: #000 !important;"></span>
                                                    </div>
                                                    @if ($message = Session::get('message'))
                                                    <div class="col-md-9 offset-md-1">
                                                        <div class="alert alert-dismissible fade show text-white bg-green" role="alert">
                                                            <a href="#" class="text-white" style="text-decoration: none;"><span class="fa fa-check mr-2"></span>{{ $message }}</a>
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true" class="text-white font-weight-normal">x</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @if ($message = Session::get('error'))
                                                    <div class="col-md-9 offset-md-1">
                                                        <div class="alert alert-dismissible fade show text-white" style="background-color: #f4516c;" role="alert">
                                                            <a href="#" class="text-white" style="text-decoration: none;">{{ $message }}</a>
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true" class="text-white font-weight-normal">x</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <form id="m_form_1" class="col-md-9 offset-md-1 mb-3 mt-5" method="post" action='{{route('user.profile.update')}}' enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <div class="text-right">
                                                                <button type='button' class="btn2 btn-primary" id='editProfile'>Edit Profile</button>
                                                            </div>
                                                        </div>
                                                        @csrf
                                                        <div class="form-group row">
                                                            <label for="first_name" class="col-lg-4 text-black col-form-label"></label>
                                                            <div class="col-lg-3">
                                                                <img id='img-preview' class="rounded-circle" src="{{$user->image_names}}" alt="" width="150px" height="150px">
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <input class="d-none" id='upload' type="file" name='image_file' accept="image/*"/>
                                                                <a href="javascript:;" id='upload_link' class="text-primary" style="padding: 70px 0;">Change</a>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="first_name" class="col-lg-4 text-black col-form-label">{{__('formname.user.first_name')}}</label>
                                                            <div class="col-lg-8">
                                                                {{Form::text('first_name',@$user->first_name,['class'=>'form-control','disabled'=>true,'maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.first_name')])}}
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputPassword" class="col-lg-4 text-black col-form-label">{{__('formname.user.middle_name')}}</label>
                                                            <div class="col-lg-8">
                                                                {{Form::text('middle_name',@$user->middle_name,['class'=>'form-control','disabled'=>true,'maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.middle_name')])}}
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="last_name" class="col-lg-4 text-black col-form-label">{{__('formname.user.last_name')}}</label>
                                                            <div class="col-lg-8">
                                                                {{Form::text('last_name',@$user->last_name,['class'=>'form-control','disabled'=>true,'maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.last_name')])}}
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="phone" class="col-sm-4 text-black col-form-label">{{__('formname.user.phone1')}}</label>
                                                            <div class="col-sm-8">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="la la-phone"></i>
                                                                        </span>
                                                                    </div>
                                                                    {{Form::text('phone',@$user->phone,['class'=>'form-control','disabled'=>true,'maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.phone1')])}}
                                                                </div>
                                                                <span class="phoneError"></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="email" class="col-sm-4 text-black col-form-label">{{__('formname.user.email')}}</label>
                                                            <div class="col-sm-8">
                                                                {{Form::email('email',@$user->email,['disabled'=>true,'class'=>'form-control','maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.email')])}}
                                                            </div>
                                                        </div>
                                                        {{-- <div class="form-group row">
                                                            <label for="inputPassword" class="col-sm-4 text-black col-form-label">Password</label>
                                                            <div class="col-sm-8">
                                                                {!! Form::password('password',['class' =>'form-control m-input','id'=>'password','placeholder'=>'Password','type' => 'password']) !!}
                                                            </div>
                                                        </div> --}}
                                                        <div class="form-group row">
                                                            <label for="inputPassword" class="col-sm-4 text-black col-form-label">{{__('formname.bank.address')}}</label>
                                                            <div class="col-sm-8">
                                                            {!! Form::textarea('address',@$user->address,['disabled'=>true,'class'=>'form-control m-input err_msg', 'maxlength'=>config('constant.text_length'),'placeholder'=>__('formname.bank.address'),'rows'=>'2'])!!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-12 row justify-content-end ml-0">
                                                                <button type="button" disabled class="col-md-3 btn2 editCancel btn-default rounded-0 text-black">Cancel</button>
                                                                <button type="submit" disabled class="col-md-3 btn2 btn-success rounded-0 bg-green">Save</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    {{-- <div class="m-form__heading section_title p-4">
                                                        <h3 class="m-form__heading-title"> Achivements </h3>
                                                        <span class="wow fadeInUp" data-wow-duration="0s"
                                                            data-wow-delay="0s"
                                                            style="background: #000 !important;"></span>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="alert alert-primary wow fadeInUp" data-wow-duration="2s" data-wow-delay=".1s" role="alert">
                                                                <img src="{{asset('images/award.svg')}}" alt="" height="auto" class="mr-2" width="30px">
                                                                Account verified successfully!
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="alert alert-primary wow fadeInUp" data-wow-duration="5s" data-wow-delay=".1s"  role="alert">
                                                                <img src="{{asset('images/award.svg')}}" alt="" height="auto" class="mr-2" width="30px">
                                                                You have successfully done repayment of your past loan.
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="alert alert-primary wow fadeInUp" data-wow-duration="7s" data-wow-delay=".1s" role="alert">
                                                                <img src="{{asset('images/award.svg')}}" alt="" height="auto" class="mr-2" width="30px">
                                                                All Document verified successfully!
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Loan tab panel --}}
                    @php
                        $appList = appList();
                    @endphp
                    {{-- Start Earning tab panel --}}
                    <div id="m_tabs_1_2" role="tabpanel" class="tab-pane">
                        <div class="row mt-3">
                            <div class="col-12 col-sm-3 col-md-3 col-lg-3 coldashmenu">
                                <div class="">
                                    <div class="card">
                                        <div class="filter-content rounded">
                                            <div class="list-group " id="list-tab" role="tablist">
                                                <div class="mt-3"></div>
                                                <a class="border-0 list-group-item list-group-item-action text-dark active"  data-toggle="tab" href="#m_tabs_3_1">
                                                    <span class="fas fa-pie-chart mr-2"></span> Dashboard
                                                </a>
                                                <a class="border-0 list-group-item list-group-item-action text-dark" data-toggle="tab" href="#m_tabs_3_2">
                                                    <span class="fas fa-user mr-3"></span>Earning Methods
                                                </a>
                                                <div class="eef5ff mb-3"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-9 col-md-9 col-lg-9">
                                <div class="tab-content">
                                    <div id="m_tabs_3_1" role="tabpanel" class="tab-pane active show">
                                        <div class="row">
                                            <div class="col-md-4 colcardbox mb-20">
                                                <div class="card card-body">
                                                    <div class="row">
                                                        <div class="col-md-9 col-9">
                                                            <label for="" class="text-black text-bold">Total Earning</label>
                                                            <div class="h5 count">
                                                            {{config('constant.currency_symbol').@$totalEarning}}
                                                            </div>
                                                        </div>
                                                        <div class="col-3 col-md-3 mt-3 p-0">
                                                            <img src="{{asset('images/d-1.svg')}}" alt="" class="h-75">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 colcardbox mb-20">
                                                <div class="card card-body">
                                                    <div class="row">
                                                        <div class="col-md-9 col-9">
                                                            <label for="" class="text-black text-bold">Amount Withdraw</label>
                                                            <div class="h5 count">
                                                                {{config('constant.currency_symbol').@$totalPaidAmount}}
                                                            </div>
                                                        </div>
                                                        <div class="col-3 col-md-3 mt-3 p-0">
                                                            <img src="{{asset('images/d-2.svg')}}" alt="" class="h-75">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 colcardbox">
                                                <div class="card card-body">
                                                    <div class="row">
                                                        <div class="col-md-9 col-9">
                                                            <label for="" class="text-black text-bold">Payment In Process</label>
                                                            <div class="h5 count">
                                                                {{config('constant.currency_symbol').@$totalUnPaidAmount}}
                                                            </div>
                                                        </div>
                                                        <div class="col-3 col-md-3 mt-3 p-0">
                                                            <img src="{{asset('images/d3.svg')}}" alt="" class="h-75">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-5 col-md-5 col-12 imgdashcolmb">
                                                <img src="{{asset('images/dashboardimage.svg')}}" alt="dashboardimage">
                                            </div>

                                            <div class="col-lg-4 col-md-6 grphcol">
                                                <div class="card card-body h-100 grphbox grphbox">
                                                    <div class="col-md-12">
                                                        {{-- <div id="containercircle" class="col-md-12 p-3"></div> --}}
                                                        <div class="datacontainer justify-content-md-center col-md-12 p-3">
                                                            <div class="box">
                                                                <div class="chart" data-percent="{{@$earningRatio}}" data-scale-color="#ffb400">{{@$earningRatio ?? 0}}%</div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label for="" class="col-6 form-label h6 text-black p-0">Transaction</label>
                                                            <label for="" class="col-6 form-label h6 text-black p-0">{{@$totalEarnings}}</label>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label for="" class="col-6 form-label h6 text-black p-0">Last transaction on</label>
                                                            <label for="" class="col-6 form-label h6 text-black p-0">{{@$lastTransactionDate}}</label>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label for="" class="col-6 form-label h6 text-black p-0">Earning Method</label>
                                                            <label for="" class="col-6 form-label h6 text-black p-0">{{@$lastEarning}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 histcol">
                                                <div class="card card-body  h-100 histbox">
                                                    <label for="" class="form-lable text-bold text-black">Transaction History</label>
                                                    <table class="w-100">
                                                        <thead class="border-0">
                                                            <tr>
                                                                <th class="text-black">Date</th>
                                                                <th class="text-right text-black">Amount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse(@$earnings as $earning)
                                                            <tr>
                                                                <td class='form-label text-dark'>{{$earning->proper_date2}}</td>
                                                                <td class='form-label text-dark text-right'> {{config('constant.currency_symbol').$earning->amount}}</td>
                                                            </tr>
                                                            @empty
                                                            <tr>
                                                                <td>No Records Found</td>
                                                            </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 col-md-5 col-12 imgdashcol">
                                                <img src="{{asset('images/dashboardimage.svg')}}" alt="dashboardimage">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="m_tabs_3_2" role="tabpanel" class="tab-pane">
                                        <div class="row">
                                            @forelse($appList as $key => $app)
                                            <div class="col-sm-4 mb-4">
                                                <a class="text-black" href="{{route('earning',['slug'=>@$app->slug])}}">
                                                    <div class="card">
                                                        <div class="card-body row">
                                                            <img class="rounded-circle col-md-4 " src="{{@$app->image_path}}" alt="" >
                                                            <div class="mt-4 text-center text-dark col-md-8">
                                                                <h4>{{@$app->title}}</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            @empty
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Earning tab panel --}}
                </div>
            </div>
        </div>
    </div>
</section>
@stop
@section('front_script')
<script src="{{ asset('backend/dist/default/assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/dist/default/assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>
<script>
    var rule = $.extend({}, {!!json_encode(config('constant'), JSON_FORCE_OBJECT) !!});
</script>
<script src="{{asset('frontend/js/user/profile.js')}}"></script>
<script src="{{asset('frontend/js/jquery.easypiechart.min.js')}}"></script>
<script>
$('.chart').easyPieChart({
    size: 160,
    barColor: function(percent) {
    var ctx = this.renderer.getCtx();
    var canvas = this.renderer.getCanvas();
    // var gradient = ctx.createLinearGradient(150,60,canvas.width,0);
        var gradient = ctx.createLinearGradient(140,-80,canvas.width,10);
        gradient.addColorStop(1, "#3D46DC");
        gradient.addColorStop(0, "#FA0B7E");
    return gradient;
    },
    scaleLength: 0,
    lineWidth: 15,
    trackColor: "#E1E5EB",
    lineCap: "circle",
    animate: 2000,
});
$('.count').each(function () {
  var $this = $(this);
  textC = $this.text();
  textC = textC.replace('$','');
  jQuery({ Counter: 0 }).animate({ Counter: textC }, {
    duration: 2000,
    easing: 'swing',
    step: function () {
        $this.text('$'+Math.ceil(this.Counter));
    }
  });
});
$('.count2').each(function () {
  var $this = $(this);
  textC = $this.text();
  jQuery({ Counter: 0 }).animate({ Counter: textC }, {
    duration: 2000,
    easing: 'swing',
    step: function () {
        $this.text(Math.ceil(this.Counter));
    }
  });
});
$('#editProfile').on('click',function(){
    debugger;
    $("form#m_form_1 :input").each(function(){
        var input = $(this); // This is the jquery object of the input, do what you will
        if(input.attr('name')!='email')
            input.attr('disabled',false);
    });
    $("form#m_form_1 :textarea").each(function(){
        var input = $(this); // This is the jquery object of the input, do what you will
        input.attr('disabled',false);
    });
})
$('.editCancel').on('click',function(){
    $("form#m_form_1 :input").each(function(){
        var input = $(this); // This is the jquery object of the input, do what you will
        if(input.attr('type') !='button')
            input.attr('disabled',true);
    });
    $("form#m_form_1 :textarea").each(function(){
        var input = $(this); // This is the jquery object of the input, do what you will
        input.attr('disabled',true);
    });
});
$(document).ready(function(){
    $("form#m_form_1 :input").each(function(){
            var input = $(this); // This is the jquery object of the input, do what you will
            if(input.attr('type') !='button')
                input.attr('disabled',true);
    });
    $("form#m_form_1 :textarea").each(function(){
        var input = $(this); // This is the jquery object of the input, do what you will
        input.attr('disabled',true);
    });
})
</script>
@stop