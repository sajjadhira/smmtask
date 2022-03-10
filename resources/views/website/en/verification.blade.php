@extends('layouts.'.$data['language'].'.main')

@section('title')
Verify Your Account
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
                    <h4 class="title">Dashboard</h4>
                    <div class="block-content ">
                        @include('website.'.$data['language'].'.myaccount-menu')
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-12">
                <div class="dashboard-right">
                    <div class="dashboard">
                        <div class="page-title">
                            <h2>Verify Your Account</h2>
                        </div>
                            <hr/>
                        <div class="welcome-msg">
                            @if ($data['process']==200)

                            <p>Your account is already verified.</p>
                            
                            @elseif($data['process'] == 403)
                            <p>You have reached maximum try limit for today please try after {{$data['process_time']}}.</p>
                            @else
                            <p>A verification code has been sent to <b>{{Auth::user()->email}}</b>, verify your account for enjoy our full features.</p>
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
                                            <h4>Enter your verification code to the input box</h4></div>
                                        <div class="box-content">
                                                    
        <form method="POST" action="{{ url('verify') }}" class="form-horizontal auth-form">
            @method('PATCH')
            <div class="form-group">
                <input name="code" type="text" placeholder="123456" id="num1" class="form-control" required autocomplete="off" maxlength="6" autofocus>
                @error('email')

            @enderror
            </div>

            <div class="form-button">
                <button class="btn btn-primary" type="submit">Verify</button>
                <a href="{{url('verification?send_code='.Auth::user()->email)}}"><button type="button" class="btn btn-info">Re-send Code</button></a>
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