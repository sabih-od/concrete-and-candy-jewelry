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
                                <h4 class="mt-0 header-title">Products Listing</h4>

                                <a href="{{ route('admin.prod.create') }}">
                                    <button class="btn btn-dark">+ Add Product</button>
                                </a>
                            </div>
                            <table id="geniustable" class="table table-bordered dt-responsive nowrap"
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Created By</th>
                                    <th>Stock</th>
                                    <th>Price</th>
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

    @include('alerts.inactive-modal')


@endsection

@section('script')

    {{--    Routes for hitting ajax--}}

    <script>
        var indexRoute = '{{ route("admin.prods.index") }}';

        var moduleName = '{{ request()->segment(2) }}'; // Module is like a which route name is set (e.g : user or product)

        var columnsConfig = [
            {data: 'name', name: 'name'},
            {data: 'category', name: 'category'},
            {data: 'created_by', name: 'created_by'},
            {data: 'stock_quantity', name: 'stock'},
            {data: 'price', name: 'price'},
            {data: 'action', searchable: false, orderable: false}
        ];
    </script>

@endsection
