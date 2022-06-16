@extends('layouts.main')

@section('title'){{__("Converting Point")}}@endsection

@section('css')
<link rel="stylesheet" href="{{url('assets/css/marketplace.css')}}">
@endsection

@section('content')


			<!-- section -->
			
            <div class="container my-account">
								
                <div class="row ">



					<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 details">


                        <form action="{{ url('user/convert/point/submit') }}"  class="steps-validation wizard-circle" id="form" method="POST" enctype="multipart/form-data">
                        
                         @method('PATCH')
    

                        <!-- Step 1 -->
                        <h4 class="text-center"> Converting Point</h4>
                        <fieldset>
    
                            <div class="row">
    
                                <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Available Points</label>
                                    <input name="points" id="points" class="form-control" value="{{Auth::user()->point}}" readonly="true" required>
                                </div>
                                </div>
                                
                                @php
                                    $taka = Auth::user()->point/100;

                                    $netFee = ($taka/100)*5;

                                    $newTaka = $taka - $netFee;

                                    $newBalance = Auth::user()->balance +  $newTaka;

                
                                @endphp
                                <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Taka &#2547;</label>
                                    <input name="taka" id="taka" class="form-control" value="{{$taka}}" readonly="true" required>
                                </div>
                                </div>

                                <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Network Fee 5%</label>
                                    <input name="netfee" id="netfee" class="form-control" value="{{$netFee}}" readonly="true" required>
                                </div>
                                </div>
    

                                <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Remaining Amount &#2547;</label>
                                    <input name="newamount" id="newamount" class="form-control" value="{{$newBalance}}" readonly="true" required>
                                </div>
                                </div>
    

                                <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">New Balance &#2547;</label>
                                    <input name="newbalance" id="newbalance" class="form-control" value="{{$newBalance}}" max="{{$newBalance}}" readonly required>
                                </div>
                                </div>
    


                                <div class="col-md-12">
                                    <br/>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-transform-primary">Convert</button>
                                    </div>
                                    </div>
    
    
                            </div>
    
                        </fieldset>
                          
                            @csrf
                        </form>


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
			
			<!-- section END    -->
            </div>


@endsection
