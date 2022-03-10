@extends('layouts.main')

@section('title'){{__("Register")}}@endsection

@section('content')


			<!-- section -->
			
            <div class="container product">
                <div class="row featured">
                    <div class="col-lg-6 col-md-6 offset-lg-3 offset-md-3 col-sm-12 col-xs-12">


						<main class="form-signin">
							<form method="POST" action="{{ route('register') }}" >
							<div class="identity-panel">

								<!-- <img class="mb-4" src="./assets/img/inihub.svg" alt="..."> -->
								<h1 class="h3 mb-3 fw-normal">Register Account</h1>
								<p class="text-muted">Register your acouunt and login to your account and get access to our platform including product discussion, support, forum and all.</p>
							</div>
								
							  <div class="form-floating">
                                <input name="name" type="text" placeholder="Your Name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autocomplete="off" autofocus>
								<label for="floatingInput">Name</label>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

							  </div>
								
							  <div class="form-floating">
                                <input name="email" type="email" placeholder="name@example.com" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="off" autofocus>
								<label for="floatingInput">Email address</label>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

							  </div>
                              
							  <div class="form-floating">
								<input required="" name="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password">
								<label for="floatingPassword">Password</label>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

							  </div>

							  <div class="form-floating">
								<input required="" name="password_confirmation" type="password" placeholder="Password Confirmation" class="form-control" required autocomplete="current-password">
								<label for="floatingPassword">Password Confirmation</label>

							  </div>
						  
							  <div class="checkbox mb-3">
								<label>
                                    <input type="checkbox" class="" name="agree" id="agree" required> I accept  &nbsp;<a href="{{url('terms-and-conditions')}}"  class="pull-right"> terms &amp; conditions</a></span></label>
								</label>
							  </div>
							  <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
							  <p class="mt-5 mb-3 text-muted">Forgot password? <a href="{{url('password/reset')}}">reset here</a>. Do you already have an account? <a href="{{url('login')}}">click here for login</a></p>

                              @csrf
							</form>
						  </main>
		
                    </div>


					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">



					</div>

                </div>
            </div>
			
			<!-- section END    -->


@endsection