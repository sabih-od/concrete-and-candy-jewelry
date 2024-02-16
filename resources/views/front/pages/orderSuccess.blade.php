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
                                    {{ __('THANK YOU FOR YOUR PURCHASE.') }}
                                </h4>
                                <p class="text">
                                    {{ __("We'll email you an order confirmation with details and tracking info.") }}
                                </p>
                                <p class="text">
                                    {{ __("kindly also check your portal for order invoices") }}
                                </p>
                                <a href="{{ route('front.index') }}"
                                   class="link text-black-50"><h6
                                        class="get-back">{{ __('Get Back To Our Homepage') }}</h6></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>


@endsection
