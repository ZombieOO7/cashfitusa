@extends('admin.layouts.default')
@section('content')

@section('title', __('formname.role_list'))

<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <div class="m-content">
        @include('admin.includes.flashMessages')
        <div class="m-portlet m-portlet--mobile">

            <div class="m-portlet__body">
                <div class="m-form__content">
                    <h5>{{__('formname.role_list')}}</h5>
                </div>
                <hr>
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <select class="form-control" name="action" id='action' aria-invalid="false">
                                <option value="">{{__('formname.action_option')}}</option>
                                @if((\Auth::guard('admin')->user()->can('role multiple delete')))
                                <option value="delete">{{__('formname.delete')}}</option>
                                @endif
                            </select>
                            <a href="javascript:;" class="btn btn-primary submit_btn"id='action_submit' data-url="{{route('role_multi_delete')}}" data-table_name="role_table">{{__('formname.submit')}}</a>
                                <button class="btn btn-info" style='margin:0px 0px 0px 12px' id='clr_filter'
                                data-table_name="role_table">{{__('formname.clear_filter')}}</button>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            @if((\Auth::guard('admin')->user()->can('role create')))
                            <li class="m-portlet__nav-item">
                                <a href="{{Route('role_create')}}"
                                    class="btn btn-accent m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                    <span>
                                        <i class="la la-plus"></i>
                                        <span>{{__('formname.new_record')}}</span>
                                    </span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="role_table">
                    <thead>
                        <tr>
                            <th class="nosort">

                                <label class="m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand">
                                    <input type="checkbox" value="" id="role_checkbox" class="m-checkable allCheckbox">
                                    <span></span>
                                </label>
                            </th>
                            <th>{{__('formname.id')}}</th>
                            <th>{{__('formname.role_name')}}</th>
                            <th>{{__('formname.action')}}</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td></td>
                            <th><input type="text" class="form-control form-control-sm tbl-filter-column"
                                    placeholder="{{__('formname.id')}}"></th>
                            <th><input type="text" class="form-control form-control-sm tbl-filter-column"
                                    placeholder="{{__('formname.role_name')}}"></th>
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

<?php /*Load script to footer section*/?>

@section('inc_script')
<script>
var role_list_url = "{{ route('role_datatable') }}";
</script>
<script src="{{ asset('backend/js/role/index.js') }}" type="text/javascript"></script>
@stop