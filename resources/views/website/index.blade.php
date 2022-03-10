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
			<h2 class="section-title mb-2 h1"><span class="brand-color">Available</span> Task ({{$data['task_count']}})</h2>
	
	<div class="row text-center">
	


		
	
		<div class="col-xs-12 col-sm-12 col-md-12">            
	
			@guest

			<div class="alert alert-info">No available task for guest user. Plese login for do some task and earn money.</div>
			
			@else			   
			
			<div class="text-center">
				<a href="{{url('dotasks')}}" onclick="return confirm('Are you sure your are using google chrome over android devoice?');">
					<button class="btn btn-primary">Start Earning Money by Doing Task</button>
				</a>
			</div>

		   @endguest

		   @php
			   if(!is_null($data['err_message'])){
				   echo $data['err_message'];
			   }
		   @endphp

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
	<script src="{{ url('assets/js/marketplace.js')}}"></script>
	@endguest
@endsection