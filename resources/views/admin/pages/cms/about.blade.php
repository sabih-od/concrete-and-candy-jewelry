@extends('admin.layout.admin')
@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            {{--@dd($data)--}}
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0" style="font-size: 2.5rem; color: #333; font-weight: bold;">About Page
                            Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#" style="color: #666;">About</a></li>
                            <li class="breadcrumb-item active" aria-current="page"
                                style="color: #333; font-weight: bold;">
                                Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <form action="{{route('admin.pages.update', ['slug' => $page->slug])}}" method="post"
                      enctype="multipart/form-data">
                    <input type="hidden" name="slug" value="{{ $page->slug }}">
                    <input type="hidden" name="media_collections[]" value="background_banner_image">
                    <input type="hidden" name="media_collections[]" value="story_image">
                    <input type="hidden" name="media_collections[]" value="story_image2">
                    <input type="hidden" name="media_collections[]" value="mission_right_image">
                    <input type="hidden" name="media_collections[]" value="mission_image1">
                    <input type="hidden" name="media_collections[]" value="mission_image2">
                    <input type="hidden" name="media_collections[]" value="mission_image3">

                    @csrf
                    <div class="row mt-5">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title"
                                       style="font-size: 1.2rem; color: #555; font-weight: bold;">Title</label>
                                <input type="text" class="form-control" id="title" name="meta_title"
                                       placeholder="Enter Title"
                                       style="border: 1px solid #ccc; border-radius: 5px; padding: 8px 12px; margin-top: 5px;"
                                       value="{{$page->meta_title ?? ''}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title"
                                       style="font-size: 1.2rem; color: #555; font-weight: bold;">Description</label>
                                <input type="text" class="form-control" id="title" name="meta_description"
                                       placeholder="Enter Description"
                                       style="border: 1px solid #ccc; border-radius: 5px; padding: 8px 12px; margin-top: 5px;"
                                       value="{{$page->meta_description ?? ''}}">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <label for="title" style="font-size:2.5rem; color: #555; font-weight: bold;">---------------About
                            Page
                            Banner Section-------------------</label>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title" style="font-size: 1.2rem; color: #555; font-weight: bold;"> Banner
                                    Image
                                    First</label>
                                <input type="file" class="form-control" name="background_banner_image"
                                       id="background_banner_image">
                                @if($page->hasMedia('background_banner_image'))
                                    <label for="existing_background_banner_image">Existing Banner Image</label>
                                    @foreach($page->getMedia('background_banner_image') as $media)
                                        <img src="{{ $media->getUrl() }}" alt="Existing Banner Image"
                                             style="max-width: 200px; max-height: 200px; margin-top: 10px;">
                                    @endforeach
                                @endif
                            </div>


                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title" style="font-size: 1.2rem; color: #555; font-weight: bold;">Banner
                                    Title
                                </label>
                                <textarea class="form-control"
                                          name="about_banner_title">{{ old('about_banner_title', $content['about_banner_title'] ?? '') }}</textarea>
                            </div>

                        </div>

                        <div class="row mt-5">
                            <label for="title" style="font-size:2.5rem; color: #555; font-weight: bold;">-----------------------
                                Story
                                Section----------------------</label>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="title"
                                           style="font-size: 1.2rem; color: #555; font-weight: bold;">Story Section
                                        Heading</label>
                                    <textarea class="form-control"
                                              name="story_sec_heading">{{ old('story_sec_heading', $content['story_sec_heading'] ?? '') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="title" style="font-size: 1.2rem; color: #555; font-weight: bold;">Story
                                        Right Image</label>
                                    <input type="file" class="form-control" name="story_image" id="cta_image">
                                    @if($page->hasMedia('story_image'))
                                        <label for="existing_background_banner_image"></label>
                                        @foreach($page->getMedia('story_image') as $media)
                                            <img src="{{ $media->getUrl() }}" alt="Existing Banner Image"
                                                 style="max-width: 200px; max-height: 200px; margin-top: 10px;">
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">


                                <div class="form-group">
                                    <label for="title"
                                           style="font-size: 1.2rem; color: #555; font-weight: bold;">Story Section
                                        Description</label>
                                    <textarea class="form-control"
                                              name="story_sec_desc">{{ old('story_sec_desc', $content['story_sec_desc'] ?? '') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="title" style="font-size: 1.2rem; color: #555; font-weight: bold;">Story
                                        Image</label>
                                    <input type="file" class="form-control" name="story_image2" id="cta_image">
                                    @if($page->hasMedia('story_image2'))
                                        <label for="existing_background_banner_image"></label>
                                        @foreach($page->getMedia('story_image2') as $media)
                                            <img src="{{ $media->getUrl() }}" alt="Existing Banner Image"
                                                 style="max-width: 200px; max-height: 200px; margin-top: 10px;">
                                        @endforeach
                                    @endif
                                </div>


                            </div>
                        </div>

                        <div class="row mt-5">
                            <label for="title" style="font-size:2.5rem; color: #555; font-weight: bold;">---------------Our
                                Mission Section-------------------</label>
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="title"
                                           style="font-size: 1.2rem; color: #555; font-weight: bold;">Story Section
                                        Heading</label>
                                    <textarea class="form-control"
                                              name="mission_sec_heading">{{ old('mission_sec_heading', $content['mission_sec_heading'] ?? '') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="title" style="font-size: 1.2rem; color: #555; font-weight: bold;">Banner
                                        Image
                                        Second</label>
                                    <input type="file" class="form-control" name="mission_right_image"
                                           id="about_right_image">
                                    @if($page->hasMedia('mission_right_image'))
                                        <label for="existing_background_banner_image">Existing Banner Image</label>
                                        @foreach($page->getMedia('mission_right_image') as $media)
                                            <img src="{{ $media->getUrl() }}" alt="Existing Banner Image"
                                                 style="max-width: 200px; max-height: 200px; margin-top: 10px;">
                                        @endforeach
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="title" style="font-size: 1.2rem; color: #555; font-weight: bold;">Our
                                        Mission Paragraph one</label>
                                    <textarea class="form-control"
                                              name="mission_sec_para1">{{ old('mission_sec_para1', $content['mission_sec_para1'] ?? '') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="title" style="font-size: 1.2rem; color: #555; font-weight: bold;">Our
                                        Mission Paragraph two</label>
                                    <textarea class="form-control"
                                              name="mission_sec_para2">{{ old('mission_sec_para2', $content['mission_sec_para2'] ?? '') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="title" style="font-size: 1.2rem; color: #555; font-weight: bold;">Our
                                        Mission Paragraph Three</label>
                                    <textarea class="form-control"
                                              name="mission_sec_para3">{{ old('mission_sec_para3', $content['mission_sec_para3'] ?? '') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="title" style="font-size: 1.2rem; color: #555; font-weight: bold;">Our
                                        Mission Paragraph Four</label>
                                    <textarea class="form-control"
                                              name="mission_sec_para4">{{ old('mission_sec_para4', $content['mission_sec_para4'] ?? '') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="title" style="font-size: 1.2rem; color: #555; font-weight: bold;">Our
                                        Mission Paragraph Five</label>
                                    <textarea class="form-control"
                                              name="mission_sec_para5">{{ old('mission_sec_para5', $content['mission_sec_para5'] ?? '') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="title" style="font-size: 1.2rem; color: #555; font-weight: bold;">Our
                                        Mission Paragraph Six</label>
                                    <textarea class="form-control"
                                              name="mission_sec_para6">{{ old('mission_sec_para6', $content['mission_sec_para6'] ?? '') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="title" style="font-size: 1.2rem; color: #555; font-weight: bold;">Our
                                        Mission Paragraph Seven</label>
                                    <textarea class="form-control"
                                              name="mission_sec_para7">{{ old('mission_sec_para7', $content['mission_sec_para7'] ?? '') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="title" style="font-size: 1.2rem; color: #555; font-weight: bold;">Our
                                        Mission Bottom Image</label>
                                    <input type="file" class="form-control" name="mission_image1"
                                           id="about_right_image">
                                    @if($page->hasMedia('mission_image1'))
                                        <label for="existing_background_banner_image">Existing Banner Image</label>
                                        @foreach($page->getMedia('mission_image1') as $media)
                                            <img src="{{ $media->getUrl() }}" alt="Existing Banner Image"
                                                 style="max-width: 200px; max-height: 200px; margin-top: 10px;">
                                        @endforeach
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="title" style="font-size: 1.2rem; color: #555; font-weight: bold;">Our
                                        Mission Bottom Image</label>
                                    <input type="file" class="form-control" name="mission_image2"
                                           id="about_right_image">
                                    @if($page->hasMedia('mission_image2'))
                                        <label for="existing_background_banner_image">Existing Banner Image</label>
                                        @foreach($page->getMedia('mission_image2') as $media)
                                            <img src="{{ $media->getUrl() }}" alt="Existing Banner Image"
                                                 style="max-width: 200px; max-height: 200px; margin-top: 10px;">
                                        @endforeach
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="title" style="font-size: 1.2rem; color: #555; font-weight: bold;">Our
                                        Mission Bottom Image</label>
                                    <input type="file" class="form-control" name="mission_image3"
                                           id="about_right_image">
                                    @if($page->hasMedia('mission_image3'))
                                        <label for="existing_background_banner_image">Existing Banner Image</label>
                                        @foreach($page->getMedia('mission_image3') as $media)
                                            <img src="{{ $media->getUrl() }}" alt="Existing Banner Image"
                                                 style="max-width: 200px; max-height: 200px; margin-top: 10px;">
                                        @endforeach
                                    @endif
                                </div>


                            </div>

                        </div>

                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>

            @endsection


            @section('script')

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(document).ready(function () {
                        $('#banner_image1').change(function () {
                            var input = this;
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    $('#banner_image1_preview').attr('src', e.target.result).show();
                                }
                                reader.readAsDataURL(input.files[0]);
                            }
                        });
                    }

@endsection
