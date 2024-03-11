@extends('front.layout.app')

@section('content')

    <div class="preLoader black">
        @if(!empty($settings->header_logo))
            <img src="{{ asset('setting_images/' . $settings->header_logo) ?? '' }}" class="img-fluid"
                 alt="img">
        @else
            <img src="{{ $settings->settingImage('header_logo') ?? ''  }}" class="img-fluid" alt="">

        @endif
    </div>
    <div class="preLoader white"></div>
    <section class="main-slider p-0" id="mainSlider"
             style="background-image: url('{{ $homeData->cmsImages('background_banner_image') ?? '' }}')">
        <div class="swiper-container homeSlider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="slideOne">
                                    <h1 class="mainHeading text-white">{{ $homeData->content['banner_title'] }}</h1>
                                    <a href="{{ route('front.shop') }}"
                                       class="themeBtn">{{ $homeData->content['banner_btn'] }}</a>
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
                                    <h1 class="mainHeading text-white">{{ $homeData->content['banner_title'] }}</h1>
                                    <a href="{{ route('front.shop') }}"
                                       class="themeBtn">{{ $homeData->content['banner_btn'] }}</a>
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
                                    <h1 class="mainHeading text-white">{{ $homeData->content['banner_title'] }}</h1>
                                    <a href="{{ route('front.shop') }}"
                                       class="themeBtn">{{ $homeData->content['banner_btn'] }}</a>
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
                                    <h1 class="mainHeading text-white">{{ $homeData->content['banner_title'] }}</h1>
                                    <a href="{{ route('front.shop') }}"
                                       class="themeBtn">{{ $homeData->content['banner_btn'] }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <div class="modern">
            <h2>{{ $homeData->content['banner_modern_bottom'] }}</h2>
        </div>
        <a href="#" class="mouse"><img src="{{ $homeData->cmsImages('mouse_image') ?? ''  }}" class="img-fluid"
                                       alt=""></a>
    </section>

    <section class="earingSec">
        <div class="container">
            <div class="row">
                @forelse($categories as $cat)
                    <div class="col-md-3" data-aos="fade-up">
                        <a href="{{ route('front.shop' , ['category' => $cat->slug]) }}" class="earingWrap">
                            <figure>
                                <img src="{{ $cat->categoryImage() }}" class="img-fluid" alt="">
                            </figure>
                            <div class="earingText">
                                <h4>{{ $cat->name ?? '' }}</h4>
                            </div>
                        </a>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </section>

    <section class="storySec">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <figure data-aos="fade-up">
                        <img src="{{ $homeData->cmsImages('story_image') ?? ''  }}" class="img-fluid" alt="">
                    </figure>
                </div>
                <div class="col-md-6">
                    <div class="storyWrap" data-aos="fade-up">
                        <figure>
                            <img src="{{ $homeData->cmsImages('story_image2') ?? ''  }}" class="img-fluid"
                                 alt="">
                        </figure>
                        <div class="storyText">
                            <h2 class="mainHeading text-white">{{ $homeData->content['story_sec_heading'] }}</h2>
                            <p>{{ $homeData->content['story_sec_desc'] }}</p>
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
                    data-aos="fade-up">{{ $homeData->content['fresh_sec_heading'] }}</h2>
            </div>
            <div class="row">

                @forelse($fresh_design as $design)
                    <div class="col">
                        <div class="freshWrap" data-aos="fade-up">
                            <figure>
                                <img src="{{ $design->productImage() }}" class="img-fluid" alt="">
                            </figure>
                            <p>{{ $design->Category->name ?? '' }} - {{ $design->name ?? '' }}</p>
                            <span>$ {{ $design->price }}.00</span>
                        </div>
                    </div>
                @empty
                @endforelse


            </div>
        </div>
    </section>

    <section class="newarrivalSec">
        <div class="container">
            <div class="freshHeading" data-aos="fade-up">
                <h2 class="mainHeading text-center mb-5">{{ $homeData->content['arrivals_sec_heading'] }}</h2>
            </div>
            <div class="row">

                @forelse($new_arrivals as $arrival)
                    <div class="col-md-4" data-aos="fade-up">
                        <a href="{{ route('front.shop.product' , ['slug' => $arrival->slug]) }}" class="arrivalWrap">
                            <figure>
                                <img src="{{ $arrival->productImage() ?? '' }}" class="img-fluid" alt="">
                            </figure>
                            <h4>{{ $arrival->name ?? '' }}</h4>
                        </a>
                    </div>
                @empty
                @endforelse

            </div>
            <div class="viewBtn text-center" data-aos="fade-up">
                <a href="{{ route('front.shop') }}" class="themeBtn">View all</a>
            </div>
        </div>
    </section>

    <section class="serviceSec">
        <div class="container-fluid p-0">
            <div class="row">
                @forelse($category_collection as $category)
                    <div class="col-md-3">
                        <div class="serviceWrap" data-aos="fade-up">
                            <figure>
                                <img src="{{ $category->categoryImage() }}" class="img-fluid" alt="">
                                <h4 class="secHeading text-white">{{ $category->name ?? '' }}</h4>
                            </figure>
                            <div class="serviceText">
                                <a href="{{  route('front.shop' , ['category' => $cat->slug])  }}">{{ $category->name }}
                                    collection</a>
                            </div>
                        </div>
                    </div>
                @empty

                @endforelse

            </div>
        </div>
    </section>

    <section class="newarrivalSec">
        <div class="container">
            <div class="freshHeading">
                <h2 class="mainHeading text-center mb-5"
                    data-aos="fade-up">{{ $homeData->content['most_love_sec_heading'] }}</h2>
            </div>
            <div class="row">

                @forelse($most_love as $most)
                    <div class="col-md-4" data-aos="fade-up">
                        <a href="{{ route('front.shop.product' , ['slug' => $arrival->slug]) }}" class="arrivalWrap">
                            <figure>
                                <img src="{{ $most->productImage() }}" class="img-fluid" alt="">
                            </figure>
                            <h4>{{ $most->name }}</h4>
                        </a>
                    </div>
                @empty

                @endforelse

            </div>
            <div class="viewBtn text-center" data-aos="fade-up">
                <a href="{{ route('front.shop') }}" class="themeBtn">View all</a>
            </div>
        </div>
    </section>



@endsection
