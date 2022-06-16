@extends('layouts.dashboard')
@section('title')Announcement @endsection

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
    <h4 class="content-header-title float-left mb-0">Announcement</h4>


    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">

        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{url('dashboard/settings')}}">Announcement</a></li>
          <li class="breadcrumb-item active" aria-current="page">Update Public Announcement</li>
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
                                        <form method="POST" action="{{ url('settings/update') }}" class="steps-validation wizard-circle" id="form" enctype='multipart/form-data'>
                                        	@method('PATCH')
                                            <!-- Step 1 -->
                                            <h6><i class="step-icon feather icon-image"></i> Public Announcement</h6>
                                            <fieldset>
                                                <div class="row">


                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="notice_type">
                                                                Announcement Type
                                                            </label>
                                                        <select name="notice_type" class="form-control">
                                                            <option value="">NOT SELECTED</option>
                                                            @foreach ($data['types'] as $type)
                                                            <option value="{{$type}}" @if($type==$data['notice_type']) selected @endif>{{strtoupper($type)}}</option>
                                                            @endforeach
                                                        </select>
                                                      
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="notice">
                                                                Announcement Message
                                                            </label>
                                                            <textarea name="notice" class="form-control char-textarea" id="textarea-counter" rows="3" placeholder="Please input notice here or you can leave it empty if you don't want to display any notice...">{{$data['notice']}}</textarea>
                                                      
                                                        </div>
                                                    </div>

                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="website_button_color">
                                                                Webiste Button Color
                                                            </label>
                                                        <select name="website_button_color" class="form-control">
                                                            <option value="">NOT SELECTED</option>
                                                            @foreach ($data['colors'] as $key=>$type)
                                                            <option value="{{$key}}" @if($key==$data['website_button_color']) selected @endif>{{strtoupper($type)}}</option>
                                                            @endforeach
                                                        </select>
                                                      
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
<!-- BEGIN: Page JS-->

<script src="{!! asset('app-assets/vendors/js/extensions/jquery.steps.min.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') !!}"></script>
<script src="{!! asset('app-assets/js/scripts/forms/wizard-steps.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/forms/select/select2.full.min.js') !!}"></script>
<!-- END: Page JS-->

@endsection