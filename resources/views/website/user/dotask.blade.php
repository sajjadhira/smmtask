@extends('layouts.main')

@section('title')Do Social Media Task and Earn Money| SMMTask @endsection

@section('hero')


@guest
	

<!-- Hero section -->

<div class="container hero">
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 offset-lg-2 offset-md-2">
			<h1>We will help you grow your social presence. <span class="brand-color">Youtube</span>, <span class="brand-color">Facebook</span> . <span class="brand-color">Tiktok</span> &amp; <span class="brand-color">etc</span>.</h1>
			<div id="tagline">
				<p class="t1">SMMTask helps you to increase Facebook Likes, Facebook Share, Facebook Followers, Facebook Post Likes, Facebook Post Share, Reddit Community Members, Reddit Post and Comments UpvotesYouTube Subscribe, YouTube Video Likes, YouTube Views, Twitter Followers, Twitter Tweets, Twitter reTweets, Twitter Favorites, Ask.fm Likes, VK Page Followers, VK Group Join, Instagram Followers, Instagram Photo Likes, Pinterest Followers, Pinterest rePins, Reverbnation Fans, SoundCloud Followers, SoundCloud Music Listening, Twitch Followers, TikTok Followers, TikTok Video Likes, TikTok Video Views, Likee Followers/Fans, Likee Video Likes, Telegram Channel, Group Members, Subscribers and WebSite Hits (autosurf).
					You can also earn moeny by doing small tasks.
				</p>
			</div>
			
			<div class="text-center">
				<a href="{{url('login')}}"><button class="btn btn-default btn-action btn-transform-primary" type="button">Start Earning Money</button></a>
			</div>
		</div>
		
	</div>
</div>

<!-- Hero section END    -->
@endguest

@endsection			

@section('content')


<div class="software">
	<section class="container" id="software">
		<div class="container-fluid">
			<h2 class="section-title mb-2 h1"><span class="brand-color">Available</span> Task</h2>
	
	<div class="row text-center">
	


		
	
		<div class="col-xs-12 col-sm-12 col-md-12">            
	
			@guest

			<div class="alert alert-info">No available task for guest user. Plese login for do some task and earn money.</div>
			
			@else			   
			   
		   
			   <div class="item-specification">

					@if($data['task_count'] >0)
				   
				   <div class="item-name" id="name">{{$data['task']->name}}</a></div>
				   @php
				   	$token_meta = $data['task']->name . $data['task']->id . $data['task']->preview_url . $data['task']->created_at;
				   	$task_hash = md5($token_meta);
				   @endphp
				   <span id="task_hash" class="d-none" data-token="{{$task_hash}}"></span>

				   <div class="row">
				   <div class="item-price col-md-12">
					   <span class="fa fa-tag"></span> <span  id="product_type">{{$data['task']->product_type}}</span><br/>
					   <span class="text-success">Reward <span  id="reward">{{number_format($data['task']->price)}}</span> Points</span><br/>
					   <span class="text-success">Time <span id="counter">{{$data['task']->duration}}</span> seconds<span id="origin_time" data-time="{{$data['task']->duration}}" class="d-none"></span></span><br/>
					   <br/>
					   <div id="message"></div>
					  <button class="btn btn-primary btn-lg action" data-id="{{$data['task']->id}}" data-type="{{$data['task']->checkout_type}}" data-url="{{url('/')}}" data-duration="{{$data['task']->duration}}" data-action="cart" >Do Task</button>
					  <button class="btn btn-warning btn-lg" id="next-task">Next Task</button>
			


				   </div>
			   </div>

			   @else
			   <div class="alert alert-info">No available task for you right now, please try later.</div>
			   @endif
			   
			   @if($data['err_message'] != "")
			   @php echo $data['err_message']; @endphp
			   @endif
		   </div>


		   @endguest

		   </div>
		   

		
	
	</div>
	
	
		</div>	
	</section>
</div>

<!-- /Software section -->	

@endsection


@section('js')
	@guest
		
	@else
	<script src="{{ url('assets/js/marketplace.js?t='.time())}}"></script>
	@endguest
@endsection