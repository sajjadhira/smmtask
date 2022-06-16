<!DOCTYPE html>
<html lang="en">
<head>
<title>@yield('title')| inihub</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="html themes, bootstrap html templete, WordPress Themes, WordPress Plugins">
<meta name="description" content="Build your brand with our beautiful themes &amp; plugins.">
<meta name="author" content="inihub">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css')}}">
<!-- <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css"> -->
<!-- FontAwesome CSS -->
<link rel="stylesheet" href="{{ url('assets/font-awesome/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{ url('assets/animate.css/animate.min.css')}}">
<!-- Custom Style -->
<!-- Shortcut Icon -->
<link rel="shortcut icon" href="{{ url('images/icons/favicon.ico')}}" type="image/x-icon" />

<link rel="apple-touch-icon" sizes="57x57" href="{{ url('images/icons/apple-icon-57x57.png')}}">
<link rel="apple-touch-icon" sizes="60x60" href="{{ url('images/icons/apple-icon-60x60.png')}}">
<link rel="apple-touch-icon" sizes="72x72" href="{{ url('images/icons/apple-icon-72x72.png')}}">
<link rel="apple-touch-icon" sizes="76x76" href="{{ url('images/icons/apple-icon-76x76.png')}}">
<link rel="apple-touch-icon" sizes="114x114" href="{{ url('images/icons/apple-icon-114x114.png')}}">
<link rel="apple-touch-icon" sizes="120x120" href="{{ url('images/icons/apple-icon-120x120.png')}}">
<link rel="apple-touch-icon" sizes="144x144" href="{{ url('images/icons/apple-icon-144x144.png')}}">
<link rel="apple-touch-icon" sizes="152x152" href="{{ url('images/icons/apple-icon-152x152.png')}}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ url('images/icons/apple-icon-180x180.png')}}">
<link rel="icon" type="image/png" sizes="192x192"  href="{{ url('images/icons/android-icon-192x192.png')}}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ url('images/icons/favicon-32x32.png')}}">
<link rel="icon" type="image/png" sizes="96x96" href="{{ url('images/icons/favicon-96x96.png')}}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ url('images/icons/favicon-16x16.png')}}">
<link rel="manifest" href="{{ url('images/icons/manifest.json')}}">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="{{ url('images/icons/ms-icon-144x144.png')}}">
<meta name="theme-color" content="#ffffff">

<link href="{{ url('assets/dashboard/dashboard.css')}}" rel="stylesheet">

<!-- Custom styles for this template -->
@yield('css')
    
</head>
<body>



<header class="navbar navbar-light navbar-brand-color sticky-top flex-md-nowrap">

  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 text-center" href="{{url('dashboard')}}">
    <span class="brand-img show"><img src="{{ url('images/inihub.svg')}}" class="d-inline-block align-text-top d-dashboard-image"></span>
    <span class="brand-text"><img src="{{ url('images/icons/apple-icon-57x57.png')}}"></span>
    </a>
  <button class="d-none d-md-block b-collapse-sidebar" id="toggle-sidebar-now"><span data-feather="align-justify"></span></button>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  {{-- <input class="form-control form-control-dark shh-w-auto" type="text" placeholder="Search" aria-label="Search"> --}}
  <div class="avatar avatar-xl dropdown">
    @php
    $dFile = 'images/'.Auth::user()->image;
        if(file_exists($dFile)){
          $avatar = url($dFile);
        }else{
          $iFile = 'images/nophoto.png';
          $avatar = url($iFile);
        }
    @endphp
    <a href="#" id="userNav" role="button" data-bs-toggle="dropdown" aria-expanded="false"><img class="rounded-circle" src="{{$avatar}}" alt="..." /></a>
  
    <ul class="dropdown-menu" aria-labelledby="userNav">
      <li class="text-center">{{Auth::user()->name}}<br/><span class="text-muted">{{ucfirst(Auth::user()->role)}}</span></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item" href="#">Profile</a></li>
      <li><a class="dropdown-item" href="#">Download Items</a></li>
      <li><a class="dropdown-item" href="#">Add Fund</a></li>
      <li><a class="dropdown-item" href="#">Settings</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item" href="#">Logout</a></li>
    </ul>

  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block navbar-brand-color sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link @if(request()->segments()[0]=='dashboard' && !isset(request()->segments()[1])) active @endif" aria-current="page" href="{{url('dashboard')}}">
              <span data-feather="home"></span>
              <span class="nav-link-text">Dashboard</span>
            </a>
          </li>

          
          <li class="nav-item">
            <a class="nav-link @if(isset(request()->segments()[1]) && (request()->segments()[1]=='products' || request()->segments()[1]=='categories' || request()->segments()[1]=='subcategories')) active @endif" href="javascript::void(0)">
              <span data-feather="shopping-cart"></span>
              <span class="nav-link-text">Products  @if(isset(request()->segments()[1]) && (request()->segments()[1]=='products' || request()->segments()[1]=='categories' || request()->segments()[1]=='subcategories')) <span data-feather="chevron-down"></span>@else <span data-feather="chevron-right"></span>@endif</span>
            </a>

            <ul class="menu-sub @if(isset(request()->segments()[1]) && (request()->segments()[1]=='products' || request()->segments()[1]=='categories' || request()->segments()[1]=='subcategories')) show @endif">
              <li><a class="dropdown-item @if(isset(request()->segments()[1]) && request()->segments()[1]=='products' && !isset(request()->segments()[2])) active @endif" href="{{url('dashboard/products/')}}"><span data-feather="more-horizontal"></span> All Products</a></li>
                {{-- @foreach (\App\Categories::get() as $item)
                <li><a class="dropdown-item" href="{{url('dashboard/products/category/'.$item->slug)}}"><span data-feather="more-horizontal"></span> {{$item->name}}</a></li>
                @endforeach --}}
                <li><a class="dropdown-item @if(isset(request()->segments()[1]) && request()->segments()[1]=='products' && isset(request()->segments()[2]) && request()->segments()[2] == "create") active @endif" href="{{url('dashboard/products/create/')}}"><span data-feather="plus"></span> Add Product</a></li>
                
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                  <span>Product Categories</span>
                </h6>
                <li><a class="dropdown-item @if(isset(request()->segments()[1]) && request()->segments()[1]=='categories' && !isset(request()->segments()[2])) active @endif" href="{{url('dashboard/categories/')}}"><span data-feather="more-horizontal"></span> All Categories</a></li>
                <li><a class="dropdown-item @if(isset(request()->segments()[1]) && request()->segments()[1]=='categories' && isset(request()->segments()[2]) && request()->segments()[2] == "create") active @endif" href="{{url('dashboard/categories/create/')}}"><span data-feather="plus"></span> Add Category</a></li>
            
                
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                  <span>Product Subcategories</span>
                </h6>
                <li><a class="dropdown-item @if(isset(request()->segments()[1]) && request()->segments()[1]=='subcategories' && !isset(request()->segments()[2])) active @endif" href="{{url('dashboard/subcategories/')}}"><span data-feather="more-horizontal"></span> All Subcategories</a></li>
                <li><a class="dropdown-item @if(isset(request()->segments()[1]) && request()->segments()[1]=='subcategories' && isset(request()->segments()[2]) && request()->segments()[2] == "create") active @endif" href="{{url('dashboard/subcategories/create/')}}"><span data-feather="plus"></span> Add Subcategory</a></li>
            
              </ul>
          </li>
          
          
          {{-- <li class="nav-item">
            <a class="nav-link" href="javascript::void(0)">
              <span data-feather="columns"></span>
              <span class="nav-link-text">Categories <span data-feather="chevron-right"></span></span>
            </a>

            <ul class="menu-sub">
                <li><a class="dropdown-item" href="{{url('dashboard/categories/')}}"><span data-feather="more-horizontal"></span> All Categories</a></li>
                <li><a class="dropdown-item" href="{{url('dashboard/categories/add/')}}"><span data-feather="plus"></span> Add Category</a></li>
            </ul>
          </li> --}}
          
          <li class="nav-item">
            <a class="nav-link @if(isset(request()->segments()[1]) && request()->segments()[1]=='users') active @endif" href="javascript::void(0)">
              <span data-feather="users"></span>
              <span class="nav-link-text">Users @if(isset(request()->segments()[1]) && request()->segments()[1]=='users')<span data-feather="chevron-down"></span> @else<span data-feather="chevron-right"></span>@endif</span>
            </a>

            <ul class="menu-sub @if(isset(request()->segments()[1]) && request()->segments()[1]=='users') show @endif">

              <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>General Users</span>
              </h6>

              <li><a class="dropdown-item @if(isset(request()->segments()[1]) && request()->segments()[1] =='users' && isset(request()->segments()[2]) && request()->segments()[2] == "user")active @endif" href="{{url('dashboard/users/user')}}"><span data-feather="more-horizontal"></span> Customers</a></li>
              <li><a class="dropdown-item @if(isset(request()->segments()[1]) && request()->segments()[1] =='users' && isset(request()->segments()[2]) && request()->segments()[2] == "affiliate")active @endif" href="{{url('dashboard/users/affiliate')}}"><span data-feather="more-horizontal"></span> Affiliates</a></li>
                            
              <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Administrative Users</span>
              </h6>
              <li><a class="dropdown-item @if(isset(request()->segments()[1]) && request()->segments()[1] =='users' && isset(request()->segments()[2]) && request()->segments()[2]=="manager")active @endif" href="{{url('dashboard/users/manager')}}"><span data-feather="more-horizontal"></span> Manager</a></li>
              <li><a class="dropdown-item @if(isset(request()->segments()[1]) && request()->segments()[1] =='users' && isset(request()->segments()[2]) && request()->segments()[2]=="administrator")active @endif" href="{{url('dashboard/users/administrator')}}"><span data-feather="more-horizontal"></span> Administrator</a></li>
                <li><a class="dropdown-item @if(isset(request()->segments()[1]) && request()->segments()[1] =='users' && isset(request()->segments()[2]) && request()->segments()[2]=="superadmin")active @endif" href="{{url('dashboard/users/superadmin')}}"><span data-feather="more-horizontal"></span> Superadmin</a></li>
                <li><a class="dropdown-item @if(isset(request()->segments()[1]) && request()->segments()[1] =='users' && isset(request()->segments()[2]) && request()->segments()[2]=="create")active @endif" href="{{url('dashboard/users/create/')}}"><span data-feather="plus"></span> Add User</a></li>

            </ul>
          </li>
          


          <li class="nav-item">
            <a class="nav-link @if(isset(request()->segments()[1]) && request()->segments()[1]=='expenditures') active @endif" href="javascript::void(0)">
              <span data-feather="trello"></span>
              <span class="nav-link-text">Expenses @if(isset(request()->segments()[1]) && request()->segments()[1]=='expenditures')<span data-feather="chevron-down"></span> @else<span data-feather="chevron-right"></span>@endif</span>
            </a>

            <ul class="menu-sub @if(isset(request()->segments()[1]) && request()->segments()[1]=='expenditures') show @endif">
              <li><a class="dropdown-item @if(isset(request()->segments()[1]) && request()->segments()[1] =='expenditures' && !isset(request()->segments()[2]))active @endif" href="{{url('dashboard/expenditures/')}}"><span data-feather="more-horizontal"></span> All Expenses</a></li>
              <li><a class="dropdown-item @if(isset(request()->segments()[1]) && request()->segments()[1] =='expenditures' && isset(request()->segments()[2]) && request()->segments()[2]=="create")active @endif" href="{{url('dashboard/expenditures/create/')}}"><span data-feather="plus"></span> Add Expense</a></li>
              
              <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Expense Categories</span>
              </h6>

              <li><a class="dropdown-item @if(isset(request()->segments()[1]) && request()->segments()[1] =='expenditures' && isset(request()->segments()[2]) && request()->segments()[2]=="categories" && !isset(request()->segments()[3]))active @endif" href="{{url('dashboard/expenditures/categories/')}}"><span data-feather="more-horizontal"></span> All Categories</a></li>
              <li><a class="dropdown-item" href="{{url('dashboard/expenditures/categories/create')}}"><span data-feather="plus"></span> Add Category</a></li>
            </ul>
          </li>

                    
          @if(Auth::user()->role == "superadmin" || Auth::user()->role == "manager" || Auth::user()->role == "administrator")
          <li class="nav-item">
            <a class="nav-link" href="{{url('dashboard/invoices/')}}">
              <span data-feather="shopping-cart"></span>
              <span class="nav-link-text">Invoices</span>
            </a>
          </li>
          @endif

          

          

          <li class="nav-item">
            <a class="nav-link" href="javascript::void(0)">
              <span data-feather="shield"></span>
              <span class="nav-link-text">Payments<span data-feather="chevron-right"></span></span>
            </a>

            <ul class="menu-sub">

              <li><a class="dropdown-item" href="{{url('dashboard/transactions/unpaid')}}"><span data-feather="more-horizontal"></span> Pending Payments</a></li>
              <li><a class="dropdown-item" href="{{url('dashboard/transactions/paid')}}"><span data-feather="more-horizontal"></span> Approved Payments</a></li>
              
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{url('settings')}}">
              <span data-feather="settings"></span>
              <span class="nav-link-text">Settings</span>
            </a>
          </li>
        </ul>

        <span class="nav-link-text">
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Saved reports</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        </span>

        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="{{url('dashboard/report/this-month')}}">
              <span data-feather="file-text"></span>
              <span class="nav-link-text">Current month</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('dashboard/report/last-month')}}">
              <span data-feather="file-text"></span>
              <span class="nav-link-text">Last Month</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('dashboard/report/this-year')}}">
              <span data-feather="file-text"></span>
              <span class="nav-link-text">This Year</span>
            </a>
          </li>
 
          <li class="nav-item">
            <a class="nav-link" href="{{url('dashboard/report/last-year')}}">
              <span data-feather="file-text"></span>
              <span class="nav-link-text">Last Year</span>
            </a>
          </li>
 
          <li class="nav-item">
            <a class="nav-link" href="{{url('dashboard/reports')}}">
              <span data-feather="file-text"></span>
              <span class="nav-link-text">All Reports</span>
            </a>
          </li>
 
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/')}}">
              <span data-feather="globe"></span>
              <span class="nav-link-text">Visit website</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>

    @yield('content')
    

</div>


</div>
<footer class="navbar-brand-color text-muted"> &copy; <span class="inihub">inihub</span> {{date('Y')}}</footer>

<script src="{{ url('assets/js/jquery.min.js')}}"></script>
<script src="{{ url('assets/js/bootstrap.min.js')}}"></script>

<script src="{{ url('assets/dashboard/feather.min.js')}}"></script>



<script src="{{ url('assets/dashboard/dashboard.js')}}"></script>
<script src="{{ url('assets/dashboard/scripts.js')}}"></script>



<script src="{!! asset('app-assets/js/scripts/extensions/sweetalert2.all.min.js') !!}"></script>



@if (Session::has('message'))
<script type="text/javascript">
     Swal.fire({
       type: "{{Session::get('message')['type']}}",
       title: '{{ucfirst(Session::get('message')['type'])}}!',
       html: '{{Session::get('message')['message']}}',
       timer: @if(Session::get('message')['type']=='success') 2000 @else 5000 @endif,
     })
 </script>
 @endif

@if (count($errors) >0 )
<script type="text/javascript">
     Swal.fire({
       type: "error",
       title: 'Error!',
       html: '@foreach($errors->all() as $error) {{ $error }}<br/> @endforeach',
       timerProgressBar: true,
     })
 </script>
@endif


 <script type="text/javascript">
$('.swal2-delete').on('click', function () {

 var delete_item = $(this).data('id');
 var current_url = $(this).data('url');
 Swal.fire({
   title: 'Are you sure?',
   text: "You won't be able to revert this!",
   type: 'warning',
   showCancelButton: true,
   confirmButtonColor: '#3085d6',
   cancelButtonColor: '#d33',
   confirmButtonText: 'Yes, delete it!',
   confirmButtonClass: 'btn btn-primary',
   cancelButtonClass: 'btn btn-danger ml-1',
   buttonsStyling: false,
 }).then(function (result) {
   if (result.value) {

     var url = current_url + '/destroy/' + delete_item;

    //  return alert(url);

     var token = $("meta[name='csrf-token']").attr("content");

$.ajax({
 url: url,
 type: 'DELETE', // Just delete Latter Capital Is Working Fine
 dataType: "JSON",
 data: {
     "id": delete_item,
     "_token": token,
 },
 success: function (data)
 {

     $.each(data, function(index, element) {
     Swal.fire({
       title: 'Deleting...',
       html: 'Your requested content will be deleted within <b></b> milliseconds.',
       timer: 3000,
       onBeforeOpen: () => {
         Swal.showLoading()
         timerInterval = setInterval(() => {
           const content = Swal.getContent()
           if (content) {
             const b = content.querySelector('b')
             if (b) {
               b.textContent = Swal.getTimerLeft()
             }
           }
         }, 100)
       },
       onClose: () => {
         clearInterval(timerInterval)
       }
     }).then((result) => {
       /* Read more about handling dismissals below */
       if (result.dismiss === Swal.DismissReason.timer) {
     
     if(element.message!='403 Access Denied!'){
     $('#tr-'+delete_item).remove();

     Swal.fire({
       type: "success",
       title: 'Deleted!',
       timer: 2000,
       html: 'Your requested content has been deleted successfully!',
       confirmButtonClass: 'btn btn-success',
     })
 }else{
     Swal.fire({
       type: "error",
       title: 'Not Authorized!',
       html: 'Sorry! You are not authorized to perform this action.',
       confirmButtonClass: 'btn btn-danger',
     })
 }

       }
     })

 });

 }

 });
   }
   else if (result.dismiss === Swal.DismissReason.cancel) {
     Swal.fire({
       title: 'Cancelled',
       timer: 2000,
       text: 'Your imaginary data is safe :)',
       type: 'error',
       confirmButtonClass: 'btn btn-success',
     })
   }
 })
});

$(document).ready(function () {
  $('.data-default-currency').html('$');
});
 </script>

@yield('js')
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
@csrf
</form>
</body>

</html>
