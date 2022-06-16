@extends('layouts.dashboard')
@section('title')Reports @endsection

@section('stylesheet')
<!-- additional css -->


<!-- ends additional css -->
@endsection

@section('content')

<!-- main starts here -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    
    <!-- starts heading & breadcrumb here -->
    <h4 class="content-header-title float-left mb-0">Reports</h4>


    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">

        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Reports</li>
        </ol>

    </nav>
    <!-- ends heading & breadcrumb here -->


    <!-- starts main content here -->
    <div class="row no-gutters">

        <div class="card h-md-100  w-md-d-card">
            <div class="card-body">
     
                <div class="col-xl-12">

                    <br/>
                    <h3 class="text-center">Summary</h3>
                    <br/>

                    <table class="table">
                        <thead>
                          <tr>
                            <th class="text-left">Total Revenue</th>
                            <th class="text-right">Total Expense</th>
                          </tr>
                        </thead>
                        <tbody>
                           
                            <tr>
                                <td class="text-left"><b>&#2547;{{number_format($income,2)}}</b></td>
                                <td class="text-right"><b>&#2547;{{number_format($expense,2)}}</b></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center">
                                    <b>Profit</b>
                                </td>
                            </tr>
                            <tr>
                            <td colspan="2" class="text-center"><b>&#2547;{{number_format(($profit),2)}}</b></td>
                            </tr>
        
                        </tbody>
                      </table>
         
                </div>


            </div>

        </div>

</main>

@endsection



