@include('partials._head')

<body>

<div class="header-main @yield('headerclass')" id="header">
{{-- <div class="header-notice ">This month payment is ready, You will be paid soon! <button type="button" class="btn-close header-btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div> --}}
<nav class="navbar navbar-expand-lg navbar-light margin-top-50">
  <div class="container">
	<a class="navbar-brand" href="{{url('/')}}"><img src="{{ url('images/inihub.svg')}}" class="d-inline-block align-text-top"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
   
		<li class="nav-item">
          <a aria-current="page" href="{{url('/')}}">Home</a>
        </li>
		
        {{-- <li class="nav-item dropdown">
          <a class="dropdown-toggle" href="#" id="productsNav" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Tasks
          </a>
          <ul class="dropdown-menu" aria-labelledby="productsNav">
            @foreach (\App\Categories::get() as $item)
            <li><a class="dropdown-item" href="{{url('category/'.$item->slug)}}">{{$item->name}}</a></li>
            @endforeach
          </ul>
        </li>		 --}}
		<li class="nav-item">
          <a aria-current="page" href="#">About</a>
        </li>	
		
		<li class="nav-item">
          <a aria-current="page" href="#">Contact</a>
    </li>	
		@if(session('cart'))
		<li class="nav-item">
          <a aria-current="page" href="{{url('cart')}}">Cart <span class="badge bg-primary">{{count(session('cart'))}}</span></a>
    </li>	
    @endif

  
      </ul>
      <ul class="d-flex nav navbar-nav navbar-right">
        
	  
        @guest
        
        <li class="nav-item">
            <a aria-current="page" href="{{url('login')}}"><span data-feather="log-in"></span> Login</a>
          </li>
          
            <li class="nav-item">
            <a aria-current="page" href="{{url('register')}}"><span data-feather="log-in"></span> Register</a>
          </li>
  
          
        @else

		
	    <li class="nav-item dropdown">
          <a class="dropdown-toggle" href="#" id="userNav" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-user-o" aria-hidden="true"></i>  {{Auth::user()->name}}
          </a>
          <ul class="dropdown-menu" aria-labelledby="userNav">
            @if (Auth::user()->role=="superadmin")
            <li><a class="dropdown-item" href="{{url('dashboard')}}">Dashboard</a></li>
            @endif
            <li><a class="dropdown-item" href="{{url('my-account')}}">Profile</a></li>
            <li><a class="dropdown-item" href="{{url('downloads')}}">Completed Tasks</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">Logout</a></li>
          </ul>
        </li>	

        @endguest
		
	  </ul>
    </div>
  </div>
</nav>
<!-- Main Navigation END    -->


@yield('hero')

</div>
<!-- Header END    -->