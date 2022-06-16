@extends('layouts.main')

@section('title'){{__("Payments")}}@endsection

@section('css')
<link rel="stylesheet" href="{{url('assets/css/marketplace.css')}}">
@endsection

@section('content')


			<!-- section -->
			
            <div class="container product">
				<h1 class="text-center">List of your Payments</h1>
                <div class="row featured">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                      
                      
                      <div class="card cart-details">
                        <div class="card-header">
                          Your Payments List</span>
                        </div>
                        <div class="card-body">
                          
                          
                          
                          <!-- content table starts here -->
                          <div class="table-responsive">
                            <table class="table">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Method</th>
                            <th>From Account Number</th>
                            <th>Amount</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                            <tr>
                              <td>{{$payment->id}}</td>
                              <td>{{Str::ucfirst($payment->method)}}</td>
                              <td>{{$payment->note}}</td>
                              <td>&#2547;{{$payment->paid}}</td>
                              <td>@if($payment->status==0)<span class="badge bg-primary">In Progress</span>@elseif($payment->status==1)<span class="badge bg-success">Approved</span>@elseif($payment->status==2)<span class="badge bg-danger">Declined</span>@endif</td>
                            </tr>          
                            @endforeach
                            
                            
                          </tbody>
                      </table>
                    </div>
                    <!-- content table ends here -->
    
                    <!-- pagination starts here -->
    
                      {{$payments->links()}}
      
                      <!-- pagination ends here -->
                      
                      
                    </div>
                  </div>
		
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4  my-account">
                  
                  <div class="card ">
                    <div class="card-header">
                      Dashboard
                    </div>
                    <div class="card-body">

                                      @include('website.user.menu')


                    </div>
                    </div>
                </div>
                </div>
              </div>
			
              <!-- section END    -->
    
@endsection