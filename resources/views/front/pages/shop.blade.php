@extends('front.layout.app')

@section('content')

    <section class="innerBan"
             style="background-image: url('{{ $data['homeData']->cmsImages('background_banner_image') ?? '' }}')">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mainHeading text-center text-white">{{ $data['homeData']->content['shop_banner_title'] }}</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="newarrivalSec jewelryInnr">
        <div class="container">
            <div class="freshHeading">
                <h2 class="mainHeading text-center mb-5">Rings</h2>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <a href="product-detail.php" class="arrivalWrap">
                        <figure>
                            <img src="{{ asset('images/jewelry1.png') }}" class="img-fluid" alt="">
                        </figure>
                        <h4>Ring name here</h4>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="product-detail.php" class="arrivalWrap">
                        <figure>
                            <img src="{{ asset('images/jewelry2.png') }}" class="img-fluid" alt="">
                        </figure>
                        <h4>Ring name here</h4>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="product-detail.php" class="arrivalWrap">
                        <figure>
                            <img src="{{ asset('images/jewelry3.png') }}" class="img-fluid" alt="">
                        </figure>
                        <h4>Ring name here</h4>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <a href="product-detail.php" class="arrivalWrap">
                        <figure>
                            <img src="{{ asset('images/jewelry4.png') }}" class="img-fluid" alt="">
                        </figure>
                        <h4>Ring name here</h4>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="product-detail.php" class="arrivalWrap">
                        <figure>
                            <img src="{{ asset('images/jewelry5.png') }}" class="img-fluid" alt="">
                        </figure>
                        <h4>Ring name here</h4>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="product-detail.php" class="arrivalWrap">
                        <figure>
                            <img src="{{ asset('images/jewelry6.png') }}" class="img-fluid" alt="">
                        </figure>
                        <h4>Ring name here</h4>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <a href="product-detail.php" class="arrivalWrap">
                        <figure>
                            <img src="{{ asset('images/jewelry7.png') }}" class="img-fluid" alt="">
                        </figure>
                        <h4>Ring name here</h4>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="product-detail.php" class="arrivalWrap">
                        <figure>
                            <img src="{{ asset('images/jewelry8.png') }}" class="img-fluid" alt="">
                        </figure>
                        <h4>Ring name here</h4>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="product-detail.php" class="arrivalWrap">
                        <figure>
                            <img src="{{ asset('images/jewelry9.png') }}" class="img-fluid" alt="">
                        </figure>
                        <h4>Ring name here</h4>
                    </a>
                </div>
            </div>
        </div>
    </section>


@endsection
