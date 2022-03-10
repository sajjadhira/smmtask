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
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      
                      
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
                            <th>PPA</th>
                            <th>Budget</th>
                            <th>Total Completed</th>
                            <th>Status</th>
                            <th>Publish Date</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                            <tr>
                              <td>{{$task->name}}</td>
                              <td>{{$task->price}} Points</td>
                              <td>{{$task->budget}} Points</td>
                              <td>{{\App\Orders::where('product',$task->id)->get()->count()}}</td>
                              <td>@if($task->status==0)<span class="text-success">Running</span>@elseif($task->budget==$task->aomunt_sold)<span class="text-success">Completed</span>@elseif($task->status==2)<span class="text-danger">Declined</span> @endif</td>
                              <td>{{date("jS F Y",strtotime($task->created_at))}}</td>
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
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  my-account">
                  
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