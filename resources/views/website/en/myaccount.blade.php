@extends('layouts.'.$data['language'].'.main')

@section('title')
My Account
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
                            <h2>{{Auth::user()->name}} </h2>
                            Your current balance is <b>&#2547;{{Auth::user()->balance}}</b></div>
                            <hr/>
                        <div class="welcome-msg">

                            <p>From your My Account / Dashboard page you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.</p>
                        </div>
                        <div class="box-account box-info">
                            <div class="box-head">
                                {{-- <h2>Account Information</h2></div> --}}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="box">
                                        <div class="box-title">
                                            <h4>Contact Information</h4>
                                        </div>
                                        <div class="box-content">
                                            <h6>{{Auth::user()->name}}</h6>
                                            <h6>{{Auth::user()->email}}</h6>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="box">
                                        <div class="box-title">
                                            <h4>Manage Addresses</h4></div>
                                        <div class="box-content">
                                            <p>Please set your default Billing &amp; Shipping Addresses</p>
                                        </div>
                                    </div>
                                </div>
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