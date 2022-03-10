@extends('layouts.main')

@section('title'){{__("Publishing New Task")}}@endsection

@section('css')
<link rel="stylesheet" href="{{url('assets/css/marketplace.css')}}">
<link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/plugins/forms/wizard.css') !!}">
<link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/forms/select/select2.min.css') !!}">
<style>
    .danger{
        color: #EA5455;
    }
</style>
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

				
                <div class="row app-content">


					<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 details">


       
          <!-- columns starts here -->
          <div class="col-md-12 col-xxl-12 mb-3 pr-md-2">

            <!-- cards starts here -->
            <div class="card h-md-100  w-md-d-card">
                <div class="card-body ">
                    <form action="{{ url('newtask/store') }}"   class="steps-validation wizard-circle" id="form" novalidate="" method="POST" enctype="multipart/form-data">
                        @method('PATCH')

                          
                    <!-- Step 1 -->
                    <h6><span data-feather="trello"></span> Indentification Information</h6>
                    <fieldset>

                        <div class="row">

                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name*</label>
                                <input class="form-control required" id="name" type="text" name="name" required="" placeholder="Task Name">
                            </div>
                            
                            <br/>
                            </div>

                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Category*</label>
                                <select class="form-control digits required" id="category" name="category" required>
                                    <option value="">Select Category</option>
                                @foreach ($data['categories'] as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>    
                                @endforeach
                            </select>
                            </div>                            
                            <br/>

                            </div>

                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Subcategory*</label>
                                <select class="form-control digits required" id="subcategory" name="subcategory" required>
                                    <option value="">Select Subcategory</option>
                            </select>
                            </div>
                            <br/>
                            <br/>
                            </div>


                            @php
                                $types = ['Youtube Video', 'Facebook Video', 'Website'];
                            @endphp
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Type*</label>
                                <select class="form-control required" id="type" name="type" required>
                                    <option value="">Select Type</option>
                                    @foreach ($types as $type)
                                    <option value="{{$type}}">{{$type}}</option>
                                    @endforeach
                            </select>
                            </div>
                            <br/>
                            <br/>
                            </div>

                        </div>

                    </fieldset>
                                               
                    <!-- Step 2 -->
                    <h6><span data-feather="dollar-sign"></span> Pricing Information</h6>
                    <fieldset>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">PPA For You (Points Per Action)*</label>
                                    <input class="form-control required" id="price" type="number" name="price" min="10" required="" placeholder="Points for The Action" >
                                </div>
                                <br/>

                            </div>


                            
                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Duration (Second of Per Task)*</label>
                                <input class="form-control required" id="duration" type="number" name="duration" required placeholder="50" value="" readonly>
                            </div>
                            <br/>
                        </div>
                            
                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Campaign Budget (Points)*</label>
                                <input class="form-control required" id="budget" type="number" name="budget" min="1000" placeholder="500000" value="">
                            </div>
                            <br/>
                            <br/>
                        </div>
                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Network Fee (Points)*</label>
                                <input class="form-control required" id="netfee" type="number" name="netfee" placeholder="5% Newtwork Free Based on Campaign Budget" value="" readonly>
                            </div>
                            <br/>
                            <br/>
                        </div>

                        

                        </div>

                    </fieldset>

                                                                    
                    <!-- Step 3 -->
                    <h6><span data-feather="database"></span> Others Information</h6>
                    <fieldset>

                        <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">URL*</label>
                                <input class="form-control required" id="preview_url" type="text" name="preview_url" placeholder="https://perview.inihub.com/hospital-management-system" value="">
                            </div>
                            <br/>
                            <br/>
                        </div>
       
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code">Description*</label>
                                <textarea name="description" class="form-control" cols="50" rows="4" placeholder="Task description..."></textarea>
                            </div>
                            <br/>
                            <br/>
                        </div>

                    </div>

                    </fieldset>


                        @csrf
                    </form>

                </div>
            </div>
            <!-- cards ends here -->

        </div>
        <!-- table column ends here -->



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

<script src="{!! asset('app-assets/vendors/js/extensions/jquery.steps.min.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') !!}"></script>
<script src="{!! asset('app-assets/js/scripts/forms/wizard-steps.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/forms/select/select2.full.min.js') !!}"></script>
<script type="text/javascript">

    $(document).ready(function(){

        $("#price").on('keyup', function(){
                const points = $(this).val()
                const sec = points * 6
                $('#duration').val(sec)
        });

        $("#budget").on('keyup', function(){
                const budget = $(this).val()
                const taka = budget
                const netfee = (taka/100)*5
                $('#netfee').val(netfee)
        });



$(document).on('change','#category',function( e ) {

    var category = $(this).val();
    var url = "{{ url('dashboard/subcates') }}/" + category;

    $.ajax({   
    type : 'GET',
    url  : url,
    success : function(data)
        {
            // alert(data);return false;

            $('#subcategory').empty();
            var opts = $.parseJSON(data);
            // Use jQuery's each to iterate over the opts value
            $.each(opts, function(i, d) {
                // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
                $('#subcategory').append('<option value="' + d.id + '">' + d.name + '</option>');
            });

        }
    });

});

/*
$(document).on('keyup','#price',function( e ) {

    var price = $('#price').val();
    
    var adv_price = price + ((price*100)/10);

    $('#price_advertiser').val(adv_price);

});
*/


});

</script>
    
@endsection