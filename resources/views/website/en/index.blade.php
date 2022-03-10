@extends('layouts.'.$data['language'].'.main')

@section('css')

@endsection

@section('content')


<section>

  <div class="row">

    <div class="col-md-2 animated fadeIn">

      <div class="title-bar bg-brand" id="categories">
        <i class="fa fa-bars"></i> Categories <i class="fa fa-chevron-down" aria-hidden="true"></i>

      </div>


      <ul class="sidebar-categories">
        @foreach ($data['categories'] as $category)
        <li class="d-block"><a href="{{url('category/'.$category->slug)}}">{{$category->name}} <i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
        @endforeach
      </ul>

    </div>

    <div class="col-md-10 text-center">
  
     <div class="welcome-messagae animated fadeIn">
       <div class="initial-messaage">Welcome to <span class="brand-name">JEKUNO.COM</span></div>
       <span class="secondary-message">Buy branded original products from us and enjoy exciting discounts.</span><br/><br/>

       <div class="typed-element"></div>
     </div>
      
  
    </div>

  </div>
</section>




  <div class="row each-section animated fadeIn">
    <div class="col-md-12 text-left">
        <h3 class="top-space"><span class="title-pad">Recent Products</span></h3>
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
        <button type="button" class="btn btn-default bg-brand add-cart buy-now" data-id="{{$item->id}}" data-quantity="1">Buy Now</button>
      </div>
    </div>            
    @endforeach

</div>


<div class="row each-section animated fadeIn">
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
      <button type="button" class="btn btn-default bg-brand add-cart buy-now" data-id="{{$item->id}}" data-quantity="1">Buy Now</button>
    </div>
  </div>            
  @endforeach

</div>

    
@endsection

@section('javascript')

<script src="//cdn.jsdelivr.net/npm/typed.js@2.0.11"></script>

<script>
  
var options = {
  @guest
  strings: [
    'Just login and continue your shopping,<br/>For login your account <a href="{{url('login')}}"><u>click here</u></a><br/>', 
  'If you do not have any account you can do it easily.<br/> <a href="{{url('register')}}"><u>Click here</u></a> and register your account easily.'
  ],
  @else
  strings: [
    'Do you know now you can earn money with us?<br/>Join our <a href="{{url('affiliate-program')}}"><u>affiliate program</u></a> sale our products to your known person and earn money.', 
    'You can also sale your own products by opening store to our website.<br/>Just <a href="{{url('open-store')}}"><u>Open Store</u></a> and sale your products from right now.'],

  @endguest
  typeSpeed: 60,
  loop: true,
  backSpeed: 0,
  backDelay: 5000
};

var typed = new Typed('.typed-element', options);

/*
setInterval(function() {
  $(".brand-name")
      .stop()
      .css({"color":"#4385F6"},1000)
      .animate({"color":"#4385F6"},1000)
      ;
},3000);
*/
  </script>
    
@endsection