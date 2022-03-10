@extends('layouts.'.$data['language'].'.main')

@section('title')
একাউন্ট ভেরিফিকেশন
@endsection

@section('css')
<link href="{!! asset('assets/css/account.css') !!}" rel="stylesheet">
@endsection

@section('content')

<!-- section start -->
<section class="section-big-py-space bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-12">
                <div class="dashboard-left">
                    <h4 class="title">ড্যাশবোর্ড</h4>
                    <div class="block-content ">
                        @include('website.'.$data['language'].'.myaccount-menu')
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-12">
                <div class="dashboard-right">
                    <div class="dashboard">
                        <div class="page-title">
                            <h2>আপনার একাউন্ট ভেরিফাই করুন</h2>
                        </div>
                            <hr/>
                        <div class="welcome-msg">
                            @if ($data['process']==200)

                            <p>আপনার একাউন্টটি ইতিমধ্যে ভেরফাই করা হয়ে গেছে।</p>
                            
                            @elseif($data['process'] == 403)
                            <p>আপনি আজকের মতো সর্বোচ্চ চেষ্টা করে ফেলেছেন। {{$data['process_time']}} সময় পর আবার চেষ্টা করুন।</p>
                            @else
                            <p>আপনার ফোন নাম্বার <b>{{Auth::user()->email}}</b> এ SMS এর মাধ্যমে একটি ৬ সংখ্যার ভেরিফিকেশন কোড পাঠানো হয়েছে, আমাদের ফুল ফিচার উপভোগ করতে একাউন্টটি ভেরিফাই করে নিন।</p>
                            @endif
                        </div>
                        <div class="box-account box-info">
                            <div class="box-head">
                                {{-- <h2>Account Information</h2></div> --}}
                            <div class="row">
                                <div class="col-sm-12 col-12 col-md-12">
                                    <div class="box">
                                        <div class="box-title">
                                        
                                        </div>
                                        <div class="box-content">

                                            </div>
                                    </div>
                                </div>
                                @if ($data['process']==302)
                                <div class="col-sm-12 col-12 col-md-12">
                                    <div class="box">
                                        <div class="box-title">
                                            <h4>৬ সংখ্যার ভেরিফিকেশন কোডটি এই বক্সে দিন-</h4></div>
                                        <div class="box-content">
                                                    
        <form method="POST" action="{{ url('verify') }}" class="form-horizontal auth-form">
            @method('PATCH')
            <div class="form-group">
                <input name="code" type="text" placeholder="উদাহারন - 123456" id="num1" class="form-control" required autocomplete="off" maxlength="6" autofocus>
                @error('email')

            @enderror
            </div>

            <div class="form-button">
                <button class="btn btn-primary" type="submit">ভেরিফাই করুন</button>
                <a href="{{url('verification?send_code='.Auth::user()->email)}}"><button type="button" class="btn btn-info">কোড পান নি? আবার কোড পাঠান</button></a>
            </div>
 

            @csrf
        </form>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- section end -->
@endsection