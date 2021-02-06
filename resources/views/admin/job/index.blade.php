@extends('admin.layouts.default')
@section('content')
<style>
    .hid_spn {
        display: none !important;
    }

    .mltclr_bx {
        color:#fff;
        font-size: 12px;
        padding: 4px 8px;
        border-radius: 4px;
    }
</style>
@section('title', __('formname.job.list'))
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- END: Subheader -->
    <div class="m-content">
        @include('admin.includes.flashMessages')
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__body">
                <div class="m-form__content">
                    <h5>{{__('formname.job.list')}}</h5>
                </div>
                <hr>
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <select class="form-control" name="action" id='action' aria-invalid="false">
                                <option value="">{{__('formname.action_option')}}</option>
                                <option value="{{config('constant.delete')}}">{{__('formname.delete')}}</option>
                                <option value="{{config('constant.active')}}">{{__('formname.active')}}</option>
                                <option value="{{config('constant.inactive')}}">{{__('formname.inactive')}}</option>
                            </select>
                            <a href="javascript:;" class="btn btn-primary submit_btn" id='action_submit'
                                data-url="{{route('job.multi_delete')}}"
                                data-table_name="job_table">{{__('formname.submit')}}</a>
                            <button class="btn btn-info" style='margin:0px 0px 0px 12px' id='clr_filter'
                                data-table_name="job_table">{{__('formname.clear_filter')}}</button>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="{{Route('job.create')}}"
                                    class="btn btn-accent m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                    <span>
                                        <i class="la la-plus"></i>
                                        <span>{{__('formname.new_record')}}</span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable for_wdth table-responsive" id="job_table"
                    data-type="" data-url="{{ route('job.datatable') }}">
                    <thead>
                        <tr>
                            <th class="nosort">
                                <label class="m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand">
                                    <input type="checkbox" value="" id="trade_checkbox" class="m-checkable allCheckbox">
                                    <span></span>
                                </label>
                            </th>
                            <th>{{__('formname.job.title')}}</th>
                            <th>{{__('formname.job.machine')}}</th>
                            <th>{{__('formname.job.problem')}}</th>
                            <th>{{__('formname.job.location')}}</th>
                            <th>{{__('formname.job.assigned_to')}}</th>
                            <th>{{__('formname.job.priority')}}</th>
                            <th>{{__('formname.job.job_status')}}</th>
                            <th>{{__('formname.created_at')}}</th>
                            <th>{{__('formname.status')}}</th>
                            <th>{{__('formname.action')}}</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td></td>
                            <th>
                                <input type="text" class="form-control form-control-sm tbl-filter-column"
                                    placeholder="{{__('formname.job.title')}}">
                            </th>
                            <th>
                                <input type="text" class="form-control form-control-sm tbl-filter-column"
                                    placeholder="{{__('formname.job.machine')}}">
                            </th>
                            <th>
                                <input type="text" class="form-control form-control-sm tbl-filter-column"
                                    placeholder="{{__('formname.job.problem')}}">
                            </th>
                            <th>
                                <input type="text" class="form-control form-control-sm tbl-filter-column"
                                    placeholder="{{__('formname.job.location')}}">
                            </th>
                            <th>
                                <input type="text" class="form-control form-control-sm tbl-filter-column"
                                    placeholder="{{__('formname.job.assigned_to')}}">
                            </th>
                            <th>
                                <input type="text" class="form-control form-control-sm tbl-filter-column"
                                    placeholder="{{__('formname.job.priority')}}">
                            </th>
                            <th>
                                <input type="text" class="form-control form-control-sm tbl-filter-column"
                                    placeholder="{{__('formname.job.job_status')}}">
                            </th>
                            <th>
                                <input type="text" class="form-control form-control-sm tbl-filter-column"
                                    placeholder="{{__('formname.created_at')}}">
                            </th>
                            <th class="slct-wdth">
                                <select class="statusFilter form-control form-control-sm tbl-filter-column">
                                    @forelse ($statusList as $key => $item)
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
    var url = "{{ route('job.datatable') }}";
</script>
<script src="{{ asset('backend/js/job/index.js') }}" type="text/javascript"></script>
@stop