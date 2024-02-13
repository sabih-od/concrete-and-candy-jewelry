@extends('admin.layout.admin')
@section('content')

    <style>
        select option {
            font-weight: normal;
        }

        select option[style="font-weight: bold"] {
            font-weight: bold;
        }
    </style>
    <div class="content-page">
        <!-- Start content -->
        <div class="content">

            <div class="container-fluid">
                <div class="page-title-box">

                    <div class="row align-items-center ">
                        <div class="col-md-8">
                            <div class="page-title-box">
                                <h4 class="page-title">Admin Panel</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.voucher.index') }}">Vocuhers</a>
                                    </li>
                                    <li class="breadcrumb-item active">Create Vocuher</li>
                                </ol>
                            </div>
                        </div>

                        <div class="col-md-4 ">
                            <button class="btn btn-circle btn-dark float-right">
                                <a href="{{ route('admin.voucher.index') }}"
                                   style="text-align:center; color: #fff; padding: 5px; text-decoration: none; display: inline-block;float: right; margin-bottom: 3px">
                                    <i class="fas fa-arrow-left"></i></a>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- end page-title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Create Voucher</h4>

                                <form method="POST" action="{{ route('admin.voucher.store') }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')

                                    <div class="row">

                                        <div class="form-group col-md-6">
                                            <label for="parent_id">Voucher</label>
                                            <input type="text" name="code" id="name" class="form-control"
                                                   value="{{ old('code') }}">
                                            @error('code')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="form-group col-md-6">
                                            <label for="name">Voucher Discount Percentage</label>
                                            <input type="number" name="discount_amount_percent" id="name"
                                                   class="form-control"
                                                   value="{{ old('discount_amount_percent') }}">
                                            @error('discount_amount_percent')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="form-group col-md-12">
                                            <label for="name">Voucher Expiration date</label>
                                            <input type="date" name="expiry_date" id="name"
                                                   class="form-control"
                                                   value="{{ old('expiry_date') }}">
                                            @error('expiry_date')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group mb-0 mt-2">
                                        <div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                Create
                                            </button>
                                        </div>
                                    </div>

                                </form>
                            </div>


                        </div>
                    </div>
                </div>
                <!-- end col -->

                <!-- end col -->
            </div>
            <!-- end row -->

        </div>

@endsection


