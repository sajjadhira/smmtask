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
						<img src="https://www.gravatar.com/avatar/{{md5(Auth::user()->email)}}?s=120" alt="..."><br/>
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
                            $purchased = \App\Orders::where('user',Auth::user()->id)->where('price','>',0)->get()->count()
							@endphp
						<div class="purchased-total"><span class="text-muted">Completed</span> {{$purchased}} {{__("Task")}}@if($purchased>1){{__("s")}}@endif</div>
						<div class="account-balance"><span class="text-muted">Points</span> {{number_format(Auth::user()->point)}}</div>
						@if(Auth::user()->signup_bonus == 0 && \App\Orders::where('user',Auth::user()->id)->where('price','>',0)->get()->count()<140)
						<div class="account-balance"><span class="text-muted"><i class="fa fa-lock"></i> SignUp Bonus</span> {{number_format(1000)}} Points</div>
						<p class="text-muted"><small>১০০ টাস্ক কমপ্লিট হওয়ার পর সাইন আপ বোনাস পয়েন্ট আপনার মূল একাউন্টে যোগ হয়ে যাবে</small></p>
						@elseif(Auth::user()->signup_bonus == 0 && \App\Orders::where('user',Auth::user()->id)->where('price','>',0)->get()->count()<145)
						<p class="text-success"><small>আপনি ১০০০ পয়েন্ট সাইন আপ বোনাস পেয়েছেন।</small></p>
						@else
						@endif
					</div>



				</div>

				
                <div class="row">

					{{-- <br/>
					@if(Auth::user()->payment_method == "" && Auth::user()->payment_account== "")
					<div class="alert alert-warning">
						Please update your payment method and get paid easily. <a href="{{url('payment-method')}}"><button class="btn btn-primary">Update Here</button></a>
					<br/>
					</div>
					@endif
 --}}


					<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 details">

						<h3>রেফার করুন এবং আর্ন করুন</h3>
						<p>

							আপনি আপনার পরিচিত বা অপরিচিত কাউকে আপনার লিংকের মাধ্যমে আমাদের সাইটে রেজিস্টার করানোকে রেফার বলে।<br/>
							আপনার রেফারকৃত ইউজার যা পয়েন্ট আর্ন করবে তার ৫% আপনাকে কমিশন প্রদান করা হবে।
							যেমন - আপনার রেফার করা ইউজার যদি ১০০০০০ পয়েন্ট আর্ন করে তাহলে ৫% হিসাবে ৫০০০ পয়েন্ট আপনি কমিশন পেয়ে যাবেন।<br/>

							আপনার রেফার লিংকঃ <b class="text-info">{{url('reffer/'.Auth::user()->id)}}/</b><br/>
							আপনার রেফার লিংকটি কপি করে অন্যকে শেয়ার করুন।
						</p>

						<h3></h3>
						<div class="card cart-details">
							<div class="card-header">
								Your reffer list ({{\App\Users::where('affiliate',Auth::user()->id)->get()->count()}})
							</div>
							<div class="card-body">

								<div class="text-center">
									
									@php
									$aff_comm = ((\App\Orders::where('affiliate',Auth::user()->id)->sum('price')/100)*5);
								@endphp
								You have earned total <b>{{round($aff_comm)}}</b> points from your all refferrs.

								</div>
								<hr/>

								<div class="row cart-item pt-1">
									<div class="col-2 typography title">
										SL.
										<br/>
									</div>
									<div class="col-4 typography title">
										Name
										<br/>
									</div>
									<div class="col-3 typography title">
										User ID
										<br/>
									</div>
		
									<div class="col-3 typography text-a-right float-end">
										Join Date
									</div>

								</div>

								<hr/>


						@foreach(\App\Users::where('affiliate',Auth::user()->id)->get() as $key=>$aff)

						<div class="row cart-item pt-1">
							<div class="col-2 typography title">
								{{$key+1}}.
								<br/>
							</div>
							<div class="col-4 typography title">
								<b>{{$aff->name}}</b>
								<br/>
							</div>
							<div class="col-3 typography title">
								 {{$aff->id}}
								<br/>
							</div>

							<div class="col-3 typography text-a-right float-end">
								{{date('d/m/Y',strtotime($aff->created_at))}}
							</div>

						</div>
						<hr/>

						@endforeach

							</div>
						</div>
							{{-- <p>Welcome to your Dashboard area. You will find everything about your account.
							You can download your items, add fund to your account, view transactions of your accoount, change account informations.
							You can manage your <span class="inihub">smmtask</span> account from here. 
							<br/>
							<br/>
							SMMTask helps you to increase Facebook Likes, Facebook Share, Facebook Followers, Facebook Post Likes, Facebook Post Share, Reddit Community Members, Reddit Post and Comments UpvotesYouTube Subscribe, YouTube Video Likes, YouTube Views, Twitter Followers, Twitter Tweets, Twitter reTweets, Twitter Favorites, Ask.fm Likes, VK Page Followers, VK Group Join, Instagram Followers, Instagram Photo Likes, Pinterest Followers, Pinterest rePins, Reverbnation Fans, SoundCloud Followers, SoundCloud Music Listening, Twitch Followers, TikTok Followers, TikTok Video Likes, TikTok Video Views, Likee Followers/Fans, Likee Video Likes, Telegram Channel, Group Members, Subscribers and WebSite Hits (autosurf). You can also earn moeny by doing small tasks.
							</p> --}}


					</div>

					
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

                </div>
            </div>
			
			<!-- Hero section END    -->
    
@endsection