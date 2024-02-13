@extends('admin.layout.admin')
@section('content')
    <div class="content-page">
    <!-- Start content -->
    <div class="content">
        {{--@dd($data)--}}
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="font-size: 2.5rem; color: #333; font-weight: bold;">My Commisssion</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#" style="color: #666;">My Commisssion</a></li>
                        <li class="breadcrumb-item active" aria-current="page" style="color: #333; font-weight: bold;">
                            Dashboard
                        </li>
                    </ol>
                </div>
            </div>
            <form action="{{ route('admin.commissionEdit') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title" style="font-size: 1.2rem; color: #555; font-weight: bold;">Commission Percentage</label>
                        <input type="text" class="form-control" id="commission_percentage" name="commission_percentage"
                               placeholder="Enter Commission"
                               style="border: 1px solid #ccc; border-radius: 5px; padding: 8px 12px; margin-top: 5px;"
                               value="{{ $commission->commission_percentage ?? '' }}">
                    </div>
                </div>

                    <button type="submit" class="btn btn-success">Submit</button>

            </form>
        </div>
    </div>

@endsection
