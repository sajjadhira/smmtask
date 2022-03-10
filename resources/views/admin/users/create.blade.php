@extends('layouts.dashboard')
@section('title')Users @endsection

<!-- additional js -->
@section('css')
<link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/plugins/forms/wizard.css') !!}">
<link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/forms/select/select2.min.css') !!}">
@endsection
<!-- ends additional css -->

@section('content')

<!-- main starts here -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 app-content">
    
    <!-- starts heading & breadcrumb here -->
    <h4 class="content-header-title float-left mb-0">Users</h4>


    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">

        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{url('dashboard/users')}}">Users</a></li>
          <li class="breadcrumb-item active" aria-current="page">Create</li>
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

                                        <form method="POST" action="{{ url('dashboard/users/store') }}" class="steps-validation wizard-circle" id="form" enctype='multipart/form-data'>
                                            @method('PATCH')
                                            <!-- Step 1 -->
                                            <h6><span data-feather="user"></span> User Information</h6>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">
                                                                Name*
                                                            </label>
                                                            <input type="text" class="form-control required" id="name" name="name" placeholder="John Doe" minlength="3">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email">
                                                                Email*
                                                            </label>
                                                            <input type="email" class="form-control required" id="email" name="email" placeholder="name@example.com">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="password">
                                                                Password*
                                                            </label>
                                                            <input type="password" class="form-control required" id="password" name="password" placeholder="Minimum 8 Characters" autocomplete="off" minlength="8">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="role">
                                                                Role*
                                                            </label>
                                                            <select class="select2-data-ajax form-control required" id="role" name="role">
                                                                <option value="">Select Role</option>
                                                                <?php
                                                                    $roles = ['user'];
                                                                if(Auth::user()->role=='superadmin'){
                                                                    $roles = ['user','affiliate','manager','administrator'];
                                                                }else if(Auth::user()->role=='administrator'){
                                                                    $roles = ['manager','affiliate','administrator'];
                                                                }else if(Auth::user()->role=='manager'){
                                                                    $roles = ['user'];
                                                                }
                                                                ?>
                                                                @foreach($roles as $role)
                                                                <option value="{{$role}}">{{ucfirst($role)}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">
                                                                Default Billing Address
                                                            </label>
                                                            <input type="text" class="form-control" id="default_billing_address" name="default_billing_address" placeholder="Billing Address" minlength="3">
                                                        </div>
                                                    </div>


                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">
                                                                Billing Phone
                                                            </label>
                                                            <input type="text" class="form-control" id="default_billing_phone" name="default_billing_phone" placeholder="Default Phone" minlength="3">
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
                    
                    
                    <!-- additional js -->
                    @section('js')

<script src="{!! asset('app-assets/vendors/js/extensions/jquery.steps.min.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') !!}"></script>
<script src="{!! asset('app-assets/js/scripts/forms/wizard-steps.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/forms/select/select2.full.min.js') !!}"></script>
<!-- END: Page JS-->

<script type="text/javascript">
$(document).ready(function () {
            
             $('#gateway').select2();

            // var token = $("meta[name='csrf-token']").attr("content");
            $('#gateway').select2({
            placeholder: "Select Gateway",
            minimumInputLength: 1,
            ajax: {
                url: '{{ url('gateways/find') }}',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });

});            
</script>
                    @endsection
                    <!-- end of additional js -->
                    