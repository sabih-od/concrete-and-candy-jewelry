@extends('admin.layout.admin')
@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            {{--@dd($data)--}}
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0" style="font-size: 2.5rem; color: #333; font-weight: bold;">Faq Page
                            Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#" style="color: #666;">Faq</a></li>
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
                                       value="background_banner_image" id="background_banner_image">
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
                                <label for="shop_banner_title">Banner Title</label>
                                <textarea class="form-control" name="faq_banner_title"
                                          placeholder="Enter Banner Title">{{ old('faq_banner_title', $content['faq_banner_title'] ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="shop_banner_title">Faq Questions Heading</label>
                            <textarea class="form-control" name="question_sec_heading"
                                      placeholder="Enter Banner Title">{{ old('question_sec_heading', $content['question_sec_heading'] ?? '') }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="shop_banner_title">Question Number One</label>
                                <textarea class="form-control" name="question1"
                                          placeholder="Enter Banner Title">{{ old('question1', $content['question1'] ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="shop_banner_title">Question One Answer</label>
                                <textarea class="form-control" name="answer1"
                                          placeholder="Enter Banner Title">{{ old('answer1', $content['answer1'] ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="shop_banner_title">Question Number Two</label>
                                <textarea class="form-control" name="question2"
                                          placeholder="Enter Banner Title">{{ old('question2', $content['question2'] ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="shop_banner_title">Question Two Answer</label>
                                <textarea class="form-control" name="answer2"
                                          placeholder="Enter Banner Title">{{ old('answer2', $content['answer2'] ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="shop_banner_title">Question Number Three</label>
                                <textarea class="form-control" name="question3"
                                          placeholder="Enter Banner Title">{{ old('question3', $content['question3'] ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="shop_banner_title">Question Three Answer</label>
                                <textarea class="form-control" name="answer3"
                                          placeholder="Enter Banner Title">{{ old('answer3', $content['answer3'] ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="shop_banner_title">Question Number Four</label>
                                <textarea class="form-control" name="question4"
                                          placeholder="Enter Banner Title">{{ old('question4', $content['question4'] ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="shop_banner_title">Question Four Answer</label>
                                <textarea class="form-control" name="answer4"
                                          placeholder="Enter Banner Title">{{ old('answer4', $content['answer4'] ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="shop_banner_title">Question Number Five</label>
                                <textarea class="form-control" name="question5"
                                          placeholder="Enter Banner Title">{{ old('question5', $content['question5'] ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="shop_banner_title">Question Five Answer</label>
                                <textarea class="form-control" name="answer5"
                                          placeholder="Enter Banner Title">{{ old('answer5', $content['answer5'] ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="shop_banner_title">Question Number Six</label>
                                <textarea class="form-control" name="question6"
                                          placeholder="Enter Banner Title">{{ old('question6', $content['question6'] ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="shop_banner_title">Question Six Answer</label>
                                <textarea class="form-control" name="answer6"
                                          placeholder="Enter Banner Title">{{ old('answer6', $content['answer6'] ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>

            </div>

@endsection


