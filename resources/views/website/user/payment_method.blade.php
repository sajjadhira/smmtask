@extends('layouts.main')

@section('title'){{__("Update Payment Method")}}@endsection

@section('css')
<link rel="stylesheet" href="{{url('assets/css/marketplace.css')}}">
@endsection

@section('content')

			
			<!-- Hero section -->
			
            <div class="container my-account">

				
                <div class="row">
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
    
                            
                              
                        <!-- Step 1 -->
                        <h3 class="text-center">Payment Method</h3>



                        <fieldset>
    
                            <div class="row">

                                <form method="POST" action="{{ url('payment-method/update') }}" class="form-horizontal auth-form">
                                    @method('PATCH')

                                    <div class="form-group">
                                        <input name="account" type="text" placeholder="Mobile Number" id="account" class="form-control" value="{{Auth::user()->payment_account}}" required autocomplete="off" autofocus>
                                    </div>

                                    <div class="form-group">
                                        <br/>
                                        <select name="method" id="method" class="form-control" required>
                                            @php
                                                $methods = ['recharge' => 'Mobile Recharge', 'bkash' => 'bKash'];
                                                $methods = ['recharge' => 'Mobile Recharge'];
                                            @endphp

                                                <option value="">Select Method</option>
                                            @foreach ($methods as $key=>$item)
                                                <option value="{{$key}}" @if($key==Auth::user()->payment_method) selected @endif>{{$item}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <br/>
                        
                                    <div class="form-button">
                                        <button class="btn btn-primary btn-transform-primary" type="submit">Save</button>
                                    </div>
                         
                        
                                    @csrf
                                </form>


    
                            </div>
    
                        </fieldset>
           


					</div>

                </div>
            </div>
			
			<!-- Hero section END    -->
    
@endsection