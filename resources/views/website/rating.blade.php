@extends('layouts.main')

@section('title'){{_("Giving Rating")}}@endsection

@section('css')
<link rel="stylesheet" href="{{url('assets/css/marketplace.css')}}">
@endsection

@section('content')


			<!-- section -->
			
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


                        <form action="{{ url('item/rating/submit/'.$order->id) }}"  class="steps-validation wizard-circle" id="form" method="POST" enctype="multipart/form-data">
                        
                         @method('PATCH')
    

                        <!-- Step 1 -->
                        <h4 class="text-center"> Giving rating to {{$product->name}}</h4>
                        <fieldset>
    
                            <div class="row">
    
                                <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Purchase ID</label>
                                    <input name="id" id="id" class="form-control" value="{{$order->id}}" readonly="true" required>
                                </div>
                                </div>
    

								<br/>
								<br/>
								<br/>
								<h4>Your Rating*</h4>
								<br/>
								@for ($i = 5; $i >0; $i--)
									
                                <div class="col-md-12">
									<div class="form-group">
										<input tabindex="15" type="radio" name="rating" value="{{$i}}" @if($i==5) checked @endif>
										@php
											echo '<label for="rating['.$i.']">' .str_repeat('<i class="fa fa-star"></i>',$i) .'</label>';
										@endphp
										
									</div>
                                </div>
								
								@endfor


								<br/>
								<br/>
								
                                <div class="col-md-12">
									<div class="form-group">
										<label for="name">Comment</label>
										<textarea name="comment" id="comment" class="form-control" placeholder="Write your valuable comment if you have..."></textarea>
									</div>
									</div>
    
                                <div class="col-md-12">
                                <div class="form-group">
                                    <div class="checkbox mb-3">
                                        <label class="">
                                            <input type="checkbox" class="" name="agree" id="agree" required> I agree that the rating is giving to <span class="inihub">inihub</span> purchase is honest.
                                        </label>
                                      </div>
                                </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-transform-primary">Give Rating</button>
                                    </div>
                                    </div>
    
    
                            </div>
    
                        </fieldset>
                          
                            @csrf
                        </form>


					</div>

                </div>
			
			<!-- section END    -->


@endsection
