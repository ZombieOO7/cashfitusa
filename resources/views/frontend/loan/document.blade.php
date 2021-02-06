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
    .form-control-feedback{
        color: #f4516c;
    }
    .dz-image {
        width: auto !important;
        height: auto !important;
    }

    .dz-image img{
        width: 150px !important;
        height: 150px !important;
    }
    p{
        font-weight: normal !important;
    }
    .dropzone .dz-preview .dz-error-message {
        top: 40px !important;
        left:5px!important;
    }

</style>
@endsection
@section('title', 'Upload Documents')
@php
$user = Auth::guard('web')->user();
@endphp
<section class="loan-process-section section-padding pt-100"  style="background-color:#fff;">
    <div class="container">
        <div class='m-form m-form--fit '>
        <form id='m_form_1'>
        <div class="row col-md-12">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12 text-left">
                        <div class="section_title text-left">
                            <h2 class="pb-0">Document Upload</h2>
                            <span style="background: #000 !important;"></span>
                        </div>
                    </div>
                </div>
                @if(!isset($frontLicence) || !isset($backLicence) || !isset($addressProof) || !isset($selfie))
                <div class="mt-20 mb-20">
                    <div class="alert alert-dismissible fade show text-white" style="background-color: #f4516c;" role="alert">
                        <a href="javascript:;" class="text-white" style="text-decoration: none;"><span class="fa fa-bell mr-2"></span> Document upload is still pending !</a>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true" class="text-white font-weight-normal">x</span>
                        </button>
                    </div>
                </div>
                @elseif(($frontLicence->status==0) || ($backLicence->status==0) || ($addressProof->status==0) || ($selfie->status==2))
                <div class="mt-20 mb-20">
                    <div class="alert alert-dismissible fade show text-white" style="background-color: #f4516c;" role="alert">
                        <a href="#" class="text-white" style="text-decoration: none;"><span class="fa fa-bell mr-2"></span> Document verification pending !</a>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true" class="text-white font-weight-normal">x</span>
                        </button>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-md-12 row">
                <div class="col-md-6 form-group">
                    <label class="col-form-label text-dark m--font-boldest">Upload Driving License or State ID Card Front *</label>
                    <div class="">
                        <div class="m-dropzone dropzone m-dropzone--primary" action="{{route('store.loan.document',['type'=>1])}}" id="m-dropzone-one" data-status="{{@$frontLicence->status}}"  data-url='{{@$frontLicence->image_path}}' data-size={{@$frontLicence->size}}>
                            <div class="m-dropzone__msg dz-message needsclick">
                                <a href='javascript:;' id='frontLicence' class="btn btn-primary text-white" type='button'>BROWSE</a>
                                <h3 class="m-dropzone__msg-title">Drop files here or click to upload.</h3>
                                <span class="m-dropzone__msg-desc"></span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="front_licence">
                    <span class="frontLicence"></span>
                </div>
                <div class="col-md-6 form-group">
                    <label class="col-form-label text-dark m--font-boldest">Upload Driving License or State ID Card Back *</label>
                    <div class="">
                        <div class="m-dropzone dropzone m-dropzone--primary" action="{{route('store.loan.document',['type'=>2])}}" id="m-dropzone-two" data-status="{{@$backLicence->status}}"  data-url='{{@$backLicence->image_path}}' data-size={{@$backLicence->size}}>
                            <div class="m-dropzone__msg dz-message needsclick">
                                <a href='javascript:;' id='frontLicence' class="btn btn-primary text-white" type='button'>BROWSE</a>
                                <h3 class="m-dropzone__msg-title">Drop files here or click to upload.</h3>
                                <span class="m-dropzone__msg-desc"></span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="back_licence">
                    <span class="backLicence"></span>
                </div>
                <div class="col-md-6 form-group">
                    <label class="col-form-label text-dark m--font-boldest">Upload Your Proof of Address (Statement of Credit Card, Water Bill, Bank statement) *</label>
                    <div class="">
                        <div class="m-dropzone dropzone m-dropzone--primary" action="{{route('store.loan.document',['type'=>3])}}" id="m-dropzone-three" data-status="{{@$addressProof->status}}"  data-url='{{@$addressProof->image_path}}' data-size={{@$addressProof->size}}>
                            <div class="m-dropzone__msg dz-message needsclick">
                                <a href='javascript:;' id='frontLicence' class="btn btn-primary text-white" type='button'>BROWSE</a>
                                <h3 class="m-dropzone__msg-title">Drop files here or click to upload.</h3>
                                <span class="m-dropzone__msg-desc"></span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="address_proof">
                    <span class="addressProof"></span>
                </div>
                <div class="col-md-6 form-group">
                    <label class="col-form-label text-dark m--font-boldest">Upload a Selfie *</label>
                    <div class="">
                        <div class="m-dropzone dropzone m-dropzone--primary" action="{{route('store.loan.document',['type'=>4])}}" id="m-dropzone-four" data-status="{{@$selfie->status}}"  data-url='{{@$selfie->image_path}}' data-size={{@$selfie->size}}>
                            <div class="m-dropzone__msg dz-message needsclick">
                                <a href='javascript:;' id='frontLicence' class="btn btn-primary text-white" type='button'>BROWSE</a>
                                <h3 class="m-dropzone__msg-title">Drop files here or click to upload.</h3>
                                <span class="m-dropzone__msg-desc"></span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="selfie">
                    <span class="selfieError"></span>
                </div>
            </div>
        </div>
        <div class="m-form__group form-group row">
            <div class="col-md-5"></div>

            <div class="m-checkbox-list">
                <label class="m-checkbox">
                    <input type="checkbox" name="term_and_condition"> Accept Loan 
                    <a href="javascript:;" data-target="#m_modal_3" data-toggle="modal">Terms and conditions</a>
                    <span></span>
                    <span class="tnc"></span>   
                </label>
            </div>
        </div>
        <div class="text-center">
            <button class="col-md-2 rounded-0 btn btn-success bg-green mb-3" type="submit">Continue</a>
            {{-- <a href="" class="col-md-2 rounded-0 btn btn-success bg-green" role="button">Continue</a> --}}
        </div>
        </form>
    </div>
</section>
@php
    $loanId = @$loan_id;
@endphp
@section('front_script')
<script>
    var loanId = '{{$loanId}}';
    var url = "{{route('application')}}";
</script>
<script src="{{ asset('js/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/scripts.bundle.js') }}" type="text/javascript"></script>
<script src="{{asset('js/dropzone.js')}}"></script>
<script src="{{ asset('frontend/js/loan/document.js')}}"></script>
@endsection
@endsection