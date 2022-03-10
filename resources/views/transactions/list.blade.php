@extends('layouts.main')

@section('title'){{__("Transactions")}}@endsection

@section('css')
<link rel="stylesheet" href="{{url('assets/css/marketplace.css')}}">
@endsection

@section('content')


			<!-- section -->
			
            <div class="container product">
				<h1 class="text-center">Transactions</h1>
                <div class="row featured">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


						<div class="card cart-details">
							<div class="card-header">
								Your Transaction List</span>
							</div>
							<div class="card-body">



                <!-- content table starts here -->
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Method</th>
                            <th>Old Balance</th>
                            <th>Amount</th>
                            <th>New Balance</th>
                            <th>Date</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['invoices'] as $invoice)
                            <tr>
                                <td>{{$invoice->id}}</td>
                                <td><span class="text-@if($invoice->type=="credit"){{__("success")}}@else{{__("danger")}}@endif">{{ucfirst($invoice->type)}}</span></td>
                                <td>{{ucfirst($invoice->method)}}</td>
                                <td><span class="data-default-currency"></span>{{$invoice->balance}}</td>
                                <td>@if($invoice->type=="credit"){{__("+")}}@else{{__("-")}}@endif<span class="data-default-currency"></span>{{$invoice->paid}}</td>
                                <td><span class="data-default-currency"></span>{{$invoice->new_balance}}</td>
                                <td>{{date("jS F Y",strtotime($invoice->created_at))}}</td>
                              </tr>          
                            @endforeach

        
                        </tbody>
                      </table>
                    </div>
                    <!-- content table ends here -->
    
                    <!-- pagination starts here -->
    
                      {{$data['invoices']->links()}}
      
                    <!-- pagination ends here -->
    

							</div>
						  </div>
		
                    </div>
                </div>
            </div>
			
			<!-- section END    -->
    
@endsection