<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<script>
    $(document).ready(function() {
        App.init();
    });
</script>
<script src="{{ asset('assets/js/custom.min.js') }}"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="{{asset('assets/js/scrollspyNav.js')}}"></script>

{{-- Forms --}}
<script src="{{asset('plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
<script src="{{asset('assets/js/forms/bootstrap_validation/bs_validation_script.js')}}"></script>
<script src="{{asset('plugins/select2/select2v.min.js')}}"></script>

{{-- Components Sweetalerts --}}
<script src="{{asset('plugins/sweetalerts/sweetalert2.min.js')}}"></script>
<script src="{{asset('plugins/sweetalerts/custom-sweetalert.js')}}"></script>

{{-- Tables Datatable Basic --}}
<script src="{{asset('plugins/table/datatable/datatables.min.js')}}"></script>

{{-- FontAwesome --}}
<script src="{{asset('assets/js/fontawesome/all.min.js')}}"></script>

{{-- ChartJS --}}
<script src="{{asset('assets/js/chartjs/Chart.min.js')}}"></script>

{{-- Popover --}}
<script src="{{asset('assets/js/elements/popovers.js')}}"></script>
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
