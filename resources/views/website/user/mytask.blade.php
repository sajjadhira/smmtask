@extends('layouts.main')

@section('title'){{__("My Tasks")}}@endsection

@section('css')
<link rel="stylesheet" href="{{url('assets/css/marketplace.css')}}">
@endsection

@section('content')


			<!-- section -->
			
            <div class="container product">
				<h1 class="text-center">List of your Published Tasks</h1>
                <div class="row featured">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                      
                      
                      <div class="card cart-details">
                        <div class="card-header">
                          Your Task List</span>
                        </div>
                        <div class="card-body">
                          
                          
                          
                          <!-- content table starts here -->
                          <div class="table-responsive">
                            <table class="table">
                        <thead>
                          <tr>
                            <th>Task</th>
                            <th>Task Type</th>
                            <th>PPA</th>
                            <th>Budget</th>
                            <th>Total Completed</th>
                            <th>Status</th>
                            <th>Publish Date</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)

                            @php

                              if($task->product_type == "Youtube Subscribe"){
                                  $limit = 100;
                                }else{
                                  
                                  $limit = 10;
                              }

                            @endphp
                            <tr>
                              <td>ID {{$task->id}} # {{$task->name}}</td>
                              <td>{{__($task->product_type)}}</td>
                              <td>{{number_format($task->price)}} Points</td>
                              <td>{{number_format($task->budget)}} Points</td>
                              <td>{{number_format($task->amount_sold)}} Points ({{\App\Orders::where('product',$task->id)->get()->count()}})</td>
                              <td>@if($task->budget-$task->amount_sold>$limit)<span class="text-success">Running</span>@elseif($task->budget-$task->amount_sold<=$limit)<span class="text-success">Completed</span>@elseif($task->status==1)<span class="text-danger">Stopped</span>@elseif($task->status==2)<span class="text-danger">Closed</span>@elseif($task->status==3)<span class="text-danger">Declined</span> @endif</td>
                              <td>{{date("jS F Y",strtotime($task->created_at))}}</td>
                              <td>
                                
                                @if($task->status <3)
                                <a href="{{url('mytasks/edit/'.$task->id)}}" class="text-primary">Update Budget</a>
                                @if($task->status <2)
                                
                                @if($task->status == 0)
                                <br/><a href="{{url('mytasks/status/'.$task->id.'/1')}}" class="text-warning">Stop Task</a>
                                @else
                                <br/><a href="{{url('mytasks/status/'.$task->id.'/0')}}" class="text-success">Start Task</a>
                                @endif
                                <br/><a href="{{url('mytasks/status/'.$task->id.'/2')}}" class="text-danger"  onclick="return confirm('Do you wanna close this task? Action can not be undone.')">Close &amp; Refund Point</a>

                                @endif
                                @endif

                              </td>
                            </tr>          
                            @endforeach
                            
                            
                          </tbody>
                      </table>
                    </div>
                    <!-- content table ends here -->
    
                    <!-- pagination starts here -->
    
                      {{$tasks->links()}}
      
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