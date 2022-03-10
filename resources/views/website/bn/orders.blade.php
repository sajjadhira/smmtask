@extends('layouts.'.$data['language'].'.main')
@section('title')
সকল অর্ডার
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
                            <h2>আপনার সকল অর্ডার</h2>
                        </div>
                  
                        <div class="box-account box-info card">
                            <div class="box-head card-body">
                                {{-- <h2>Account Information</h2></div> --}}
                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <table class="table cart-table table-responsive">
                                        <thead>
                                        <tr class="table-head">
                                            <th scope="col">ইনভয়েস নাম্বার</th>
                                            <th scope="col">সর্বমোট টাকা</th>
                                            <th scope="col">অর্ডারের অবস্থা</th>
                                            <th scope="col">তারিখ</th>
                                            <th scope="col">লিংকস</th>
                                        </tr>
                                        </thead>
                                        @foreach ($data['orders'] as $order)
                    
                                        <tbody>
                                        <tr>
                                            <td>
                                                <a href="{{url('order/'.$order->id)}}">#{{\App\Http\Controllers\HomeController::bfn($order->id)}}</a>
                                            </td>
                                            <td>
                                                &#2547;{{\App\Http\Controllers\HomeController::bfn(number_format($order->total,2))}}
                                            </td>
                    
                                            <td>
                                                @if ($order->status==0)
                                                <span class="badge badge-info">অর্ডার হয়েছে</span>                            
                                                @elseif ($order->status==1)
                                                <span class="badge badge-info">প্রসেসিংএ আছে</span>
                                                @elseif ($order->status==2)
                                                <span class="badge badge-success">ডেলিভারি হয়েছে</span>
                                                @elseif ($order->status==403)
                                                <span class="badge badge-danger">ক্বাতিল হয়েছে</span>
                                                @elseif ($order->status==127)
                                                <span class="badge badge-danger">ফেরত হয়েছে</span>
                                                @endif
                    
                                            </td>
                                            
                                            <td>
                                                {{\App\Http\Controllers\HomeController::bfn(date('d F, Y',strtotime($order->created_at)))}}
                                            </td>
                    
                                            <td>
                                                <a href="{{url('order/'.$order->id)}}">বিস্তারিত</a>
                                               |  <a target="_blank" href="{{url('invoice/'.$order->id)}}">প্রিন্ট</a>
                                            </td>
                                        </tr>
                                        </tbody>
                    
                                        @endforeach
                                        
                                    </table>
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