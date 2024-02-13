@extends('admin.layout.admin')
@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            {{--@dd($data)--}}
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0" style="font-size: 2.5rem; color: #333; font-weight: bold;">Footer Content
                            Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#" style="color: #666;">Footer</a></li>
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
                    <input type="hidden" name="media_collections[]" value="social_media_pic1">
                    <input type="hidden" name="media_collections[]" value="social_media_pic2">
                    <input type="hidden" name="media_collections[]" value="social_media_pic3">
                    <input type="hidden" name="media_collections[]" value="social_media_pic4">

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
                        <label for="title" style="font-size:2.5rem; color: #555; font-weight: bold;">---------------Footer
                            Content
                            Section-------------------</label>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title" style="font-size: 1.2rem; color: #555; font-weight: bold;">Footer
                                    Heading
                                </label>
                                <textarea class="form-control"
                                          name="footer_heading">{{ old('footer_heading', $content['footer_heading'] ?? '') }}</textarea>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="title" style="font-size: 1.2rem; color: #555; font-weight: bold;">Footer Sub
                                Heading
                            </label>
                            <textarea class="form-control"
                                      name="footer_sub_heading">{{ old('footer_sub_heading', $content['footer_sub_heading'] ?? '') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="title" style="font-size: 1.2rem; color: #555; font-weight: bold;">Footer
                                Description
                            </label>
                            <textarea class="form-control"
                                      name="footer_description">{{ old('footer_description', $content['footer_description'] ?? '') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="title" style="font-size: 1.2rem; color: #555; font-weight: bold;">Footer Button
                            </label>
                            <textarea class="form-control"
                                      name="footer_button">{{ old('footer_button', $content['footer_button'] ?? '') }}</textarea>
                        </div>

                        <div class="row mt-5">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title" style="font-size: 1.2rem; color: #555; font-weight: bold;">Social-Media
                                        Image 1</label>
                                    <input type="file" class="form-control" name="social_media_pic1"
                                           id="social_media_pic1">
                                    @if($page->hasMedia('social_media_pic1'))
                                        <label for="existing_social_media_pic1">Existing Social-Media Image</label>
                                        @foreach($page->getMedia('social_media_pic1') as $media)
                                            <img src="{{ $media->getUrl() }}" alt="Existing Banner Image"
                                                 style="max-width: 200px; max-height: 200px; margin-top: 10px;">
                                        @endforeach
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="title" style="font-size: 1.2rem; color: #555; font-weight: bold;">Social-Media
                                        Image 2</label>
                                    <input type="file" class="form-control" name="social_media_pic2"
                                           id="social_media_pic2">
                                    @if($page->hasMedia('social_media_pic2'))
                                        <label for="existing_social_media_pic2">Existing Social-Media Image</label>
                                        @foreach($page->getMedia('social_media_pic2') as $media)
                                            <img src="{{ $media->getUrl() }}" alt="Social-Media Profile Image"
                                                 style="max-width: 200px; max-height: 200px; margin-top: 10px;">
                                        @endforeach
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="title" style="font-size: 1.2rem; color: #555; font-weight: bold;">Social-Media
                                        Image 3</label>
                                    <input type="file" class="form-control" name="social_media_pic3"
                                           id="social_media_pic3">
                                    @if($page->hasMedia('social_media_pic3'))
                                        <label for="existing_social_media_pic3">Existing Social-Media Image</label>
                                        @foreach($page->getMedia('social_media_pic3') as $media)
                                            <img src="{{ $media->getUrl() }}" alt="Social-Media Profile Image"
                                                 style="max-width: 200px; max-height: 200px; margin-top: 10px;">
                                        @endforeach
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="title" style="font-size: 1.2rem; color: #555; font-weight: bold;">Social-Media
                                        Image 4</label>
                                    <input type="file" class="form-control" name="social_media_pic4"
                                           id="social_media_pic4">
                                    @if($page->hasMedia('social_media_pic4'))
                                        <label for="existing_social_media_pic4">Existing Social-Media Image</label>
                                        @foreach($page->getMedia('social_media_pic4') as $media)
                                            <img src="{{ $media->getUrl() }}" alt="Social-Media Profile Image"
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
                    });
                </script>
@endsection
