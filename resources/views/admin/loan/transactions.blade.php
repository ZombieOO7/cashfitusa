@extends('admin.layouts.default')
@section('content')
<style>
    .hid_spn{
        display: none !important;
    }
    #loan_transaction_table input, #loan_transaction_table select	{
        font-size:14px;
        padding:5px 5 5px 5px;
        display:block;
        width:100%;
        border:none;
        background: transparent;
    }
    #loan_transaction_table input:focus,#loan_transaction_table select:focus	{ 
        outline:none; border-bottom:1px solid #757575;
    }
</style>
@section('title', 'Transactions')
@php 
// $role = role();
@endphp
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- END: Subheader -->
    <div class="m-content">
        @include('admin.includes.flashMessages')
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__body">
                <div class="m-form__content">
                    <h5>Transactions</h5>
                </div>
                <hr>
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable for_wdth " id="loan_transaction_table"
                data-type="" data-table_name="loan_transaction_table" data-url="{{ route('user.datatable') }}">
                    <thead>
                        <tr>
                            <th>Installment</th>
                            <th>Loan Amount</th>
                            <th>Month</th>
                            <th>Paid Amount</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
@stop
@section('inc_script')
<script>
var url = "{{ route('get.loan.transaction',['loan_id'=>@$loanUser->id]) }}";
var saveUrl = '{{route("store.loan.transaction")}}';
</script>
<script src="{{ asset('backend/js/loan/transaction.js') }}" type="text/javascript"></script>
@stop