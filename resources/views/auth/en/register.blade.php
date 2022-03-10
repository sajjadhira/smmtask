@extends('layouts.main')

@section('title')
    Register 
@endsection

@section('content')
<section>

    <div class="row">
        <div class="col-md-6 offset-md-3">
    <div class="card">
        <div class="card-body">
          <h5 class="card-title">Register</h5>
          <h6 class="card-subtitle mb-2 text-muted">Please name, input mobile number and passsword for register your account</h6>
          <div class="card-body">
            
                                    <form class="form-horizontal auth-form" method="POST" action="{{ route('register') }}">
                                        
                                        <div class="form-group">
                                            <input required="" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Your Name" id="name" value="{{ old('name') }}" required autocomplete="name" autofocus autocomplete="off">
                                           
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input required="" name="email" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Mobile Number 018xxxxxxxx') }}" value="{{ old('email') }}" required autocomplete="email">

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input required="" name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('6 Digit Password') }}"  required autocomplete="new-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input required="" name="password_confirmation" type="password"  class="form-control" placeholder="{{ __('Confirm Password') }}" required autocomplete="new-password">
                                        </div>
                                        <div class="form-terms">
                                            <div class="custom-control custom-checkbox mr-sm-2">
                                                <label class="" for=""><span>By clicking submit you are agreeing to the <a href="{{url('terms-and-conditions')}}"  class="pull-right"> Terms &amp; Conditions</a></span></label>
                                            </div>
                                        </div>
                                        <div class="form-button">
                                            <button class="btn btn-primary" type="submit">Register</button>
                                        </div>
                                        <div class="form-footer">
                                            <span>Already have an account? Please <a href="{{url('login')}}">Sign In</a></span>
                                            <!--span>Or Sign up with social platforms</span>
                                            <ul class="social">
                                                <li><a class="icon-facebook" href=""></a></li>
                                                <li><a class="icon-twitter" href=""></a></li>
                                                <li><a class="icon-instagram" href=""></a></li>
                                                <li><a class="icon-pinterest" href=""></a></li>
                                            </ul-->
                                        </div>


                                        @csrf
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
</section>
@endsection