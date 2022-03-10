@extends('layouts.'.$data['language'].'.main')

@section('title')
    Checkout
@endsection

@section('content')


<!-- section start -->
<section class="section-big-py-space bg-light">
    <div class="custom-container">
        <h1 class="text-center">Checkout</h1>
        <div class="checkout-page contact-page">
            <div id="message" class="zero-message"></div>
            <div class="checkout-form">
                <form method="POST" action="{{ url('place-order') }}" data-parsley-validate>
                    @method('PATCH')
                    <div class="row">

                        @if(session('cart'))
                        <div class="col-lg-6 col-sm-12 col-xs-12">

                            @guest
                            <div class="theme-form text-center">
                            <h4>It seems you are not logged in. Please login to place your order!</h4>

                            <a href="{{url('login')}}"><button class="btn btn-default">Login</button></a>
                            
                            <br/><br/>
                            <h4>Don't have an account? make it now its fast &amp; simple.</h4>
                            <a href="{{url('register')}}"><button class="btn btn-default">Create an account</button></a><br/>
                            </div>
                            @else
                            
                            <div class="checkout-title">
                                <h3>Billing Details</h3></div>
                            <div class="theme-form">
                                <div class="row check-out ">

                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" class="form-control" name="phone" value=" @if(Auth::user()->default_billing_phone==NULL) {{Auth::user()->email}} @else {{Auth::user()->default_billing_phone}} @endif" placeholder="Phone Number" required>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" class="form-control" name="address" value="{{Auth::user()->default_billing_address}}" placeholder="Address" required>
                                    </div>

                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">

                                        <input type="checkbox" name="set_default_address" id="set_default_address" value="1" checked> 
                                        <label class="field-label">Set this address as default billing address</label>
                                        
                                    </div>

                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">

                                        <label class="field-label">Delivery Option</label><br/>
                                        @php

                                        $delivery_types = ['inside-dhaka'=>'Inside Dhaka','outside-dhaka'=>'Outside Dhaka'];
                                        $del_type = '';
                                        @endphp

                                        @foreach ($delivery_types as $key=>$type)

                                        @php
                                            if(session('delivery')){
                                                $delivery = session('delivery');
                                                $del_type = $delivery['type'];
                                            }elseif(isset(Auth::user()->defaut_delivery_option) && Auth::user()->defaut_delivery_option!=NULL){
                                                $del_type = Auth::user()->defaut_delivery_option;
                                            }
                                        @endphp
                                        
                                        <input type="radio" name="delivery_type" id="delivery-type" value="{{$key}}" @if($del_type==$key) checked @endif required> {{$type}} <br/>
                                        @endforeach
                                    </div>

                                    @php
                                    if(session('cupon')){
                                        $cupon = session('cupon');
                                        $code = $cupon['cupon'];

                                    }else{
                                        $code = '';
                                    }
                                @endphp

                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">

                                        <label class="field-label">Apply Cupon</label>
                                        <input type="text" name="cupon" id="cupon" class="form-control" placeholder="Apply cupon if you have" @if(session('cupon')) value="{{$code}}"  readonly @endif> 
                                        
                                        <br/>
                                        <button id="apply_cupon" type="button" class="btn btn-primary" @if(session('cupon')) disabled @endif>Apply</button>
                                        <br/>
                                        <br/>


                                        <div id="cupon_message">
                                        </div>

                                        @if(session('cupon'))
                                        <div class="alert alert-success">Cupon <b>{{$code}}</b> has applied successfully!
                                        </div>
                                        @endif
                                    </div>

                                </div>
                            </div>

                            @endguest
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12">
                            <div class="loading-cart d-none"><img src="{{url('icons/loading-dot.gif')}}"></div>
                            <div class="checkout-details theme-form section-big-mt-space">
                                <div class="order-box">
                                    @if(session('cart'))
                                    <div class="row">
                                        <div class="col-4 title-box ">Product</div>
                                        <div class="col-6 title-box ">Quantity</div> 
                                        <div class="col-2 title-box ">Total</div>
                         
                                    {{-- <ul class="qty"> --}}
                                        @php
                                             $subtotal = 0; 
                                        @endphp
                                        @if(session('cart'))
                    
                                        @foreach(session('cart') as $id => $details)
                    
                                        @php
                                            $subtotal += $details['price'] * $details['quantity'];
                                        @endphp
                                            <div class="col-4 cart-item-row">{{ $details['name'] }}</div>
                                            <div class="col-5 cart-item-row"><input type="number" class="form-control cart-quantity" value="{{ $details['quantity'] }}" data-id="{{$id}}" data-price="{{$details['price']}}"></div>
                                            <div class="col-3 cart-item-row text-right">&#2547;<span id="{{$id}}-subtotal" class="subtotal">{{number_format($details['price'] * $details['quantity'],2,".","")}}</span></div>
                                        @endforeach
                    
                                        @endif
                    
                                        @php
                                            $discount = 0;
                                            

                                            // $delivery_charge = 60;

                                            if(session('delivery')){

                                                
                                                $delivery = session('delivery');
                                             
                                                if($delivery['type'] == 'inside-dhaka'){
                                                    $delivery_charge = 60;
                                                }else if($delivery['type'] == 'outside-dhaka'){
                                                    $delivery_charge = 120;
                                                }

                                            }else if(isset(Auth::user()->defaut_delivery_option) && Auth::user()->defaut_delivery_option != NULL){
                                                if(Auth::user()->defaut_delivery_option == 'inside-dhaka'){
                                                    $delivery_charge = 60;
                                                }else{
                                                    $delivery_charge = 120;
                                                }
                                            }else{
                                                $delivery_charge = 60;
                                            }

                                            $total = $subtotal + $delivery_charge;

                                            if(session('cupon')){
                                                $cupon = session('cupon');
                                                if($cupon['status']=='true'){
                                                    $discount_type = $cupon['discount_type'];
                                                    if($discount_type=='flat'){
                                                        $discount = $cupon['discount'];
                                                        $grand_total = $total-$discount;
                                                    }else{
                                                        $discount = ceil(($subtotal*$cupon['discount'])/100);
                                                        $grand_total = $total-$discount;
                                                    }
                                                }
    
                                            }else {
                                                $grand_total = $total;
                                            }
                                            
                                        @endphp

                    
                                        <div class="col-6 cart-item-row">Subtotal</div> <div class="col-6 cart-item-row text-right">&#2547;<span id="subtotal">{{number_format($subtotal,2,".","")}}</span></div>
                                        
                    
                                        <div class="col-6 cart-item-row">Delivery Charge</div><div class="col-6 cart-item-row text-right"><span class="count">&#2547;<span id="delivery_charge">{{number_format($delivery_charge,2,".","")}}</span></span></div>
                                        <div class="col-6 cart-item-row">Discount</div><div class="col-6 cart-item-row text-right"><span class="discount">&#2547;<span id="discount_amount">{{number_format($discount,2,".","")}}</span></span><input type="hidden" name="discount" id="discount" class="form-control" value="{{$discount}}"> </div>
                                        <div class="col-6 cart-item-row">Total</div><div class="col-6 cart-item-row text-right"><span class="count">&#2547;<span id="total">{{number_format($grand_total,2,".","")}}</span></span></div>
                    
                                </div>

                                </div>

                                <hr/>
                                <div class="payment-box">
                                    <div class="upper-box">
                                        <div class="payment-options">
                                            <h5>Payment Option</h5>
                                            <ul>
                                                
                                                {{-- <li>
                                                    <div class="">
                                                        <input type="radio" name="payment_type" id="paypal" value="paypal"  checked="checked">
                                                        <label for="payment-3">PayPal<span class="image"><img src="{{url('assets/images/paypal.png')}}" alt=""></span></label>
                                                    </div>
                                                </li> --}}
{{-- 
                                                <li>
                                                    <div class="">
                                                        <input type="radio" name="payment_type" id="check" value="check" >
                                                        <label for="payment-1">Check Payments</label>
                                                    </div>
                                                </li> --}}
                                                <li>
                                                    <div class="">
                                                        <input type="radio" name="payment_type" id="cod" value="cod" checked="checked" >
                                                        <label for="payment-2">Cash On Delivery</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    @guest
                                    <div class="text-right"><button class="btn-normal btn btn-danger" id="clear-cart" type="button">Clear Cart</button>  <a href="{{url('login')}}" class="btn-normal btn bg-brand">Login Now</a></div>
                                    @else
                                    <div class="text-right"><button class="btn-normal btn btn-danger" id="clear-cart" type="button">Clear Cart</button>  <button class="btn-normal btn bg-brand" id="confirm-cart" type="submit" @if($total<100) disabled @endif>Place Order</button></div>
                                    @endguest
                                </div>
                                @endif

                                @if($total<121)
                                    <div class="zero-message"><div class='alert alert-warning'>We are sorry that we cannot process cart without product.</div></div>
                                @endif
                            </div>
                        </div>


                        @else
                        <div class="col-md-12">
                        <div class="text-center">
                        No product on you cart<br/>
                        <a href="{{url('/')}}" class="btn-normal btn bg-brand">Continue Shopping</a>
                        </div>
                        </div>
                        @endif
                    </div>

                    @csrf
                </form>
            </div>
        </div>
    </div>
</section>
<!-- section end -->
@endsection

@section('javascript')
<script src="{!! asset('assets/js/bootstrap-input-spinner-master/src/bootstrap-input-spinner.js') !!}"></script>
<script>
 $("input[type='number']").inputSpinner()

   
 $(document).on('change','.cart-quantity',function( e ) {

// $(".loading-cart").removeClass('d-none');
$("#clear-cart").prop("disabled",true);
$("#confirm-cart").prop("disabled",true);

  var quantity = $(this).val();
  var id = $(this).data("id");
  var price = $(this).data("price");
  var data = '';

$.ajax({   
type : 'GET',
url  : "{{url('product/add-cart')}}" + "/" + id + "/" + quantity,
success : function(data)
{
  
  var response = jQuery.parseJSON(data);

 if(response.result == "success"){

var sub_total_price = quantity * price;

$("#"+id+"-subtotal").html(sub_total_price.toFixed(2));

// $(".loading-cart").addClass('d-none');
$("#clear-cart").prop("disabled",false);
$("#confirm-cart").prop("disabled",false);
var delivery_charge =  parseInt($("#delivery_charge").html());

var total = response.total + delivery_charge;


var discount = $('#discount').val();
    var grand_total = total - discount;

$('#subtotal').html(response.total.toFixed(2));
$('#total').html(grand_total.toFixed(2));

if(total<(delivery_charge+1)){

    if(total<0){
        var message = "<div class='alert alert-warning'>So, funny cart, thanks for fun with us.</div>";
    }else
    if(total<(delivery_charge+1)){
        var message = "<div class='alert alert-warning'>We are sorry that we cannot process cart without product.</div>";
    }
    $("#message").html(message);
    $("#confirm-cart").prop("disabled",true);
    $('.zero-message').slideDown('fast');
}else{
    $('.zero-message').slideUp('fast');
}

//   $('.total-cart').html(response.total_cart);

//   $("#confirm-cart").html('Add to cart').prop("disabled",false);
//   $("#direct-cart").prop("disabled",false);
//   if( $('.cart_product').html() !=""){
//   $('.cart_product').html("");
//   }
//   var list =  $('.cart_product');

//   $.each(response.products, function(key, product){
//       var image = '{{url("images")}}/' + product.photo;
//       var content = '<li><div class="media"><a href="#"><img alt="" class="mr-3" src="' + image +'"></a><div class="media-body"><a href="#"><h4> ' + product.name + ' </h4></a><h4><span>' + product.quantity +' x $ '+ product.price + '</span></h4></div></div></li>';
//       list.append(content);

//   });

//   $('.cart_total').show();
//   $('#total_price').html('$'+response.total);
  


}else{

}


}
});


});


$(document).on('change','#delivery-type',function( e ) {

    // $("#confirm-cart").prop("disabled",true);
    // $("#clear-cart").prop("disabled",true);

    var subtotal  = parseInt($("#subtotal").html());
    var type = $(this).val();
    if(type == 'inside-dhaka'){
        var charge = 60;
    }else{
        var charge = 120;
    }

    var total = subtotal + charge;

    var discount = $('#discount').val();
    var grand_total = total - discount;

    $("#delivery_charge").html(charge.toFixed(2));
    $("#total").html(grand_total.toFixed(2));


  var data = 'type='+type;

$.ajax({   
type : 'GET',
url  : "{{url('set-default-delivery')}}",
data : data,
success : function(data)
{

console.log(data);

}

});

    // $("#clear-cart").prop("disabled",false);
    // $("#confirm-cart").prop("disabled",false);

});


function execute_cupon_functionality(){
    
$("#apply_cupon").prop("disabled",true);
$("#confirm-cart").prop("disabled",true);

  var cupon = $("#cupon").val();
  var data = 'code='+cupon;

$.ajax({   
type : 'GET',
url  : "{{url('cupon')}}",
data : data,
success : function(data)
{
    $("#apply_cupon").prop("disabled",false);
    $("#confirm-cart").prop("disabled",false);

    if(data.status == 'true'){
    $("#cupon").prop("readonly",true);
    $("#apply_cupon").prop("disabled",true);

    var subtotal  = parseInt($("#subtotal").html());
    var delivery_charge  = parseInt($("#delivery_charge").html());
    var total = subtotal + delivery_charge;
    if(data.discount_type=='flat'){
        var discount = data.discount;
        var grand_total = subtotal - discount;
    }else if(data.discount_type == 'parcent'){
        var discount = Math.ceil((subtotal * data.discount )/100);
        var grand_total = total - discount;
    }

    $('#discount_amount').html(discount.toFixed(2));
    $('#total').html(grand_total.toFixed(2));
    $('#discount').val(discount.toFixed(2));

    $("#cupon_message").html('<div class="alert alert-success">Cupon <b>'+cupon+'</b> has applied successfully.</div>').slideDown("fast");
    }else{
        $("#cupon_message").html('<div class="alert alert-warning">Your applied cupon code is expired or not found.</div>').slideDown("fast");
    }


 }

})

}
   
$(document).on('click','#apply_cupon',function( e ) {
    
    execute_cupon_functionality();

});

$(document).on('keypress','#cupon',function( e ) {
    
    if(e.which == 13){
    execute_cupon_functionality();
    }

});
 </script>
 @endsection