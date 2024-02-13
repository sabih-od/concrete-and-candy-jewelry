<script src="{{ asset('admin-assets/js/jquery.min.js')}}"></script>
<script src="{{ asset('admin-assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('admin-assets/js/metismenu.min.js')}}"></script>
<script src="{{ asset('admin-assets/js/jquery.slimscroll.js')}}"></script>
<script src="{{ asset('admin-assets/js/waves.min.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"
        integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

{{--<script src="{{ asset('admin-assets/pages/dashboard.init.js')}}"></script>--}}

<script src="{{ asset('admin-assets/js/app.js') }}"></script>

<script src="https://cdn.datatables.net/autofill/2.6.0/js/dataTables.autoFill.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

{{--this is for datatables & popup of delete modal--}}
<script src="{{ asset('admin-assets/js/datatable.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>


{{-- toastr js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

<script>
    $(document).ready(function () {
        toastr.options.timeOut = 10000;
        @if (Session::has('error'))
        toastr.error('{{ Session::get('error') }}');
        @elseif(Session::has('success'))
        toastr.success('{{ Session::get('success') }}');
        @endif
    });
</script>


{{--    FOR LOADER--}}

</body>

</html>
