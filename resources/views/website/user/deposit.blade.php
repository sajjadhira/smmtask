@extends('layouts.main')

@section('title'){{__("Deposit Balance")}}@endsection

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


                        <form action="{{ url('deposit-submit') }}"  class="steps-validation wizard-circle" id="form" method="POST" enctype="multipart/form-data">
                            @method('PATCH')
    
    
                            
                              
                        <!-- Step 1 -->
                        <h3 class="text-center"> Deposit Balance</h3>
                        <fieldset>

                            <p class="text-center">
                                Make a <span class="text-danger">"Send Money"</span> to <span class="text-success">01714692560</span> (bKash &amp; Nagad Personal Number) and provide amount, from which number you sent the amount.
                            </p>
    
                            <div class="row">
    
                                <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Type of Payment</label>
                                    
                                    @php
                                        $types = ['bkash','nagad'];
                                    @endphp
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="">Select Type</option>
                                        @foreach ($types as $item)
                                            <option value="{{$item}}">{{ucfirst($item)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                </div>



                                <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">From Acoount Number</label>
                                    <input class="form-control required" id="from_number" type="text" name="from_number" required="" minlength="11" maxlength="12" placeholder="01XXXXXXXXX">
                                </div>
                                </div>

                                <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Amount (BDT)</label>
                                    <input class="form-control required" id="amount" type="number" name="amount" required="" min="100" placeholder="Amount 100-50000">
                                </div>
                                </div>

                                <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Points will deposit to account</label>
                                    <input class="form-control required" id="points" type="number" name="points" required="" readonly>
                                </div>
                                </div>
    
                                <div class="col-md-12">
                                <div class="form-group">
                                    <div class="checkbox mb-3">
                                        <label class="text-danger">
                                            <input type="checkbox" class="" name="agree" id="agree" required> I am sure I have made sendmoney, and I agree with multiple false request can ban my account permanently from authority.
                                        </label>
                                      </div>
                                </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-transform-primary">Preview Deposit Request</button>
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
            </div>
			
			<!-- Hero section END    -->
    
@endsection

@section('js')

<script type="text/javascript">
    $(document).ready(function(){

        $("#amount").on('keyup', function(){
                const val = $(this).val();
                const points = val * 100;
                $('#points').val(points);
        });

    });
</script>
    
@endsection