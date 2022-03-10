@extends('layouts.main')

@section('title'){{$data['product']->name}}@endsection

@section('css')
<link rel="stylesheet" href="{{url('assets/css/marketplace.css')}}">
@endsection

@section('content')

			
			<!-- content section -->
			
            <div class="container product">
				<h1>{{$data['product']->name}}</h1>
                <div class="row featured">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
		
						<div class="">
							<div class="featured-content">

								<h1 class="text-center">Task Details</h1>

								<h4 class="h4">Points Per Action: {{number_format($data['product']->price)}} Points</h4>
								<h4 class="h4">Category: {{\App\Categories::find($data['product']->category)->name}}</h4>
								<h4 class="h4">Subcategory: {{\App\Subcategories::find($data['product']->subcategory)->name}}</h4>
								<h4 class="h4">Duration: <span id="counter">{{$data['product']->duration}}</span><span id="totime" data-time="{{date('Y-m-d H:i:s')}}" class="d-none"></span> Seconds</h4>

			
							</div>


							<div class="item-description">
								@php
									echo nl2br($data['product']->description);
								@endphp
							</div>
						</div>

                    </div>


					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

						<div class="accordion" id="accordionExample">
							<div class="accordion-item">
							  <h2 class="accordion-header" id="headingOne">
								<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#individual" aria-expanded="true" aria-controls="RegularLicense">
								  
								</button>
							  </h2>
							  <div id="individual" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
								  <div class="accordion-body">
									<h3 class="text-center">Task Information</h3>
									  <ul class="license-specification">
										<li><i class="fa fa-tag"></i> {{\App\Categories::find($data['product']->category)->name}}</li>
										<li><i class="fa fa-tag"></i> {{\App\Subcategories::find($data['product']->subcategory)->name}}</li>
										<li><i class="fa fa-circle"></i> Reward {{number_format($data['product']->price)}} Points Per action</li>
										<li><i class="fa fa-check-circle"></i> Approved by <span class="inihub">SMMTask</span></li>
										<li><i class="fa fa-clock-o"></i> Duration {{$data['product']->duration}} seconds</li>
									</ul>


									<div class="purchase-area text-center">
										<a data-id="{{$data['product']->id}}" data-type="{{$data['product']->checkout_type}}" data-url="{{$data['product']->preview_url}}" data-duration="{{$data['product']->duration}}" data-action="cart" class="action" href="javascript::void(0)"><button class="btn btn-default btn-action btn-transform-primary">Complete Task ({{number_format($data['product']->price)}} Points)</button></a>
									</div>

									
								</div>
	
							  </div>
							</div>
						  </div>

						  @if($data['product']->sales>1)
						  <div class="total-sales text-center">
							 <i class="fa fa-cart-arrow-down"></i> {{number_format($data['product']->sales)}} {{_("Complted")}}@if($data['product']->sales>1){{_("s")}}@endif
						  </div>
						  @endif

						  @if($data['average_ratings']>0)
						  <div class="total-rating text-center">
							  @php
								  $remain = 5 - $data['average_ratings'];
							  @endphp
							 Item Rating: 
							 @for($i=1;$i<=$data['average_ratings'];$i++)
							 <i class="fa fa-star"></i> 
							 @endfor
							
							@php
							 echo str_repeat('<i class="fa fa-star-o"></i>',$remain);
						 	@endphp
							 

							 <br>
							 <small class="text-muted">{{$data['average_ratings']}} average based on {{$data['total_ratings_row']}} ratings.</small>
						  </div>
						  @endif

					</div>

                </div>
            </div>
			
			<!-- content section END    -->

@endsection

@section('js')
<script type="text/javascript">
	var base_url = "{{url('/')}}";
	$(document).ready(function () {
            

	});
</script>
<script src="{{ url('assets/js/marketplace.js')}}"></script>
@endsection