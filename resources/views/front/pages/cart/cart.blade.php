@extends('front.layout.app')

@section('content')

    <div class="mouse-cursor cursor-outer"></div>
    <div class="mouse-cursor cursor-inner"></div>

    <section class="innerBan" style="background-image: url('images/innerBg.jpg') ">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mainHeading text-center text-white">Cart</h2>
                </div>
            </div>
        </div>
    </section>

    <div class="check-out-section" style="padding: 100px 0px;
    border-top: 1px solid #ebebeb;">
        <div class="container">
            <div class="check-out-form check-out-2 text-center">
                <h2 class="primary-heading">Confirm Your Purchase</h2>
                <div class="col-12 offset-lg-1 col-lg-10">
                    @forelse($cart as $crt)
                        <div class="row card-row">
                            <div class="col-md-2">
                                <a href="" class="card-hover">
                                    <figure>
                                        <img src="{{$crt->options->product->productImage()!=null ?
                                    $crt->options->product->productImage() :  asset('images/summer2.jpg') }}" alt="">
                                    </figure>
                                </a>
                            </div>
                            <div class="col-md-5">
                                <a href="">
                                    <h4 class="red">{{$crt->name}}</h4>
                                </a>
                                <h6>{{$crt->options->product->description}}</h6>
                                @if($crt->options->color!=null)
                                    <h6>Color :
                                        <div
                                            style="width: 20px; height: 20px; background-color: {{ $crt->options->color }};"></div>
                                    </h6>
                                @endif

                                @if($crt->options->size !=null)
                                    <h6>Size : {{App\Helpers\SizeHelper::getSize($crt->options->size)}}</h6>
                                @endif

                                <h6>Original Price : {{$crt->price}}</h6>
                            </div>
                            <div class="col-md-2">
                                <span class="price red">$ {{$crt->price * $crt->qty}}</span>
                            </div>
                            <div class="col-md-3">
                                <form class="numForm d-flex justify-content-between"
                                      method="POST"
                                      action="{{route('front.cart.update',$crt->rowId)}}">
                                    @csrf
                                    @method('PUT')
                                    <div class="shop-details num-block">
                                        <div class="numberone">
                                            <span class="plus" onclick="changeQuantity('add')">+</span>
                                            <input class="in-num"
                                                   type="text"
                                                   name="quantity" value="{{$crt->qty}}">
                                            <span class="minus dis" onclick="changeQuantity('minus')">-</span>
                                        </div>
                                    </div>
                                    <div class="updateBtn">
                                        <a href="{{route('front.cart.remove', $crt->rowId)}}">
                                            <svg class="svg-inline--fa fa-trash-alt fa-w-14" aria-hidden="true"
                                                 data-prefix="far"
                                                 data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 448 512" data-fa-i2svg="">
                                                <path fill="currentColor"
                                                      d="M192 188v216c0 6.627-5.373 12-12 12h-24c-6.627 0-12-5.373-12-12V188c0-6.627 5.373-12 12-12h24c6.627 0 12 5.373 12 12zm100-12h-24c-6.627 0-12 5.373-12 12v216c0 6.627 5.373 12 12 12h24c6.627 0 12-5.373 12-12V188c0-6.627-5.373-12-12-12zm132-96c13.255 0 24 10.745 24 24v12c0 6.627-5.373 12-12 12h-20v336c0 26.51-21.49 48-48 48H80c-26.51 0-48-21.49-48-48V128H12c-6.627 0-12-5.373-12-12v-12c0-13.255 10.745-24 24-24h74.411l34.018-56.696A48 48 0 0 1 173.589 0h100.823a48 48 0 0 1 41.16 23.304L349.589 80H424zm-269.611 0h139.223L276.16 50.913A6 6 0 0 0 271.015 48h-94.028a6 6 0 0 0-5.145 2.913L154.389 80zM368 128H80v330a6 6 0 0 0 6 6h276a6 6 0 0 0 6-6V128z">
                                                </path>
                                            </svg>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="row mb-3">
                            <div class="offset-1 col-lg-10 offset-1">
                                <a href="{{ route('front.shop') }}" class="text-dark">
                                    <i class="fas fa-arrow-left"></i>
                                    <b>Go To Shopping</b>
                                </a>
                            </div>
                        </div>
                    @endforelse

                    <div class="row">
                        <div class="offset-1 col-lg-10 offset-1">
                            <p>Total Price : $ <b>{{Cart::subtotal()}}</b></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="offset-1 col-lg-10 offset-1">
                            <div class="row fields-row mt-60 d-flex justify-content-between">
                                @if(Cart::subtotal() > 0)
                                    <a href="{{ route('clear.cart') }}" class="col-md-4">
                                        <button type="button" class="btn cart-btn"
                                        >Clear Cart
                                        </button>
                                    </a>
                                    <a href="{{ route('front.checkout.form') }}" class="col-md-8 ">
                                        <button class="btn cart-btn"
                                        >PROCEED To Pay
                                        </button>
                                    </a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('script')

    <script>

        function changeQuantity(action) {
            var inputElement = document.querySelector('.in-num');
            var currentValue = parseInt(inputElement.value);

            if (action === 'add') {
                $('#loader-container').css('display', 'block');

                inputElement.value = currentValue + 1;
            } else if (action === 'minus' && currentValue > 1) {
                $('#loader-container').css('display', 'block');

                inputElement.value = currentValue - 1;
            }

            document.querySelector('.numForm').submit();

        }

    </script>

@endsection
