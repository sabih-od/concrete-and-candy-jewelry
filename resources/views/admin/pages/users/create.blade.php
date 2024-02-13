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
                                <h4 class="page-title">Admin Panel</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none" href="{{ route('admin.dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none"
                                           href="{{ route('admin.users.index') }}">Users</a>
                                    </li>
                                    <li class="breadcrumb-item active">Create User</li>
                                </ol>
                            </div>
                        </div>

                        <div class="col-md-4 ">
                            <button class="btn btn-circle btn-dark float-right">
                                <a href="{{ route('admin.users.index') }}"
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

                                <h4 class="mt-0 header-title">Create User</h4>

                                <form method="POST" action="{{ route('admin.user.store') }}">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                               value="{{ old('name') }}">
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        <div class="form-group col-md-6">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email" class="form-control"
                                                   value="{{ old('email') }}">
                                            @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control"
                                                   value="{{ old('password') }}">
                                            @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="form-group col-md-6">
                                            <label for="phone">Phone</label>
                                            <input type="text" name="phone" id="phone" class="form-control"
                                                   value="{{ old('phone') }}">
                                            @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="roles">Add Roles</label>
                                            <select name="role" id="roles" class="form-control">
                                                <option value="user" @if(old('role') == 'user') selected @endif>User
                                                </option>
                                                <!-- Add other role options here -->
                                            </select>
                                            @error('role')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="form-group col-md-4">
                                            <label for="country">Country</label>
                                            <select name="country" id="country" class="form-control">
                                                <option value="" disabled selected>Select Country</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('country')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="state">State</label>
                                            <select name="state_id" id="state" class="form-control">
                                                <option value="" disabled selected>Select State</option>
                                            </select>
                                            @error('state')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="city">City</label>
                                            <input type="text" name="city" id="city" class="form-control"
                                                   value="{{ old('city') }}">
                                            @error('city')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="zip">Zip</label>
                                            <input type="text" name="zip" id="zip" class="form-control"
                                                   value="{{ old('zip') }}">
                                            @error('zip')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="textarea">Address</label>
                                        <div>
                                            <textarea name="address" required class="form-control"
                                                      rows="5">{{ old('address') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group mb-0">
                                        <div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <!-- end col -->
                </div>
                <!-- end row -->

            </div>

            @endsection
            @section('script')
                <script>
                    $(document).ready(function () {
                        $('#country').change(function () {
                            var countryId = $(this).val();
                            var csrfToken = $('meta[name="csrf-token"]').attr('content');

                            $.ajax({
                                type: 'GET',
                                url: '{{ route('admin.country.states') }}',
                                data: {
                                    _token: csrfToken,
                                    country: countryId
                                },
                                success: function (data) {
                                    console.log("data", data)
                                    var stateDropdown = $('#state');
                                    stateDropdown.empty();

                                    if (data.data.length > 0) {
                                        stateDropdown.prop('disabled', false);

                                        data.data.forEach(function (state) {
                                            stateDropdown.append('<option value="' + state.id + '">' + state.name + '</option>');
                                        });
                                    } else {
                                        stateDropdown.prop('disabled', true);
                                    }
                                }
                            });
                        });
                    });
                </script>


@endsection
