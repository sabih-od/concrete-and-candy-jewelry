@extends('admin.layout.admin')
@section('content')

    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <!-- Page Title -->
                <div class="page-title-box">
                    <!-- ... (similar structure as in create.blade.php) ... -->
                </div>

                <!-- Edit Role Form -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Edit Role</h4>

                                <form method="POST" action="{{ route('admin.role.update', $role->id) }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="name">Role Name</label>
                                            <input type="text" name="name" id="name" class="form-control" value="{{ $role->name }}" required>

                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Add more fields if needed -->

                                        <div class="form-group col-md-12">
                                            <h5>Assign Permissions</h5>
                                            @foreach($permissions as $permission)
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="{{ $permission->name }}" name="permissions[]" value="{{ $permission->name }}" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
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
                                                    Update Role
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
