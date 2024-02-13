@extends('front.layout.app')

@section('content')


    <section class="innerBan"
             style="background-image: url('{{ $data['homeData']->cmsImages('background_banner_image') ?? '' }}')">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mainHeading text-center text-white">{{ $data['homeData']->content['faq_banner_title'] }}</h2>
                </div>
            </div>
        </div>
    </section>


    <section class="faq-section">
        <div class="container">
            <div class="text-center">
                <h2 class="mainHeading  mx-auto mb-5"
                    data-aos="fade-up">{{ $data['homeData']->content['question_sec_heading'] }}</h2>
                <div class="col-md-10 mx-auto">
                    <div class="accordion" id="faqModule">
                        <div class="accordion-item" data-aos="fade-up">
                            <div class="card-header" id="faqOne">
                                <button class="btn" type="button" data-toggle="collapse" data-target="#collapseOne"
                                        aria-expanded="true" aria-controls="collapseOne">
                                    {{ $data['homeData']->content['question1'] }}
                                </button>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="faqOne"
                                 data-parent="#faqModule">
                                <div class="card-body">
                                    <p>{{ $data['homeData']->content['answer1'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item" data-aos="fade-up">
                            <div class="card-header" id="faqTwo">
                                <button class="btn collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    {{ $data['homeData']->content['question2'] }}
                                </button>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="faqTwo" data-parent="#faqModule">
                                <div class="card-body">
                                    <p>{{ $data['homeData']->content['answer2'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item" data-aos="fade-up">
                            <div class="card-header" id="faqThree">
                                <button class="btn collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                    {{ $data['homeData']->content['question3'] }}
                                </button>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="faqThree"
                                 data-parent="#faqModule">
                                {{ $data['homeData']->content['answer3'] }}
                            </div>
                        </div>
                        <div class="accordion-item" data-aos="fade-up">
                            <div class="card-header" id="faqfour">
                                <button class="btn collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    {{ $data['homeData']->content['question4'] }}
                                </button>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="faqfour" data-parent="#faqModule">
                                <div class="card-body">
                                    <p>{{ $data['homeData']->content['answer4'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item" data-aos="fade-up">
                            <div class="card-header" id="faqfive">
                                <button class="btn collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
                                    {{ $data['homeData']->content['question5'] }}
                                </button>
                            </div>
                            <div id="collapsefive" class="collapse" aria-labelledby="faqfive" data-parent="#faqModule">
                                <div class="card-body">
                                    <p>{{ $data['homeData']->content['answer5'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item" data-aos="fade-up">
                            <div class="card-header" id="faqsix">
                                <button class="btn collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapsesix" aria-expanded="false" aria-controls="collapsesix">
                                    {{ $data['homeData']->content['question6'] }}
                                </button>
                            </div>
                            <div id="collapsesix" class="collapse" aria-labelledby="faqsix" data-parent="#faqModule">
                                <div class="card-body">
                                    <p>{{ $data['homeData']->content['answer6'] }}</p>
                                </div>
                            </div>
                        </div>
                        {{--<div class="accordion-item" data-aos="fade-up">
                            <div class="card-header" id="faqseven">
                                <button class="btn collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapseseven" aria-expanded="false"
                                        aria-controls="collapseseven">
                                    Can I return an item?
                                </button>
                            </div>
                            <div id="collapseseven" class="collapse" aria-labelledby="faqseven"
                                 data-parent="#faqModule">
                                <div class="card-body">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                        unknown printer took a galley of type and scrambled it to make a type specimen
                                        book. It has survived not only five centuries, but also the leap into electronic
                                        typesetting, remaining essentially unchanged.</p>
                                </div>
                            </div>
                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
