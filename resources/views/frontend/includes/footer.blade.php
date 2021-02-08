<div class="modal fade" id="m_modal_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Privacy Policy</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="m-scrollable m-scroller ps ps--active-y" data-scrollbar-shown="true" data-scrollable="true" data-height="200" style="height: 200px; overflow: hidden;">
                    {!! privacyPolicy() !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="m_modal_3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Term and Condition</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="m-scrollable m-scroller ps ps--active-y" data-scrollbar-shown="true" data-scrollable="true" data-height="200" style="height: 200px; overflow: hidden;">
                    {!! termAndCondition() !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="footer_top">
        <div class="container">

            <hr>
            <div class="row">
                <div class="col-xl-6 col-lg-12 col-md-12 col-12 fooinfocol">
                    <div class="row">
                    <div class="col-lg-6 col-12">
                    <div class="fooconinfo">
                        <div class="coninfoemail">
                            <span><i class="icon fa fa-building"></i><p>600 SUPERIOR AVE. EAST, FIFTH THIRD BUILDING, SUITE 1300, CLEVELAND, OHIO, 44114</p></span>
                            </div>
                            <div class="coninfoemail">
                            <span><i class="icon fa fa-user"></i><a href="mailto:Support@RapidCashAmerica.com">Support@RapidCashAmerica.com</a></span>
                            </div>
                            <div class="coninfoemail">
                            <span><i class="icon fa fa-phone"></i><a href="tel:+1(216)-232-6665">+1(216)-232-6665</a></span>
                            </div>
                    </div>
                    <div class="footlogoimg">
                        <span class="d-block"><img src="{{asset('frontend/img/about/footlogoimg1.png')}}" alt="sitereflogo" width="140"></span>
                        <span><img src="{{asset('frontend/img/about/footlogoimg2.png')}}" alt="sitereflogo" width="140"></span>
                        <span><img src="{{asset('frontend/img/about/footlogoimg3.png')}}" width="80" alt="sitereflogo"></span>
                    </div>
                </div>

                <div class="col-lg-6 col-12">
                    <div class="footlogoimg footmapimg">
                        <span class="footlogo d-block"><img src="{{asset('frontend/img/about/footlogo.png')}}" alt="logo" width="140"></span>
                        <span><img src="{{asset('frontend/img/about/footmapimg.png')}}" width="100%" alt="sitelogo"></span>
                    </div>
                </div>
            </div>

                </div>
                <div class="col-xl-6 col-lg-12 col-md-12 col-12">
                    <div class="row">
                        <div class="col-6">
                            <div class="footBox footboxone">
                        <h3 class="footTitle">Services</h3>
                        <div class="footBoxCon">
                            <div class="menu-footer">
                                <ul>
                                    <li class="menu-item"><a class="text-white" href="{{route('loan.detail')}}" title="Apply For Loan">Apply For Loan</a></li>
                                    <li class="menu-item"><a class="text-white" href="{{route('work-from-home')}}" title="Remote Working">Remote Working</a></li>
                                    <li class="menu-item"><a class="text-white" href="{{route('get.contact-us')}}" title="Contact Us">Contact Us</a></li>
                                    <li class="menu-item"><a class="text-white" href="{{route('get.about-us')}}" title="About Us">About Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                        </div>
                        <div class="col-6">
                            <div class="footBox">
                        <h3 class="footTitle">Legal</h3>
                        <div class="footBoxCon">
                            <div class="menu-footer">
                                <ul>
                                    <li class="menu-item"><a class="text-white" href="{{route('terms-of-use')}}" title="Terms of Use">Terms of Use</a></li>
                                    <li class="menu-item"><a class="text-white" href="{{route('security-privacy')}}" title="Security and Privacy">Security and Privacy</a></li>
                                    <li class="menu-item"><a class="text-white" href="{{route('accessibility')}}" title="Accessibility">Accessibility</a></li>
                                    <li class="menu-item"><a class="text-white" href="#" title="Do Not Sell My Information">Do Not Sell My Information</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                        </div>
                    </div>
                    
                </div>
            </div>

           <!--  <div class="row">
                <div class="col-xl-3 col-md-6 col-lg-3 col-6">
                    <div class="footer_widget">
                        {{-- <h3 class="footer_title">
                            Loan
                        </h3> --}}
                        <ul>
                            <li><a href="{{route('loan.detail')}}">Apply For Loan </a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-lg-2 col-6">
                    <div class="footer_widget">
                        <ul>
                            <li><a href="{{route('work-from-home')}}">Remote Working </a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-lg-2 col-6 uppaddcol">
                    <div class="footer_widget">
                        <ul>
                            <li><a href="{{route('get.contact-us')}}">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-lg-4 col-12 uppaddcol">
                    <div class="footer_widget">
                        <ul>
                            <li><a href="{{route('get.about-us')}}">About Us</a></li>
                        </ul>
                    </div>
                </div>
            </div> -->
            <!-- <div class="row mt-2 mb-2">
                <div class="col-xl-3 col-md-6 col-lg-4 col-12 uppaddcol">
                    <div class="footer_widget">
                        <ul>
                            <li><a href="{{route('terms-of-use')}}">Terms Of Use</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-lg-4 col-12 uppaddcol">
                    <div class="footer_widget">
                        <ul>
                            <li><a href="{{route('security-and-privacy')}}">Security And Privacy</a></li>
                        </ul>
                    </div>
                </div>
            </div> -->
            <hr>
            <div class="row">
                <div class="col-xl-12">
                    <div class="footer_widget">
                        <h3 class="footer_title text-center">
                            Disclaimer
                        </h3>
                        <p class="text-justify">
                            We request people facing serious financial difficulties to consider other alternatives or seek out professional financial advice instead of applying for loans.
                        </p>
                        <p class="text-justify">
                            RapidCashAmericais not responsible for making loan or credit decisions. 
                        </p>
                        <p class="text-justify">
                            By submitting your information via this website, you are authorizing RapidCashAmerica and its partners to do a credit check, which may include verifying your social security number, driver license number or other identification, and a review of your creditworthiness. 
                        </p>
                        <p class="text-justify">
                            Avoid Late Payments to Protect Your Credit Score
                            Every loan that is approved will have terms and conditions for repayment as well as late payments. Please take a note that any missing payment or making a late payment can negatively impact your credit score. We request you to thoroughly study the terms and conditions, to protect yourself and your credit history, and then only accept loan terms that you can afford to repay. In case of any delays regarding the payments, we request you to immediately bring the same to our notice.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-right_text">
            <div class="container">
                <div class="footer_border"></div>
                <div class="row">
                    <div class="col-xl-12">
                        <p class="copy_right text-center mt-3   ">
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> 
                       <a href="#" class="comlink">{{env('app_name')}}</a> All rights reserved
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
