@extends('layouts.dashboard')
@section('title')Expenses Categories @endsection

@section('stylesheet')
<!-- additional js -->


<!-- ends additional css -->
@endsection

@section('content')

<!-- main starts here -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    
    <!-- starts heading & breadcrumb here -->
    <h4 class="content-header-title float-left mb-0">Expenses Categories</h4>


    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">

        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Expenses Categories</li>
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
                @php
                    $total = 0;
                @endphp
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Total Expense</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['categories'] as $category)
                            <tr>
                                <td>{{$category->name}}</td>
                                <td><span class="data-default-currency"></span>{{ \App\Expenses::where('category','=',$category->id)->sum('amount')}}</td>
                                <td><a href="{{ url('dashboard/expenditures/categories/edit/'.$category->id) }}"><span class="badge bg-primary text-white"><i class="feather icon-edit"></i> Update</span></a></td>
                              </tr>          
                            @endforeach

        
                        </tbody>
                      </table>
                    </div>
                    <!-- content table ends here -->
    
                    <!-- pagination starts here -->
    
                      {{$data['categories']->links()}}

                    <!-- pagination ends here -->
    
                </div>
            </div>
            <!-- cards ends here -->

        </div>
        <!-- table column ends here -->


    </div>
    <!-- main contents ends here -->

</main>
<!-- main ends here -->

@endsection



