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
                                <h1 class="h3 mb-3 fw-normal title-top">{{ __('Confirm Password') }}</h1>
                                <p class="text-muted">{{ __('Please confirm your password before continue.') }}</p>

                                @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                                @endif

                            </div>
        

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="form-floating">
                            <input required="" name="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password">
                            <label for="floatingPassword">Password</label>

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                          </div>
                          <br/>

                          <button class="w-100 btn btn-lg btn-primary" type="submit">Confirm Password</button>
                          <br/>
                          <p class="mt-5 mb-3 text-muted">Forgot password? <a href="{{url('password/reset')}}">reset here</a>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
