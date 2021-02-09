@extends('frontend.work.layout.default')
@section('title', 'Work From Home')
@section('app-content')
<style>
.dataTables_empty{
   text-align: center;
}
</style>
@php
    $appList = appList();
@endphp
<div class="col-lg-9 col-12 mt-3">
    <div class="tab-content">
        <div class="card">
            @if(count($appList)>0)
                @if($earning == null)
                    <div id="getStart" style="display:{{(@$earning!=null)?'none':''}};">
                        <div class="col-md-12 text-center">
                            <div class="text-center mb-30 mt-30">
                                <h3 class="font-weight-bold" >How It Works</h3>
                                <div class="content">
                                    <span class=""  style="background: #000 !important;"></span>
                                    <p>RapidCashAmerica helps you earn extra income as well as pay off your bills easily with a few simple steps. If you are 18+, you have the flexibility to work at your convenient hours, from the comfort of your home, along with your regular job by joining hands with us.</p>
                                    <p>Be an agent for our valued customers those who do not have a bank account or are unable to access it and earn 2% of the EMI amount. RapidCashAmerica provides an easy withdrawal option within 7 days of every successful transaction.</p>
                                    <p>Register now with a few simple steps, get instant approval by providing documents and get the chance of earning extra income.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6 text-center">
                            <div class="col-lg-12">
                                {{-- @if(@$app->video_path == null ) --}}
                                    <iframe style="width: 500px;height: 400px; border-radius: 15px;" class="video" src="{{ asset('images/video2.mp4')}}"></iframe>
                                {{-- @else --}}
                                    {{-- <iframe style="width: 500px;height: 400px; border-radius: 15px;" class="video" src="{{@$app->video_path }}"></iframe> --}}
                                {{-- @endif --}}
                            </div>
                            <div class="row text-left mt-20 mb-20">
                                <div class="col-md-2"></div>
                                <div class="col-md-6 mt-3">
                                    <label for="font-weight-bold">Please Call On </label>
                                    <a href="javascript:;" class="text-primary ml-2"><i class="fa fa-phone fa-rotate-90" aria-hidden="true"></i>+1(216)-232-6665</a>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{route('apply.work-from-home',['slug'=>@$app->slug])}}" role="button" class="btn btn-success rounded-0 bg-green mt-3">GET STARTED</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    @if($earning->status==1)
                        <div id="earning" class="pt-5 pb-5">
                            <div class=" row">
                                <div class="col-lg-5 text-center">
                                    <img class="h-50" src="{{asset('frontend/img/earn1.svg')}}" alt="">
                                </div>
                                <div class="col-lg-7">
                                    <div class="mb-5 heading text-center">
                                        <h3>Your Earning</h3>
                                        {{-- <div class="text-right">
                                            <a href="{{route('apply.work-from-home',['id'=>@$app->slug])}}" class="text-primary" title="Edit Personal Detail">
                                                <span class="fas fa-pencil-alt"></span>
                                            </a>
                                        </div> --}}
                                    </div>
                                    <table class="table table-stripped " id='user_earning_table'>
                                        <thead>
                                            <tr>
                                                <td class='form-lable'>Date</td>
                                                <td class='form-lable text-center'>Full Name</td>
                                                <td class='form-lable text-right'>Grand Total</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <a href="{{route('withdraw.request',['app_id'=>@$app->id,'earning_id'=>@$earning->id])}}" class="col-md-12 btn btn-success bg-green rounded-0 mt-4">Withdraw</a>
                                    <div class="mt-5 alert alert-warning text-black" role="alert">
                                        <i class="fas fa-info-circle"></i> You can withdraw your earnings every 7 Days.
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="p-4 text-center" id='process'>
                            <img src="{{asset('frontend/img/earn3.svg')}}" alt="" class="">
                            <div class="mt-3">
                                <p>Please wait till your accout get approved.</p>
                            </div>
                        </div>
                    @endif
                @endif
            @else
                <div id="getStart" style="display:{{(@$earning!=null)?'none':''}};">
                    <div class="col-md-12 text-center">
                        <div class="text-center mb-30 mt-30">
                            <h3 class="font-weight-bold" >Comming Soon</h3>
                            {{-- <div class="section_title">
                                <span class=""  style="background: #000 !important;"></span>
                            </div> --}}
                        </div>
                    </div>
                </div>
            @endif
            </div>
    </div>
</div>
@endsection
@php
    $earningId = @$earning_id;
@endphp
@section('front_script')
<script>
    var earningId = '{{$earningId}}';
    var url = "{{ route('app-earning.datatable',['appId'=>@$app->id]) }}";
</script>
<script src="{{ asset('backend/dist/default/assets/vendors/base/vendors.bundle.js') }}" type="text/javascript">
</script>
<script src="{{ asset('backend/dist/default/assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>
<script>
    var rule = $.extend({}, {!!json_encode(config('constant'), JSON_FORCE_OBJECT) !!});
</script>
<script src="{{ asset('backend/dist/default/assets/vendors/custom/datatables/datatables.bundle.js') }}"
    type="text/javascript"></script>
<script src="{{asset('backend/js/common.js')}}"></script>
<script src="{{asset('frontend/js/work/create.js')}}"></script>
@endsection
