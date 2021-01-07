@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center text-center">
        <div class="col-md-8 py-4 mt-4">
            <h1 class="h3 mb-3 font-weight-normal font-weight-bold">Sign In</h1>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group d-flex flex-column align-items-center">
                    <label for="email" class="sr-only">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-8">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="mohammadnasrulazis@gmail.com" placeholder="Email" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group d-flex flex-column align-items-center">
                    <label for="password" class="sr-only">{{ __('Password') }}</label>

                    <div class="col-md-8">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="123123123" placeholder="Password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div> -->

                <div class="form-group mb-0 d-flex justify-content-center">
                    <div class="col-md-8">
                        <button type="submit" class="w-100 btn btn-dark">
                            {{ __('Login') }}
                        </button>
                        <p>&copy acostudio 2021</p>
                        <!-- @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
