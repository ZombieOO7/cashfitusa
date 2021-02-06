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
    p{
        font-weight: normal !important;
    }
</style>
@endsection
@section('title', 'Applications')
<section class="loan-process-section section-padding pt-100"  style="background-color:#fff;">
    <div class="container">
        <form id='myForm1'>
        <div class="row col-md-12">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12 text-left">
                        <div class="section_title text-left">
                            <h2 class="pb-0">Please Confirm Your Identification</h2>
                            <span style="background: #000 !important;"></span>
                        </div>
                    </div>
                </div>
                <div class="mt-40">
                    {!! @$content->page_content !!}
                </div>
                <div class="m-form__group form-group  mt-40">
                    <div class="m-checkbox-list">
                        <label class="m-checkbox">
                            <input type="checkbox" name="term_and_condition"> Accept Loan 
                            <a href="javascript:;" data-target="#m_modal_3" data-toggle="modal">Terms and conditions</a>
                            <span></span>
                            <span class="tnc"></span>   
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-40">
            <button class="col-md-2 btn btn-success rounded-0 bg-green" type="submit">Continue</button>
        </div>
        </form>
    </div>
</section>
@endsection
@section('front_script')
<script src="{{ asset('backend/dist/default/assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/dist/default/assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontend/js/loan/document.js')}}"></script>
<script>
    var url ="{{route('upload.document',['loan_id'=>$uuid])}}";
    $('#myForm1').validate({ 
        rules:{
            term_and_condition:{
                required: true,
            },
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
                window.location.replace(url);
            }
        },
    });
</script>
@endsection