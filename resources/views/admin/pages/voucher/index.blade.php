@extends('admin.layout.admin')
@section('content')

    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="page-title-box">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="mt-0 header-title">Voucher Listing</h4>

                                <a href="{{ route('admin.voucher.create') }}">
                                    <button class="btn btn-dark">+ Add Voucher</button>
                                </a>
                            </div>
                            <table id="geniustable" class="table table-bordered dt-responsive nowrap"
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Voucher</th>
                                    <th>Discount Percentage</th>
                                    <th>Expiry Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('alerts.delete-modal')

@endsection

@section('script')

    {{--    Routes for hitting ajax--}}
    <script>
        var indexRoute = '{{ route("admin.voucher.index") }}'; //for datatable.js

        var moduleName = '{{ request()->segment(2) }}';  //for main.js

        var columnsConfig = [
            {data: 'code', name: 'code'},
            {data: 'discount_amount_percent', name: 'discount_amount_percent'},
            {data: 'expiry_date', name: 'expiry_date'},
            {data: 'action', searchable: false, orderable: false}
        ];

    </script>


@endsection

