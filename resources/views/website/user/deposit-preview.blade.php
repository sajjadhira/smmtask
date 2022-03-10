@extends('layouts.main')

@section('title'){{__("Deposit Preview")}}@endsection

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
						<div class="account-balance"><span class="text-muted">Balance</span> <span class="data-default-currency"></span>{{number_format(Auth::user()->balance)}} USD</div>
                        @php
                            $purchased = \App\Orders::where('user',Auth::user()->id)->get()->count()
                        @endphp
						<div class="purchased-total"><span class="text-muted">Purchased</span> {{$purchased}} {{__("Item")}}@if($purchased>1){{__("s")}}@endif</div>
					</div>
				</div>

				
                <div class="row">


					<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 details">

                        @php
                            $deposit = session()->get('deposit');
                        @endphp
   
                        <!-- Step 1 -->
                        <h3 class="text-center"> Deposit Preview</h3>
                        <br/>
                        <br/>
                        <br/>
                        <fieldset>
    
                            <div class="row deposit-panel text-center">
    
                                <div class="col-md-6 preview-pane">
                                    Type of Payment:
                                </div>
                                <div class="col-md-6 text-a-left preview-pane">
                                    <strong>{{ucfirst($deposit["type"])}}</strong>
                                </div>
    
    
                                <div class="col-md-6 preview-pane">
                                    From Acoount Number:
                                </div>
                                <div class="col-md-6 text-a-left preview-pane">
                                    <strong>{{ucfirst($deposit["from_number"])}}</strong>
                                </div>
    
                                <div class="col-md-6 preview-pane">
                                    Amount:
                                </div>
                                <div class="col-md-6 text-a-left preview-pane">
                                    <strong><span class="data-default-currency"></span>{{ucfirst($deposit["amount"])}}</strong>
                                </div>
    
                                <div class="col-md-6 preview-pane">
                                    Points:
                                </div>
                                <div class="col-md-6 text-a-left preview-pane">
                                    <strong>{{ucfirst($deposit["points"])}}</strong>
                                </div>

                                <div class="col-md-6 offset-md-3 text-center preview-pane">
                                    <div class="form-group">
                                        <a href="{{url('deposit-confirm')}}"><button type="button" class="btn btn-transform-primary">Confirm Deposit Now</button></a>
                                    </div>
                                    </div>
    
    
                            </div>
    
                        </fieldset>
                          


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