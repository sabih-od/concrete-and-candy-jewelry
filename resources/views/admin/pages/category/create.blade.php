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
                                        <a href="{{ route('admin.users.index') }}">Categories</a>
                                    </li>
                                    <li class="breadcrumb-item active">Create Category</li>
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

                                <h4 class="mt-0 header-title">Create Category</h4>

                                <form method="POST" action="{{ route('admin.category.store') }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')

                                    <div class="row">

                                        <div class="col-md-8">
                                            <div class="form-group col-md-12">
                                                <label for="name">Category Name</label>
                                                <input type="text" name="name" id="name" class="form-control"
                                                       value="{{ old('name') }}">

                                                @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="col-md-4">

                                            <div class="form-group col-md-12">
                                                <label for="name">Category Image</label>
                                                <div class="col-lg-12">
                                                    <div class="panel panel-body">
                                                        <div id="crop-image"
                                                             class="span4 cropme text-center d-flex justify-content-center"
                                                             id="landscape"
                                                             style="width: 100%; height: 285px; border: 1px dashed #ddd; background: #f1f1f1;">
                                                            <button type="button" id="upload-btn" class="mybtn1">
                                                                <i class="icofont-upload-alt"></i> Upload Image Here
                                                            </button>
                                                            <img id="image-preview" src="" alt="Image Preview"
                                                                 style="max-width: 100%; max-height: 285px; display: none;object-fit:contain">
                                                        </div>
                                                    </div>

                                                </div>
                                                <input type="file" id="file-input" name="category_img"
                                                       style="display: none;">
                                                <input type="hidden" id="feature_photo" value=""
                                                       required="">
                                                @error('category_img')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group mb-0">
                                            <div>
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                    Create
                                                </button>
                                            </div>
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

                    //FOR PRODUCT FEATURE IMAGE PREVIEW
                    const uploadButton = document.getElementById("crop-image");
                    const fileInput = document.getElementById("file-input");
                    const featurePhoto = document.getElementById("feature_photo");
                    const imagePreview = document.getElementById("image-preview");
                    const uploadBtn = document.getElementById("upload-btn");

                    uploadButton.addEventListener("click", function () {
                        fileInput.click();
                    });

                    fileInput.addEventListener("change", function () {
                        if (fileInput.files.length > 0) {
                            const selectedImage = fileInput.files[0];
                            featurePhoto.value = selectedImage.name;  // Set the filename in the hidden input
                            imagePreview.style.display = "block"; // Show the image preview
                            imagePreview.src = URL.createObjectURL(selectedImage); // Set the preview image source
                            uploadBtn.style.display = "none";

                        } else {
                            imagePreview.style.display = "none"; // Hide the image preview if no image is selected
                            uploadBtn.style.display = "block";

                        }
                    });

                </script>


@endsection
