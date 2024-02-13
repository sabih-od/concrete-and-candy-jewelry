@extends('front.layout.app')

@section('content')

    <section class="main-slider p-0" id="mainSlider"
             style="background-image: url('{{ $data['homeData']->cmsImages('background_banner_image') ?? '' }}')">
        <div class="swiper-container homeSlider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="slideOne">
                                    <h1 class="mainHeading text-white">{{ $data['homeData']->content['banner_title'] }}</h1>
                                    <a href="{{ route('front.shop') }}"
                                       class="themeBtn">{{ $data['homeData']->content['banner_btn'] }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="slideOne">
                                    <h1 class="mainHeading text-white">{{ $data['homeData']->content['banner_title'] }}</h1>
                                    <a href="{{ route('front.shop') }}"
                                       class="themeBtn">{{ $data['homeData']->content['banner_btn'] }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="slideOne">
                                    <h1 class="mainHeading text-white">{{ $data['homeData']->content['banner_title'] }}</h1>
                                    <a href="{{ route('front.shop') }}"
                                       class="themeBtn">{{ $data['homeData']->content['banner_btn'] }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="slideOne">
                                    <h1 class="mainHeading text-white">{{ $data['homeData']->content['banner_title'] }}</h1>
                                    <a href="{{ route('front.shop') }}"
                                       class="themeBtn">{{ $data['homeData']->content['banner_btn'] }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <div class="modern">
            <h2>{{ $data['homeData']->content['banner_modern_bottom'] }}</h2>
        </div>
        <a href="#" class="mouse"><img src="{{ $data['homeData']->cmsImages('mouse_image') ?? ''  }}" class="img-fluid"
                                       alt=""></a>
    </section>

    <section class="earingSec">
        <div class="container">
            <div class="row">
                <div class="col-md-3" data-aos="fade-up">
                    <a href="earrings.php" class="earingWrap">
                        <figure>
                            <img src="{{ asset('images/img1.jpg') }}" class="img-fluid" alt="">
                        </figure>
                        <div class="earingText">
                            <h4>Earring</h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-3" data-aos="fade-up">
                    <a href="necklace.php" class="earingWrap">
                        <figure>
                            <img src="{{ asset('images/img2.jpg') }}" class="img-fluid" alt="">
                        </figure>
                        <div class="earingText">
                            <h4>Nacklace</h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-3" data-aos="fade-up">
                    <a href="bracelet.php" class="earingWrap">
                        <figure>
                            <img src="{{ asset('images/img3.jpg') }}" class="img-fluid" alt="">
                        </figure>
                        <div class="earingText">
                            <h4>Bracelets</h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-3" data-aos="fade-up">
                    <a href="shop.php" class="earingWrap">
                        <figure>
                            <img src="{{ asset('images/img4.jpg') }}" class="img-fluid" alt="">
                        </figure>
                        <div class="earingText">
                            <h4>Rings</h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="storySec">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <figure data-aos="fade-up">
                        <img src="{{ $data['homeData']->cmsImages('story_image') ?? ''  }}" class="img-fluid" alt="">
                    </figure>
                </div>
                <div class="col-md-6">
                    <div class="storyWrap" data-aos="fade-up">
                        <figure>
                            <img src="{{ $data['homeData']->cmsImages('story_image2') ?? ''  }}" class="img-fluid"
                                 alt="">
                        </figure>
                        <div class="storyText">
                            <h2 class="mainHeading text-white">{{ $data['homeData']->content['story_sec_heading'] }}</h2>
                            <p>{{ $data['homeData']->content['story_sec_desc'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="freshSec">
        <div class="container">
            <div class="freshHeading">
                <h2 class="mainHeading text-center mb-4"
                    data-aos="fade-up">{{ $data['homeData']->content['fresh_sec_heading'] }}</h2>
            </div>
            <div class="row">
                <div class="col">
                    <div class="freshWrap" data-aos="fade-up">
                        <figure>
                            <img src="{{ asset('images/fresh1.jpg') }}" class="img-fluid" alt="">
                        </figure>
                        <p>NEBULA - Deep Blue Crystal Ring
                            With magenta, Purple, Violet</p>
                        <span>$108.00</span>
                    </div>
                </div>
                <div class="col">
                    <div class="freshWrap" data-aos="fade-up">
                        <figure>
                            <img src="{{ asset('images/fresh2.jpg') }}" class="img-fluid" alt="">
                        </figure>
                        <p>HEAVEN - Baguette Ring W
                            Mystical Multicolor Crystal AB</p>
                        <span>$78.00</span>
                    </div>
                </div>
                <div class="col">
                    <div class="freshWrap" data-aos="fade-up">
                        <figure>
                            <img src="{{ asset('images/fresh3.jpg') }}" class="img-fluid" alt="">
                        </figure>
                        <p>CLAIRVOYANT - Brilliant clear
                            Crystal pendant necklace</p>
                        <span>$168.00</span>
                    </div>
                </div>
                <div class="col">
                    <div class="freshWrap" data-aos="fade-up">
                        <figure>
                            <img src="{{ asset('images/fresh4.jpg') }}" class="img-fluid" alt="">
                        </figure>
                        <p>START DUST - Brilliant Sparkly
                            Trilliant Crystal pendant Necklace</p>
                        <span>$154.00</span>
                    </div>
                </div>
                <div class="col">
                    <div class="freshWrap" data-aos="fade-up">
                        <figure>
                            <img src="{{ asset('images/fresh5.jpg') }}" class="img-fluid" alt="">
                        </figure>
                        <p>START DUST - Large Trilliant
                            Clear Crystal Ring</p>
                        <span>$138.00</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="newarrivalSec">
        <div class="container">
            <div class="freshHeading" data-aos="fade-up">
                <h2 class="mainHeading text-center mb-5">{{ $data['homeData']->content['arrivals_sec_heading'] }}</h2>
            </div>
            <div class="row">
                <div class="col-md-4" data-aos="fade-up">
                    <a href="shop.php" class="arrivalWrap">
                        <figure>
                            <img src="{{ asset('images/arrival1.png') }}" class="img-fluid" alt="">
                        </figure>
                        <h4>Sterling silver</h4>
                    </a>
                </div>
                <div class="col-md-4" data-aos="fade-up">
                    <a href="shop.php" class="arrivalWrap">
                        <figure>
                            <img src="{{ asset('images/arrival2.png') }}" class="img-fluid" alt="">
                        </figure>
                        <h4>Chokers</h4>
                    </a>
                </div>
                <div class="col-md-4" data-aos="fade-up">
                    <a href="shop.php" class="arrivalWrap">
                        <figure>
                            <img src="{{ asset('images/arrival3.png') }}" class="img-fluid" alt="">
                        </figure>
                        <h4>Long Necklaces/ Lariats</h4>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4" data-aos="fade-up">
                    <a href="shop.php" class="arrivalWrap">
                        <figure>
                            <img src="{{ asset('images/arrival4.png') }}" class="img-fluid" alt="">
                        </figure>
                        <h4>Bangle Stacks</h4>
                    </a>
                </div>
                <div class="col-md-4" data-aos="fade-up">
                    <a href="shop.php" class="arrivalWrap">
                        <figure>
                            <img src="{{ asset('images/arrival5.png') }}" class="img-fluid" alt="">
                        </figure>
                        <h4>Chain bracelets</h4>
                    </a>
                </div>
                <div class="col-md-4" data-aos="fade-up">
                    <a href="shop.php" class="arrivalWrap">
                        <figure>
                            <img src="{{ asset('images/arrival6.png') }}" class="img-fluid" alt="">
                        </figure>
                        <h4>Earrings Studs</h4>
                    </a>
                </div>
            </div>
            <div class="viewBtn text-center" data-aos="fade-up">
                <a href="shop.php" class="themeBtn">View all</a>
            </div>
        </div>
    </section>

    <section class="serviceSec">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-md-3">
                    <div class="serviceWrap" data-aos="fade-up">
                        <figure>
                            <img src="{{ asset('images/service1.jpg') }}" class="img-fluid" alt="">
                            <h4 class="secHeading text-white">Solstics</h4>
                        </figure>
                        <div class="serviceText">
                            <a href="#">Shop Solstics Collection</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="serviceWrap" data-aos="fade-up">
                        <figure>
                            <img src="{{ asset('images/service2.jpg') }}" class="img-fluid" alt="">
                            <h4 class="secHeading text-white">Coastal</h4>
                        </figure>
                        <div class="serviceText">
                            <a href="#">Shop Coastal Collection</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="serviceWrap" data-aos="fade-up">
                        <figure>
                            <img src="{{ asset('images/service3.jpg') }}" class="img-fluid" alt="">
                            <h4 class="secHeading text-white">Nebula</h4>
                        </figure>
                        <div class="serviceText">
                            <a href="#">Shop Nebula Collection</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="serviceWrap" data-aos="fade-up">
                        <figure>
                            <img src="{{ asset('images/service4.jpg') }}" class="img-fluid" alt="">
                            <h4 class="secHeading text-white">Warehouse</h4>
                        </figure>
                        <div class="serviceText" data-aos="fade-up">
                            <a href="#">Shop warehouse Collection</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="newarrivalSec">
        <div class="container">
            <div class="freshHeading">
                <h2 class="mainHeading text-center mb-5"
                    data-aos="fade-up">{{ $data['homeData']->content['most_love_sec_heading'] }}</h2>
            </div>
            <div class="row">
                <div class="col-md-4" data-aos="fade-up">
                    <a href="shop.php" class="arrivalWrap">
                        <figure>
                            <img src="{{ asset('images/arrival7.png') }}" class="img-fluid" alt="">
                        </figure>
                        <h4>Billy Dainty Chain Ring</h4>
                    </a>
                </div>
                <div class="col-md-4" data-aos="fade-up">
                    <a href="shop.php" class="arrivalWrap">
                        <figure>
                            <img src="{{ asset('images/arrival8.png') }}" class="img-fluid" alt="">
                        </figure>
                        <h4>Erin Huggie Hoop Earring</h4>
                    </a>
                </div>
                <div class="col-md-4" data-aos="fade-up">
                    <a href="shop.php" class="arrivalWrap">
                        <figure>
                            <img src="{{ asset('images/arrival9.png') }}" class="img-fluid" alt="">
                        </figure>
                        <h4>Carla Paper Clip Chain
                            Necklace</h4>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4" data-aos="fade-up">
                    <a href="shop.php" class="arrivalWrap">
                        <figure>
                            <img src="{{ asset('images/arrival10.png') }}" class="img-fluid" alt="">
                        </figure>
                        <h4>Anais Dainty Twist Ring</h4>
                    </a>
                </div>
                <div class="col-md-4" data-aos="fade-up">
                    <a href="shop.php" class="arrivalWrap">
                        <figure>
                            <img src="{{ asset('images/arrival11.png') }}" class="img-fluid" alt="">
                        </figure>
                        <h4>Sailor Dainty Ball Ring</h4>
                    </a>
                </div>
                <div class="col-md-4" data-aos="fade-up">
                    <a href="shop.php" class="arrivalWrap">
                        <figure>
                            <img src="{{ asset('images/arrival12.png') }}" class="img-fluid" alt="">
                        </figure>
                        <h4>Milly Ring</h4>
                    </a>
                </div>
            </div>
            <div class="viewBtn text-center" data-aos="fade-up">
                <a href="shop.php" class="themeBtn">View all</a>
            </div>
        </div>
    </section>



@endsection
