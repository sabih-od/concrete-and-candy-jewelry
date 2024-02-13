@extends('front.layout.app')

@section('content')


    <section class="innerBan"
             style="background-image: url('{{ $data['homeData']->cmsImages('background_banner_image') ?? '' }}')">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mainHeading text-center text-white">{{ $data['homeData']->content['contact_banner_title'] }}</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="contactInner">
        <div class="container">
            <div class="contactHeading text-center">
                <h2 class="mainHeading">{{ $data['homeData']->content['contact_form_heading'] }}</h2>
                <p>{{ $data['homeData']->content['contact_form_description'] }}</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <form class="contactForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name *</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email *</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Subject *</label>
                                    <select>
                                        <option>Subject</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Order Number *</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Write A Message...</label>
                                    <textarea name="" class="form-control" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="contactBtn">
                                    <button class="themeBtn btn">Submit</button>
                                    <p>{{ $data['homeData']->content['contact_form_footer_para'] }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4173.853440720163!2d-71.38279885079751!3d42.29218175990173!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89e387d515645243%3A0x374e90b3dbc16d1d!2sSurrey%20Ln%2C%20Natick%2C%20MA%2001760%2C%20USA!5e0!3m2!1sen!2s!4v1706533532929!5m2!1sen!2s"
            width="100%" height="730" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>




@endsection
