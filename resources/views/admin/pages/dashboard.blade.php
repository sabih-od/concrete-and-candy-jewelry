@extends('admin.layout.admin')
@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">

            <div class="container-fluid">
                <div class="page-title-box">

                    <div class="row align-items-center ">
                        <div class="col-md-8">
                            <div class="page-title-box">
                                <h4 class="page-title">Dashboard</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active">Welcome To Concrete & Candy Jewelry Admin
                                        Dashboard
                                    </li>
                                </ol>
                            </div>
                        </div>

                        {{--                        <div class="col-md-4">--}}
                        {{--                            <div class="float-right d-none d-md-block app-datepicker">--}}
                        {{--                                <input type="text" class="form-control" data-date-format="MM dd, yyyy"--}}
                        {{--                                       readonly="readonly" id="datepicker">--}}
                        {{--                                <i class="mdi mdi-chevron-down mdi-drop"></i>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
                <!-- end page-title -->

                <!-- start top-Contant -->
                <div class="row">
                    <div class="col-sm-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center p-1">
                                    <div class="col-lg-10">
                                        <h5 class="font-16">Total Order Amount</h5>
                                        {{--                                        <h4 class="text-info pt-1 mb-0">${{$reports['total_orders_amount']}}</h4>--}}
                                    </div>
                                    {{--                                    <div class="col-lg-6">--}}
                                    {{--                                        <div id="chart1"></div>--}}
                                    {{--                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center p-1">
                                    <div class="col-lg-10">
                                        <h5 class="font-16 w-100">My Total Commission</h5>
                                        {{--                                        <h4 class="text-warning pt-1 mb-0">${{$reports['total_invoice_commision']}}</h4>--}}
                                    </div>
                                    {{--                                    <div class="col-lg-6">--}}
                                    {{--                                        <div id="chart2"></div>--}}
                                    {{--                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center p-1">
                                    <div class="col-lg-10">
                                        <h5 class="font-16">Pending Invoices of Vendors</h5>
                                        {{--                                        <h4 class="text-primary pt-1 mb-0">${{$reports['pending_invoice_amount']}}</h4>--}}
                                    </div>
                                    {{--                                    <div class="col-lg-6">--}}
                                    {{--                                        <div id="chart3"></div>--}}
                                    {{--                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center p-1">
                                    <div class="col-lg-10">
                                        <h5 class="font-16">Total Unpaid Invoices</h5>
                                        {{--                                        <h4 class="text-danger pt-1 mb-0">{{$reports['unpaid_invoice_count']}}</h4>--}}
                                    </div>
                                    {{--                                    <div class="col-lg-6">--}}
                                    {{--                                        <div id="chart4"></div>--}}
                                    {{--                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end top-Contant -->


                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title mb-4">New Users</h4>
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0 customTable">
                                        <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Stripe Account ID</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Country</th>
                                            <th scope="col">Address</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{$user->name ?? ' - '}}</td>
                                                <td>{{$user->email ?? ' - '}}</td>
                                                <td>{{$user->stripe_account_id ?? ' - '}}</td>
                                                <td>{{$user->phone ?? '-'}}</td>
                                                <td>{{$user->country ?? '-'}}</td>
                                                <td>{{$user->address ?? '-'}}</td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title mb-4">Latest Orders</h4>
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0 customTable">
                                        <thead>
                                        <tr>
                                            <th scope="col">Order #</th>
                                            <th scope="col">Customer</th>
                                            <th scope="col">Shipping Address</th>
                                            <th scope="col">Total Items</th>
                                            <th scope="col">Total Price</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Transaction ID</th>

                                        </tr>
                                        </thead>
                                        <tbody>

                                        <!-- start 5 -->
                                        <tr v>
                                        @foreach($orders as $order)
                                            <tr>
                                                <td>{{$order->order_number ?? '-'}}</td>
                                                <td>{{$order->user->name ?? '-'}}</td>
                                                <td>{{$order->shipping_address ?? '-'}}</td>
                                                <td>{{$order->total_items ?? '-'}}</td>
                                                <td>{{$order->total_price ?? '-'}}</td>
                                                <td>{{$order->status ?? '-'}}</td>
                                                <td>{{$order->transaction_id ?? '-'}}</td>

                                            </tr>
                                            @endforeach
                                            </tr>

                                            <!-- end 8 -->

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- container-fluid -->

        </div>
        <!-- content -->

        <footer class="footer">
            © 2023 Candy-jewelry <span class="d-none d-sm-inline-block"> - Copyright reserved. </span>.
        </footer>

    </div>
@endsection
