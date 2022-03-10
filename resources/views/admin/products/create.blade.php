@extends('layouts.dashboard')
@section('title')Add Product @endsection

@section('css')
<!-- additional js -->

<link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/plugins/forms/wizard.css') !!}">
<link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/forms/select/select2.min.css') !!}">

<!-- ends additional css -->
@endsection

@section('content')

<!-- main starts here -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    
    <!-- starts heading & breadcrumb here -->
    <h4 class="content-header-title float-left mb-0">Products</h4>


    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">

        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{url('dashboard/products')}}">Products</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Product</li>
        </ol>

    </nav>
    <!-- ends heading & breadcrumb here -->


    <!-- starts main content here -->
    <div class="row no-gutters app-content">

          <!-- columns starts here -->
          <div class="col-md-12 col-xxl-12 mb-3 pr-md-2">

            <!-- cards starts here -->
            <div class="card h-md-100  w-md-d-card">
                <div class="card-body ">
                    <form action="{{ url('dashboard/products/store') }}"   class="steps-validation wizard-circle" id="form" novalidate="" method="POST" enctype="multipart/form-data">
                        @method('PATCH')

                          
                    <!-- Step 1 -->
                    <h6><span data-feather="trello"></span> Indentification Information</h6>
                    <fieldset>

                        <div class="row">

                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name*</label>
                                <input class="form-control required" id="name" type="text" name="name" required="" placeholder="Product Name">
                            </div>
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
                            </div>

                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Subcategory*</label>
                                <select class="form-control digits required" id="subcategory" name="subcategory" required>
                                    <option value="">Select Subcategory</option>
                            </select>
                            </div>
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
                            </div>
{{-- 
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Thumbnail*</label>
                                <fieldset class="qty-box">
                                    <input class="upload required" name="image" type="file" required>
                                </fieldset>
                            </div>
                            </div>

                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Images*</label>
                                <fieldset class="qty-box">
                                    <input class="upload" name="images[]" type="file" multiple>
                                </fieldset>
                            </div>
                            </div> --}}

                        </div>

                    </fieldset>
                                               
                    <!-- Step 2 -->
                    <h6><span data-feather="dollar-sign"></span> Pricing Information</h6>
                    <fieldset>

                        <div class="row">

                      
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">PPA For You (Points Per Action)*</label>
                                    <input class="form-control required" id="price" type="number" name="price" required="" placeholder="Points for The Action" >
                                </div>
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
                        </div>
                        
                        @php
                            $checkouts = ['newwindow'=>'New Window','newtab'=>'New Tab','samepage'=>'Same Page'];
                        @endphp
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Checkout Type*</label>
                                <select class="form-control required" id="checkout_type" name="checkout_type" required>
                                    <option value="">Select Checkout Type</option>
                                    @foreach ($checkouts as $key=>$item)
                                        <option value="{{$key}}">{{$item}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        

                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Duration (Second)*</label>
                                <input class="form-control required" id="duration" type="number" name="duration" placeholder="50" value="">
                            </div>
                        </div>

                        

                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code">Description*</label>
                                <textarea name="description" required class="form-control required" cols="50" rows="4" placeholder="Product description..."></textarea>
                            </div>
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
    <!-- main contents ends here -->

</main>
<!-- main ends here -->


@endsection


@section('js')


<script src="{!! asset('app-assets/vendors/js/extensions/jquery.steps.min.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') !!}"></script>
<script src="{!! asset('app-assets/js/scripts/forms/wizard-steps.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/forms/select/select2.full.min.js') !!}"></script>
<script type="text/javascript">


$(document).ready(function () {


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


    $(document).on('keyup','#price',function( e ) {

        alert("working");
        var price = $('#price').val();
        
        var adv_price = price + ((price*100)/10);

        $('#price_advertiser').val(adv_price);

    });


});

</script>

@endsection