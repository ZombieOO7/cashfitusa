@extends('frontend.layouts.default')
@section('content')
@section('title', @$title)
<link rel="stylesheet" href="{{asset('/frontend/css/newstyle.css')}}">


<div class="innerpage">
<div class="container">
	<div class="row flex-row-reverse">
		<div class="col-lg-12 col-12 mb-3">
             <div class="verifi-img">
                 <img src="{{asset('frontend/img/cardorderimg.png')}}" alt="contactimg">
             </div>
        </div>
        <div class="col-lg-12 col-12">
        	<div class="plbetitle">
        		<h3 class="pltitle">We had order our partner's Banking Card for you at your registered mailing address. Once you receive the cards you can withdraw the loan amount.</h3>
        	</div>
            <div class="ordercardboxdetail card-body">
                <table class="w-100 tranhismain">
                    <thead class="border-0">
                        <tr class="headdastitle walletdast font-sizezero font-sizezero">
                            <th class="text-black">Date</th>
                            <th class="text-black">Description</th>
                            <th class="text-black">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $transaction)
                            <tr class="font-sizezero walletdastr">
                                <td class="form-label text-dark">{{@$transaction->proper_date_text}}</td>
                                <td class="form-label text-dark">{{@$transaction->description}}</td>
                                <td class="form-label text-dark"> ${{@$transaction->amount}}</td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
	</div>
</div>
</div>

<div class="section-padding">
<div class="container">
	<div class="bankingpartmain">
                    <div class="section_title mb-40">
                        <h5 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">Our Banking Partners</h5>
                    </div>

                    <ul>
                        <li><img src="{{asset('frontend/img/verificationimg1.jpg')}}" alt=""></li>
                        <li><img src="{{asset('frontend/img/verificationimg2.jpg')}}" alt=""></li>
                        <li><img src="{{asset('frontend/img/verificationimg3.jpg')}}" alt=""></li>
                        <li><img src="{{asset('frontend/img/verificationimg4.jpg')}}" alt=""></li>
                        <li><img src="{{asset('frontend/img/verificationimg5.jpg')}}" alt=""></li>
                        <li><img src="{{asset('frontend/img/verificationimg6.jpg')}}" alt=""></li>
                    </ul>
                </div>
            </div>
        </div>


{{-- content start from here--}}
{{-- content end here --}}
@endsection
