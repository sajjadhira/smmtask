@extends('layouts.dashboard')
@section('title')Users @endsection

@section('stylesheet')
<!-- additional js -->


<!-- ends additional css -->
@endsection

@section('content')

<!-- main starts here -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    
    <!-- starts heading & breadcrumb here -->
    <h4 class="content-header-title float-left mb-0">Users</h4>


    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">

        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Users</li>
        </ol>

    </nav>
    <!-- ends heading & breadcrumb here -->


    <!-- starts search here -->
    <div class="row no-gutters">


        <div class="form-inline">
        <div class="form-group mb-2">
            <input class="form-control" id="name" name="name" required="required" placeholder="Please type user name...">
        </div>

            <button type="submit" class="btn btn-primary">Search</button> 
                                    
    </div>


    </div>
    <!-- end of search here -->



    <!-- starts main content here -->
    <div class="row no-gutters">

          <!-- columns starts here -->
          <div class="col-md-12 col-xxl-12 mb-3 pr-md-2">

            <!-- cards starts here -->
            <div class="card h-md-100  w-md-d-card">
                <div class="card-body ">

                <!-- content table starts here -->
                <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>UID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Balance</th>
                            <th>Role</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                         @foreach ($data['users'] as $user)
                        <tr id="tr-{{ $user->id }}">
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>${{ $user->balance }}</td>
                            <td>{{ ucfirst($user->role) }}</td>

                            <td class="text-center">
                                <a href="{{ url('dashboard/users/edit/'.  $user->id ) }}"><span class="badge bg-primary text-white"><i class="feather icon-edit"></i> Update</span></a>
                                @if(Auth::user()->role=='superadmin')
                                <a class="swal2-delete" data-id="{{ $user->id }}" href="javascript:;" data-url="{{ url('dashboard/users') }}"><span class="badge bg-danger text-white"><i class="feather icon-trash"></i> Delete</span></a>
                                @endif
                            </td>
                        </tr>
                         @endforeach
                    </tbody>
                </table>
                </div>
                <!-- content table ends here -->

                <!-- pagination starts here -->

                {{ $data['users']->links() }}

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


@section('javascript')
<!-- additional js -->

<!-- end of additional js -->
@endsection


