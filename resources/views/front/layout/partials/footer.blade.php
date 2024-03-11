<section class="instaSec">

    <div class="container">
        <div class="freshHeading">
            <h2 class="mainHeading text-center mb-4">{{ $footer->content['footer_heading'] ?? '' }}</h2>
        </div>
        <div class="row">
            <div class="swiper instaSlider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="instaWrap">
                            <img src="{{ $footer->cmsImages('social_media_pic1') ?? ''  }}" class="img-fluid"
                                 alt="">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="instaWrap">
                            <img src="{{ $footer->cmsImages('social_media_pic2') ?? ''  }}" class="img-fluid"
                                 alt="">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="instaWrap">
                            <img src="{{ $footer->cmsImages('social_media_pic3') ?? ''  }}" class="img-fluid"
                                 alt="">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="instaWrap">
                            <img src="{{ $footer->cmsImages('social_media_pic4') ?? ''  }}" class="img-fluid"
                                 alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>

<!-- Begin: Footer -->
<footer>
    <div class="container">
        <div class="row align-items-center signBg">
            <div class="col-md-6">
                <div class="signHead">
                    <h2>{{ $footer->content['footer_sub_heading'] ?? '' }}</h2>
                    <p>{{ $footer->content['footer_description'] ?? '' }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <form class="searchForm">
                    <input type="text" placeholder="Email here...">
                    <button class="themeBtn">{{ $footer->content['footer_button'] ?? '' }}</button>
                </form>
            </div>
        </div>
        <div class="row justify-content-between">
            <div class="col-md-3 my-auto">
                <a href="" class="footLogo">
                    @if(!empty($settings->footer_logo))
                        <img src="{{ asset('setting_images/' . $settings->footer_logo) ?? '' }}" class="img-fluid"
                             alt="img">
                    @else
                        <img src="{{ $settings->settingImage('footer_logo') ?? ''  }}" class="img-fluid" alt="">

                    @endif
                </a>
                <ul class="topSocial">
                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <h4>QUICK LINKS</h4>
                <ul class="links">
                    <li><a href="{{ route('front.index') }}">Home</a></li>
                    <li><a href="{{ route('front.about') }}">About us</a></li>
                    <li><a href="{{ route('front.shop') }}">Shop</a></li>
                    <li><a href="{{ route('front.faq') }}">Faq's</a></li>
                    <li><a href="{{ route('front.contact') }}">Contact us</a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <h4>CATEGORIES</h4>
                <ul class="links">
                    <li><a href="earrings.php">Earrings</a></li>
                    <li><a href="shop.php">Rings</a></li>
                    <li><a href="necklace.php">Necklace</a></li>
                    <li><a href="bracelet.php">Bracelets</a></li>
                    <li><a href="shop.php">Accessories</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h4>CONTACT INFO</h4>
                <ul class="links quickLinks">
                    <li><a href="#">Phone: {{ $settings->phone_no ?? '' }}</a></li>
                    <li><a href="etching-work">Email: {{ $settings->email ?? '' }}</a></li>
                    <li><a href="clothing.php">{{ $settings->address ?? '' }}</a></li>
                </ul>
            </div>
        </div>
        <div class="row align-items-center copyRight">
            <div class="col-md-3">
                <p class="text-white m-0">Copyright © 2024. All rights reserved.</p>
            </div>
            <div class="col-md-6">
                <ul>
                    <li><a href="{{ route('front.privacy-policy') }}">Privacy Policy</a></li>
                    <li><a href="{{ route('front.term-and-conditions') }}">Terms And Conditions</a></li>
                    <li><a href="{{ route('front.return-policy') }}">Refund Policy</a></li>
                </ul>
            </div>
            <div class="col-md-3 text-right">
                <figure>
                    <img src="{{ asset('images/card1.png') }}" class="img-fluid" alt="">
                </figure>
            </div>
        </div>
    </div>
</footer>
<!-- END: Footer -->


<div id="search">
    <button class="close" type="button">×</button>
    <form action="{{ route('front.search') }}" method="POST">
        @csrf
        <input placeholder="SEARCH" name="search" type="search" value="">
        <div class="srch-btn">
            <button href="#" class="themeBtn" type="submit">Search</button>
        </div>
    </form>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{ asset('js/all.min.js') }}"></script>
<script src="{{ asset('js/aos.js') }}"></script>
<script src="{{ asset('js/gsap.js') }}"></script>
<script src="{{ asset('js/scrollTrigger.js') }}"></script>

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/gh/studio-freight/lenis@1.0.27/bundled/lenis.min.js"></script>

<script src="{{ asset('js/custom.min.js') }}"></script>

{{-- toastr js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

<script>
    $(document).ready(function () {
        toastr.options.timeOut = 10000;
        @if (Session::has('error'))
        toastr.error('{{ Session::get('error') }}');
        @elseif(Session::has('success'))
        toastr.success('{{ Session::get('success') }}');
        @endif
    });

</script>

@yield('script')

</body>

</html>
