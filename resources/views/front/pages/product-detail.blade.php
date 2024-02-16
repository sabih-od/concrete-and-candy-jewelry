@extends('front.layout.app')

@section('content')


    <section class="innerBan"
             style="background-image: url('{{ $homeData->cmsImages('background_banner_image') ?? '' }}')">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mainHeading text-center text-white">Product Detail</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="productdetailInner">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="productImages">
                        <img src="{{ $product->productImage() }}" class="img-fluid"/>
                        @if(count($product->productGalleryImages()) > 0)

                            @forelse($product->productGalleryImages() as $galleryImg)
                                <div class="swiper-slide" style="position: relative">
                                    <img src="{{ $galleryImg->getUrl() }}" class="img-fluid"/>
                                </div>
                            @empty
                            @endforelse
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="productText">
                        {{--                        <div class="uislider-label">--}}
                        {{--                            <label for="amount">Price Range <span id="fromday">$</span> 15/-</label>--}}
                        {{--                            <label for="amount">to <span id="today">$</span> 70/-</label>--}}
                        {{--                        </div>--}}
                        {{--                        <div id="slider-range"></div>--}}
                        <h2 class="mainHeading">{{ $product->name ?? '' }}</h2>
                        <ul class="star">
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><span>37 reviews</span></li>
                        </ul>
                        <div class="price">
                            <span>Regular price</span>
                            <span class="d-flex">$ <span id="product-price">{{ $product->price ?? '' }}</span></span>
                        </div>


                        <div class="btn-group">
                            @forelse(json_decode($product->features) ?? [] as $feature)
                                @if($feature == 'waterproof' )
                                    <a href="#"><img src="{{ asset('images/water.png') }}" class="img-fluid" alt="">
                                        waterproof</a>
                                @elseif($feature == 'hypoallergenic')
                                    <a href="#"><i class="fal fa-heart"></i>Hypoallergenic</a>
                                @endif
                            @empty
                            @endforelse
                        </div>
                        <form id="addToCartForm" action="{{ route('front.cart.add',$product->id) }}" method="POST">
                        @csrf
                        @if(count($product->variations()) > 0)
                            <!-- Select for Size -->
                                <select name="variation_size_id" id="sizeSelect" class="form-control mt-4"
                                        style="border: 2px solid black ; border-radius: 0px">
                                    @php
                                        $addedSizes = [];
                                    @endphp

                                    @forelse($product->variations() as $variation)
                                        @if($variation->size() && !in_array($variation->size()->id, $addedSizes))
                                            <option

                                                value="{{ $variation->size()->id }}">{{ $variation->size()->name }}
                                            </option>
                                            @php
                                                $addedSizes[] = $variation->size()->id;
                                            @endphp
                                        @endif
                                    @empty
                                        <option disabled>No sizes available</option>
                                    @endforelse
                                </select>

                                <!-- Select for Color -->
                                <h5 class="mt-3">Colors</h5>
                                <ul id="colorSelect" class="mt-3 color-option">

                                </ul>
                            @endif
                            {{--                        <a href="#" class="size"><i class="fal fa-arrows-h"></i>Size Guide</a>--}}
                            <div class="qtybox mt-3">
                                <button type="button" class="subbtn"><i class="fas fa-minus"></i></button>
                                <input type="text" class="textbox" value="1" readonly="" name="quantity">
                                <button type="button" class="addbtn"><i class="fas fa-plus"></i></button>
                            </div>
                            <button type="submit" class="cartBtn">ADD TO CART</button>
                            {{--                        <a href="#" class="shoPay">Buy with <img src="{{ asset('images/shop.png') }}" class="img-fluid"--}}
                            {{--                                                                 alt=""></a>--}}
                            {{--                        <a href="#" class="payment">More payment options</a>--}}
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>




@endsection

@section('script')

    {{--    <script>--}}
    {{--        // Initialize the agent on page load.--}}
    {{--        $(document).ready(function () {--}}

    {{--            const fpPromise = import('https://fpjscdn.net/v3/cPkLoUhV7vuBbPEf5YRZ')--}}
    {{--                .then(FingerprintJS => FingerprintJS.load())--}}
    {{--            // Get the visitorId when you need it.--}}
    {{--            fpPromise--}}
    {{--                .then(fp => fp.get())--}}
    {{--                .then(result => {--}}
    {{--                    const visitorId = result.visitorId--}}
    {{--                    sendFingerprintToServer(visitorId);--}}
    {{--                })--}}


    {{--            function sendFingerprintToServer(fingerprint) {--}}
    {{--                var csrfToken = $('meta[name="csrf-token"]').attr('content');--}}

    {{--                $.ajax({--}}
    {{--                    type: 'POST',--}}
    {{--                    url: '{{ route('track.visitor', ['product' => $product->id]) }}',--}}
    {{--                    data: {--}}
    {{--                        _token: csrfToken,--}}
    {{--                        fingerprint: fingerprint,--}}
    {{--                    },--}}
    {{--                    success: function (data) {--}}
    {{--                        console.log("data", data)--}}
    {{--                        if (data) {--}}
    {{--                            $('#interestedproductCount').html(data.data.VisitorCount);--}}

    {{--                        }--}}
    {{--                    },--}}
    {{--                });--}}
    {{--            }--}}
    {{--        })--}}

    {{--    </script>--}}


    <script>

        $(document).ready(function () {
            // Your existing code for handling the change event
            $('#sizeSelect').on('change', function () {
                var sizeSelect = $(this).val();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'POST',
                    url: '{{ route('product.size.colors') }}',
                    data: {
                        _token: csrfToken,
                        variation_size: sizeSelect,
                        product_id: {{ $product->id }}
                    },
                    success: function (data) {
                        var colorDropdown = $('#colorSelect');
                        colorDropdown.empty();
                        console.log("data", data.data)
                        if (data.data.length > 0) {
                            // colorDropdown.append('<option disabled selected hidden style="width: 100%;">Select Color Variation</option>');
                            data.data.forEach(function (item, index) {
                                if (item.color == null) {
                                    $('#product-price').text(item.price);
                                    $('#product_price').val(item.price);
                                    document.getElementById('product_price').value = item.price;
                                    colorDropdown.hide();
                                    return
                                }
                                colorDropdown.show();
                                var listItem = $('<li></li>');
                                var label = $('<label class="choose-color"></label>');
                                var input = $('<input value="' + item.color + '" type="radio" hidden name="variation_color">');
                                var span = $('<span class="color-box" style="--color:' + item.color + '"></span>');

                                label.append(input);
                                label.append(span);
                                listItem.append(label);
                                colorDropdown.append(listItem);


                                if (index === 0) {
                                    $('#product-price').text(item.price);
                                    $('#product_price').val(item.price);

                                }

                            });
                        }
                    }
                });
            });

            // Trigger the change event on page load
            $('#sizeSelect').change();
        });


        $('#colorSelect').on('change', function () {
            var selectedOption = $(this).find('option:selected');

            var selectedColor = $(this).val();
            var selectedPrice = selectedOption.data('price');

            $('#colorSelect').css('background-color', selectedColor);

            $('#product-price').text(selectedPrice);
            $('#product_price').val(selectedPrice);

            document.getElementById('product_price').value = selectedPrice;

        });
    </script>
@endsection

