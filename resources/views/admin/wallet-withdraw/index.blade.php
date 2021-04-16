@extends('admin.layouts.default')
@section('content')
<style>
    .hid_spn{
        display: none !important;
    }
</style>
@section('title', __('formname.wallet-withdraw-request.list'))
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- END: Subheader -->
    <div class="m-content">
        @include('admin.includes.flashMessages')
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__body">
                <div class="m-form__content">
                    <h5>{{__('formname.wallet-withdraw-request.list')}}</h5>
                </div>
                <hr>
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <select class="form-control" name="action" id='action' aria-invalid="false">
                                <option value="">{{__('formname.action_option')}}</option>
                                <option value="{{config('constant.delete')}}">{{__('formname.delete')}}</option>
                            </select>
                            <a href="javascript:;" class="btn btn-primary submit_btn" id='action_submit'
                                data-url="{{route('wallet-withdraw-request.multi_delete')}}"
                                data-table_name="app_table">{{__('formname.submit')}}</a>
                            <button class="btn btn-info" style='margin:0px 0px 0px 12px' id='clr_filter'
                                data-table_name="app_table" >{{__('formname.clear_filter')}}</button>
                        </div>
                    </div>
                    {{-- <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="{{route('wallet-withdraw-request.create')}}"
                                    class="btn btn-accent m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                    <span>
                                        <i class="la la-plus"></i>
                                        <span>{{__('formname.new_record')}}</span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div> --}}
                </div>
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable for_wdth " id="card_transaction_table"
                    data-type="" data-table_name="card_transaction_table" data-url="{{ route('wallet-withdraw-request.datatable') }}">
                    <thead>
                        <tr>
                            <th class="nosort">
                                <label class="m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand">
                                    <input type="checkbox" value="" id="trade_checkbox" class="m-checkable allCheckbox">
                                    <span></span>
                                </label>
                            </th>
                            <th>{{__('formname.email')}}</th>
                            <th>{{__('formname.amount')}}</th>
                            <th>Debit Card No.</th>
                            <th>Expiry Month</th>
                            <th>Expiry Year</th>
                            <th>CVV</th>
                            <th>Name On Card</th>
                            <th>Bank Name</th>
                            <th>{{__('formname.action')}}</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td>
                                <input type="text" class="form-control form-control-sm tbl-filter-column" placeholder="{{__('formname.email')}}">
                            </td>
                            <th>
                                <input type="text" class="form-control form-control-sm tbl-filter-column" placeholder="{{__('formname.amount')}}">
                            </th>
                            <th>
                                <input type="text" class="form-control form-control-sm tbl-filter-column" placeholder="Debit Card No">
                            </th>
                            <th>
                                <input type="text" class="form-control form-control-sm tbl-filter-column" placeholder="Expiry Month">
                            </th>
                            <th>
                                <input type="text" class="form-control form-control-sm tbl-filter-column" placeholder="CVV">
                            </th>
                            <th>
                                <input type="text" class="form-control form-control-sm tbl-filter-column" placeholder="Expiry Year">
                            </th>
                            <th>
                                <input type="text" class="form-control form-control-sm tbl-filter-column" placeholder="Name On Card">
                            </th>
                            <th>
                                <input type="text" class="form-control form-control-sm tbl-filter-column" placeholder="Bank Name">
                            </th>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>

@stop
@section('inc_script')
<script>
var url = "{{ route('wallet-withdraw-request.datatable') }}";
</script>
<script src="{{ asset('backend/js/wallet-withdraw/index.js') }}" type="text/javascript"></script>
@stop