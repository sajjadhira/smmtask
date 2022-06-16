@extends('layouts.dashboard')
@section('title')Products @endsection

@section('stylesheet')
<!-- additional css -->


<!-- ends additional css -->
@endsection

@section('content')

<!-- main starts here -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    
    <!-- starts heading & breadcrumb here -->
    <h4 class="content-header-title float-left mb-0">Products</h4>


    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">

        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Products</li>
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
                    <table class="table">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Publisher</th>
                            <th>PPA</th>
                            <th>Budget</th>
                            <th>Budget Reached</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['products'] as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{\App\Categories::findOrFail($item->category)->name}}</td>
                                <td>{{\App\Users::findOrFail($item->user)->name}}</td>
                                <td>{{number_format($item->price)}} Points</td>
                                <td>{{number_format($item->budget)}} Points</td>
                                <td>{{number_format($item->amount_sold)}} Points</td>
                                <td><a href="{{ url('dashboard/products/edit/'.$item->id) }}"><span class="badge bg-primary text-white"><i class="feather icon-edit"></i> Update</span></a></td>
                              </tr>          
                            @endforeach

        
                        </tbody>
                      </table>
                    </div>
                    <!-- content table ends here -->
    
                    <!-- pagination starts here -->
    
                      {{$data['products']->links()}}
  
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



