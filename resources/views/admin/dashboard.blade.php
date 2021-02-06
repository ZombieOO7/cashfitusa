@extends('admin.layouts.default')
@push('inc_css')
@endpush
@section('content')
<style>
    .hid_spn{
        display: none !important;
    }
</style>
@section('title', 'Dashboard')
<div class="m-grid__item m-grid__item--fluid m-wrapper adminDashboard">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center" >
            <div class="mr-auto">
                <h3 class="m-subheader__title ">Dashboard</h3>
            </div>
        </div>
    </div>
    <div class="m-content " style="padding-left:15px !important;" >
        <div class="m-portlet ">
            <div class="m-portlet__body  m-portlet__body--no-padding">
                <div class="row m-row--no-padding m-row--col-separator-xl">
                    <div class="col-md-12 col-lg-6 col-xl-3 p-5">
                        <h5 class="">
                            Total Loan Apply
                        </h4>
                        <span class="h2 m-widget24__stats  m--font-brand">
                            {{@$totalLoan}}
                        </span>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-3 p-5">
                        <h5 class="">
                            Toatal loan approved
                        </h4>
                        <span class="h2 m-widget24__stats m--font-success">
                            {{@$totalApprovedLoan}}
                        </span>
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-3 p-5">
                        <h5 class="">
                            Pending loan
                        </h4>
                        <span class="h2 m-widget24__stats m--font-danger">
                            {{@$totalPendingLoan}}
                        </span>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-3 p-5">
                        <h5 class="">
                            Work From Home User
                        </h4>
                        <span class="h2 m-widget24__stats m--font-accent">
                            {{@$earningUser}}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-portlet ">
            <div class="m-portlet__body  m-portlet__body--no-padding">
                <div class="row m-row--no-padding m-row--col-separator-xl">
                    <div class="col-md-12 col-lg-6 col-xl-4 p-5">
                        <h5 class="">
                            Total Earning Amount
                        </h4>
                        <span class="h2 m-widget24__stats m--font-brand">
                            {{config('constant.currency_symbol').@$totalEarningAmount}}
                        </span>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-4 p-5">
                        <h5 class="">
                            Total Paid Amount
                        </h4>
                        <span class="h2 m-widget24__stats m--font-success">
                            {{config('constant.currency_symbol').@$totalPaidAmount}}
                        </span>
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-4 p-5 m--font-danger">
                        <h5 class="">
                            Left To Pay
                        </h4>
                        <span class="h2 m-widget24__stats">
                            {{config('constant.currency_symbol').@$totalUnPaidAmount}}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@stop
