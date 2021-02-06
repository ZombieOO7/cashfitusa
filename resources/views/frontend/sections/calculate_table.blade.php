<!-- <style>
.table-responsive {
    display: table;
}
</style> -->
<section class="loan-process-section section-padding pt-100"
    style="background-image: url({{asset('images/group2.png')}});background-repeat:no-repeat;background-color:#fff;">
    <div class="container" style="">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section_title text-center mb-90">
                    <h3 class="wow fadeInUp text-white" data-wow-duration="1s" data-wow-delay=".2s">Personal Loan
                        Calculator</h3>
                    <span class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s"
                        style="background: #FFF !important;"></span>
                    <p class="text-white">Personal Loans are a way to meet financial needs during an emergency. It is an
                        unsecured loan and can be used for marriage expenses, paying the medical bills, going for your
                        dream vacation or renovating your home. Irrespective of what your personal financial goals are,
                        Personal Loan offers you the perfect solution.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="packmain">
    <div class="container">
        <div class="packsec">
            <div class="packlist">
                @php $i = 1;@endphp
                @forelse(@$tableData as $key => $data)
                    <div class="packcol">
                        <div class="packbox">
                            <div class="digiboxtitle">
                                <h5 class="resisolartitle">Loan Amount</h5>
                                <h3 class="resisolarkwtitle">{{config('constant.currency_symbol').@$data['amount']}}</h3>
                            </div>
                            <div class="tabmar">
                                <div class="digimarpacstar">
                                    <ul class="resisolarpack">
                                        <li class="packinfo">Month</li>
                                        <li class="resisolardetail"><span>{{@$data['months']}}</span> ({{@$i}} year)</li>
                                        <li class="packinfo">Rate of Interest P.A [FYI]</li>
                                        <li class="resisolardetail"><span>{{@$data['per']}}</span></li>
                                        <li class="packinfo">Repayment Per Month</li>
                                        <li class="resisolardetail"><span>{{config('constant.currency_symbol').$data['returnPerMonth'].' / month'}}</span></li>
                                    </ul>
                                </div>
                                <div class="requaquotebtn">
                                    {{ Form::open(['route' => 'apply.loan.post','method'=>'post','class'=>'','id'=>'m_form_1']) }}
                                    {!! Form::hidden('amount',@$data['amount']) !!}
                                    {!! Form::hidden('months',@$data['months']) !!}
                                    {!! Form::hidden('returnPerMonth',@$data['returnPerMonth']) !!}
                                    <button type="submit" class="btn" title="Request a Quote"><i class="fa fa-check mr-1"></i>
                                        Select</button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    @php $i++; @endphp
                @empty
                @endforelse
        </div>
    </div>
</section>