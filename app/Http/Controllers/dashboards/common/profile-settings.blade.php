@extends('dashboards.user.index')

@section('content')


    <div class="col-lg-9 layout">
        <h2 class="mainHeadig">Profile Settings</h2>
        <div class="profileSetting">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                       aria-controls="pills-home" aria-selected="true">User Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                       aria-controls="pills-profile" aria-selected="false">Edit Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab"
                       aria-controls="pills-contact" aria-selected="false">Edit Password</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="userProfile-setting">

                        <x-dashboard.common.user-profile :user="$user"/>

                        @if($user->vendorShop)
                            <x-dashboard.common.store-profile :user="$user"/>
                        @endif
                    </div>
                </div>
                <div class="tab-pane fade editprof" id="pills-profile" role="tabpanel"
                     aria-labelledby="pills-profile-tab">
                    <div class="recentTable editProfile editRes">
                        <div class="row align-items-start">
                            <div class="col-md-2">
                                <label>User Profile*</label>
                            </div>

                            <div class="col-md-10">
                                <div class="changeProfile verfiyMain">
                                    <div>
                                        <figure>
                                            <div id="imagePreview">

                                                <img src="{{$user->userImage()}}"
                                                     class="img-fluid"
                                                     alt="img">
                                            </div>


                                        </figure>
                                    </div>
                                    <div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <form class="editForm" method="POST" action="{{route('user.vendor.profile.update',$user->id)}}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                            <div class="row align-items-start">
                                <div class="col-md-2">
                                    <label>Profile Image*</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="file" class="themeBtn" name="image" id="image" class="form-control"
                                           onchange="previewImage(this)">
                                    @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row align-items-start">
                                <div class="col-md-2">
                                    <label>Your Name*</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" name="name" id="name" class="form-control"
                                           value="{{ $user->name }}" value="{{ old('name') }}">

                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row align-items-start">
                                <div class="col-md-2">
                                    <label>Email Address*</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="email" name="email" id="email" class="form-control"
                                           value="{{ $user->email }}" value="{{ old('email') }}">
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row align-items-start">
                                <div class="col-md-2">
                                    <label>Phone Number*</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" name="phone" id="phone" class="form-control"
                                           value="{{ $user->phone }}" value="{{ old('phone') }}">
                                    @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row align-items-start">
                                <div class="col-md-2">
                                    <label>Gender*</label>
                                </div>
                                <div class="col-md-10">
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="" disabled>Select a Gender</option>
                                        <option value="Male" @if($user->gender == 'Male') selected @endif>Male</option>
                                        <option value="Female" @if($user->gender == 'Female') selected @endif>Female
                                        </option>
                                    </select>
                                    @error('gender')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row align-items-start">
                                <div class="col-md-2">
                                    <label>Country**</label>
                                </div>
                                <div class="col-md-10">
                                    <select name="country" id="country" class="form-control">
                                        <option value="">Select a country</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}"
                                                {{ ($user->country == $country->id) ? 'selected' : '' }}
                                                {{ (old('country') == $country->id) ? 'selected' : '' }}>
                                                {{ $country->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('country')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row align-items-start">
                                <div class="col-md-2">
                                    <label>State**</label>
                                </div>
                                <div class="col-md-10">
                                    <select name="state_id" id="state" value="{{ $user->state ?? '' }}"
                                            class="form-control">
                                        {{--                                                                                <option value="">Select a state</option>--}}
                                        {{--                                                                                @if ($user->country_id)--}}
                                        {{--                                                                                    @foreach($states as $state)--}}
                                        {{--                                                                                        <option value="{{ $state->id }}"--}}
                                        {{--                                                                                            {{ ($user->state_id == $state->id) ? 'selected' : '' }}--}}
                                        {{--                                                                                            {{ (old('state_id') == $state->id) ? 'selected' : '' }}>--}}
                                        {{--                                                                                            {{ $state->name }}--}}
                                        {{--                                                                                        </option>--}}
                                        {{--                                                                                    @endforeach--}}
                                        {{--                                                                                @endif--}}
                                    </select>
                                    @error('state_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row align-items-start">
                                <div class="col-md-2">
                                    <label>City**</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" name="city" id="city" class="form-control"
                                           value="{{ $user->city }}" value="{{ old('city') }}">
                                    @error('city')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row align-items-start">
                                <div class="col-md-2">
                                    <label>Zip**</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" name="zip" id="zip" class="form-control"
                                           value="{{ $user->zip }}" value="{{ old('zip') }}">
                                    @error('zip')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row align-items-start">
                                <div class="col-md-2">
                                    <label>Address*</label>
                                </div>
                                <div class="col-md-10">
                                            <textarea name="address" required class="form-control"
                                                      rows="5">{{ $user->address ?? '' }}</textarea>
                                </div>
                            </div>

                            @if($user->hasRole('vendor'))
{{--                                <x-dashboard.vendor.create-vendor-profile :user="$user"/>--}}
                            @endif
                            <div class="col-md-10">
                                <button type="submit" class="themeBtn">Save Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade editprof" id="pills-contact" role="tabpanel"
                     aria-labelledby="pills-contact-tab">
                    <div class="recentTable editProfile editRes">
                        <form class="editForm" method="POST" action="{{route('password.update')}}">
                            @csrf
                            @method('POST')
                            <div class="row align-items-start">
                                <div class="col-md-2">
                                    <label>Current Password*</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="password" name="current_password">

                                </div>
                            </div>
                            <div class="row align-items-start">
                                <div class="col-md-2">
                                    <label>New Password*</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="password" name="password">

                                </div>
                            </div>
                            <div class="row align-items-start">
                                <div class="col-md-2">
                                    <label>Confirm Password*</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="password" name="password_confirmation">
                                </div>
                            </div>
                            <div class="row align-items-start">
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-10">
                                    <button type="submit" class="themeBtn">Save Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/user.js') }}"></script>

@endsection
@push('script')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#country').on('change', function () {
                var countryId = $(this).val();

                $.ajax({
                    url: '{{asset('/get-states/')}}/' + countryId,
                    type: 'GET',
                    success: function (data) {
                        var stateSelect = $('#state');

                        stateSelect.empty().append('<option value="">Select a state</option>');

                        $.each(data, function (key, value) {
                            stateSelect.append('<option value="' + value.id + '">' + value.name + '</option>');
                        });


                    }
                });
            });
        });
    </script>
