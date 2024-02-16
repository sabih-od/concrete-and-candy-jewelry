@extends('front.layout.app')

@section('content')


    <section class="tempcart d-flex align-items-center" style="height: 80vh">

        <div class="container" style="margin-bottom: 10%">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="content-box section-padding add-product-1">
                        <div class="top-area">
                            <div class="content order-de">
                                <h4 class="heading">
                                    {{ __('Something went wrong while ordering.') }}
                                </h4>
                                <p class="text">
                                    {{ __("Order not recieved") }}
                                </p>
                                <a href="{{ route('front.index') }}"
                                   class="link text-black-50"><h6
                                        class="get-back"><i
                                            class="fas fa-arrow-left"></i> {{ __('Get Back To Our Homepage') }}</h6></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>


@endsection
