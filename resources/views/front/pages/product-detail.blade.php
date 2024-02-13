@extends('front.layout.app')

@section('content')


    <section class="innerBan">
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
                        <img src="{{ asset('images/product1.jpg') }}" class="img-fluid" alt="">
                        <img src="{{ asset('images/product2.jpg') }}" class="img-fluid" alt="">
                        <img src="{{ asset('images/product3.jpg') }}" class="img-fluid" alt="">
                        <img src="{{ asset('images/product4.jpg') }}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="productText">
                        <div class="uislider-label">
                            <label for="amount">Price Range <span id="fromday">$</span> 15/-</label>
                            <label for="amount">to <span id="today">$</span> 70/-</label>
                        </div>
                        <div id="slider-range"></div>
                        <h2 class="mainHeading">Earrings name here</h2>
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
                            <a href="#">$60.00</a>
                        </div>
                        <div class="btn-group">
                            <a href="#"><img src="{{ asset('images/water.png') }}" class="img-fluid" alt=""> waterproof</a>
                            <a href="#"><i class="fal fa-heart"></i>Hypoallergenic</a>
                        </div>
                        <h4>COLOR<span>– Black</span></h4>
                        <ul class="color-option">
                            <li>
                                <label class="choose-color">
                                    <input type="radio" name="color" checked hidden>
                                    <span class="color-box" style="--color:#E4BA80"></span>
                                </label>
                            </li>
                            <li>
                                <label class="choose-color">
                                    <input type="radio" name="color" hidden>
                                    <span class="color-box" style="--color:#344256"></span>
                                </label>
                            </li>
                            <li>
                                <label class="choose-color">
                                    <input type="radio" name="color" hidden>
                                    <span class="color-box" style="--color:#95D2CB"></span>
                                </label>
                            </li>
                            <li>
                                <label class="choose-color">
                                    <input type="radio" name="color" hidden>
                                    <span class="color-box" style="--color:#DC14C8"></span>
                                </label>
                            </li>
                            <li>
                                <label class="choose-color">
                                    <input type="radio" name="color" hidden>
                                    <span class="color-box" style="--color:#5A740F"></span>
                                </label>
                            </li>
                            <li>
                                <label class="choose-color">
                                    <input type="radio" name="color" hidden>
                                    <span class="color-box" style="--color:#4238D2"></span>
                                </label>
                            </li>
                            <li>
                                <label class="choose-color">
                                    <input type="radio" name="color" hidden>
                                    <span class="color-box" style="--color:#D42A36"></span>
                                </label>
                            </li>
                            <li>
                                <label class="choose-color">
                                    <input type="radio" name="color" hidden>
                                    <span class="color-box" style="--color:#8588A0"></span>
                                </label>
                            </li>
                        </ul>
                        <a href="#" class="size"><i class="fal fa-arrows-h"></i>Size Guide</a>
                        <div class="qtybox">
                            <button class="subbtn"><i class="fas fa-minus"></i></button>
                            <input type="text" class="textbox" value="1" readonly="">
                            <button class="addbtn"><i class="fas fa-plus"></i></button>
                        </div>
                        <a href="#" class="cartBtn">ADD TO CART</a>
                        <a href="#" class="shoPay">Buy with <img src="{{ asset('images/shop.png') }}" class="img-fluid"
                                                                 alt=""></a>
                        <a href="#" class="payment">More payment options</a>
                    </div>
                </div>
            </div>
        </div>
    </section>




@endsection
