@extends('layouts.dashboard')
@section('title')
Manage Order
@endsection

@section('stylesheet')


@endsection

@section('content')


<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5>Manage Order</h5>
        </div>
        <div class="card-body">
            <div class="row product-adding">
                <div class="col-xl-12">
                    <form action="{{ url('dashboard/order/update/'.$data['invoice']->id) }}" class="needs-validation add-product-form" novalidate="" method="POST" enctype="multipart/form-data">
                        @method('PATCH')
                        <div class="form">
                            <div class="form-group mb-3 row">
                                <label for="name" class="col-xl-3 col-sm-4 mb-0">Customer :</label>
                            <input class="form-control col-xl-8 col-sm-7" id="name" type="text" name="name"value="{{\App\Users::find($data['invoice']->user)->name}}" disabled>
                                <div class="valid-feedback">Looks good!</div>
                            </div>

                            
                            <div class="form-group mb-3 row">
                                <label for="price" class="col-xl-3 col-sm-4 mb-0">Phone :</label>
                                <input class="form-control col-xl-8 col-sm-7" id="phone" type="text" name="phone"  value="{{$data['invoice']->phone}}" disabled>
                                <div class="valid-feedback">Looks good!</div>
                            </div>

                            
                            <div class="form-group mb-3 row">
                                <label for="price" class="col-xl-3 col-sm-4 mb-0">Delivery Address :</label>
                                <input name="delivery_address" class="form-control col-xl-8 col-sm-7" value="{{$data['invoice']->address}}"  readonly >
                
                                <div class="valid-feedback">Looks good!</div>
                            </div>

                            
                            <div class="form-group mb-3 row">
                                <label for="price" class="col-xl-3 col-sm-4 mb-0">Subtotal :</label>
                                <input class="form-control col-xl-8 col-sm-7" id="subtotal" type="number" name="subtotal" value="{{$data['invoice']->subtotal}}" disabled>
                                <div class="valid-feedback">Looks good!</div>
                            </div>

                            <div class="form-group mb-3 row">
                                <label for="price" class="col-xl-3 col-sm-4 mb-0">Delivery Charge :</label>
                                <input class="form-control col-xl-8 col-sm-7" id="delivery_charge" type="number" name="delivery_charge" value="{{$data['invoice']->delivery_charge}}" disabled>
                                <div class="valid-feedback">Looks good!</div>
                            </div>

                            <div class="form-group mb-3 row">
                                <label for="price" class="col-xl-3 col-sm-4 mb-0">Discount :</label>
                                <input class="form-control col-xl-8 col-sm-7" id="discount" type="number" name="discount"  value="{{$data['invoice']->discount}}" disabled>
                                <div class="valid-feedback">Looks good!</div>
                            </div>


                            <div class="form-group mb-3 row">
                                <label for="price" class="col-xl-3 col-sm-4 mb-0">Total :</label>
                                <input class="form-control col-xl-8 col-sm-7" id="total" type="number" name="total"  value="{{$data['invoice']->total}}" disabled>
                                <div class="valid-feedback">Looks good!</div>
                            </div>

                            <div class="form-group mb-3 row">
                                <label for="price" class="col-xl-3 col-sm-4 mb-0">Payment Type :</label>
                                <input class="form-control col-xl-8 col-sm-7" id="payment_type" type="text" name="payment_type"  value=" @if($data['invoice']->payment_type=='cod') Cash on Delivery @elseif($data['invoice']->payment_type=='bkash') bKash @elseif($data['invoice']->payment_type=='nagad') Nagad @else Undefiend @endif " disabled>
                                <div class="valid-feedback">Looks good!</div>
                            </div>



                            @php
                                // $statuses = [0=>'Placed',1=>'Processing',2=>'Delivered',403=>'Cancled',127=>'Returned'];
                                $agents = \App\Deliveryagents::where(['id'=>$data['invoice']->delivery_agent])->get();
                            @endphp
                            <div class="form-group mb-3 row">
                                <label for="price" class="col-xl-3 col-sm-4 mb-0">Delivery Agent :</label>
                                <select name="delivery_agent" class="form-control col-xl-8 col-sm-7" @if(Auth::user()->role!="superadmin" && $data['invoice']->status == 2) readonly @endif>
                    
                                    @foreach ($agents as $key=>$item)
                                        <option value="{{$item->id}}" @if($data['invoice']->delivery_agent == $item->id) selected @endif>{{$item->name}}</option>
                                    @endforeach
                                    </select>
                                <div class="valid-feedback">Looks good!</div>
                            </div>


                            @php
                                // $statuses = [0=>'Placed',1=>'Processing',2=>'Delivered',403=>'Cancled',127=>'Returned'];
                                $areas = ['inside-dhaka'=>'Inside Dhaka','around-dhaka'=>'Around Dhaka','outside-dhaka'=>'Outside Dhaka'];
                            @endphp
                            <div class="form-group mb-3 row">
                                <label for="price" class="col-xl-3 col-sm-4 mb-0">Delivery Area :</label>
                                <select name="delivery_area" class="form-control col-xl-8 col-sm-7" @if(Auth::user()->role!="superadmin" && $data['invoice']->status == 2) readonly @endif>
                                        <option value="">Select Delivery Area</option>
                                    @foreach ($areas as $key=>$item)
                                        <option value="{{$key}}" @if($data['invoice']->delivery_option == $key) selected @endif>{{$item}}</option>
                                    @endforeach
                                    </select>
                                <div class="valid-feedback">Looks good!</div>
                            </div>

                            @php
                                // $statuses = [0=>'Placed',1=>'Processing',2=>'Delivered',403=>'Cancled',127=>'Returned'];
                                $areas = ['facebook-ads'=>'Facebook Ads','google-ads'=>'Google Ads','youtube-ads'=>'Youtube Ads','other-platforms'=>'Other Platforms'];
                            @endphp
                            <div class="form-group mb-3 row">
                                <label for="price" class="col-xl-3 col-sm-4 mb-0">Sale From :</label>
                                <select name="sale_tracking" class="form-control col-xl-8 col-sm-7" @if(Auth::user()->role!="superadmin" && $data['invoice']->status == 2) readonly @endif>
                                    @foreach ($areas as $key=>$item)
                                        <option value="{{$key}}" @if($data['invoice']->sale_tracking == $key) selected @endif>{{$item}}</option>
                                    @endforeach
                                    </select>
                                <div class="valid-feedback">Looks good!</div>
                            </div>


                            @php
                                $statuses = [0=>'Placed',1=>'Processing',2=>'Delivered',403=>'Cancled',127=>'Returned'];
                            @endphp
                            <div class="form-group mb-3 row">
                                <label for="price" class="col-xl-3 col-sm-4 mb-0">Order Status :</label>
                                <select name="order_status" class="form-control col-xl-8 col-sm-7" @if(Auth::user()->role!="superadmin" && $data['invoice']->status == 2) readonly @endif>
                                    @foreach ($statuses as $key=>$item)
                                        <option value="{{$key}}" @if($data['invoice']->status == $key) selected @endif>{{$item}}</option>
                                    @endforeach
                                    </select>
                                <div class="valid-feedback">Looks good!</div>
                            </div>

             
                            <div class="form-group mb-3 row">
                                <label for="price" class="col-xl-3 col-sm-4 mb-0">Advance Paid :</label>
                                <input class="form-control col-xl-8 col-sm-7" id="paid" type="number" name="paid"  value="{{$data['invoice']->paid}}">
                                <div class="valid-feedback">Looks good!</div>
                            </div>

               

             
                            <div class="form-group mb-3 row">
                                <label for="price" class="col-xl-3 col-sm-4 mb-0">Delivery Tracking :</label>
                                <input class="form-control col-xl-8 col-sm-7" id="delivery_tracking" type="text" name="delivery_tracking"  value="{{$data['invoice']->delivery_tracking}}">
                                <div class="valid-feedback">Looks good!</div>
                            </div>

               
                            

                        <div class="offset-xl-3 offset-sm-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="reset" class="btn btn-light">Discard</button>
                        </div>

                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('javascript')

<!-- touchspin js-->
<script src="{!! url('assets/js/touchspin/vendors.min.js') !!}"></script>
<script src="{!! url('assets/js/touchspin/touchspin.js') !!}"></script>
<script src="{!! url('assets/js/touchspin/input-groups.min.js') !!}"></script>

<!-- form validation js-->
<script src="{!! url('assets/js/dashboard/form-validation-custom.js') !!}"></script>

<!-- ckeditor js-->
<script src="{!! url('assets/js/editor/ckeditor/ckeditor.js') !!}"></script>
<script src="{!! url('assets/js/editor/ckeditor/styles.js') !!}"></script>
<script src="{!! url('assets/js/editor/ckeditor/adapters/jquery.js') !!}"></script>
<script src="{!! url('assets/js/editor/ckeditor/ckeditor.custom.js') !!}"></script>

<!-- Zoom js-->
<script src="{!! url('assets/js/jquery.elevatezoom.js') !!}"></script>
<script src="{!! url('assets/js/zoom-scripts.js') !!}"></script>


<!-- lazyload js-->
<script src="{!! url('assets/js/lazysizes.min.js') !!}"></script>

<!--right sidebar js-->
<script src="{!! url('assets/js/chat-menu.js') !!}"></script>

<!--script admin-->
<script src="{!! url('assets/js/admin-script.js') !!}"></script>

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