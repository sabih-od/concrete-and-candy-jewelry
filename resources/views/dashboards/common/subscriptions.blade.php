@extends('dashboards.user.index')

@section('content')


    <div class="col-lg-9 layout">
        <h2 class="mainHeadig">Subscriptions</h2>
        <div class="profileSetting totalOrder">
            <div class="row">
                @forelse($subscriptions as $subscription)
                    <div class="col-lg-4 col-sm-6">
                        <div class="subscriptionBox">
                            <h3>{{ $subscription->title ?? '' }}</h3>
                            @if($subscription->limitation == 'limited')
                                <h4>FREE</h4>
                            @else
                                <h4>$ {{ $subscription->total_price ?? '' }}</h4>
                            @endif
                            {{--                           <h5>{{$subscription->limitation == 'limited' ? '':'Per Month' }}</h5>--}}
                            <ul class="package-list">
                                @if($subscription->limitation == 'limited')
                                    <li>Allowed products : <b>{{ $subscription->allowed_products ?? '' }}</b></li>
                                    <li>PricePerProduct : <b>{{ $subscription->price_per_product ?? '' }}</b></li>
                                @endif
                                <li>limitations : <b>{{ $subscription->limitation ?? '' }}</b></li>
                                <li>Total price : <b>$ {{ $subscription->total_price ?? '' }}</b></li>
                                <li>Expire days : <b>{{ $subscription->expiry_days ?? '' }}</b></li>
                                <li>Further details : <b>{{ $subscription->details ?? '' }}</b></li>
                            </ul>
                            @if($checkSubscription &&  $subscription->id == $checkSubscription->subscription_id )
                                <a href="#" disabled="true"
                                   class="themeBtn">Active Package</a>
                            @else
                                <a href="{{ route('become.a.vendor' , ['subscription' => $subscription->id]) }}"
                                   class="themeBtn">Upgrade Package</a>
                            @endif

                        </div>
                    </div>
                @empty
                    <p>No subscriptions found</p>
                @endforelse
            </div>

        </div>
    </div>

    <!-- section css end -->
    </div>
    </div>
    </section>

@endsection
