@forelse($products as $product)

    <div class="col-md-4">
        <div class="product-card">


            @if($product->wishlist != null)

                <div class="product-card__icon">
                    <i class="fa fa-heart"></i>
                    <i class="fal fa-heart"></i>
                </div>

            @else

                <a href="{{ route('add-to-wishlist' , $product->id) }}" class="product-card__icon">
                    <i class="fal fa-heart"></i>
                    <i class="fas fa-heart"></i>
                </a>


            @endif

            <a href="{{ route('front.shop.product' , ['slug' => $product->slug]) }}" class="arrivalWrap">
                <figure>
                    <img src="{{ $product->productImage() }}" class="img-fluid" alt="">
                </figure>
                <h4>{{ $product->name ?? '' }}</h4>
            </a>

        </div>

    </div>


@empty

    <p>Sorry!! No products found</p>

@endforelse
