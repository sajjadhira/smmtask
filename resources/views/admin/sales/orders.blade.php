@extends('layouts.dashboard')
@section('title'){{__('Invoices ')}}@endsection

@section('stylesheet')
<!-- additional js -->


<!-- ends additional css -->
@endsection

@section('content')

<!-- main starts here -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    
    <!-- starts heading & breadcrumb here -->
    <h4 class="content-header-title float-left mb-0">Invoices</h4>


    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">

        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Invoices</li>
        </ol>

    </nav>
    <!-- ends heading & breadcrumb here -->


    <!-- starts main content here -->
    <div class="row no-gutters">

          <!-- columns starts here -->
          <div class="col-md-12 col-xxl-12 mb-3 pr-md-2">

            <!-- cards starts here -->
            <div class="card h-md-100  w-md-d-card">
                <div class="card-body ">

                <!-- content table starts here -->
                <div class="table-responsive">
                <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>User</th>
                            <th>Amount</th>
                            <th>Payment Method</th>
                            <th>Mobile Number</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['orders'] as $order)

                            @php
                                $order_details_explode = explode('to',$order->sale_tracking);
                                $type = trim($order_details_explode[0]);
                                $account = trim($order_details_explode[1]);
                            @endphp
                            <tr>
                                <td>{{\App\Users::find($order->user)->name}}</td>
                                <td>&#2547;{{$order->total}}</td>
                                <td>{{$type}}</td>
                                <td>{{$account}}</td>
                                <td>@if($order->status==0)<span class="badge bg-primary">In Progress</span>@elseif($order->status==1)<span class="badge bg-success">Paid</span>@elseif($order->status==2)<span class="badge bg-danger">Declined</span>@endif</td>
                                
                                <td>
                                  @if($order->status==0)
                                  <a href="{{url('dashboard/payment/confirm/'.$order->id)}}"  onclick="return confirm('Are you sure, you sent the payment to the user?')"><button class="btn btn-primary">Make Payment</button></a>
                                  @endif
                                </td>
                              </tr>          
                            @endforeach

        
                        </tbody>
                      </table>
                </div>
                      
                      <div class="text-center">
                      {{$data['orders']->links()}}
                    </div>
                </div>

            </div>

        </div>

    </div>

</main>

@endsection



