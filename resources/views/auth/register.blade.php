@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center text-center">
        <div class="col-md-8 py-4 mt-4">
            <h1 class="h3 mb-3 font-weight-normal font-weight-bold">Register</h1>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group d-flex flex-column align-items-center">
                    <!-- <label for="name" class="col-md-4 col-form-label">{{ __('Name') }}</label> -->

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Name" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group d-flex flex-column align-items-center">
                    <!-- <label for="email" class="col-md-4 col-form-label">{{ __('E-Mail Address') }}</label> -->

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email"placeholder="Name" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group d-flex flex-column align-items-center">
                    <!-- <label for="password" class="col-md-4 col-form-label">{{ __('Password') }}</label> -->

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group d-flex flex-column align-items-center">
                    <!-- <label for="password-confirm" class="col-md-4 col-form-label">{{ __('Confirm Password') }}</label> -->

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group d-flex flex-column align-items-center">
                    <div class="col-md-6">
                        <button type="submit" class="w-100 btn btn-dark">
                            {{ __('Register') }}
                        </button>
                        <p>&copy acostudio 2021</p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
