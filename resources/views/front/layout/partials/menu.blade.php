<!-- Begin: Header -->
<header>
    <div class="topBar">
        <p>
            <marquee>Free Shipping on all orders to USA . Use Code and checkout</marquee>
        </p>
    </div>
    <div class="container">
        <nav class="navbar navbar-expand-lg p-0">
            <a class="navbar-brand" href="index.php">
                @if(!empty($settings->header_logo))
                    <img src="{{ asset('setting_images/' . $settings->header_logo) ?? '' }}" class="img-fluid"
                         alt="img">
                @else
                    <img src="{{ $settings->settingImage('header_logo') ?? ''  }}" class="img-fluid" alt="">

                @endif
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav m-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('front.index') }}">Home <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.about') }}">ABOUT us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.shop') }}">shop</a>
                    </li>
                    <li class="nav-item drop-down">
                        <a class="nav-link" href="">jewelry</a>
                        <ul>
                            @forelse($categories as $cat)
                                <li>
                                    <a href="{{ route('front.shop' , ['category' => $cat->slug]) }}">{{ $cat->name }}</a>
                                </li>
                            @empty
                            @endforelse
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.faq') }}">faq</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.contact') }}">Contact us</a>
                    </li>
                </ul>
                <div class="form-inline">
                    <a href="#search"><i class="fal fa-search"></i></a>
                    <a href="{{ auth()->check() ? route('user.dashboard') : route('login.form') }}"><i
                            class="fal fa-user"></i></a>
                    <a href="#"><i class="fal fa-heart"></i></a>
                    <a href="{{ route('front.cart') }}" class="cart"><i
                            class="fal fa-shopping-cart"></i><span><b>${{Cart::subtotal()}}</b></span></a>
                </div>
            </div>
        </nav>
    </div>
</header>


<!-- END: Header -->
