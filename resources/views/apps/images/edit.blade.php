@extends('layouts.main')
@section('title')
<?php  echo \App\Campaigns::findOrFail($data['campaign'])->name  ?> Edit Images
@endsection

@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/plugins/forms/wizard.css') !!}">
<link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/featherlight/featherlight.css') !!}">
@endsection

@section('content')



    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0"><?php  echo \App\Campaigns::findOrFail($data['campaign'])->name  ?> Edit Image</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('dashboard/') }}">Dashboard</a>
                                    <li class="breadcrumb-item"><a href="{{ url('campaigns/') }}">Campaigns</a>
                                    <li class="breadcrumb-item"><a href="{{ url('campaigns/images/'.$data['campaign']) }}">Images</a>
                                    </li>
                                    <li class="breadcrumb-item active">Edit Image
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-lg-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrum-right">
                            <a href="{{ url('campaigns/images/'.$data['campaign']) }}"><button class="btn-icon btn btn-primary btn-round btn-md" type="button"><i class="feather icon-command"></i> <?php  echo \App\Campaigns::findOrFail($data['campaign'])->name  ?> Images</button></a>
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
                                        <form method="POST" action="{{ url('images/update/'.$data['image']->id) }}" class="steps-validation wizard-circle" id="form" enctype='multipart/form-data'>
                                            @method('PATCH')
                                            <!-- Step 1 -->
                                            <h6><i class="step-icon feather icon-image"></i> Image Information</h6>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="code">
                                                                Image Code
                                                            </label>
                                                        <select class="form-control required" id="code" name="code">
                                                        	<option value="">Select Image</option>
                                                            @for($i=1;$i<=20;$i++)
                                                            <option value="image-{{$i}}" @if('image-'.$i == $data['image']->code) selected="selected" @endif>image-{{$i}}</option>
                                                            @endfor
                                                        </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="model_age">
                                                                Image
                                                            </label>
                                                      <input type="file" name="image" class="form-control">
                                                      <input type="hidden" name="campaign" value="{{$data['campaign']}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <a href="javascript:;" data-featherlight="{{url('images/'.$data['image']->url)}}">{{ $data['image']->url }}</a>
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
<script src="{!! asset('app-assets/vendors/js/featherlight/featherlight.js') !!}"></script>


<!-- END: Page JS-->

@endsection