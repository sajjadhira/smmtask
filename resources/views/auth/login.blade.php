@extends('layouts.main')

@section('title'){{__("Login")}}@endsection

@section('content')


			<!-- section -->
		
            <div class="container product">
                <div class="row featured">
                    <div class="col-lg-6 col-md-6 offset-lg-3 offset-md-3 col-sm-12 col-xs-12">


						<main class="form-signin">
							<form method="POST" action="{{ route('login') }}" >
							<div class="identity-panel">

								<!-- <img class="mb-4" src="./assets/img/inihub.svg" alt="..."> -->
								<h1 class="h3 mb-3 fw-normal title-top">Please sign in</h1>
								<p class="text-muted">Login to your account and get access to our platform including product discussion, support, forum and all.</p>
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
						  
							  <div class="checkbox mb-3">
								<label>
                                    <input type="checkbox" class="" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
								</label>
							  </div>
							  <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
							  {{-- <p class="mt-5 mb-3 text-muted">Forgot password? <a href="{{url('password/reset')}}">reset here</a>. Do not have account? <a href="{{url('register')}}">create new</a></p> --}}
							  <p class="mt-5 mb-3 text-muted">
								  পাসওয়ার্ড ভুলে গেলে আপনার রেজিস্টার্ড ইমেইল এড্রেস থেকে যোগাযোগ করুন - <br/>
								  <ul>
									  <li>ইমেইল এড্রেস - <a href="mailto:smmcreatorbd@gmail.com" target="_blank">এখানে ক্লিক করুন</a></li>
								  </ul>
							  </p>

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