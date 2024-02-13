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

                                <li class="breadcrumb-item active">Settings</li>
                            </ol>
                        </div>
                        <!-- Back Button -->
                    </div>
                </div>

                <!-- Update Settings Form -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Update Settings</h4>

                                <form method="POST" action="{{ route('admin.setting.update', $setting->id) }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="header_logo">Header Logo</label>
                                            <input type="file" name="header_logo" id="header_logo" class="form-control"
                                                   onchange="previewImage(this, 'header_logo_preview')"
                                                   accept="image/*">
                                            @foreach($setting->getMedia('header_logo') as $media)
                                                <img src="{{ $media->getUrl() }}" alt="Existing Banner Image"
                                                     style="max-width: 200px; max-height: 200px; margin-top: 10px;">
                                            @endforeach
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="footer_logo">Footer Logo</label>
                                            <input type="file" name="footer_logo" id="footer_logo" class="form-control"
                                                   onchange="previewImage(this, 'footer_logo_preview')"
                                                   accept="image/*">
                                            @foreach($setting->getMedia('footer_logo') as $media)
                                                <img src="{{ $media->getUrl() }}" alt="Existing Banner Image"
                                                     style="max-width: 200px; max-height: 200px; margin-top: 10px;">
                                            @endforeach
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="fav_image">Favicon Image</label>
                                            <input type="file" name="fav_image" id="fav_image" class="form-control"
                                                   onchange="previewImage(this, 'fav_image_preview')" accept="image/*">
                                            @foreach($setting->getMedia('fav_icon') as $media)
                                                <img src="{{ $media->getUrl() }}" alt="Existing Banner Image"
                                                     style="max-width: 200px; max-height: 200px; margin-top: 10px;">
                                            @endforeach
                                        </div>

                                        <!-- Add more fields for phone_no, address, email, social links as needed -->

                                        <div class="form-group col-md-4">
                                            <label for="phone_no">Phone Number</label>
                                            <input type="text" name="phone_no" id="phone_no" class="form-control"
                                                   value="{{ $setting->phone_no ?? ''}}">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="address">Address</label>
                                            <input type="text" name="address" id="address" class="form-control"
                                                   value="{{ $setting->address ?? ''}}">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="email">Email</label>
                                            <input type="text" name="email" id="email" class="form-control"
                                                   value="{{ $setting->email ?? ''}}">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="social_link_1">Social Link 1</label>
                                            <input type="text" name="social_link_1" id="social_link_1"
                                                   class="form-control" value="{{ $setting->social_link_1 }}">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="social_link_2">Social Link 2</label>
                                            <input type="text" name="social_link_2" id="social_link_2"
                                                   class="form-control" value="{{ $setting->social_link_2 }}">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="social_link_3">Social Link 3</label>
                                            <input type="text" name="social_link_3" id="social_link_3"
                                                   class="form-control" value="{{ $setting->social_link_3 }}">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="social_link_4">Social Link 4</label>
                                            <input type="text" name="social_link_4" id="social_link_4"
                                                   class="form-control" value="{{ $setting->social_link_4 }}">
                                        </div>

{{--                                        <div class="form-group col-md-4">--}}
                                        {{--                                            <label for="pay_out_days">Pay out days</label>--}}
                                        {{--                                            <input type="text" name="pay_out_days" id="pay_out_days"--}}
                                        {{--                                                   class="form-control" value="{{ $setting->pay_out_days }}">--}}
                                        {{--                                        </div>--}}

                                        {{--                                        <div class="form-group col-md-4">--}}
                                        {{--                                            <label for="product_return_days">Product return days</label>--}}
                                        {{--                                            <input type="text" name="product_return_days" id="product_return_days"--}}
                                        {{--                                                   class="form-control" value="{{ $setting->product_return_days }}">--}}
                                        {{--                                        </div>--}}

                                        <div class="form-group mb-0">
                                            <div>
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                    Update Settings
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

<script>
    function previewImage(input, previewId) {
        var preview = document.getElementById(previewId);
        var file = input.files[0];
        var reader = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
        }
    }
</script>
