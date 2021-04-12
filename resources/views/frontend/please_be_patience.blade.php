@extends('frontend.layouts.default')
@section('content')
@section('title', @$title)
<link rel="stylesheet" href="{{asset('/frontend/css/newstyle.css')}}">

<div class="innerpage">
<div class="container">
	<div class="row flex-row-reverse">
		<div class="col-lg-12 col-12 mb-3">
             <div class="verifi-img">
                 <img src="{{asset('frontend/img/plebepatieimg.png')}}" alt="contactimg">
             </div>
        </div>
        <div class="col-lg-12 col-12">
        	<div class="plbetitle">
        		<h3 class="pltitle">Please Be Patience We Are Working On Your Application.</h3>
        	</div>
        </div>
	</div>
</div>
</div>

	<!-- start testinomial section -->
    @include('frontend.sections.testinomial') 
    <!-- end of testinomial process section -->


{{-- content start from here--}}
{{-- content end here --}}
@endsection
