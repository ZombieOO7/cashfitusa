@extends('frontend.layouts.default')
@section('content')
@section('title', 'Contact Us')
<link rel="stylesheet" href="{{asset('/frontend/css/newstyle.css')}}">
    <div class="container mt-20 mb-20">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
            <form id="m_form_1" action="{{route('post.contact-us')}}" method="post">
                @csrf
                <h2>Contact Us</h2>
                <div class="row">
                    @if ($message = Session::get('message'))
                        <div class="col-md-9">
                            <div class="alert alert-dismissible fade show text-white bg-green" role="alert">
                                <a href="#" class="text-white" style="text-decoration: none;"><span class="fa fa-check mr-2"></span>{{ $message }}</a>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true" class="text-white font-weight-normal">x</span>
                                </button>
                            </div>
                        </div>
                    @endif
                    @if ($message = Session::get('error'))
                        <div class="col-md-9">
                            <div class="alert alert-dismissible fade show text-white" style="background-color: #f4516c;" role="alert">
                                <a href="#" class="text-white" style="text-decoration: none;">{{ $message }}</a>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true" class="text-white font-weight-normal">x</span>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="first">Full Name</label>
                            <input type="text" name="full_name" class="form-control" placeholder="Full Name" id="first" maxlength="{{config('constant.name_length')}}">
                        </div>
                    </div>
                    <!--  col-md-6   -->
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="email" maxlength="{{config('constant.email_length')}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email">Subject</label>
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" maxlength="{{config('constant.email_length')}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="phone">Message</label>
                            <textarea class="form-control" name="message" placeholder="Message" maxlength="{{config('constant.text_length')}}"></textarea>
                        </div>
                    </div>
                    <!--  col-md-6   -->
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
         <div class="col-lg-6 col-md-6 col-12">
             <div class="cont-img">
                 <img src="{{asset('frontend/img/about/contact-img.png')}}" alt="contactimg">
             </div>
         </div>
        </div>
    </div>
@endsection
    @section('front_script')
    <script>
        var rule = $.extend({}, {!!json_encode(config('constant'), JSON_FORCE_OBJECT) !!});
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrfToken"]').attr('content')}
        });
        $("#m_form_1").validate({
            rules: {
                full_name:{
                    required: true,
                    maxlength: rule.name_length,
                    noSpace: true,
                },
                email:{
                    email:true,
                    required: true,
                    maxlength: rule.email_length,
                    noSpace: true,
                },
                subject:{
                    required: true,
                    maxlength: rule.name_length,
                    noSpace: true,
                },
                message:{
                    required: true,
                    maxlength: rule.name_length,
                    noSpace: true,
                }
            },
            ignore: [],
            errorPlacement: function (error, element) {
                if(element.attr('name')=='phone'){
                    error.insertAfter('.phoneError');
                }else{
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {
                if (!this.beenSubmitted) {
                    this.beenSubmitted = true;
                    form.submit();
                }
            },
        });
    </script>
@endsection

