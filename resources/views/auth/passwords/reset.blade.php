@extends('layouts.main')

@section('title'){{__("Reset Password")}}@endsection

@section('content')


			<!-- section -->
		
            <div class="container product">
                <div class="row featured">
                    <div class="col-lg-6 col-md-6 offset-lg-3 offset-md-3 col-sm-12 col-xs-12">


						<main class="form-signin">


                            <div class="identity-panel">

                                <!-- <img class="mb-4" src="./assets/img/inihub.svg" alt="..."> -->
                                <h1 class="h3 mb-3 fw-normal title-top">{{ __('Reset Password') }}</h1>
                                <p class="text-muted">{{ __('Please provide your email and new password bellow.') }}</p>
                            </div>
        

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-floating">
                            <input name="email" type="email" placeholder="name@example.com" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $email ?? old('email') }}" required autocomplete="off" autofocus>
                            <label for="floatingInput">Email address</label>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                          </div>


                        <div class="form-floating">
                            <input required="" name="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password">
                            <label for="floatingPassword">Password</label>

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                          </div>

                        <div class="form-floating">
                            <input required="" name="password_confirmation" type="password" placeholder="Confirm Password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password">
                            <label for="floatingPassword">Confirm Password</label>

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                          </div>
                      

                        <br/>

                        <button class="w-100 btn btn-lg btn-primary" type="submit">Reset Password</button>

                    </form>
                </div>
            </div>
        </div>

@endsection
