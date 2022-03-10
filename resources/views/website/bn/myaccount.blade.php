@extends('layouts.'.$data['language'].'.main')

@section('title')
আমার একাউন্ট
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
                            <h2>{{Auth::user()->name}} </h2>
                            আপনার বর্তমান ব্যালেন্স <b>&#2547;{{Auth::user()->balance}}</b></div>
                            <hr/>
                        <div class="welcome-msg">

                            <p>আপনার একাউন্ট অপশন থেকে আপনি আপনার একাউন্টের তথ্য, সকল অর্ডার দেখতে পারবেন। তাছাড়া আপনি আপনার ডেলিভারি ঠিকানা, পাসওয়ার্ড, ফোন নাম্বার, আপডেট করতে পারবেন।</p>
                        </div>
                        <div class="box-account box-info">
                            <div class="box-head">
                                {{-- <h2>Account Information</h2></div> --}}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="box">
                                        <div class="box-title">
                                            <h4>একাউন্টের তথ্য</h4>
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
                                            <h4>ডেলিভারি ঠিকানা</h4></div>
                                        <div class="box-content">
                                            <p>দয়া করে আপনার ডেলিভারি তথ্য আপডেট করুন।</p>
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