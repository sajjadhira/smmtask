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
                                <p class="text-muted">{{ __('Please provide your registered email for resetting password bellow.') }}</p>

                                @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                                @endif

                            </div>
        

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-floating">
                            <input name="email" type="email" placeholder="name@example.com" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $email ?? old('email') }}" required autocomplete="off" autofocus>
                            <label for="floatingInput">Email address</label>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <br/>
                          </div>


                          <button class="w-100 btn btn-lg btn-primary" type="submit">Send Password Reset Link</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
