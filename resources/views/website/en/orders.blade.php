@extends('layouts.'.$data['language'].'.main')
@section('title')
My Ordres
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
                            <h2>Your orders</h2>
                        </div>
                  
                        <div class="box-account box-info">
                            <div class="box-head">
                                {{-- <h2>Account Information</h2></div> --}}
                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <table class="table cart-table table-responsive">
                                        <thead>
                                        <tr class="table-head">
                                            <th scope="col">Invoice</th>
                                            <th scope="col">Total Price</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        @foreach ($data['orders'] as $order)
                    
                                        <tbody>
                                        <tr>
                                            <td>
                                                <a href="{{url('order/'.$order->id)}}">#{{$order->id}}</a>
                                            </td>
                                            <td>
                                                &#2547;{{$order->total}}
                                            </td>
                    
                                            <td>
                                                @if ($order->status==0)
                                                <span class="badge badge-info">Placed</span>                            
                                                @elseif ($order->status==1)
                                                <span class="badge badge-info">Processing</span>
                                                @elseif ($order->status==2)
                                                <span class="badge badge-success">Delivered</span>
                                                @elseif ($order->status==403)
                                                <span class="badge badge-danger">Cancled</span>
                                                @elseif ($order->status==127)
                                                <span class="badge badge-danger">Returned</span>
                                                @endif
                    
                                            </td>
                                            
                                            <td>
                                                {{date('d F, Y',strtotime($order->created_at))}}
                                            </td>
                    
                                            <td>
                                                <a href="{{url('order/'.$order->id)}}">View Details</a>
                                               |  <a target="_blank" href="{{url('invoice/'.$order->id)}}">Print</a>
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