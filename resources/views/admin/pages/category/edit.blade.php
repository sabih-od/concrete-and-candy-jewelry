@extends('admin.layout.admin')

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="page-title-box">
                    <h4 class="mt-0 header-title">Edit Category</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.category.update', ['category' => $category->id]) }}"
                                  method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group col-md-12">
                                            <label for="name">Category Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                   value="{{ $category->name }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="parent_id">Parent Category</label>
                                            <select class="form-control" id="parent_id" name="parent_id">
                                                <option value="0">Select Parent Category</option>
                                                @foreach($categories as $parentCategory)
                                                    @if ($parentCategory->parent_id == 0)
                                                        <option style="font-weight: bold;" value="{{ $parentCategory->id }}" {{ $category->parent_id == $parentCategory->id ? 'selected' : '' }}>
                                                            {{ $parentCategory->name }}
                                                        </option>
                                                        @if ($parentCategory->subcategories->count() > 0)
                                                            @include('admin.components.edit-category-dropdown', [
                                                                'subcategories' => $parentCategory->subcategories,
                                                                 'maincategories' => $category,
                                                                'level' => 1 // Start with level 1 for the top-level categories
                                                            ])
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group col-md-12">
                                            <label for="parent_id">Category Image</label>
                                            <div class="col-lg-12">
                                                <div class="panel panel-body">
                                                    <div id="crop-image"
                                                         class="span4 cropme text-center d-flex justify-content-center"
                                                         id="landscape"
                                                         style="width: 100%; height: 285px; border: 1px dashed #ddd; background: #f1f1f1;">
                                                        <img id="image-preview"
                                                             src="{{ $category->categoryImage() }}"
                                                             alt="Image Preview"
                                                             style="max-width: 100%; max-height: 285px; object-fit:contain">
                                                    </div>
                                                </div>

                                            </div>
                                            <input type="file" id="file-input" name="category_img"
                                                   style="display: none;"
                                                   accept="image/*">
                                            <input type="hidden" id="feature_photo" value=""
                                                   required="">
                                            @error('category_img')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Update Category</button>
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
