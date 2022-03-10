@extends('layouts.main')

@section('title')Cart @endsection

@section('css')
<link rel="stylesheet" href="{{url('assets/css/marketplace.css')}}">
@endsection

@section('content')

			
			<!-- section -->
			
            <div class="container product">
				<h1 class="text-center">Shopping Cart</h1>
                <div class="row featured">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


						<div class="card cart-details">


                            @if(session('cart'))

							<div class="card-header">
								You have currently <b>{{count(session('cart'))}}</b> {{_("item")}}@if(count(session('cart'))>1){{_("s")}}@endif in your cart</span>
							</div>
							<div class="card-body">

                                @php
                                    $total_cart = 0;
                                @endphp

                                @foreach(session('cart') as $id => $details)

                                @php
                                    $product = \App\Products::find($id);
                                    $license = $details['license'];
                                    $total_cart+=$product->$license;
                                @endphp
								<div class="row cart-item">
									<div class="col-3 typography">
										<img class="img-fluid" src="{{url('images/uploads/'.$product->thumbnail)}}" alt="{{$product->name}}">
									</div>
									<div class="col-6 typography title">
										<a target="_blank" href="{{url('product/'.make_slug($product->name,'-').'/'.$product->id)}}">{{$product->name}}</a>
										<br/>
										<span class="text-muted licenseing-tag">License: {{license_name($license)}}</span>
									</div>

									<div class="col-3 typography text-a-right"><span class="data-default-currency"></span>{{$product->$license}} <a href="{{url("cart/remove/".$id)}}" class="text-danger"><i class="fa fa-trash-o"></i></a></div>

								</div>
                                @endforeach

								<div class="row cart-item">
									<div class="col-3 typography">
										<!-- <img src="./assets/img/item.jpg" alt="..."> -->
									</div>
									<div class="col-6 typography title text-a-right">
										Total Amount
									</div>

									<div class="col-3 typography text-a-right"><span class="data-default-currency"></span>{{number_format($total_cart,2)}}</div>

								</div>

								<div class="row cart-item @if(Auth::user()->balance>$total_cart){{_("text-success")}}@else{{_("text-danger")}}@endif">
									<div class="col-3 typography">
										<!-- <img src="./assets/img/item.jpg" alt="..."> -->
									</div>
									<div class="col-6 typography title text-a-right">
										Your Balance
									</div>

									<div class="col-3 typography text-a-right"><span class="data-default-currency"></span>{{Auth::user()->balance}}</div>

								</div>

                                @if($total_cart>Auth::user()->balance)
								<div class="row cart-item">
									<div class="col-3 typography">
										<!-- <img src="./assets/img/item.jpg" alt="..."> -->
									</div>
									<div class="col-9 typography title text-a-right text-info">
										*You don not have enought balance to make this payment, please add balance.
									</div>

								</div>
                                @endif

								<div class="row cart-item">
									<div class="col-3 typography">
										<a href="{{url('cart/empty')}}"><button class="btn btn-secondary" id="clear" type="button">Clear</button></a>
									</div>
									<div class="col-5 typography text-center">
										<!-- If you have any cupon <a href="#" id="show-cuponbox"><u>Click Here</u></a> -->
									</div>

									<div class="col-4 typography text-a-right">
                                        @guest
										<a href="{{url('login')}}"><button class="btn btn-default btn-action btn-transform-primary">Login</button></a>
										<!-- <a data-id="1" data-license="regular" data-price="49" data-action="cart" class="action" href="checkout.html"><button class="btn btn-default btn-action btn-transform-primary">Checkout</button></a> -->
                                        @else
                                        @if($total_cart>Auth::user()->balance)
										<a href="{{url('deposit')}}"><button class="btn btn-default btn-action btn-transform-primary">Add Balance</button></a>
                                        @else
                                        <a href="{{url('place-order')}}"><button class="btn btn-default btn-action btn-transform-primary">Checkout</button></a>
                                        @endif

                                        @endguest
									</div>

								</div>


							</div>

                            @endif
						  </div>
		
                    </div>


					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">



					</div>

                </div>
            </div>
			
			<!-- section END    -->

@endsection