@extends('layouts.main')
@section('title')
<?php  echo \App\Campaigns::findOrFail($data['campaign'])->name  ?> Images
@endsection

@section('stylesheet')
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
                            <h2 class="content-header-title float-left mb-0"><?php  echo \App\Campaigns::findOrFail($data['campaign'])->name  ?> Images</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('dashboard/') }}">Dashboard</a>
                                    <li class="breadcrumb-item"><a href="{{ url('campaigns/') }}">Campaigns</a>
                                    </li>
                                    <li class="breadcrumb-item active">Images
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-lg-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrum-right">
                            <a href="{{ url('campaigns/images/create/'.$data['campaign']) }}"><button class="btn-icon btn btn-primary btn-round btn-md" type="button"><i class="feather icon-plus-circle"></i> Add Image</button></a>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic Tables start -->
                <div class="row" id="basic-table">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?php  echo \App\Campaigns::findOrFail($data['campaign'])->name  ?> Images</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">

                                    <!-- Table with outer spacing -->
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Code</th>
                                                    <th>Image</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            	 @foreach ($data['images'] as $image)
                                                <tr id="tr-{{ $image->id }}">
                                                    <td>{{ $image->code }}</td>
                                                    <td><a href="javascript:;" data-featherlight="{{url('images/'.$image->url)}}">{{ $image->url }}</a></td>

                                                    <td>
                            
                                                    <div class="dropdown">
                                                    <button class="btn-icon btn btn-primary btn-round btn-md dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-settings"></i></button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                       <a class="dropdown-item" href="{{ url('images/edit/'.  $image->id ) }}"><i class="feather icon-edit"></i> Update</a>

                                                        <a class="dropdown-item swal2-delete" data-id="{{ $image->id }}" href="javascript:;" data-url="{{ url('images') }}"><i class="feather icon-trash"></i> Delete</a>
                                                    </div>
                                                    </div>
                                    </td>
                                                </tr>
                                                 @endforeach
                                            </tbody>
                                        </table>


                                        {{ $data['images']->links() }}
                                    </div>
                                </div>
                               
                            </div>
                        </div>

                <!-- Responsive tables end -->

            </div>
        </div>
    </div>

   </div>
 </div>
    <!-- END: Content-->
@endsection


@section('javascript')
<!-- BEGIN: Page JS-->
    <script src="{!! asset('app-assets/vendors/js/featherlight/featherlight.js') !!}"></script>
    <!-- END: Page JS-->
@endsection


