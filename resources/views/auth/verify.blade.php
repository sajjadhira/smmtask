@extends('layouts.main')

@section('title'){{__("Verify")}}@endsection


@section('content')

			<!-- section -->
		
            <div class="container product">
                <div class="row featured">
                    <div class="col-lg-6 col-md-6 offset-lg-3 offset-md-3 col-sm-12 col-xs-12">


                <main class="form-signin">

                    <div class="identity-panel">

                        <!-- <img class="mb-4" src="./assets/img/inihub.svg" alt="..."> -->
                        <h1 class="h3 mb-3 fw-normal title-top">{{ __('Verify Your Email Address') }}</h1>
                        <p class="text-muted">{{ __('A fresh verification link has been sent to your email address. Plese check your inbox, spam folder.') }}</p>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            @endif

                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }},
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" class="w-100 btn btn-lg btn-primary">{{ __('click here to request another') }}</button>.
                            </form>

                        </div>
                    </div>
                </main>

                </div>
            </div>
        </div>


@endsection
