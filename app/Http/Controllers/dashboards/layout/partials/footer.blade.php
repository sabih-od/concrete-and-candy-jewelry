<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{ asset('dashboard-assets/js/all.min.js') }}"></script>
<script src="{{ asset('dashboard-assets/js/custom.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"
        integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdn.datatables.net/autofill/2.6.0/js/dataTables.autoFill.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
{{-- toastr js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

<script src="{{ asset('js/datatable.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
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
<script>
    $(document).ready(function () {
        var currentPath = window.location.pathname;
        var lastSelectedTab = localStorage.getItem('lastSelectedTab');
        if (lastSelectedTab) {
            $(".navbar-nav .nav-item").removeClass("active");
            $("a[href='" + lastSelectedTab + "']").parent().addClass("active");
        }

        $(".navbar-nav .nav-item").click(function () {
            $(".navbar-nav .nav-item").removeClass("active");
            $(this).addClass("active");

            var selectedTab = $(this).find("a").attr("href");
            localStorage.setItem('lastSelectedTab', selectedTab);
        });
    });

</script>

@yield('script')

</body>

</html>
