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
			<h2 class="section-title mb-1 h1"><span class="brand-color">Available</span> Task</h2>
	
	<div class="row text-center">
	


		
	
		<div class="col-xs-12 col-sm-12 col-md-12">            
	
			@guest

			<div class="alert alert-info">আপনার জন্য এই মুহুর্তে কোন টাস্ক এভেইলেবল নেই, টাস্ক পেতে লগিন করুন।</div>
			
			@else			   
			   
			@php

			$set = \App\Settings::where('name','notice')->get();
			$notype = \App\Settings::where('name','notice_type')->get();

			@endphp

			@if($set[0]->value !="")
			<div class="col-xl-12 col-md-12 pt-2 pb-2">
				<div class="alert alert-{{$notype[0]->value}}">
				@php echo nl2br($set[0]->value); @endphp
				</div>
			</div>
			@endif

			   <div class="item-specification">

					@if($data['task_count'] >0)
				   <div class="h3 text-center">{{trim(str_replace('Task','',$data['task']->product_type))}} Task</div>
				   <div class="item-name" id="name">Task ID {{$data['task']->id}} # {{$data['task']->name}}</a></div>
				   @php
				   	$token_meta = $data['task']->name . $data['task']->id . $data['task']->preview_url . $data['task']->created_at . Auth::user()->id;
				   	$task_hash = md5($token_meta);
					Session::put('hash', $task_hash);
				   @endphp
				   <span id="task_hash" class="d-none" data-token="{{$task_hash}}"></span>

				   <div class="row">
				   <div class="item-price col-md-12">
						
					   <span class="text-success">Reward Point: <span  id="reward">@if($data['task']->product_type == 'Youtube Subscribe'){{__("100")}}@else{{number_format($data['task']->price)}}@endif</span> Points</span><br/>
					   @if($data['task']->product_type != 'Website' && $data['task']->product_type != 'Do VPN Website Task')
					   <span class="text-success">Duration Time: <span id="counter">{{$data['task']->duration}}</span> seconds<span id="origin_time" data-time="{{$data['task']->duration}}" class="d-none"></span> / {{gmdate("H:i:s", $data['task']->duration)}}</span><br/>
					   @endif
					   <br/>
					   <div id="message"></div>
					  <button class="btn btn-primary btn-lg action" data-id="{{$data['task']->id}}" data-type="{{$data['task']->product_type}}" data-url="{{url('/')}}" data-duration="{{$data['task']->duration}}" data-action="cart" >Do Task</button>
					  <a href="{{url('task/skip/'.$data['task']->id)}}" onclick="return confirm('Do you wanna skip the task?')"><button class="btn btn-warning btn-lg" >Skip Task</button></a>

					  @if($data['task']->product_type == 'Youtube Subscribe')
					  <div class="text-center mt-5">
						<img src="{{url('images/subscribe.gif')}}" class="img-fluid">
					  </div>
					  @endif


					  <div class="alert alert-info mt-5">
						@if($data['task']->product_type == 'Youtube Subscribe')
						আপনার পাওয়া বর্তমান টাস্কটি <b>ইউটিউব চ্যানেল সাবস্ক্রাইব টাস্ক</b> এ টাস্কটি কমপ্লিট করতে Do Task এ ক্লিক করার পর যে ভিডিও ওপেন হবে তা কমপক্ষে {{gmdate("i:s", $data['task']->duration)}} মিনিট দেখার পর চ্যানেলের সাবস্ক্রাইব বাটনে ক্লিক করে ৪/৫ সেকেন্ড অপেক্ষা করে এই পেইজে ফিরে আসুন।
						@elseif($data['task']->product_type == 'Youtube Video')
						আপনার পাওয়া বর্তমান টাস্কটি <b>ইউটিউব ভিডিও ভিউ টাস্ক</b> এ টাস্কটি কমপ্লিট করতে Do Task এ ক্লিক করার পর যে ভিডিও ওপেন হবে তা  কমপক্ষে {{gmdate("i:s", $data['task']->duration)}} মিনিট দেখার পর এই পেইজে ফিরে আসুন।
						@elseif($data['task']->product_type == 'Facebook Video')
						আপনার পাওয়া বর্তমান টাস্কটি <b>ফেসবুক ভিডিও ভিউ টাস্ক</b> এ টাস্কটি কমপ্লিট করতে Do Task এ ক্লিক করার পর, ফেসবুক এপে ওপেন করুন। যে ভিডিও ওপেন হবে তা {{gmdate("i:s", $data['task']->duration)}} মিনিট দেখার পর আরো ১০ সেকেন্ড অপেক্ষা করে এই পেইজে ফিরে আসুন।
						@elseif($data['task']->product_type == 'Do VPN Task')
						আপনার পাওয়া বর্তমান টাস্কটি <b>ভিপিএন টাস্ক</b> এ টাস্কটি কমপ্লিট করতে Do Task এ ক্লিক করার পর, ফেসবুক এপে ওপেন করুন। যে ভিডিও ওপেন হবে তা {{gmdate("i:s", $data['task']->duration)}} মিনিট দেখার পর আরো ১০ সেকেন্ড অপেক্ষা করে এই পেইজে ফিরে আসুন।
						@endif
					  </div>


			


				   </div>
			   </div>

			   @else
			   @if($data['type'] == 'Do VPN Task' || $data['type'] == 'Do VPN Website Task' || $data['type'] == 'Youtube VPN Chrome')
			   <div class="alert alert-warning mt-5">
			   আপনার পাওয়া বর্তমান টাস্কটি <b>ভিপিএন টাস্ক</b> টাস্ক পেতে অবশ্যই কোন ভিপিএন কানেক্ট করে USA অথবা CANADA কান্ট্রি/দেশ সিলেক্ট করতে হবে, কেবলমাত্র তখনই আপনি টাস্ক পাবেন।
			   </div>
			   @endif
			   
			   <div class="alert alert-info">আপনার জন্য এই মুহুর্তে কোন টাস্ক এভেইলেবল নেই, টাস্ক আসা পর্যন্ত অপেক্ষা করুন এবং এই পেইজ ভিজিট করতে থাকুন।</div>
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