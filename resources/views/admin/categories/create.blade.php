@extends('layouts.dashboard')
@section('title')Create Product Category @endsection

@section('css')
<!-- additional js -->

<link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/plugins/forms/wizard.css') !!}">
<link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/forms/select/select2.min.css') !!}">

<!-- ends additional css -->
@endsection

@section('content')

<!-- main starts here -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    
    <!-- starts heading & breadcrumb here -->
    <h4 class="content-header-title float-left mb-0">Product Category</h4>


    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">

        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{url('dashboard/categories')}}">Product Category</a></li>
          <li class="breadcrumb-item active" aria-current="page">Create Product Category</li>
        </ol>

    </nav>
    <!-- ends heading & breadcrumb here -->


    <!-- starts main content here -->
    <div class="row no-gutters app-content">

          <!-- columns starts here -->
          <div class="col-md-12 col-xxl-12 mb-3 pr-md-2">

            <!-- cards starts here -->
            <div class="card h-md-100  w-md-d-card">
                <div class="card-body ">
                    <form action="{{ url('dashboard/categories/store/') }}"  class="steps-validation wizard-circle" id="form"  novalidate="" method="POST" enctype="multipart/form-data">
                        @method('PATCH')


                        
                          
                    <!-- Step 1 -->
                    <h6><span data-feather="trello"></span> Indentification Information</h6>
                    <fieldset>

                        <div class="row">

                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name*</label>
                                <input class="form-control required" id="name" type="text" name="name" required="" placeholder="Product Category Name">
                            </div>
                            </div>

                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Image</label>
                                <input class="upload" name="image" type="file">
                            </div>
                            </div>


                        </div>

                    </fieldset>
                      
                        @csrf
                    </form>
     
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


@section('js')
<script src="{!! asset('app-assets/vendors/js/extensions/jquery.steps.min.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') !!}"></script>
<script src="{!! asset('app-assets/js/scripts/forms/wizard-steps.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/forms/select/select2.full.min.js') !!}"></script>

@endsection