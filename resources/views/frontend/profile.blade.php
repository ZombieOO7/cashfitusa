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
<link href="{{ asset('backend/dist/default/assets/demo/default/base/style.bundle.css') }}" rel="stylesheet"
    type="text/css" />
@endsection
@section('content')
@section('title', 'Dashboard')
<section class="loan-process-section section-padding pt-100">
    <div class="col-md-12 pl-5">
        <div class="mb-2">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <ul class="nav nav-pills nav-fill" role="tablist">
                            <li class="nav-item">
                                <a style="border-top-right-radius: 0 !important;border-bottom-right-radius: 0 !important;" class="nav-link active" data-toggle="tab" href="#m_tabs_3_1">Loan</a>
                            </li>
                            <li class="nav-item">
                                <a style="border-top-left-radius: 0 !important;border-bottom-left-radius: 0 !important;" class="nav-link" data-toggle="tab" href="#m_tabs_3_2">Earning</a>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-3">
                        <div class="card">
                            <div class="filter-content rounded">
                                <div class="list-group " id="list-tab" role="tablist">
                                    <div class="mt-3"></div>
                                    <a class="border-0 list-group-item list-group-item-action text-dark" href="{{route('dashboard')}}">
                                        <span class="fas fa-pie-chart mr-2"></span> Dashboard
                                    </a>
                                    <a class="border-0 list-group-item list-group-item-action text-dark" href="{{route('loan.detail')}}">
                                        <span class="fas fa-plus mr-2"></span> New Application
                                    </a>
                                    <a class="border-0 list-group-item list-group-item-action text-dark" href="{{route('application')}}">
                                        <span class="fas fa-eye mr-2"></span> View Application
                                    </a>
                                    <a class="border-0 list-group-item list-group-item-action text-dark active" href="{{route('user.profile')}}">
                                        <span class="fas fa-user mr-3"></span>Account
                                    </a>
                                    <div class="eef5ff mb-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-9">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="" class="text-black">Total Loan Amount</label>
                                        <div class="h5">
                                        {{config('constant.currency_symbol').@$totalLoanAmount}}
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3 p-0">
                                        <img src="{{asset('images/d-1.svg')}}" alt="" class="h-75">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="" class="text-black">Paid Amount</label>
                                        <div class="h5">
                                            {{config('constant.currency_symbol').@$totalPaidAmount}}
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3 p-0">
                                        <img src="{{asset('images/d-2.svg')}}" alt="" class="h-75">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="card card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="" class="text-black">Left to Pay</label>
                                        <div class="h5">
                                            {{config('constant.currency_symbol').@$totalUnPaidAmount}}
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3 p-0">
                                        <img src="{{asset('images/d3.svg')}}" alt="" class="h-75">
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
                                    @csrf
                                    <div class="form-group row">
                                        <label for="first_name" class="col-lg-4 text-black col-form-label"></label>
                                        <div class="col-lg-3">
                                            <img id='img-preview' class="rounded-circle" src="{{$user->image_names}}" alt="" width="150px" height="150px">
                                        </div>
                                        <div class="col-lg-4">
                                            <input class="d-none" id='upload' type="file" name='image_file' accept="image/*"/>
                                            <a href="javascript:;" id='upload_link' class="text-primary" style="padding: 70px 0;">Edit</a>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="first_name" class="col-lg-4 text-black col-form-label">{{__('formname.user.first_name')}}</label>
                                        <div class="col-lg-8">
                                            {{Form::text('first_name',@$user->first_name,['class'=>'form-control','maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.first_name')])}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-lg-4 text-black col-form-label">{{__('formname.user.middle_name')}}</label>
                                        <div class="col-lg-8">
                                            {{Form::text('middle_name',@$user->middle_name,['class'=>'form-control','maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.middle_name')])}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="last_name" class="col-lg-4 text-black col-form-label">{{__('formname.user.last_name')}}</label>
                                        <div class="col-lg-8">
                                            {{Form::text('last_name',@$user->last_name,['class'=>'form-control','maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.last_name')])}}
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
                                                {{Form::text('phone',@$user->phone,['class'=>'form-control','maxlength'=>config('constant.name_length'),'placeholder'=>__('formname.user.phone1')])}}
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
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-4 text-black col-form-label">Password</label>
                                        <div class="col-sm-8">
                                            {!! Form::password('password',['class' =>'form-control m-input','id'=>'password','placeholder'=>'Password','type' => 'password']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-4 text-black col-form-label">{{__('formname.bank.address')}}</label>
                                        <div class="col-sm-8">
                                        {!! Form::textarea('address',@$user->address,['class'=>'form-control m-input err_msg', 'maxlength'=>config('constant.text_length'),'placeholder'=>__('formname.bank.address'),'rows'=>'2'])!!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12 row justify-content-end ml-0">
                                            <button type="button" class="col-md-3 btn2 btn-default rounded-0 text-black">Cancel</button>
                                            <button type="submit" class="col-md-3 btn2 btn-success rounded-0 bg-green ml-3">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
@endsection