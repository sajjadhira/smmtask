@extends('layouts.main')

@section('title'){{__("Withdraw Amount")}}@endsection

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
						<div class="purchased-total"><span class="text-muted">Completed Task </span> {{$purchased}} {{__("Item")}}@if($purchased>1){{__("s")}}@endif</div>
					</div>
				</div>

				
                <div class="row">


					<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 details">


                        <form action="{{ url('withdraw-submit') }}"  class="steps-validation wizard-circle" id="form" method="POST" enctype="multipart/form-data">
                        @method('PATCH')
                        <!-- Step 1 -->
                        <h3 class="text-center">Withdraw Balance</h3>
                        <fieldset>


    
                            <div class="row">
 
                                <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Available Balance (BDT)</label>
                                    <input class="form-control required" id="available_amount" type="number" name="available_amount" required="" min="100" value="{{Auth::user()->balance}}" readonly>
                                </div>
                                </div>




                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">To Acoount Number</label>
                                            <input class="form-control required" id="to_number" type="text" name="to_number" required="" minlength="11" maxlength="11" placeholder="01XXXXXXXXX">
                                        </div>
                                        </div>
        
    
 
                                <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Amount (BDT)</label>
                                    @php
                                        $amounts = [10,50,100,200,500,1000];
                                    @endphp
                                    <select class="form-control required" id="amount" name="amount" required>
                                        <option value="">Please Select Amount</option>
                                        @foreach ($amounts as $amount)
                                            @if($amount<=Auth::user()->balance)
                                            <option value="{{$amount}}">{{$amount}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                </div>


                                    
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Type of Withdraw</label>
                                        
                                        @php
                                            $types = ['recharge'=>'Mobile Recharge','bkash'=>'bKash','nagad'=>'Nagad'];
                                        @endphp
                                        <select name="type" id="type" class="form-control" required>
                                            <option value="">Select Type</option>
                                            @foreach ($types as $key=>$item)
                                                <option value="{{$key}}">{{$item}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <br/>
                                    </div>



                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-transform-primary">Send Withdraw Request</button>
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

        $("#amount").on('change', function(){
                
                $('#type').empty()
                const val = $(this).val();
                if(val<100){

                    $("#type").append(new Option("Mobile Recharge", "recharge"));
                    //$('#type').find("option[value='bkash']").remove();
                    //$('#type').find("option[value='nagad']").remove();
                }else if(val>=100 && val<500){
                    $("#type").append(new Option("Mobile Recharge", "recharge"));
                    $("#type").append(new Option("bKash", "bkash"));
                    $("#type").append(new Option("Nagad", "nagad"));

                }else if(val>=500){
                    // $('#type').find("option[value='recharge']").remove();
                    $("#type").append(new Option("bKash", "bkash"));
                    $("#type").append(new Option("Nagad", "nagad"));

                }
        });

    });
</script>
    
@endsection