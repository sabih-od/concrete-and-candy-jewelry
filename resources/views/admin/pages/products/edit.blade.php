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
                                        <a href="{{ route('admin.dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.prods.index') }}">Products</a>
                                    </li>
                                    <li class="breadcrumb-item active">Edit Product</li>
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

                <form method="POST" id="edit-product-form" action="{{route('admin.prod.update',$product->id)}}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="mt-0 header-title">Edit Product</h4>
                                    <div class="form-group">
                                        <label for="name">Name *</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                               value="{{ $product->name ?? old('name') }}">
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="roles">Category *</label>
                                        <select name="category_id" id="parent_id" class="form-control">
                                            <option disabled>Select Category</option>
                                            @foreach ($categories as $category)
                                                @if ($category->parent_id == 0)
                                                    <option style="font-weight: bold;"
                                                            value="{{ $category->id }}"
                                                            @if ($category->id == $product->category_id)
                                                            selected
                                                        @endif>
                                                        {{ $category->name }}
                                                    </option>
                                                    @if ($category->subcategories->count() > 0)
                                                        @include('admin.components.category-dropdown', [
                                                            'subcategories' => $category->subcategories,
                                                            'level' => 1,
                                                            'parentCategoryID' => $category->id,
                                                            'selectedCategoryID' => $product->category_id // Pass the selected category ID
                                                        ])
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="">
                                        <ul class="list">
                                            <li>
                                                <input class="checkclick1" name="product_brand_check"
                                                       type="checkbox" id="product_condition_check" value="1"
                                                       @if($product->brand != null) checked @endif>
                                                <label
                                                    for="product_condition_check">{{ __('Product Brand') }}</label>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="form-group @if($product->brand == null) show-box @endif ">
                                        <div class="col-lg-12">
                                            <div class="left-area">
                                                <p class="m-0">{{ __('Product Brand') }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <input type="text" class="form-control"
                                                   name="brand" value="{{$product->brand}}">
                                        </div>
                                        @error('brand')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{--                                    Validation for variation errors--}}
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
                                    {{--                                    @dd($product->variations())--}}
                                    <div class="">
                                        <ul class="list">
                                            <li>
                                                <input class="checkclick1" name="product_variation_check"
                                                       type="checkbox" id="product_condition_check" value="1"
                                                       @if($product->variations()->isNotEmpty()) checked @endif>
                                                <label
                                                    for="product_condition_check">{{ __('Manage Variation') }}</label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div id="duplicated-container"
                                         class=" @if(!$product->variations()->isNotEmpty()) show-box @endif">
                                        <p style="font-size: 12px ;color:grey;" class="ml-3">( Note: if variation is
                                            checked you should set atleast one variation.. )</p>

                                        @forelse($product->variations() as $index => $variation)
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
                                                                    <option value="{{ $sizes->id }}"
                                                                            @if($sizes->id == $variation->size_id) selected @endif>
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
                                                                       name="variation_colors[]" readonly
                                                                       value="{{ $variation->color }}"
                                                                       style=" background-color: {{ $variation->color}}">
                                                            </div>

                                                            <div class="col-2 pl-1 pr-0">
                                                                <input type="color" id="colorPicker"
                                                                       class="form-control">
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
                                                                   placeholder="Select Size Price"
                                                                   value="{{$variation->price ?? ''}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-1"></div>

                                                    <div class="col-1 d-flex justify-content-center align-items-center">
                                                        @if ($index === 0)
                                                            <button type="button" id="add-variation"
                                                                    class="btn btn-primary mt-4">
                                                                <i class="fas fa-plus"></i>
                                                            </button>

                                                        @else
                                                            <button type="button" id="minus-variation"
                                                                    class="btn btn-danger mt-4">
                                                                <i class="fas fa-minus"></i>
                                                            </button>
                                                        @endif
                                                        <button type="button" id="minus-variation"
                                                                class="btn btn-danger mt-4"
                                                                style="display: none"><i
                                                                class="fas fa-minus"></i></button>
                                                    </div>

                                                </div>

                                            </div>

                                        @empty
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
                                                                <input type="color" id="colorPicker"
                                                                       class="form-control">
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

                                        @endforelse

                                    </div>

                                    <div class="">
                                        <ul class="list">
                                            <li>
                                                <input name="featured"
                                                       type="checkbox" id="product_condition_check"
                                                       @if($product->featured == 1) checked @endif value="1">
                                                <label
                                                    for="product_condition_check">{{ __('Featured') }}</label>
                                            </li>
                                        </ul>
                                    </div>
                                    {{--                                    <div class="">--}}
                                    {{--                                        <ul class="list">--}}
                                    {{--                                            <li>--}}
                                    {{--                                                <input class="checkclick1" name="product_return"--}}
                                    {{--                                                       type="checkbox" id="product_return" value="1"--}}
                                    {{--                                                       @if(optional($product->returnPolicy)->product_id !== null) checked @endif>--}}
                                    {{--                                                <label--}}
                                    {{--                                                    for="product_return_policy">{{ __('Return Policy') }}</label>--}}
                                    {{--                                                <span class="note">( If the checkbox is left unchecked,--}}
                                    {{--                                                    it will not be eligible for return )</span>--}}
                                    {{--                                            </li>--}}
                                    {{--                                        </ul>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div--}}
                                    {{--                                        class="form-group @if(optional($product->returnPolicy)->product_id == null) show-box @endif ">--}}
                                    {{--                                        <div class="col-lg-12">--}}
                                    {{--                                            <textarea name="product_return_policy" class="form-control"--}}
                                    {{--                                                      rows="5"--}}
                                    {{--                                                      placeholder="Return policy">{{optional($product->returnPolicy)->return_policy}}--}}
                                    {{--                                            </textarea>--}}

                                    {{--                                        </div>--}}
                                    {{--                                        @error('product_return_policy')--}}
                                    {{--                                        <span class="text-danger">{{ $message }}</span>--}}
                                    {{--                                        @enderror--}}
                                    {{--                                    </div>--}}

                                    <div class="form-group">
                                        <label for="name">Stock *</label>
                                        <input type="number" name="stock_quantity" id="name" class="form-control"
                                               value="{{ $product->stock_quantity ?? old('stock_quantity') }}"
                                               placeholder="Quantity">
                                        @error('stock_quantity')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="textarea">Description *</label>
                                        <div>
                                            <textarea name="description" class="form-control"
                                                      rows="5"
                                                      placeholder="Detail">{{ $product->description ?? old('description') }}</textarea>

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
                                                                <img id="image-preview"
                                                                     src="{{ $product->productImage() }}"
                                                                     alt="Image Preview"
                                                                     style="max-width: 100%; max-height: 285px; object-fit:contain">
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
                                                            <i class="icofont-plus"></i> View Gallery
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
                                                               value="{{ $product->price ?? old('price') }}"
                                                               placeholder="e.g 20"
                                                               step="0.01" min="0">
                                                    </div>
                                                    @error('price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="row text-center">
                                                    <div class="col-6 offset-3">
                                                        <button type="submit" class="addProductSubmit-btn">Update
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

                    {{--PRODUCT ADD GALLERY MODAL--}}
                    <div class="modal fade" id="setgallery" tabindex="-1" role="dialog" aria-labelledby="setgallery"
                         aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"
                                        id="exampleModalCenterTitle">{{ __('Product  Gallery') }}</h5>
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
                                                            class="icofont-upload-alt"></i>{{ __('Upload File') }}
                                                    </label>
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
                                            <div class="row">
                                                @forelse($product->productGalleryImages() as  $galleryImg)
                                                    <div class="col-sm-6">
                                                        <div class="img gallery-img">
                                                <span class="gallery-img-cross"><i class="fas fa-times"></i>
                                                    <input type="hidden" value="{{$galleryImg->id}}">
                                                </span>
                                                            <a href="URL.createObjectURL(event.target.files[i])"
                                                               target="_blank">
                                                                <img src="{{ $galleryImg->getUrl() }}"
                                                                     class="gallery-image" alt="gallery image">
                                                            </a>
                                                        </div>
                                                    </div>
                                                @empty
                                                @endforelse

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

            @section('script')

                <script src="{{ asset('js/products.js') }}"></script>

@endsection
@endsection


