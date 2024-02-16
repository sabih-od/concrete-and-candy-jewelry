@extends('front.layout.app')
@section('content')

    <div class="mouse-cursor cursor-outer"></div>
    <div class="mouse-cursor cursor-inner"></div>



    <section class="loginSec">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="formBox">
                        <form method="POST" action="{{ route('user.login') }}">
                            @csrf
                            <h1>Login</h1>
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
                            <div class="form-group">
                                <input class="form-control @error('password') is-invalid @enderror" type="password"
                                       placeholder="Password" name="password"
                                       value="">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-between">
                                <a class="forgetPassword" href="{{ route('forget.password.form') }}">Forget
                                    Password?</a>

                            </div>
                            <button class="themeBtn" type="submit">Sign in</button>
                            <a class="forgetPassword themeBtn" href="{{ route('register.form') }}">Create a new
                                account</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection







