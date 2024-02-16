@extends('front.layout.app')
@section('content')

    <div class="mouse-cursor cursor-outer"></div>
    <div class="mouse-cursor cursor-inner"></div>



    <section class="loginSec">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="formBox">
                        <form method="POST" action="{{ route('user.register') }}">
                            @csrf
                            <h1>Register</h1>
                            <div class="form-group">
                                <input class="form-control @error('name') is-invalid @enderror" type="text"
                                       placeholder="Name" name="name" value="">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input class="form-control @error('email') is-invalid @enderror" type="email"
                                       placeholder="Email address" name="email"
                                       value="">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input class="form-control @error('password') is-invalid @enderror" type="password" placeholder="Password" name="password"
                                       value="">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" placeholder="Confirm password"
                                       name="password_confirmation" value="">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <a class="forgetPassword" href="{{ route('login.form') }}">Already have an account?</a>
                            </div>
                            <div class="text-center">
                                <button class="themeBtn" type="submit">Sign Up</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
