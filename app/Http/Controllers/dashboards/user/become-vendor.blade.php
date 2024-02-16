@extends('dashboards.user.index')

@section('content')

    <div class="col-lg-9 layout">
        <div class="becomeVendor">
            <div class="becomeVendor-img">
                <img src="{{ asset('dashboard-assets/images/becomeVendor.png') }}" alt="image" class="img-fluid">
            </div>
            <div class="becomeVendor-content text-center">
                <h3 class="heading">Become A Vendor Now!</h3>
                <a href="{{ route('subscriptions') }}" class="themeBtn">Get Started</a>
            </div>
        </div>
    </div>

    </div>
    </div>
    </section>

@endsection
