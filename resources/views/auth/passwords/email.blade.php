@extends('front.layout.app')

@section('content')
    <div class="mouse-cursor cursor-outer"></div>
    <div class="mouse-cursor cursor-inner"></div>

    <section class="loginSec">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="formBox">
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <h1>Forget Password</h1>
                            <div class="form-group">
                                <input class="form-control @error('email') is-invalid @enderror" type="email"
                                       placeholder="Email Address" name="email"
                                       value="">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button class="themeBtn" type="submit">Send Email</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
