@extends('layouts.dashboard')
@section('title')Edit Expense @endsection

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
    <h4 class="content-header-title float-left mb-0">Expenses</h4>


    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">

        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Expensees</a></li>
          <li class="breadcrumb-item active" aria-current="page">Edit Expense</li>
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

                    <form action="{{ url('dashboard/expenditures/update/'.$data['expense']->id) }}"  class="steps-validation wizard-circle" id="form" novalidate="" method="POST" enctype="multipart/form-data">
                        @method('PATCH')

                    <!-- Step 1 -->
                    <h6><span data-feather="trello"></span> Expense Information</h6>
                    <fieldset>

                        <div class="row">
                            
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">
                                    Name*
                                </label>
                                <input class="form-control required" id="name" type="text" name="name" required="" placeholder="Expense Name" value="{{$data['expense']->name}}">
                            </div>
                            </div>

                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">
                                    Category*
                                </label>
                                <select class="form-control required" id="category" name="category" required="">
                                        <option value="">Select Category</option>
                                    @foreach ($data['categories'] as $item)
                                        <option value="{{$item->id}}" @if($data['expense']->category == $item->id) selected @endif>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            </div>
                                  
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Amount*</label>
                                <input class="form-control required" id="amount" type="number" name="amount" required="" placeholder="Expense Amount" value="{{$data['expense']->amount}}">
                            </div>     
                            </div>     

                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Remark</label>
                                <input class="form-control" id="remark" type="text" name="remark" placeholder="Expense Remark"  value="{{$data['expense']->remark}}">
                            </div>
                            </div>

                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Date*</label>
                                <input class="form-control required" id="date" type="date" name="date" required value="{{date('Y-m-d',strtotime($data['expense']->created_at))}}">
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

<script type="text/javascript">

$(document).ready(function () {
            
            $('#category').select2();

});
</script>

@endsection