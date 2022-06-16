@extends('layouts.main')

@section('title'){{__("Completed Tasks")}}@endsection

@section('css')
<link rel="stylesheet" href="{{url('assets/css/marketplace.css')}}">
@endsection

@section('content')


			<!-- section -->
			
            <div class="container product">
				<h1 class="text-center">Your task list</h1>
                <div class="row featured">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">


						<div class="card cart-details">
							<div class="card-header">
								Your completed tasks
							</div>
							<div class="card-body">

                                @foreach ($data['orders'] as $item)

                                @php
                                    $product_info = \App\Products::where('id',$item->product)->get();

									
									if($product_info->count()>0){
										$product = $product_info[0];
									}

									@endphp
                                    
									
									@if($product_info->count()>0)
								<div class="row cart-item">
									<div class="col-7 typography title">
										{{$product->name}}
										<br/>
									</div>

									<div class="col-5 typography text-a-right float-end">
										{{number_format($product->price)}} Points Rewarded
									</div>

								</div>

								@endif

                                @endforeach		

								<div class="row cart-item text-center">
                                    {{$data['orders']->links()}}
								</div>


						  </div>
		
                    </div>
                </div>

				
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 my-account">


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
			
			<!-- section END    -->


@endsection