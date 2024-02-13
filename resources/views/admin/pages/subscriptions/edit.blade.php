@extends('admin.layout.admin')
@section('content')

    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="page-title-box">
                                <h4 class="page-title">Admin Panel</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.subscriptions.index') }}">Subscriptions</a>
                                    </li>
                                    <li class="breadcrumb-item active">Edit Subscription</li>
                                </ol>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <button class="btn btn-circle btn-dark float-right">
                                <a href="{{ route('admin.subscriptions.index') }}"
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
                                <h4 class="mt-0 header-title">Edit Subscription</h4>

                                <form method="POST" action="{{ route('admin.subscription.update', $subscription->id) }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" id="title" class="form-control" value="{{ $subscription->title }}" required>
                                            @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="cost">Cost</label>
                                            <input type="text" name="cost" id="cost" class="form-control" value="{{ $subscription->cost }}" required>
                                            @error('cost')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="product_limit">Product Limit</label>
                                            <select name="product_limit" id="product_limit" class="form-control" required>
                                                <option value="limited" @if($subscription->product_limit === 'limited') selected @endif>Limited</option>
                                                <option value="unlimited" @if($subscription->product_limit === 'unlimited') selected @endif>Unlimited</option>
                                            </select>
                                            @error('product_limit')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4"id="allowed_products_field">
                                            <label for="allowed_products">Allowed Products</label>
                                            <input type="text" name="allowed_products" id="allowed_products" class="form-control"  value="{{$subscription->allowed_products}}" required>

                                            @error('allowed_products')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4" id="price_per_product_field">
                                            <label for="price_per_product">Price Per Product</label>
                                            <input type="number" name="price_per_product" id="price_per_product" class="form-control" value="{{$subscription->price_per_product}}"required>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="total_price">Total Price</label>
                                            <input type="text" name="total_price" id="total_price" class="form-control"  value="{{$subscription->total_price}}" required>

                                            <input type="hidden" value="partial" name = "payment_type" />

                                            @error('total_price')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="expiry_days">Expiry Days</label>
                                            <input type="text" name="expiry_days" id="expiry_days" class="form-control"  value="{{$subscription->expiry_days}}" required>

                                            @error('expiry_days')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="details">Details</label>
                                            <input type="text" name="details" id="details" class="form-control" value="{{$subscription->details}}" required>

                                            @error('details')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-0">
                                            <div>
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                    Update
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the necessary elements
            var productLimitSelect = document.getElementById('product_limit');
            var allowedProductsField = document.getElementById('allowed_products_field');
            var pricePerProductField = document.getElementById('price_per_product_field');
            var totalPriceField = document.getElementById('total_price_field');
            var totalPriceInput = document.getElementById('total_price');
            var priceInput = document.getElementById('price_per_product');  // Assuming you have this element
            var quantityInput = document.getElementById('allowed_products');  // Assuming you have this element
            var paymentTypeInput = document.getElementsByName('payment_type')[0]; // Assuming there is only one element with the name 'payment_type'


            // Add an event listener to the product limit select
            productLimitSelect.addEventListener('change', function() {
                // Check the selected value
                var selectedValue = productLimitSelect.value;

                // Show/hide fields based on the selected value
                if (selectedValue === 'unlimited') {
                    allowedProductsField.style.display = 'none';
                    pricePerProductField.style.display = 'none';
                    totalPriceInput.removeAttribute('readonly');
                    document.getElementById('allowed_products').removeAttribute('required');
                    document.getElementById('price_per_product').removeAttribute('required');
                    paymentTypeInput.value ="one_time"

                } else {
                    allowedProductsField.style.display = 'block';
                    pricePerProductField.style.display = 'block';
                    totalPriceField.style.display = 'block';
                    totalPriceInput.setAttribute('readonly', 'readonly');
                    document.getElementById('allowed_products').setAttribute('required', 'required');
                    document.getElementById('price_per_product').setAttribute('required', 'required');
                    paymentTypeInput.value ="partial"

                    // totalPriceInput.value = ''; // Clear the value if it's set and the field is readonly
                }
            });

            // Trigger the change event to set the initial state
            productLimitSelect.dispatchEvent(new Event('change'));

            // Function to update total price
            function updateTotalPrice() {
                var price = parseFloat(priceInput.value) || 0;
                var quantity = parseInt(quantityInput.value) || 0;
                var total = price * quantity;

                // Update the total price input field
                totalPriceInput.value = total.toFixed(2);
            }

            // Add event listeners to update total price when inputs change
            priceInput.addEventListener('input', updateTotalPrice);
            quantityInput.addEventListener('input', updateTotalPrice);
        });
    </script>
@endsection
