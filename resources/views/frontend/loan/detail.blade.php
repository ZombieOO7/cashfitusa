@extends('frontend.layouts.default')
@section('content')
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
<link href="{{ asset('backend/dist/default/assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('backend/dist/default/assets/demo/default/base/style.bundle.css') }}" rel="stylesheet"
    type="text/css" />
<style>
    .form-label{
        font-size: 16px;
    }
    .h6{
        font-size: 16px;
    }
    p{
        font-weight: normal !important;
    }
</style>
@endsection
@section('title', 'Applications')
@php
$userData = Auth::guard('web')->user();
$userDocument = $user->loanDocuments;
@endphp
<form id='myForm1'>
<section class="loan-process-section section-padding"  style="background-color:#fff;">
    <div class="container">
        <div class="row">
            @if(!isset($frontLicence) || !isset($backLicence) || !isset($addressProof) || !isset($selfie))
            <div class="col-md-8 mt-20 mb-20">
                <div class="alert alert-dismissible fade show text-white" style="background-color: #f4516c;" role="alert">
                    <a href="javascript:;" class="text-white" style="text-decoration: none;"><span class="fa fa-bell mr-2"></span> Document upload is still pending !</a>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" class="text-white font-weight-normal">x</span>
                    </button>
                </div>
            </div>
            @elseif(($frontLicence->status==0) || ($backLicence->status==0) || ($addressProof->status==0) || ($selfie->status==2))
            <div class="col-md-8 mt-20 mb-20">
                <div class="alert alert-dismissible fade show text-white" style="background-color: #f4516c;" role="alert">
                    <a href="#" class="text-white" style="text-decoration: none;"><span class="fa fa-bell mr-2"></span> Document verification pending !</a>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" class="text-white font-weight-normal">x</span>
                    </button>
                </div>
            </div>
            @endif
        </div>
        <div class="text-center">
                        <div class="section_title headtitle">
                            <h2 class="pb-0">Contact Detail</h2>
                            <span style="background: #fff !important;"></span>
                        </div>
                    </div>
        <div class="row">
            <div class="col-md-4 mt-5 imgshowmb">
                <img class="w-100" src="{{asset('images/detail.svg')}}" alt="">
            </div>
            <div class="col-md-4 mt-5 imgshowds">
                <img class="w-100" src="{{asset('images/detail.svg')}}" alt="">
            </div>
            <div class="col-md-8 condetcol">
                <div class="row">
                    <!-- <div class="col-md-12 text-center">
                        <div class="section_title">
                            <h2 class="pb-0">Contact Detail</h2>
                            <span style="background: #000 !important;"></span>
                        </div>
                    </div> -->
                </div>
                <div class="row mt-2 from-group">
                    <div class="col-lg-4">
                        <div class="form-label text-gray font-weight-normal mb-2">First Name</div>
                        <div class="h6">{{@$user->first_name}}</div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-label text-gray font-weight-normal mb-2">Middle Name</div>
                        <div class="h6">{{@$user->first_name}}</div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-label text-gray font-weight-normal mb-2">Last Name</div>
                        <div class="h6">{{@$user->last_name}}</div>
                    </div>
                </div>
                <div class="row mt-2 from-group">
                    <div class="col-lg-4">
                        <div class="form-label text-gray font-weight-normal mb-2">Phone Number.</div>
                        <div class="h6">{{@$user->phone1}}</div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-label text-gray font-weight-normal mb-2">Home Phone Number.</div>
                        <div class="h6">{{@$user->phone2}}</div>
                    </div>
                </div>
                <div class="row mt-2 from-group">
                    <div class="col-lg-4">
                        <div class="form-label text-gray font-weight-normal mb-2">Address Line 1</div>
                        <div class="h6">{{@$user->address1}}</div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-label text-gray font-weight-normal mb-2">Address Line 2</div>
                        <div class="h6">{{@$user->address2}}</div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-label text-gray font-weight-normal mb-2">City</div>
                        <div class="h6">{{@$user->city}}</div>
                    </div>
                </div>
                <div class="row mt-2 from-group">
                    <div class="col-lg-4">
                        <div class="form-label text-gray font-weight-normal mb-2">State</div>
                        <div class="h6">{{@$user->state}}</div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-label text-gray font-weight-normal mb-2">Zipcode</div>
                        <div class="h6">{{@$user->zip_code}}</div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-label text-gray font-weight-normal mb-2">Time Of Residency</div>
                        <div class="h6">{{@config('constant.residency_year')[$user->time_of_residency]}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="loan-process-section section-padding"  style="background-color:#fff;">
    <div class="container">
        <div class="text-center">
                        <div class="section_title headtitle">
                            <h2 class="pb-0">Bank Detail</h2>
                            <span style="background: #fff !important;"></span>
                        </div>
                    </div>
        <div class="row">
            <div class="col-md-4 mt-5 imgshowmb">
                <img class="w-100" src="{{asset('images/bankdetailsimg.svg')}}" alt="">
            </div>
            <div class="col-md-4 mt-5 imgshowds">
                <img class="w-100" src="{{asset('images/bankdetailsimg.svg')}}" alt="">
            </div>
            <div class="col-md-8 condetcol">
                <div class="row">
                    <!-- <div class="col-md-12 text-center">
                        <div class="section_title">
                            <h2 class="pb-0">Contact Detail</h2>
                            <span style="background: #000 !important;"></span>
                        </div>
                    </div> -->
                </div>
               <!--  <div class="row mt-50">
                    <div class="col-md-12 text-center">
                        <div class="section_title">
                            <h2 class="pb-0">Bank Detail</h2>
                            <span style="background: #000 !important;"></span>
                        </div>
                    </div>
                </div> -->
                <div class="row mt-2 from-group">
                    <div class="col-lg-4">
                        <div class="form-label text-gray font-weight-normal mb-2">Bank Name</div>
                        <div class="h6">{{@$user->bank_name}}</div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-label text-gray font-weight-normal mb-2">Type Of Account</div>
                        <div class="h6">{{@config('constant.account_type')[$user->account_type]}}</div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-label text-gray font-weight-normal mb-2">Loan Type</div>
                        <div class="h6">{{@config('constant.account_type')[$user->loan_type]}}</div>
                    </div>
                </div>
                <div class="row mt-2 from-group">
                    <div class="col-lg-4">
                        <div class="form-label text-gray font-weight-normal mb-2">Account Number</div>
                        <div class="h6">{{@$user->account_number}}</div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-label text-gray font-weight-normal mb-2">Routing Number</div>
                        <div class="h6">{{@$user->routing_number}}</div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-label text-gray font-weight-normal mb-2">Bank Address</div>
                        <div class="h6">{{@$user->bank_address}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@if(count($user->loanDocuments) == count($user->pendingDocuments))
@elseif(count($user->rejectedDocuments) > 0)
@else
<section class="loan-process-section section-padding"  style="background-color:#fff;">
    <div class="container">
        <div class="text-center">
                        <div class="section_title headtitle">
                            <h2 class="pb-0">Documents</h2>
                            <span style="background: #fff !important;"></span>
                        </div>
                    </div>
        <div class="row">
            <div class="col-md-4 mt-5 imgshowmb">
                <img class="w-100" src="{{asset('images/detail.svg')}}" alt="">
            </div>
            <div class="col-md-4 mt-5 imgshowds">
                <img class="w-100" src="{{asset('images/detail.svg')}}" alt="">
            </div>
            <div class="col-md-8 condetcol">
                <div class="row mt-2 from-group">
                    <div class="col-lg-6 col-6 mb-2">
                        <div class="form-label text-gray font-weight-normal mb-2">Driving Licence Front</div>
                        <div class="">
                            @php
                                $ext = strtolower(pathinfo(@$frontLicence->image_path, PATHINFO_EXTENSION));
                            @endphp
                            @if($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg')
                            <img id="flicenceImg" src="{{@$frontLicence->image_path}}" alt="" width= "150px";
                            height= "150px"; style="{{ isset($frontLicence->image_path) ? 'display:block;' : 'display:none;' }}" />
                            @else
                                <img id="flicenceImg" src="{{asset('images/pdf.jpeg')}}" alt="" width= "150px"; height= "150px"; style="{{ isset($frontLicence->image_path) ? 'display:block;' : 'display:none;' }}" />
                            @endif
                            @if($frontLicence != null && @$frontLicence->image_path != null)
                            <div class="mt-2">
                                <a href='{{@$frontLicence->image_path}}' role="button" class="btn m-btn--square  btn-outline-info m-btn m-btn--custom text-brand" title='Download' download><span class=" fa fa-download"></span></a>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-6 mb-2">
                        <div class="form-label text-gray font-weight-normal mb-2">Driving Licence Back</div>
                        <div class="">
                            @php
                                $ext2 = strtolower(pathinfo(@$backLicence->image_path, PATHINFO_EXTENSION));
                            @endphp
                            @if($ext2 == 'jpg' || $ext2 == 'png' || $ext2 == 'jpeg')
                            <img id="flicenceImg" src="{{@$backLicence->image_path}}" alt="" width= "150px";
                            height= "150px"; style="{{ isset($backLicence->image_path) ? 'display:block;' : 'display:none;' }}" />
                            @else
                                <img id="flicenceImg" src="{{asset('images/pdf.jpeg')}}" alt="" width= "150px"; height= "150px"; style="{{ isset($backLicence->image_path) ? 'display:block;' : 'display:none;' }}" />
                            @endif
                            @if($backLicence != null && @$backLicence->image_path != null)
                            <div class="mt-2">
                                <a href='{{@$backLicence->image_path}}' role="button" class="btn m-btn--square  btn-outline-info m-btn m-btn--custom text-brand" title='Download' download><span class=" fa fa-download"></span></a>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-6 mb-2">
                        <div class="form-label text-gray font-weight-normal mb-2">Address Proof</div>
                        <div class="">
                            @php
                                $ext3 = strtolower(pathinfo(@$addressProof->image_path, PATHINFO_EXTENSION));
                            @endphp
                            @if($ext3 == 'jpg' || $ext3 == 'png' || $ext3 == 'jpeg')
                            <img id="flicenceImg" src="{{@$addressProof->image_path}}" alt="" width= "150px";
                            height= "150px"; style="{{ isset($addressProof->image_path) ? 'display:block;' : 'display:none;' }}" />
                            @else
                                <img id="flicenceImg" src="{{asset('images/pdf.jpeg')}}" alt="" width= "150px"; height= "150px"; style="{{ isset($addressProof->image_path) ? 'display:block;' : 'display:none;' }}" />
                            @endif
                            @if($addressProof != null && @$addressProof->image_path != null)
                            <div class="mt-2">
                                <a href='{{@$addressProof->image_path}}' role="button" class="btn m-btn--square  btn-outline-info m-btn m-btn--custom text-brand" title='Download' download><span class=" fa fa-download"></span></a>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-6 mb-2">
                        <div class="form-label text-gray font-weight-normal mb-2">Selfie</div>
                        <div class="">
                            @php
                                $ext4 = strtolower(pathinfo(@$selfie->image_path, PATHINFO_EXTENSION));
                            @endphp
                            @if($ext4 == 'jpg' || $ext4 == 'png' || $ext4 == 'jpeg')
                            <img id="flicenceImg" src="{{@$selfie->image_path}}" alt="" width= "150px";
                            height= "150px"; style="{{ isset($selfie->image_path) ? 'display:block;' : 'display:none;' }}" />
                            @else
                                <img id="flicenceImg" src="{{asset('images/pdf.jpeg')}}" alt="" width= "150px"; height= "150px"; style="{{ isset($selfie->image_path) ? 'display:block;' : 'display:none;' }}" />
                            @endif
                            @if($selfie != null && @$selfie->image_path != null)
                            <div class="mt-2">
                                <a href='{{@$selfie->image_path}}' role="button" class="btn m-btn--square  btn-outline-info m-btn m-btn--custom text-brand" title='Download' download><span class=" fa fa-download"></span></a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<section class="loan-process-section section-padding"  style="background-color:#fff;">
    <div class="container">
        <div class="col-md-12 text-center">
                        <div class="section_title headtitle">
                            <h2 class="pb-0">Loan Amount</h2>
                            <span style="background: #fff !important;"></span>
                        </div>
                    </div>
        <div class="row">
            <div class="col-md-4 mt-5 imgshowmb">
                <img class="w-100" src="{{asset('images/Finance-cuate.svg')}}" alt="">
            </div>
            <div class="col-md-4 mt-5 imgshowds">
                <img class="w-100" src="{{asset('images/Finance-cuate.svg')}}" alt="">
            </div>
            <div class="col-md-8 condetcol">
                <div class="row">
                </div>
                <div class="row mt-40 from-group">
                    <div class="col-lg-4">
                        <div class="h4 text-gray font-weight-normal">{{config('constant.currency_symbol').@$user->loan_amount ?? 0}}</div>
                    </div>
                    <div class="col-lg-4">
                        <div class="h4 text-gray font-weight-normal">{{@$user->months ?? 0}} Months</div>
                    </div>
                    <div class="col-lg-4">
                        <div class="h4" style="color:red;">{{config('constant.currency_symbol').@$user->repayment_amount ?? 0}} / Month</div>
                    </div>
                    <div class="col-lg-4">
                        <div class="h4 text-gray font-weight-normal" >{{@config('constant.loan_type')[$user->loan_type]}}</div>
                    </div>
                </div>
                <div class="row mt-40 from-group">
                    <div class="col-md-4"></div>
                    <div class="col-lg-4">
                        @if($user->status == 2)
                            <div class="h3 text-danger">Loan Rejected</div>
                        @else
                            <div class="text-success ml-2">
                                <div class="row">
                                    <img class="" src="{{asset('images/approved.svg')}}" alt="" style="width:40px;height:40px;">
                                    <div class="mt-2 ml-3 h5">Loan Approved</div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                @if($user->status == 2)
                    <div class="row mt-2 from-group">
                        <div class="col-lg-4">
                            <div class="form-label text-gray font-weight-normal mb-2">Reason</div>
                            <div class="h6">{{@$user->reason}}</div>
                        </div>
                    </div>
                @endif
                <div class="m-form__group form-group row  mt-40">
                    <div class="col-md-4"></div>
                    <div class="col-md-6">
                        <div class="m-checkbox-list">
                            <label class="m-checkbox">
                                <input type="checkbox" name="term_and_condition"> Accept Loan 
                                <a href="{{route('terms-of-use')}}">Terms and conditions</a>
                                <span></span>
                                <span class="tnc"></span>
                            </label>
                            <label class="m-checkbox m-checkbox">
                                <input type="checkbox" name="privacy"> Accept 
                                <a href="{{route('security-privacy')}}">Security & Privacy</a>
                                <span></span>
                                <span class="privacy"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-40">
                    <button type="submit" class="btn btn-success rounded-0 btn-xl w-25 bg-green">Continue</button>
                </div>
            </div>
        </div>
    </div>
</section>
</form>



@php
$flag = 'true';
if($frontLicence==null || @$frontLicence->status==0 || $backLicence==null  || @$backLicence->status==0 || $addressProof==null || @$addressProof->status==0 || $selfie==null || @$selfie->status==0){
    $flag = 'false';
}
@endphp
@stop
@section('front_script')
<script src="{{ asset('backend/dist/default/assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/dist/default/assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>
<script>
    var url ="{{route('upload.document',['loan_id'=>$user->uuid])}}";
    var downloadCerti ="{{ URL::signedRoute('application.download',['uuid'=>@$user->uuid]) }}";
    flag = '{{$flag}}';
    // var url ="{{route('upload.document',['loan_id'=>$user->uuid])}}";
    $('#myForm1').validate({ 
        rules:{
            term_and_condition:{
                required: true,
            },
            privacy:{
                required: true,
            }
        },
        errorPlacement: function (error, element) {
            if(element.attr("name") == 'term_and_condition'){
                error.insertAfter('.tnc');
            } else if(element.attr("name") == 'privacy'){
                error.insertAfter('.privacy');
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            if (!this.beenSubmitted) {
                this.beenSubmitted = true;
                if(flag =='true'){
                    window.location.replace(downloadCerti);
                }else{
                    window.location.replace(url);
                }
            }
        },
    });
</script>
@endsection