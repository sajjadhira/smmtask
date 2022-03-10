@extends('layouts.main')

@section('title')Checkout @endsection

@section('content')


<!-- section start -->
<section class="section-big-py-space bg-light">
    <div class="custom-container">
        <h1 class="text-center">চেকআউট</h1>
        <div class="checkout-page contact-page">
            <div id="message" class="zero-message"></div>
            <div class="checkout-form">
                <form method="POST" action="{{ url('place-order') }}" data-parsley-validate>
                    @method('PATCH')
                    <div class="row">

                        @if(session('cart'))
                        <div class="col-lg-6 col-sm-12 col-xs-12">
{{-- 
                            @guest
                            <div class="theme-form text-center">
                            <h6>আপনার অর্ডারটি সম্পূর্ণ করতে আপনার একাউন্টে লগিন করতে হবে,</h6>

                            <a href="{{url('login')}}"><button class="btn btn-default">লগিন করতে এখানে ক্লিক করুন</button></a>
                            
                            <br/><br/>
                            <h6>আপনার কি কোন একাউন্ট নেই? তাহলে খুব সহজেই করে নিন একাটি একাউন্ট আর উপভোগ করুন আকর্ষণীয় অফার,</h6>
                            <a href="{{url('register')}}"><button class="btn btn-default">নতুন একাউন্ট করতে এখানে ক্লিক করুন</button></a><br/>
                            </div>
                            @else --}}
                            
                            <div class="checkout-title">
                                <h3>বিলিং বিস্তারিত</h3></div>
                            <div class="theme-form">
                                <div class="row check-out ">

                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" class="form-control" name="name" value="@if(isset(Auth::user()->name)){{Auth::user()->name}}@endif" placeholder="আপনার নাম লিখুন" required  autocomplete="off">
                                    </div>

                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" class="form-control" name="phone" value="@if(isset(Auth::user()->default_billing_phone)){{Auth::user()->default_billing_phone}}@elseif(isset(Auth::user()->email)){{Auth::user()->email}}@endif" placeholder="১১ ডিজিটের ফোন নাম্বার লিখুন, উদাহারন- 01712XXXXXX" maxlength="11" required  autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" class="form-control" name="address" value="@if(isset(Auth::user()->default_billing_address)){{Auth::user()->default_billing_address}}@endif" placeholder="পূর্ণ ঠিকানা লিখুন- বাসার নাম্বার/রোড নাম্বার, গ্রাম, উপজেলা, জেলা" required autocomplete="off">
                                    </div>

                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">

                                        <input type="checkbox" name="set_default_address" id="set_default_address" value="1" checked> 
                                        <label class="field-label">এই ঠিকানাটি ডিফল্ট ঠিকানা হিসাবে সেভ করে রাখুন</label>
                                        
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

                                        <label class="field-label">কুপন</label>
                                        <input type="text" name="cupon" id="cupon" class="form-control" placeholder="আপনার কুপন কোড থাকলে এপ্ল্যায় করুন" @if(session('cupon')) value="{{$code}}"  readonly @endif> 
                                        
                                        <br/>
                                        <button id="apply_cupon" type="button" class="btn btn-primary" @if(session('cupon')) disabled @endif>এপ্ল্যায়</button>
                                        <br/>
                                        <br/>


                                        <div id="cupon_message">
                                        </div>

                                        @if(session('cupon'))
                                        <div class="alert alert-success">কুপন <b>{{$code}}</b> এপ্ল্যায় করা হয়েছে!
                                        </div>
                                        @endif
                                    </div>

                                </div>
                            </div>

                            {{-- @endguest --}}
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12">
                            <div class="loading-cart d-none"><img src="{{url('icons/loading-dot.gif')}}"></div>
                            <div class="checkout-details theme-form section-big-mt-space">
                                <div class="order-box">
                                    @if(session('cart'))
                                    <div class="row">
                                        <div class="col-4 title-box ">পণ্যের তালিকা</div>
                                        <div class="col-6 title-box ">পরিমাণ</div> 
                                        <div class="col-2 title-box ">মোট</div>
                         
                                    {{-- <ul class="qty"> --}}
                                        @php
                                             $subtotal = 0; 
                                        @endphp
                                        @if(session('cart'))
                    
                                        @foreach(session('cart') as $id => $details)
                    
                                        @php
                                            $subtotal += $details['price'] ;
                                        @endphp
                                            <div class="col-4 cart-item-row">{{ $details['name'] }}</div>
                                            <div class="col-5 cart-item-row"><input type="number" class="form-control cart-quantity" value="1" data-id="{{$id}}" data-price="{{$details['price']}}"></div>
                                            <div class="col-3 cart-item-row text-right">&#2547;<span id="{{$id}}-subtotal" class="subtotal d-none">{{number_format($details['price'] * 1,2,".","")}}</span></div>
                                        @endforeach
                    
                                        @endif
                    
                    
                    
                                        <div class="col-6 cart-item-row">যোগফল</div> <div class="col-6 cart-item-row text-right">&#2547;<span id="subtotal" class="d-none">{{number_format($subtotal,2,".","")}}</span><span id="subtotal_show">{{\App\Http\Controllers\HomeController::bfn(number_format($subtotal,2,".",""))}}</span></div>

                                        <div class="col-6 cart-item-row">সর্বমোট</div><div class="col-6 cart-item-row text-right"><span class="count">&#2547;<span id="total" class="d-none">{{number_format($subtotal,2,".","")}}</span><span id="total_show">{{\App\Http\Controllers\HomeController::bfn(number_format($subtotal,2,".",""))}}</span></span></div>
                    
                                </div>

                                </div>

                                <hr/>
                                <div class="payment-box">
                                    <div class="upper-box">
                                        <div class="payment-options">
                                            <h5>পেমেন্ট অপশন</h5>
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
                                                        <label for="payment-2">ক্যাশ অন ডেলিভারি</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    {{-- @guest --}}
                                    {{-- <div class="text-right"><button class="btn-normal btn btn-danger" id="clear-cart" type="button">অর্ডার লিস্ট খালি করুন</button>  <a href="{{url('login')}}" class="btn-normal btn bg-brand">একাউন্টে লগিন করুন</a></div> --}}
                                    {{-- @else --}}
                                    <div class="text-right"><button class="btn-normal btn btn-danger" id="clear-cart" type="button">অর্ডার লিস্ট খালি করুন</button>  <button class="btn-normal btn bg-brand" id="confirm-cart" type="submit" @if($subtotal<1) disabled @endif>অর্ডারটি সম্পন্ন করুন</button></div>
                                    {{-- @endguest --}}
                                </div>
                                @endif

                                @if($subtotal<1)
                                    <div class="zero-message"><div class='alert alert-warning'>দুঃখিত! কোন পণ্য ছাড়া আপনি অর্ডারটি প্লেস করতে পারবেন না।</div></div>
                                @endif
                            </div>
                        </div>


                        @else
                        <div class="col-md-12">
                        <div class="text-center">
                        আপনার অর্ডারে কোন পণ্য নেই<br/>
                        <a href="{{url('/')}}" class="btn-normal btn bg-brand">কেনাকাটা অব্যাহত রাখুন</a>
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

 function replaceCumulative(str, find, replace) {
  for (var i = 0; i < find.length; i++)
    str = str.replace(new RegExp(find[i],"g"), replace[i]);
  return str;
};

 function bfn(str){
     return replaceCumulative(str,['0','1','2','3','4','5','6','7','8','9'],['০','১','২','৩','৪','৫','৬','৭','৮','৯']);;
 }

   
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
$("#"+id+"-subtotal_show").html(bfn(sub_total_price.toFixed(2)));

// $(".loading-cart").addClass('d-none');
$("#clear-cart").prop("disabled",false);
$("#confirm-cart").prop("disabled",false);
var delivery_charge =  parseInt($("#delivery_charge").html());

var total = response.total + delivery_charge;


var discount = $('#discount').val();
    var grand_total = total - discount;

$('#subtotal').html(response.total.toFixed(2));
$('#subtotal_show').html(bfn(response.total.toFixed(2)));
$('#total').html(grand_total.toFixed(2));
$('#total_show').html(bfn(grand_total.toFixed(2)));

if(total<(delivery_charge+1)){

    if(total<0){
        var message = "<div class='alert alert-warning'>দুঃখিত! পণ্যের ঋণাত্মক পরিমাণ দিয়ে আপনি অর্ডারটি প্লেস করতে পারবেন না।</div>";
    }else
    if(total<(delivery_charge+1)){
        var message = "<div class='alert alert-warning'>দুঃখিত! কোন পণ্য ছাড়া আপনি অর্ডারটি প্লেস করতে পারবেন না।</div>";
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


$(document).on('change','.delivery-type',function( e ) {

    // $("#confirm-cart").prop("disabled",true);
    // $("#clear-cart").prop("disabled",true);

    var subtotal  = parseInt($("#subtotal").html());
    var charge = parseInt($(this).data("charge"));
    var type = parseInt($(this).data("type"));

    var total = subtotal + charge;

    var discount = $('#discount').val();
    var grand_total = total - discount;

    $("#delivery_charge").html(charge.toFixed(2));
    $("#delivery_charge_show").html(bfn(charge.toFixed(2)));
    $("#total").html(grand_total.toFixed(2));
    $("#total_show").html(bfn(grand_total.toFixed(2)));


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
    $('#discount_amount_show').html(bfn(discount.toFixed(2)));
    $('#total').html(grand_total.toFixed(2));
    $('#total_show').html(bfn(grand_total.toFixed(2)));
    $('#discount').val(discount.toFixed(2));
    $('#discount_show').val(bfn(discount.toFixed(2)));

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