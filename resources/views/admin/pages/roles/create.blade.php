@extends('admin.layout.admin')
@section('content')

    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <!-- Page Title -->
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <!-- Breadcrumbs -->
                        <div class="col-md-8">
                            <h4 class="page-title">Admin Panel</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.roles.index') }}">Roles</a>
                                </li>
                                <li class="breadcrumb-item active">Create Role</li>
                            </ol>
                        </div>
                        <!-- Back Button -->
                        <div class="col-md-4 ">
                            <button class="btn btn-circle btn-dark float-right">
                                <a href="{{ route('admin.roles.index') }}" style="text-align:center; color: #fff; padding: 5px; text-decoration: none; display: inline-block;float: right; margin-bottom: 3px">
                                    <i class="fas fa-arrow-left"></i>
                                </a>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Create Role Form -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Create Role</h4>

                                <form method="POST" action="{{ route('admin.role.store') }}">
                                    @csrf
                                    @method('POST')

                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="name">Role Name</label>
                                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>

                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Add more fields if needed -->

                                        <div class="form-group col-md-12">
                                            <h5>Assign Permissions</h5>
                                            @foreach($permissions as $permission)
                                                <br>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="{{ $permission->name }}" name="permissions[]" value="{{ $permission->name }}">
                                                    <label class="custom-control-label" for="{{ $permission->name }}">{{ $permission->name }}</label>
                                                </div>

                                            @endforeach

                                            @error('permissions')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-0">
                                            <div>
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                    Create Role
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
