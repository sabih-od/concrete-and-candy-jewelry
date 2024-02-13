@extends('front.layout.app')

@section('content')


    <section class="innerBan"
             style="background-image: url('{{ $data['homeData']->cmsImages('background_banner_image') ?? '' }}')">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mainHeading text-center text-white">{{ $data['homeData']->content['about_banner_title'] }}</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="storySec abtInner">
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

    <section class="missionSec">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="missionText">
                        <h2 class="mainHeading"
                            data-aos="fade-up">{{ $data['homeData']->content['mission_sec_heading'] }}</h2>
                        <p data-aos="fade-up">{{ $data['homeData']->content['mission_sec_para1'] }}</p>
                        <p class="scndPara" data-aos="fade-up">{{ $data['homeData']->content['mission_sec_para2'] }}</p>
                        <p data-aos="fade-up">{{ $data['homeData']->content['mission_sec_para3'] }}</p>
                    </div>
                </div>
                <div class="col-md-8">
                    <figure data-aos="fade-up">
                        <img src="{{ $data['homeData']->cmsImages('mission_right_image') ?? ''  }}" class="img-fluid"
                             alt="">
                    </figure>
                </div>
                <div class="col-md-12 mt-5 pt-3">
                    <div class="missionText">
                        <p class="mb-4" data-aos="fade-up">{{ $data['homeData']->content['mission_sec_para4'] }}</p>
                        <p data-aos="fade-up">{{ $data['homeData']->content['mission_sec_para5'] }}</p>
                    </div>
                </div>
            </div>
            <div class="row align-items-center mt-4">
                <div class="col-md-4">
                    <figure>
                        <img src="{{ $data['homeData']->cmsImages('mission_image1') ?? ''  }}" class="img-fluid"
                             alt="">
                    </figure>
                </div>
                <div class="col-md-3">
                    <figure>
                        <img src="{{ $data['homeData']->cmsImages('mission_image2') ?? ''  }}" class="img-fluid"
                             alt="">
                    </figure>
                </div>
                <div class="col-md-5">
                    <figure>
                        <img src="{{ $data['homeData']->cmsImages('mission_image3') ?? ''  }}" class="img-fluid"
                             alt="">
                    </figure>
                </div>
                <div class="col-md-12 mt-5 pt-3">
                    <div class="missionText">
                        <p class="mb-4" data-aos="fade-up">{{ $data['homeData']->content['mission_sec_para6'] }}</p>
                        <p data-aos="fade-up">{{ $data['homeData']->content['mission_sec_para7'] }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="missionBg">
            <img src="{{ asset('images/abt1.png') }}" class="img-fluid abt1" alt="">
            <img src="{{ asset('images/abt2.png') }}" class="img-fluid abt2" alt="">
        </div>
    </section>

@endsection
