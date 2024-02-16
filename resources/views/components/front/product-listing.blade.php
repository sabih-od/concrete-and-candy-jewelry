@forelse($products as $product)

    <div class="col-md-4">
        <a href="{{ route('front.shop.product' , ['slug' => $product->slug]) }}" class="arrivalWrap">
            <figure>
                <img src="{{ $product->productImage() }}" class="img-fluid" alt="">
            </figure>
            <h4>{{ $product->name ?? '' }}</h4>
        </a>
    </div>


@empty

    <p>Sorry!! No products found</p>

@endforelse
