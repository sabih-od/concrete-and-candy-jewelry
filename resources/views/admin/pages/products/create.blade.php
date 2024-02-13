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
                                           href="{{ route('admin.prods.index') }}">Products</a>
                                    </li>
                                    <li class="breadcrumb-item active">Create Product</li>
                                </ol>
                            </div>
                        </div>

                        <div class="col-md-4 ">
                            <button class="btn btn-circle btn-dark float-right">
                                <a href="{{ route('admin.prods.index') }}"
                                   style="text-align:center; color: #fff; padding: 5px; text-decoration: none; display: inline-block;float: right; margin-bottom: 3px">
                                    <i class="fas fa-arrow-left"></i></a>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- end page-title -->
                <form id="add-product-form" action="{{ route('admin.prod.store') }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="mt-0 header-title">Create Product</h4>
                                    <div class="form-group">
                                        <label for="name">Name *</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                               value="{{ old('name') }}">
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="roles">Category *</label>
                                        <select name="category_id" id="parent_id" class="form-control">
                                            <option value="0" disabled>Select Category</option>
                                            @forelse ($categories as $category)
                                                @if ($category->parent_id == 0)
                                                    <option style="font-weight: bold;"
                                                            value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @if ($category->subcategories->count() > 0)
                                                        @include('admin.components.category-dropdown', [
                                                            'subcategories' => $category->subcategories,
                                                            'level' => 1, // Start with level 1 for the top-level categories
                                                            'create_new_category' => 1
                                                        ])
                                                    @endif
                                                @endif

                                            @empty
                                                <option value="">No category available</option>
                                            @endforelse
                                        </select>
                                        @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="">
                                        <ul class="list">
                                            <li>
                                                <input class="checkclick1" name="product_brand_check"
                                                       type="checkbox" id="product_condition_check" value="1">
                                                <label
                                                    for="product_condition_check">{{ __('Product Brand') }}</label>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="form-group show-box">
                                        <div class="col-lg-12">
                                            <div class="left-area">
                                                <p class="m-0">{{ __('Product Brand') }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <input type="text" class="form-control"
                                                   name="brand">
                                        </div>
                                        @error('brand')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Validation for variation errors--}}
                                    @if ($errors->any())
                                        <div>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    @if (strpos($error, 'variation') !== false)
                                                        <li class="text-danger">{{ $error }}</li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="">
                                        <ul class="list">
                                            <li>
                                                <input class="checkclick1" name="product_variation_check"
                                                       type="checkbox" id="product_condition_check" value="1">
                                                <label
                                                    for="product_condition_check">{{ __('Manage Variation') }}</label>
                                            </li>
                                        </ul>
                                    </div>

                                    <div id="duplicated-container" class="show-box">
                                        <div class="form-group variation-box">
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="col-lg-12">
                                                        <div class="left-area">
                                                            <p class="m-0">{{ __('Size') }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <select name="variation_sizes[]" id="roles"
                                                                class="form-control">
                                                            @forelse($productSizes as $sizes)
                                                                <option value="{{ $sizes->id }}">
                                                                    {{$sizes->name ?? '' }}
                                                                </option>
                                                            @empty
                                                                <option value="">
                                                                    No sizes available
                                                                </option>
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="col-lg-12">
                                                        <div class="left-area">
                                                            <p class="m-0">{{ __('Color') }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-9 pr-0">
                                                            <input type="text" id="colorCode" class="form-control"
                                                                   name="variation_colors[]" readonly>
                                                        </div>

                                                        <div class="col-2 pl-1 pr-0">
                                                            <input type="color" id="colorPicker" class="form-control">
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-3">
                                                    <div class="col-lg-12">
                                                        <div class="left-area">
                                                            <p class="m-0">{{ __('Price') }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <input type="number" class="form-control"
                                                               name="variation_prices[]"
                                                               placeholder="Select Size Price">
                                                    </div>
                                                </div>

                                                <div class="col-1"></div>

                                                <div class="col-1 d-flex justify-content-center align-items-center">
                                                    <button type="button" id="minus-variation"
                                                            class="btn btn-danger mt-4"
                                                            style="display: none"><i
                                                            class="fas fa-minus"></i></button>

                                                    <button type="button" id="add-variation"
                                                            class="btn btn-primary mt-4"><i
                                                            class="fas fa-plus"></i>
                                                    </button>
                                                </div>

                                            </div>

                                        </div>
                                    </div>


                                    <div class="">
                                        <ul class="list">
                                            <li>
                                                <input name="featured"
                                                       type="checkbox" id="product_condition_check" value="1">
                                                <label
                                                    for="product_condition_check">{{ __('Featured') }}</label>
                                            </li>
                                        </ul>
                                    </div>


{{--                                    <div class="">--}}
{{--                                        <ul class="list">--}}
{{--                                            <li>--}}
{{--                                                <input class="checkclick1" name="product_return"--}}
{{--                                                       type="checkbox" id="product_return" value="1">--}}
{{--                                                <label--}}
{{--                                                    for="product_return_policy">{{ __('Return Policy') }}</label>--}}
{{--                                                <span class="note">( If the checkbox is left unchecked,--}}
{{--                                                    it will not be eligible for return )</span>--}}
{{--                                            </li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}

{{--                                    <div class="form-group show-box">--}}
{{--                                        <div class="col-lg-12">--}}
{{--                                            <textarea name="product_return_policy" class="form-control"--}}
{{--                                                      rows="5"--}}
{{--                                                      value=""--}}
{{--                                                      placeholder="Return policy..">{{ old('product_return_policy') }}</textarea>--}}

{{--                                        </div>--}}
{{--                                        @error('product_return_policy')--}}
{{--                                        <span class="text-danger">{{ $message }}</span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}


                                    <div class="form-group">
                                        <label for="name">Stock *</label>
                                        <input type="number" name="stock_quantity" id="name" class="form-control"
                                               value="{{ old('stock_quantity') }}" placeholder="Quantity">
                                        @error('stock_quantity')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="textarea">Description *</label>
                                        <div>
                                            <textarea name="description" class="form-control"
                                                      rows="5"
                                                      placeholder="Detail">{{ old('description') }}</textarea>

                                        </div>
                                        @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="add-product-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="product-description">
                                            <div class="body-area">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="left-area">
                                                            <label class="heading">Feature Image *</label>
                                                        </div>
                                                    </div>
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
                                                    <input type="file" id="file-input" name="photo"
                                                           style="display: none;"
                                                           accept="image/*">
                                                    <input type="hidden" id="feature_photo" value=""
                                                           required="">

                                                    <input type="file" name="gallery[]" class="hidden"
                                                           id="uploadgallery" accept="image/*" multiple="">
                                                    @error('photo')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-lg-12 mb-2">
                                                        <div class="left-area">
                                                            <label class="heading">
                                                                Product Gallery Images *
                                                            </label>
                                                        </div>
                                                        @error('gallery')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <button type="button" class="set-gallery" data-toggle="modal"
                                                                data-target="#setgallery">
                                                            <i class="icofont-plus"></i> Set Gallery
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="left-area">
                                                            <label class="heading">
                                                                Price *
                                                            </label>

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <input name="price" type="number" class="input-field"
                                                               value="{{ old('price') }}" placeholder="e.g 20"
                                                               step="0.01" min="0">
                                                    </div>
                                                    @error('price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="row text-center">
                                                    <div class="col-6 offset-3">
                                                        <button type="submit" class="addProductSubmit-btn">Create
                                                            Product
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- end row -->

            </div>
            {{--PRODUCT ADD GALLERY MODAL--}}
            <div class="modal fade" id="setgallery" tabindex="-1" role="dialog" aria-labelledby="setgallery"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Image Gallery') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="top-area">
                                <div class="row">
                                    <div class="col-sm-6 text-right">
                                        <div class="upload-img-btn">
                                            <label for="image-upload" id="prod_gallery"><i
                                                    class="icofont-upload-alt"></i>{{ __('Upload File') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="javascript:;" class="upload-done" data-dismiss="modal"> <i
                                                class="fas fa-check"></i> {{ __('Done') }}</a>
                                    </div>
                                    <div class="col-sm-12 text-center mb-2">(
                                        <small>{{ __('You can upload multiple Images.') }}</small> )
                                    </div>
                                </div>
                            </div>
                            <div class="gallery-images">
                                <div class="selected-image">
                                    <div class="row"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            @endsection


            @section('script')

                {{--    FOR LOADER--}}
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        var form = document.getElementById('add-product-form');

                        form.addEventListener('submit', function () {
                            // Show the loader when the form is submitted
                            $('#loader-container').css('display', 'block');

                        });
                    });
                </script>

                <script>
                    $(document).ready(function () {
                        // Event delegation for plus buttons
                        $("#duplicated-container").on("click", "#add-variation", function () {
                            var clone = $(".form-group.variation-box:first").clone(true);

                            // Clear the color picker and the associated input field
                            clone.find("input[type=color]").val("#000000");
                            clone.find("#colorCode").val("");
                            clone.find("#colorCode").val("").css('background-color', 'transparent');

                            clone.find("input[type=color]").val(""); // Clear color input
                            clone.find("input[type=number]").val(""); // Clear price input
                            clone.find("#minus-variation").show(); // Show the minus button for the new duplicate
                            clone.find("#add-variation").hide(); // Hide the plus button on the current clone
                            $("#duplicated-container").append(clone);
                        });

                        // Event delegation for minus buttons
                        $("#duplicated-container").on("click", "#minus-variation", function () {
                            $(this).closest(".form-group.variation-box").remove();
                        });

                        // Event delegation for color picker inputs
                        $("#duplicated-container").on("change", "input[type=color]", function () {
                            // Get the selected color value
                            const selectedColor = $(this).val();

                            // Find the associated color code input field within the same form group
                            const clonedColorCodeInput = $(this).closest(".form-group.variation-box").find("#colorCode");
                            clonedColorCodeInput.css('background-color', selectedColor);
                            clonedColorCodeInput.val(selectedColor);
                        });
                    });
                </script>


                <script>

                    // For show and hide checkbox inner box's
                    $(".checkclick1").on("change", function () {
                        if (this.checked) {
                            $(this).parent().parent().parent().next().removeClass('show-box');
                        } else {
                            $(this).parent().parent().parent().next().addClass('show-box');
                        }
                    });


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


                    // For set product Gallery
                    $(document).on('click', '.gallery-img-cross', function () {
                        var id = $(this).find('input[type=hidden]').val();
                        $('#galval' + id).remove();
                        $(this).parent().parent().remove();
                    });

                    $(document).on('click', '#prod_gallery', function () {
                        $('#uploadgallery').click();
                        $('.selected-image .row').html('');
                        $('#geniusform').find('.removegal').val(0);
                    });


                    $("#uploadgallery").change(function () {
                        var total_file = document.getElementById("uploadgallery").files.length;
                        for (var i = 0; i < total_file; i++) {
                            $('.selected-image .row').append('<div class="col-sm-6">' +
                                '<div class="img gallery-img">' +
                                '<span class="gallery-img-cross"><i class="fas fa-times"></i>' +
                                '<input type="hidden" value="' + i + '">' +
                                '</span>' +
                                '<a href="' + URL.createObjectURL(event.target.files[i]) + '" target="_blank">' +
                                '<img src="' + URL.createObjectURL(event.target.files[i]) + '"  class="gallery-image" alt="gallery image">' +
                                '</a>' +
                                '</div>' +
                                '</div> '
                            );
                            $('#add-product-form').append('<input type="hidden" name="galval[]" id="galval' + i + '" class="removegal" value="' + i + '">')
                        }

                    });

                </script>


@endsection

