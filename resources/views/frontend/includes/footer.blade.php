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
            <div class="row">
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
                            <li><a href="{{route('earning')}}">Remote Working </a></li>
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
            </div>
            <div class="row mt-2 mb-2">
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
            </div>
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
                        <p class="text-justify">
                            Email : Support@RapidCashAmerica.com <br/>
                            Phone : +1(216)-232-6665
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
