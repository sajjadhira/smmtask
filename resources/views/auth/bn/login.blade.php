@extends('layouts.'.$data['language'].'.main')

@section('title')
    Login 
@endsection

@section('content')


<div class="row">
    <div class="col-md-6 offset-md-3">
<div class="card">
    <div class="card-body">
      <h5 class="card-title">লগিন করুন</h5>
      <h6 class="card-subtitle mb-2 text-muted">লগিন করতে আপনার ফোন নাম্বার ও পাসওয়ার্ড দিয়ে লগিন বাটনে ক্লিক করুন।</h6>
      <div class="card-body">
        
        <form method="POST" action="{{ route('login') }}" class="form-horizontal auth-form">
            <div class="form-group">
                <input name="email" type="text" placeholder="আপনার মোবাইল নাম্বার দিন" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="off" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            <div class="form-group">
                <input required="" name="password" type="password" placeholder="আপনার পাসওয়ার্ড দিন" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            <div class="form-terms">
                <div class="custom-control custom-checkbox mr-sm-2">
                    <input type="checkbox" class="" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="" for="customControlAutosizing">লগিন মনে রাখুন</label>
                    
                    <a href="#" class="btn btn-default forgot-pass">পাসওয়ার্ড ভুলে গেছেন?</a>
                </div>
            </div>
            <div class="form-button">
                <button class="btn btn-primary" type="submit">লগিন</button>
            </div>
            <div class="form-footer">
                <span>আপনার কি কোন একাউন্ট নেই? সহজেই করে নিন একটি একাউন্ট <a href="{{url('register')}}"><u>একাউন্ট করতে এখানে ক্লিক করুন</u></a></span>
                <!--span>Or Login up with social platforms</span>
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

<br/>
<br/>
<br/>

@endsection