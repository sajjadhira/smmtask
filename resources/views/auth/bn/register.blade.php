@extends('layouts.'.$data['language'].'.main')



@section('title')
    Register 
@endsection

@section('content')
<section>

    <div class="row">
        <div class="col-md-6 offset-md-3">
    <div class="card">
        <div class="card-body">
          <h5 class="card-title">নতুন একাউন্ট করুন</h5>
          <h6 class="card-subtitle mb-2 text-muted">নতুন একাউন্ট করতে আপনার নাম, ফোন নাম্বার, পাসওয়ার্ড টাইপ করে রেজিস্টার বাটনে ক্লিক করুন</h6>
          <div class="card-body">
            
                                    <form class="form-horizontal auth-form" method="POST" action="{{ route('register') }}">
                                        
                                        <div class="form-group">
                                            <input required="" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="আপনার নাম" id="name" value="{{ old('name') }}" required autocomplete="name" autofocus autocomplete="off">
                                           
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input required="" name="email" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('মোবাইল নাম্বার ইংরেজিতে 018xxxxxxxx') }}" value="{{ old('email') }}" required autocomplete="email">

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input required="" name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('৬ সংখ্যার পাসওয়ার্ড দিন') }}"  required autocomplete="new-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input required="" name="password_confirmation" type="password"  class="form-control" placeholder="{{ __('পুনরাই পাসওয়ার্ড দিন') }}" required autocomplete="new-password">
                                        </div>
                                        <div class="form-terms">
                                            <div class="custom-control custom-checkbox mr-sm-2">
                                                <label class="" for=""><span><small>রেজিস্টার বাটনে ক্লিক করে আপনি আমাদের <a target="_blank" href="{{url('terms-and-conditions')}}"> শর্তাবলি</a>তে সম্মত হচ্ছেন।</small></span></label>
                                            </div>
                                        </div>
                                        <div class="form-button">
                                            <button class="btn btn-primary" type="submit">রেজিস্টার</button>
                                        </div>
                                        <br/>
                                        <div class="form-footer">
                                            <span>আপনার কি ইতিমধ্যে একাউন্ট আছে? থাকলে লগিন করতে <a href="{{url('login')}}">এখানে ক্লিক করুন</a></span>
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