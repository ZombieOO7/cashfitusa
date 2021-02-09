@extends('frontend.layouts.default')
@section('content')
@section('front_css')
<!--begin::Web font -->
<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
<script>
WebFont.load({
    google: {
        "families": ["Roboto:300,400,500,600,700", "Roboto:300,400,500,600,700"]
    },
    active: function() {
        sessionStorage.fonts = true;
    }
});
</script>
<!--end::Web font -->
<link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
{{-- <link href="{{ asset('backend/dist/default/assets/vendors/custom/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" /> --}}
<link href="{{ asset('backend/dist/default/assets/demo/default/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/css/common.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('title', 'Applications')
    <!-- start loan_step section -->
    <section class="loan-process-section section-padding"  style="background-color:#fff;z-index: 0 !important;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section_title text-center mb-30">
                        <h3 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">Applications</h3>
                        <span class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s" style="background: #000 !important;"></span>
                        {{-- <p>Personal Loans are a way to meet financial needs during an emergency. It is an unsecured loan and can be used for marriage expenses, paying the medical bills, going for your dream vacation or renovating your home. Irrespective of what your personal financial goals are, Personal Loan offers you the perfect solution.</p> --}}
                    </div>
                </div>
            </div>
            <div class="row process-list">
                <div class="col-lg-12 col-md-12 process text-center">
                    <table class="table table-striped table-bordered table-hover table-checkable for_wdth" id="loan_table"
                    data-type="" data-table_name="loan_table" data-url="{{ route('user.loan.datatable') }}">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th scope="col">Apply Date</th>
                                <th scope="col">Loan Account Number</th>
                                <th scope="col">Initial Amount</th>
                                <th scope="col">Tenure</th>
                                {{-- <th scope="col">Rate of Interest  P.A [FYI]</th> --}}
                                <th scope="col">Monthly Instalments</th>
                                <th scope="col">Document Status</th>
                                <th scope="col">Loan Status</th>
                                <th class="" width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        {{-- <tfoot>
                            <th><input type="text" class="form-control form-control-sm tbl-filter-column"
                                placeholder="{{__('formname.loan.created_at')}}"></th>
                            <th><input type="text" class="form-control form-control-sm tbl-filter-column"
                                placeholder="{{__('formname.bank.account_number')}}"></th>
                            <th><input type="text" class="form-control form-control-sm tbl-filter-column"
                                placeholder="{{__('formname.loan.loan_amount')}}"></th>
                            <th><input type="text" class="form-control form-control-sm tbl-filter-column"
                                placeholder="{{__('formname.loan.months')}}"></th>
                            <th><input type="text" class="form-control form-control-sm tbl-filter-column"
                                placeholder="{{__('formname.loan.repayment_amount')}}"></th>
                            <th><input type="text" class="form-control form-control-sm tbl-filter-column"
                                placeholder="{{__('formname.loan.status')}}"></th>
                            <td></td>
                        </tfoot> --}}
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- end of loan_step section -->

    <!-- start help section -->
    {{-- @include('frontend.sections.help') --}}
    <!-- end of help section -->

@stop
@section('front_script')
<script src="{{ asset('backend/dist/default/assets/vendors/base/vendors.bundle.js') }}" type="text/javascript">
</script>
<script src="{{ asset('backend/dist/default/assets/demo/default/base/scripts.bundle.js') }}"
    type="text/javascript"></script>
<script src="{{ asset('backend/dist/default/assets/vendors/custom/datatables/datatables.bundle.js') }}"
    type="text/javascript"></script>
<script src="{{ asset('js/jquery.raty.js') }}"></script>
<script src="{{ asset('backend/js/common.js') }}" type="text/javascript"></script>
<script src="{{ asset('sweetalert/sweetalert.min.js') }}"></script>
<script type="text/javascript" src="{{ str_replace('public/', '', URL('resources/lang/js/en/message.js')) }}"></script>
<script>
    var rule = $.extend({}, {!!json_encode(config('constant'), JSON_FORCE_OBJECT) !!});
    var url = "{{ route('user.loan.datatable') }}";
    var id = "{{Auth::id()}}";
</script>
<script src="{{asset('frontend/js/loan/index.js')}}"></script>
<script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>
<script src="https://kendo.cdn.telerik.com/2017.2.621/js/jszip.min.js"></script>
<script src="https://kendo.cdn.telerik.com/2017.2.621/js/kendo.all.min.js"></script>
<script>
$('#cmd').click(function () {   
    ExportPdf();
});

function ExportPdf(){ 
    kendo.drawing
        .drawDOM("#loan_table", 
        { 
            paperSize: "A4",
            margin: { top: "1cm", bottom: "1cm" },
            scale: 0.8,
            height: 500
        })
            .then(function(group){
            kendo.drawing.pdf.saveAs(group, "Exported.pdf")
        });
}
</script>
@endsection