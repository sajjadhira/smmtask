@extends('layouts.main')

@section('title'){{__("My Account")}}@endsection

@section('css')
<link rel="stylesheet" href="{{url('assets/css/marketplace.css')}}">
@endsection

@section('content')

			
			<!-- Hero section -->
			
            <div class="container my-account">

				<div class="row nameplate">
					<div class="col-6">
						<div class="name">
                        @if (file_exists('public/images/users/'.Auth::user()->image))
                        <img src="{{url('public/images/users/'.Auth::user()->image)}}" alt="{{Auth::user()->name}}"><br/>
                        @else
						<img src="http://www.gravatar.com/avatar/{{md5(Auth::user()->email)}}?s=120" alt="..."><br/>
						{{Auth::user()->name}}
                        @endif
						</div>

						<div class="joined">
							<span class="text-muted">Member since {{date("jS F Y",strtotime(Auth::user()->created_at))}}</span>
						</div>
					</div>
					<div class="col-6 text-a-right wallet-information">
						<div class="account-balance"><span class="text-muted">Balance</span> <span class="data-default-currency"></span>{{(Auth::user()->balance)}} BDT</div>
                        @php
                            $purchased = \App\Orders::where('user',Auth::user()->id)->get()->count()
							@endphp
						<div class="purchased-total"><span class="text-muted">Completed</span> {{$purchased}} {{__("Task")}}@if($purchased>1){{__("s")}}@endif</div>
						<div class="account-balance"><span class="text-muted">Points</span> {{number_format(Auth::user()->point)}}</div>
					</div>



				</div>

				
                <div class="row">

					<br/>
					@if(Auth::user()->payment_method == "" && Auth::user()->payment_account== "")
					<div class="alert alert-warning">
						Please update your payment method and get paid easily. <a href="{{url('payment-method')}}"><button class="btn btn-primary">Update Here</button></a>
					<br/>
					</div>
					@endif

                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">


						<div class="card ">
							<div class="card-header">
								Dashboard
							</div>
							<div class="card-body">

                                @include('website.user.menu')


							</div>
						  </div>
		
                    </div>


					<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 details">

							<p>Welcome to your Dashboard area. You will find everything about your account.
							You can download your items, add fund to your account, view transactions of your accoount, change account informations.
							You can manage your <span class="inihub">smmtask</span> account from here. 
							<br/>
							<br/>
							SMMTask helps you to increase Facebook Likes, Facebook Share, Facebook Followers, Facebook Post Likes, Facebook Post Share, Reddit Community Members, Reddit Post and Comments UpvotesYouTube Subscribe, YouTube Video Likes, YouTube Views, Twitter Followers, Twitter Tweets, Twitter reTweets, Twitter Favorites, Ask.fm Likes, VK Page Followers, VK Group Join, Instagram Followers, Instagram Photo Likes, Pinterest Followers, Pinterest rePins, Reverbnation Fans, SoundCloud Followers, SoundCloud Music Listening, Twitch Followers, TikTok Followers, TikTok Video Likes, TikTok Video Views, Likee Followers/Fans, Likee Video Likes, Telegram Channel, Group Members, Subscribers and WebSite Hits (autosurf). You can also earn moeny by doing small tasks.
						</p>


					</div>

                </div>
            </div>
			
			<!-- Hero section END    -->
    
@endsection