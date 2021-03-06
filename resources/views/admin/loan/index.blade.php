@extends('admin.layouts.default')
@section('content')
<style>
    .hid_spn{
        display: none !important;
    }
</style>
@section('title', __('formname.loan.list'))
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
                    <h5>{{__('formname.loan.list')}}</h5>
                </div>
                <hr>
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <select class="form-control" name="action" id='action' aria-invalid="false">
                                <option value="">{{__('formname.action_option')}}</option>
                                {{-- @if((\Auth::guard('admin')->user()->hasRole('superadmin')||\Auth::guard('admin')->user()->can('product category multiple delete'))) --}}
                                <option value="{{config('constant.delete')}}">{{__('formname.delete')}}</option>
                                {{-- @endif --}}
                                {{-- @if((\Auth::guard('admin')->user()->hasRole('superadmin')||\Auth::guard('admin')->user()->can('product category multiple active'))) --}}
                                <option value="{{config('constant.approve')}}">{{__('formname.approve')}}</option>
                                {{-- @endif --}}
                                {{-- @if((\Auth::guard('admin')->user()->hasRole('superadmin')||\Auth::guard('admin')->user()->can('product category multiple inactive'))) --}}
                                <option value="{{config('constant.reject')}}">{{__('formname.reject')}}</option>
                                {{-- @endif --}}
                            </select>
                            <a href="javascript:;" class="btn btn-primary submit_btn" id='action_submit'
                                data-url="{{route('loan.multi_delete')}}"
                                data-table_name="loan_table">{{__('formname.submit')}}</a>
                            <button class="btn btn-info" style='margin:0px 0px 0px 12px' id='clr_filter'
                                data-table_name="loan_table" >{{__('formname.clear_filter')}}</button>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                @if((\Auth::guard('admin')->user()->hasRole('superadmin')||\Auth::guard('admin')->user()->can('product category create')))
                                <a href="{{route('loan.create')}}" class="btn btn-accent m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                    <span>
                                        <i class="la la-plus"></i>
                                        <span>{{__('formname.new_record')}}</span>
                                    </span>
                                </a>
                            </li>
                            <li class="m-portlet__nav-item">
                                <form action="{{route('loan.export')}}" method="POST" id='exportData'>
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="from_date" placeholder="From Date" id="startDate" readonly>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="to_date" placeholder="To Date" id="endDate" readonly>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-success m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air mt-0">
                                                <span>
                                                    <i class="fas fa-file-excel"></i>
                                                    <span>{{__('formname.export')}}</span>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable for_wdth table-responsive" id="loan_table"
                data-type="" data-table_name="loan_table" data-url="{{ route('user.datatable') }}">
                    <thead>
                        <tr>
                            <th class="nosort">
                                <label class="m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand">
                                    <input type="checkbox" value="" id="trade_checkbox" class="m-checkable allCheckbox">
                                    <span></span>
                                </label>
                            </th>
                            <th>{{__('formname.created_at')}}</th>
                            <th>{{__('formname.user.first_name')}}</th>
                            <th>{{__('formname.user.middle_name')}}</th>
                            <th>{{__('formname.user.last_name')}}</th>
                            <th>{{__('formname.bank.account_number')}}</th>
                            <th>{{__('formname.document_status')}}</th>
                            <th>{{__('formname.status')}}</th>
                            <th>{{__('formname.action')}}</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td></td>
                            <th><input type="text" class="form-control form-control-sm tbl-filter-column"
                                placeholder="{{__('formname.user.first_name')}}"></th>
                            <th><input type="text" class="form-control form-control-sm tbl-filter-column"
                                placeholder="{{__('formname.user.middle_name')}}"></th>
                            <th><input type="text" class="form-control form-control-sm tbl-filter-column"
                                placeholder="{{__('formname.user.last_name')}}"></th>
                            <th><input type="text" class="form-control form-control-sm tbl-filter-column"
                                placeholder="{{__('formname.bank.account_number')}}"></th>
                            <th><input type="text" class="form-control form-control-sm tbl-filter-column"
                                placeholder="{{__('formname.created_at')}}"></th>
                            <th><input type="text" class="form-control form-control-sm tbl-filter-column"
                                placeholder="{{__('formname.document_status')}}"></th>
                            <th class="slct-wdth">
                                <select class="statusFilter form-control form-control-sm tbl-filter-column">
                                    @forelse (@$statusList as $key => $item)
                                        <option value="{{$key}}">{{$item}}</option>
                                    @empty
                                    @endforelse
                                </select>
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
var url = "{{ route('loan.datatable') }}";
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script src="{{ asset('backend/js/loan/index.js') }}" type="text/javascript"></script>
@stop