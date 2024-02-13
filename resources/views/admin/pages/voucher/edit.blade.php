@extends('admin.layout.admin')

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="page-title-box">
                    <h4 class="mt-0 header-title">Edit Voucher</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.voucher.update', ['voucher' => $voucher->id]) }}"
                                  method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label for="parent_id">Voucher</label>
                                        <input type="text" name="code" id="name" class="form-control"
                                               value="{{ $voucher->code ?? old('code') }}">
                                        @error('code')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group col-md-6">
                                        <label for="name">Voucher Discount Percentage</label>
                                        <input type="number" name="discount_amount_percent" id="name"
                                               class="form-control"
                                               value="{{ $voucher->discount_amount_percent ?? old('discount_amount_percent') }}">
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
                                               value="{{ $voucher->expiry_date ?? old('expiry_date') }}">
                                        @error('expiry_date')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Update Voucher</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>
        //FOR PRODUCT FEATURE IMAGE PREVIEW
        let uploadButton = document.getElementById("crop-image");
        const fileInput = document.getElementById("file-input");
        const featurePhoto = document.getElementById("feature_photo");
        const imagePreview = document.getElementById("image-preview");

        uploadButton.addEventListener("click", function () {
            fileInput.click();
        });

        fileInput.addEventListener("change", function () {
            if (fileInput.files.length > 0) {
                const selectedImage = fileInput.files[0];
                featurePhoto.value = selectedImage.name;  // Set the filename in the hidden input
                imagePreview.style.display = "block"; // Show the image preview
                imagePreview.src = URL.createObjectURL(selectedImage); // Set the preview image source

            } else {
                imagePreview.style.display = "none"; // Hide the image preview if no image is selected

            }
        });

    </script>

@endsection
