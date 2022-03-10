@extends('layouts.'.$data['language'].'.main')

@section('css')
<link href="{!! asset('assets/js/fancybox-master/dist/jquery.fancybox.min.css') !!}" rel="stylesheet">
@endsection


@section('content')
  

  <section>

    <div class="row">

      <div class="col-md-2">

        <div class="title-bar bg-brand" id="categories">
          <i class="fa fa-bars"></i> Categories <i class="fa fa-chevron-down" aria-hidden="true"></i>

        </div>


        <ul class="sidebar-categories">
          @foreach ($data['categories'] as $category)
          <li class="d-block"><a href="{{url('category/'.$category->slug)}}">{{$category->name}}</a></li>
          @endforeach
        </ul>

      </div>

      <div class="col-md-10 card">

        <div class="card-body">

        <div class="row">
          <div class="col-md-6">
            <div class="img-section text-center">
            
              <a data-fancybox="gallery" href="{{url('images/'.$data['product']->thumbnail)}}">
                <img class="img img-thumbnail img-focused" src="{{url('images/'.$data['product']->thumbnail)}}" alt="{{$data['product']->name}}">
              </a>
            <div class="more-images">More Images</div>
            <div class="row padding-list">

              @php
                  $images = [];
                  if($data['product']->images != ""){
                    $images = json_decode($data['product']->images);
                  }

                  // print_r($images);
                  // $item = '';
              @endphp

              @foreach ($images as $key=>$item)
                  
              <div class="col-xs-3 col-sm-3 col-md-3 small-thumb">
                <a data-fancybox="gallery" href="{{url('images/'.$item)}}">
                  <img class="img img-thumbnail img-thumbnail-list" src="{{url('images/'.$item)}}" alt="{{$data['product']->name}}">
                </a>
              </div>
              
              @endforeach
            </div>

            </div>

          </div>

          <div class="col-md-6 product-details">

            <span class="id-tag">ID# <span id="product_id">{{$data['product']->id}}</span></span>
            <div class="title-tag">{{$data['product']->name}}</div>

            
          <div class="product-catalog-price">
            @if($data['product']->orginal_price>$data['product']->price)
            <del><small>&#2547;{{$data['product']->orginal_price}}</small></del> <b>&#2547;{{$data['product']->price}}</b> <span class="tag">&#2547;{{$data['product']->orginal_price-$data['product']->price}} SAVE</span>
            @else
            <b>&#2547;{{$data['product']->orginal_price}}</b>
            @endif
          </div>
          <div class="title-tag"><small>Shop:</b></small> <span class="text-primary">{{\App\Companies::findOrFail($data['product']->company)->name}}</span></div>
          <div class="qunatity-tag">
            <div class="row">
                <div class="col-md-4 quantity-section">
                  <input type="number" value="1" id="product-quantity">
                </div>
                <div class="col-md-8 action-section text-center">
                  <button type="button" class="btn btn-default bg-brand add-cart" id="confirm-cart">Add to cart</button>
                  <button type="button" class="btn btn-success add-cart buy-now" data-id="{{$data['product']->id}}" data-quantity="1" id="direct-cart">Buy now</button>
                </div>
                

                <div class="col-md-12 text-left delivery-instruction">
                  @php
                  $wa_message = "I want to buy - ". $data['product']->name . " (Product ID# ".$data['product']->id.")";
                  $whatsapp_message = urlencode($wa_message);
                  @endphp
                  {{-- <ul>
                    <li>Order via phone <a rel="nofollow" href="tel:+8801303435034"><u class="text-primary">Call</u></a></li>
                    <li>Order via phone <a rel="nofollow" href="sms://+8801303435034?body={{$whatsapp_message}}"><u class="text-primary">Message</u></a></li>
                    <li>Order via <a rel="nofollow" target="_blank" href="https://wa.me/8801303435034?text={{$whatsapp_message}}"><u class="text-primary">WhatsApp</u></a></li>
                    <li>Order via <a rel="nofollow" target="_blank" href="https://m.me/jekunobd"><u class="text-primary">Messenger</u></a></li>
                  </ul> --}}
                  <ul>
                    <li>Deliverable to <span class="text-primary">JEKUNO PICKUP POINT</span></li>
                    <li>Deliverable to <span class="text-primary">YOUR HOME</span></li>
                  </ul>
                </div>
            </div>
          </div>

          </div>

          <div class="col-md-12">
            <div class="description">
              <h6 class="subtitle-tag text-left">DESCRIPTION</h6>
              @php
              echo ($data['product']->description);
              @endphp
            </div>
          </div>
        </div>
    
      </div>

      </div>
  
    </div>
  </section>


    <div class="row each-section">
      <div class="col-md-12 text-left">
          <h3 class="top-space"><span class="title-pad">Related Products</span></h3>
      </div>

      @foreach ($data['products'] as $item)

      @php
          $name = strtolower(preg_replace('#[ -]+#', '-', $item->name));
      @endphp
      <div class="col-6 col-md-3 product-catalog text-center">
        <a href="{{url('product/'.$name.'/'.$item->id)}}">

          <img class="img img-thumbnail" src="{{url('images/thumb_'.$item->thumbnail)}}" alt="{{$item->name}}">

        </a>
        <div class="product-catalog-name">
          <a href="{{url('product/'.$name.'/'.$item->id)}}">
        {{$item->name}}
          </a>
        </div>

        <div class="product-catalog-price">
          @if($item->orginal_price>$item->price)
          <del><small>&#2547;{{$item->orginal_price}}</small></del> <b>&#2547;{{$item->price}}</b> <span class="tag">&#2547;{{$item->orginal_price-$item->price}} SAVE</span>
          @else
          <b>&#2547;{{$item->orginal_price}}</b>
          @endif

        
        </div>


        <div class="product-catalog-add-cart">
          <button type="button" class="btn btn-default bg-brand add-cart buy-now" data-id="{{$item->id}}" data-quantity="1">Add to Cart</button>
        </div>
      </div>            
      @endforeach

  </div>

  
  <div class="row each-section">
    <div class="col-md-12 text-left">
        <h3 class="top-space"><span class="title-pad">Popular Products</span></h3>
    </div>

    @foreach ($data['popular_products'] as $item)

    @php
        $name = strtolower(preg_replace('#[ -]+#', '-', $item->name));
    @endphp
    <div class="col-6 col-md-3 product-catalog text-center">
      <a href="{{url('product/'.$name.'/'.$item->id)}}">

        <img class="img img-thumbnail" src="{{url('images/thumb_'.$item->thumbnail)}}" alt="{{$item->name}}">

      </a>
      <div class="product-catalog-name">
        <a href="{{url('product/'.$name.'/'.$item->id)}}">
      {{$item->name}}
        </a>
      </div>

      <div class="product-catalog-price">
        @if($item->orginal_price>$item->price)
        <del><small>&#2547;{{$item->orginal_price}}</small></del> <b>&#2547;{{$item->price}}</b> <span class="tag">&#2547;{{$item->orginal_price-$item->price}} SAVE</span>
        @else
        <b>&#2547;{{$item->orginal_price}}</b>
        @endif

      
      </div>


      <div class="product-catalog-add-cart">
        <button type="button" class="btn btn-default bg-brand add-cart buy-now" data-id="{{$item->id}}" data-quantity="1">Add to Cart</button>
      </div>
    </div>            
    @endforeach

</div>


@endsection

@section('javascript')
<script src="{!! asset('assets/js/bootstrap-input-spinner-master/src/bootstrap-input-spinner.js') !!}"></script>
<script src="{!! asset('assets/js/fancybox-master/dist/jquery.fancybox.min.js') !!}"></script>
<script>
 $("input[type='number']").inputSpinner()

 $('.more-images').click(function(){
      $('.padding-list').slideToggle("fast");
      if($(this).html()=="More Images"){
        $(this).html("Less Images");
      }else{
        $(this).html("More Images");
      }
  });

  
  $(document).on('click','#confirm-cart',function( e ) {

  $("#confirm-cart").html('<i class="fa fa-spin fa-spinner"></i> Loading...').prop("disabled",true);
  $("#direct-cart").prop("disabled",false);

    var quantity = $('#product-quantity').val();
    var id = $('#product_id').html();
    var data = '';

$.ajax({   
type : 'GET',
url  : "{{url('product/add-cart')}}" + "/" + id + "/" + quantity,
success : function(data)
{
    
    var response = jQuery.parseJSON(data);

   if(response.result == "success"){
        
    $('.total-cart').html(response.total_cart);

    $("#confirm-cart").html('Add to cart').prop("disabled",false);
    $("#direct-cart").prop("disabled",false);
    if( $('.cart_product').html() !=""){
    $('.cart_product').html("");
    }
    var list =  $('.cart_product');

    $.each(response.products, function(key, product){
        var image = '{{url("images")}}/' + product.photo;
        var content = '<li><div class="media"><a href="#"><img alt="" class="mr-3" src="' + image +'"></a><div class="media-body"><a href="#"><h4> ' + product.name + ' </h4></a><h4><span>' + product.quantity +' x $ '+ product.price + '</span></h4></div></div></li>';
        list.append(content);

    });

    $('.cart_total').show();
    $('#total_price').html('$'+response.total);
    


}else{

}


}
});


});


</script>

@endsection