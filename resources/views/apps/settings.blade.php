@extends('layouts.dashboard')
@section('title')
Settings
@endsection

@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/plugins/forms/wizard.css') !!}">
<link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/forms/select/select2.min.css') !!}">
@endsection

@section('content')



    <!-- BEGIN: Content-->
    <div class="app-content content col-md-12">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
  
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-lg-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrum-right">
                            
                    </div>
                </div>
            </div>


                <!-- Form wizard with step validation section start -->
                <section id="validation">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <div class="card-content">
                                    <div class="card-body">
                                        <form method="POST" action="{{ url('settings/update') }}" class="steps-validation wizard-circle" id="form" enctype='multipart/form-data'>
                                        	@method('PATCH')
                                            <!-- Step 1 -->
                                            <h6><i class="step-icon feather icon-image"></i> Basic Settings</h6>
                                            <fieldset>
                                                <div class="row">


                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="notice_type">
                                                                Notice Type
                                                            </label>
                                                        <select name="notice_type" class="form-control">
                                                            <option value="">NOT SELECTED</option>
                                                            @foreach ($data['types'] as $type)
                                                            <option value="{{$type}}" @if($type==$data['notice_type']) selected @endif>{{strtoupper($type)}}</option>
                                                            @endforeach
                                                        </select>
                                                      
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="notice">
                                                                Notice
                                                            </label>
                                                            <textarea name="notice" class="form-control char-textarea" id="textarea-counter" rows="3" placeholder="Please input notice here or you can leave it empty if you don't want to display any notice...">{{$data['notice']}}</textarea>
                                                      
                                                        </div>
                                                    </div>


                                                </div>
                                            </fieldset>

                                 
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Form wizard with step validation section end -->




@endsection

@section('javascript')
<!-- BEGIN: Page JS-->
<script src="{!! asset('app-assets/vendors/js/extensions/jquery.steps.min.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') !!}"></script>
<script src="{!! asset('app-assets/js/scripts/forms/wizard-steps.js') !!}"></script>

<!-- END: Page JS-->

@endsection