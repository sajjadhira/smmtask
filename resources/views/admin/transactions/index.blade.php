@extends('layouts.dashboard')
@section('title'){{__('Payments')}}@endsection

@section('stylesheet')
<!-- additional js -->


<!-- ends additional css -->
@endsection

@section('content')

<!-- main starts here -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    
    <!-- starts heading & breadcrumb here -->
    <h4 class="content-header-title float-left mb-0">Payments</h4>


    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">

        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Payments</li>
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
                            <th>Type</th>
                            <th>Method</th>
                            <th>From Account Number</th>
                            <th>Paid Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{\App\Users::find($transaction->user)->name}}</td>
                                <td>{{$transaction->type}}</td>
                                <td>{{$transaction->method}}</td>
                                <td>{{$transaction->note}}</td>
                                <td>&#2547;{{$transaction->paid}}</td>
                                <td>@if($transaction->status==0)<span class="badge bg-primary">In Progress</span>@elseif($transaction->status==1)<span class="badge bg-success">Approved</span>@elseif($transaction->status==2)<span class="badge bg-danger">Declined</span>@endif</td>
                                
                                <td>
                                  @if($transaction->status==0)
                                  <a href="{{url('dashboard/transactions/payment/'.$transaction->id.'/1')}}"  onclick="return confirm('Are you sure, you want to approve the payment for the user?')"><button class="btn btn-primary">Approve</button></a>
                                  <a href="{{url('dashboard/transactions/payment/'.$transaction->id.'/2')}}"  onclick="return confirm('Are you sure, you want to decline the payment for the user?')"><button class="btn btn-danger">Deny</button></a>
                                  @else
                                  <a href="{{url('dashboard/transactions/payment/'.$transaction->id.'/0')}}"  onclick="return confirm('Are you sure, you want to undo the payment for the user?')"><button class="btn btn-danger">Undo Aprrovement</button></a>
                                  @endif
                                </td>
                              </tr>          
                            @endforeach

        
                        </tbody>
                      </table>
                </div>
                      
                      <div class="text-center">
                      {{$transactions->links()}}
                    </div>
                </div>

            </div>

        </div>

    </div>

</main>

@endsection



