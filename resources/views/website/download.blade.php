@extends('layouts.main')

@section('title'){{_("Download Items")}}@endsection

@section('css')
<link rel="stylesheet" href="{{url('assets/css/marketplace.css')}}">
@endsection

@section('content')


			<!-- section -->
			
            <div class="container product">
				<h1 class="text-center">Your task list</h1>
                <div class="row featured">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


						<div class="card cart-details">
							<div class="card-header">
								Your completed tasks</span>
							</div>
							<div class="card-body">

                                @foreach ($data['orders'] as $item)

                                @php
                                    $product = \App\Products::find($item->product);
                                @endphp
                                    

								<div class="row cart-item">
									<div class="col-7 typography title">
										{{$product->name}}
										<br/>
									</div>

									<div class="col-5 typography text-a-right float-end">
										{{number_format($product->price)}} Points Rewarded
									</div>

								</div>
                                @endforeach		

								<div class="row cart-item text-center">
                                    {{$data['orders']->links()}}
								</div>


						  </div>
		
                    </div>
                </div>
            </div>

			</div>
			
			<!-- section END    -->


@endsection