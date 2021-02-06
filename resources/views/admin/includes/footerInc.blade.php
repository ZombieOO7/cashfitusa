<!--begin::Base Scripts -->
<script src="{{ asset('backend/dist/default/assets/vendors/base/vendors.bundle.js') }}" type="text/javascript">
</script>
<script src="{{ asset('backend/dist/default/assets/demo/default/base/scripts.bundle.js') }}"
    type="text/javascript"></script>
<script src="{{ asset('backend/dist/default/assets/app/js/dashboard.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/dist/default/assets/vendors/custom/datatables/datatables.bundle.js') }}"
    type="text/javascript"></script>
<script src="{{ asset('js/jquery.raty.js') }}"></script>
<script src="{{ asset('backend/js/common.js') }}" type="text/javascript"></script>
<script src="{{ asset('sweetalert/sweetalert.min.js') }}"></script>
<script type="text/javascript" src="{{ str_replace('public/', '', URL('resources/lang/js/en/message.js')) }}"></script>
@yield('inc_script')
@component('vendor.sweetalert.view')
@endcomponent
