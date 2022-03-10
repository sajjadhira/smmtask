@extends('layouts.dashboard')
@section('title')
Companies
@endsection

@section('stylesheet')

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
                            <a href="{{ url('companies/create/') }}"><button class="btn-icon btn btn-primary btn-round btn-md" type="button"><i class="feather feather-plus-square"></i> Create Company</button></a>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic Tables start -->
                <div class="row" id="basic-table">
                    <div class="col-12">



                        @if(Auth::user()->id!='user')
                    
                            <form method="get">

                         <div class="col-md-12">
                                <div class="form-group">
                                    <input class="form-control" id="name" name="name" required="required" placeholder="Please type company name...">
                                </div>
                         </div>

                         <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Search</button> 
                                                            
                                </div>
                          </div>

                            </form>
         
                        @endif

                        <div class="card">


                            <div class="card-header">
                                <h4 class="card-title">All Companies</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">

                                    <!-- Table with outer spacing -->
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Domain</th>
                                                    <th>Base Administrator</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            	 @foreach ($data['companies'] as $company)
                                                <tr id="tr-{{ $company->id }}">
                                                    <td>{{ $company->id }}</td>
                                                    <td>{{ $company->name }}</td>
                                                    <td>{{ $company->domain }}</td>
                                                    <td>{{ $company->admin_name }} </td>
                                                    <td>{{ date('d F, Y',strtotime($company->created_at)) }}</td>

                                                    <td>
                                                      
                                                       <a class="dropdown-item" href="{{ url('companies/edit/'.  $company->id ) }}"><i class="feather icon-edit"></i> Update</a>

                                                        <a class="dropdown-item swal2-delete" data-id="{{ $company->id }}" href="javascript:;" data-url="{{ url('companies') }}"><i class="feather icon-trash"></i> Delete</a>
                                                    </td>
                                                </tr>
                                                 @endforeach
                                            </tbody>
                                        </table>


                                        {{ $data['companies']->links() }}
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

<!-- END: Page JS-->
@endsection


