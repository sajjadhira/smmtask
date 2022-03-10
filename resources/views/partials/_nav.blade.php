@include('partials._head')

<body>

<div class="header-main" id="header">
<div class="header-notice ">50% off for our new customer for boishakhi offer, buy now hurry! <button type="button" class="btn-close header-btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
<nav class="navbar navbar-expand-lg navbar-light margin-top-50">
  <div class="container">
	<a class="navbar-brand" href="{{url('/')}}"><img src="images/inihub.svg" class="d-inline-block align-text-top"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
   
		<li class="nav-item">
          <a aria-current="page" href="{{url('/')}}">Home</a>
        </li>
		
        <li class="nav-item dropdown">
          <a class="dropdown-toggle" href="#" id="productsNav" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Products
          </a>
          <ul class="dropdown-menu" aria-labelledby="productsNav">
              @foreach (\App\Categories::get() as $item)
              <li><a class="dropdown-item" href="{{url('category/'.$item->slug)}}">{{$item->name}}</a></li>
              @endforeach
            <li><a class="dropdown-item" href="#">WordPress Themes</a></li>
            <li><a class="dropdown-item" href="#">WordPress Plugins</a></li>
            <li><a class="dropdown-item" href="#">PSD Templates</a></li>
            <li><a class="dropdown-item" href="#">HTML Templates</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">I Need Custom Software</a></li>
          </ul>
        </li>		
        <li class="nav-item dropdown">
          <a class="dropdown-toggle" href="#" id="servicesNav" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Tools
          </a>
          <ul class="dropdown-menu" aria-labelledby="servicesNav">
            <li><a class="dropdown-item" href="#">Email Validation</a></li>
            <li><a class="dropdown-item" href="#">Email Extractor</a></li>
            <li><a class="dropdown-item" href="#">Email List Cleaner</a></li>
            <li><a class="dropdown-item" href="#">URL Shortner</a></li>
            <li><a class="dropdown-item" href="#">Random Image Resizer</a></li>
            <li><a class="dropdown-item" href="#">SMTP Tester</a></li>
            <li><a class="dropdown-item" href="#">Port Scaner</a></li>
            <li><a class="dropdown-item" href="#">Send SMS</a></li>
            <li><a class="dropdown-item" href="#">Send Promotional Email</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">I Need Custom Tool</a></li>
          </ul>
        </li>
		
		<li class="nav-item">
          <a aria-current="page" href="#">About</a>
        </li>	
		
		<li class="nav-item">
          <a aria-current="page" href="#">Contact</a>
        </li>	

  
      </ul>
      <ul class="d-flex nav navbar-nav navbar-right">
	  
	  	<li class="nav-item">
          <a aria-current="page" href="#"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
        </li>
		
	  	<li class="nav-item">
          <a aria-current="page" href="#"><i class="fa fa-user-plus" aria-hidden="true"></i> Register</a>
        </li>
		
		
	    <li class="nav-item dropdown">
          <a class="dropdown-toggle" href="#" id="userNav" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-user-o" aria-hidden="true"></i>  Sajjad Hossain
          </a>
          <ul class="dropdown-menu" aria-labelledby="userNav">
            <li><a class="dropdown-item" href="#">Dashboard</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><a class="dropdown-item" href="#">Download Items</a></li>
            <li><a class="dropdown-item" href="#">Add Fund</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Logout</a></li>
          </ul>
        </li>	
		
	  </ul>
    </div>
  </div>
</nav>
<!-- Main Navigation END    -->


</div>
<!-- Header END    -->