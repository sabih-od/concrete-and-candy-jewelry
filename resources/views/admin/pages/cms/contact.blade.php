@extends('admin.layout.admin')
@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            {{--@dd($data)--}}
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0" style="font-size: 2.5rem; color: #333; font-weight: bold;">Contact Page
                            Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#" style="color: #666;">Contact</a></li>
                            <li class="breadcrumb-item active" aria-current="page"
                                style="color: #333; font-weight: bold;">
                                Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <form action="{{ route('admin.pages.update', ['slug' => $page->slug]) }}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="slug" value="{{ $page->slug }}">
                    <input type="hidden" name="media_collections[]" value="background_banner_image">

                    <div class="row mt-5">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="meta_title">Title</label>
                                <input type="text" class="form-control" id="meta_title" name="meta_title"
                                       placeholder="Enter Title" value="{{ old('meta_title', $page->meta_title) }}"
                                       required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="meta_description">Description</label>
                                <input type="text" class="form-control" id="meta_description" name="meta_description"
                                       placeholder="Enter Description"
                                       value="{{ old('meta_description', $page->meta_description) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="background_banner_image">Banner Image</label>
                                <input type="file" class="form-control" name="background_banner_image"
                                       value="about_right_image" id="background_banner_image">
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
                                <label for="contact_banner_title">Banner Title</label>
                                <textarea class="form-control" name="contact_banner_title"
                                          placeholder="Enter Banner Title">{{ old('contact_banner_title', $content['contact_banner_title'] ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="contact_banner_title">Contact Form heading</label>
                            <textarea class="form-control" name="contact_form_heading"
                                      placeholder="Enter Banner Title">{{ old('contact_form_heading', $content['contact_form_heading'] ?? '') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="contact_banner_title">Contact Form Description</label>
                            <textarea class="form-control" name="contact_form_description"
                                      placeholder="Enter Banner Title">{{ old('contact_form_description', $content['contact_form_description'] ?? '') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="contact_banner_title">Contact Form Footer Paragraph</label>
                            <textarea class="form-control" name="contact_form_footer_para"
                                      placeholder="Enter Banner Title">{{ old('contact_form_footer_para', $content['contact_form_footer_para'] ?? '') }}</textarea>
                        </div>
                        <div class="col-md-12 mt-3">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>

            </div>

@endsection


