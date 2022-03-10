@extends('layouts.dashboard')
@section('title')Edit Product @endsection

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
          <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
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
                    <form action="{{ url('dashboard/products/update/'.$data['product']->id) }}"   class="steps-validation wizard-circle" id="form" novalidate="" method="POST" enctype="multipart/form-data">
                        @method('PATCH')

                          
                    <!-- Step 1 -->
                    <h6><span data-feather="trello"></span> Indentification Information</h6>
                    <fieldset>

                        <div class="row">

                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name*</label>
                                <input class="form-control required" id="name" type="text" name="name" required="" placeholder="Product Name" value="{{$data['product']->name}}">
                            </div>
                            </div>

                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Category*</label>
                                <select class="form-control digits required" id="category" name="category" required>
                                    <option value="">Select Category</option>
                                @foreach ($data['categories'] as $item)
                                    <option value="{{$item->id}}" @if($data['product']->category==$item->id) selected @endif>{{$item->name}}</option>
                                @endforeach
                            </select>
                            </div>
                            </div>

                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Subcategory*</label>
                                <select class="form-control digits required" id="subcategory" name="subcategory" required>
                                    <option value="">Select Subcategory</option>
                                    @foreach ($data['subcategories'] as $item)
                                    <option value="{{$item->id}}" @if($data['product']->subcategory==$item->id) selected @endif>{{$item->name}}</option>
                                    @endforeach
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
                                    <option value="{{$type}}" @if($data['product']->product_type==$type) selected @endif>{{$type}}</option>
                                    @endforeach
                            </select>
                            </div>
                            </div>


                        </div>

                    </fieldset>
                                               
                    <!-- Step 2 -->
                    <h6><span data-feather="dollar-sign"></span> Pricing Information</h6>
                    <fieldset>

                        <div class="row">


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">PPA For You (Points Per Action)*</label>
                                    <input class="form-control required" id="price" type="number" name="price" required="" placeholder="Points for The Action" value="{{$data['product']->price}}">
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
                                <input class="form-control required" id="preview_url" type="text" name="preview_url" placeholder="https://perview.inihub.com/hospital-management-system" value="{{$data['product']->preview_url}}">
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
                                        <option value="{{$key}}" @if($data['product']->checkout_type==$key) selected @endif>{{$item}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        

                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Duration (Second)*</label>
                                <input class="form-control required" id="duration" type="number" name="duration" placeholder="50" value="{{$data['product']->duration}}">
                            </div>
                        </div>

                        

                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code">Description*</label>
                                <textarea name="description" required class="form-control required" cols="50" rows="4" placeholder="Product description...">{{$data['product']->description}}</textarea>
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


<script src="//cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {
    // $('#category').select2();
    // $('#subcategory').select2();
  $('#description').summernote();
});

$(document).ready(function () {

    $(document).on('change','#checkout_type',function( e ) {
        var val = $(this).val();

        if(val == ""){
            $('#checkout_url_section').slideUp('fast').addClass('d-none');
            $('#checkout_url').prop('required',true);
        }
        else if(val != "inhouse"){
            $('#checkout_url_section').slideDown('fast').removeClass('d-none');
            $('#checkout_url').prop('required',false);
        }else{
            $('#checkout_url_section').slideUp('fast').addClass('d-none');
            $('#checkout_url').prop('required',true);
            
        }

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

    $(document).on('keyup','#name',function( e ) {
        var name = $("#name").val();
        var subcate = $('#category').val();
        var price = $('#price').val();
        
        var nameF  = name.replace(/\s/g, '').toLowerCase();
        var subcatF  = subcate.replace(/\s/g, '').toLowerCase();
        var priceF  = price.replace(/\./g, '').toLowerCase();
        var code  = nameF + subcatF + priceF;

        $('#code').val(code);

    });

    $(document).on('keyup','#price',function( e ) {
        var name = $("#name").val();
        var subcate = $('#category').val();
        var price = $('#price').val();
        
        var nameF  = name.replace(/\s/g, '').toLowerCase();
        var subcatF  = subcate.replace(/\s/g, '').toLowerCase();
        var priceF  = price.replace(/\./g, '').toLowerCase();
        var code  = nameF + subcatF + priceF;

        $('#code').val(code);

    });

    $(document).on('change','#category',function( e ) {
        var name = $("#name").val();
        var subcate = $('#category').val();
        var price = $('#price').val();
        
        var nameF  = name.replace(/\s/g, '').toLowerCase();
        var subcatF  = subcate.replace(/\s/g, '').toLowerCase();
        var priceF  = price.replace(/\./g, '').toLowerCase();
        var code  = nameF + subcatF + priceF;

        $('#code').val(code);

    });

});

</script>

@endsection