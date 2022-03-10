@extends('layouts.'.$data['language'].'.main')

@section('css')

@endsection

@section('content')


<section>

  <div class="row">

    <div class="col-md-2 animated fadeIn">

      <div class="title-bar bg-brand" id="categories">
        <i class="fa fa-bars"></i> ক্যাটাগরি <i class="fa fa-chevron-down" aria-hidden="true"></i>

      </div>


      <ul class="sidebar-categories">
        @foreach ($data['categories'] as $category)
        <li class="d-block"><a href="{{url('category/'.$category->slug)}}">{{$category->name}} <i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
        @endforeach
      </ul>

    </div>

    <div class="col-md-10 text-center">
  
     <div class="welcome-messagae animated fadeIn">
       <div class="initial-messaage"><span class="brand-name">যেকোন.কম</span> এ আপনাকে স্বাগতম।</div>
       <span class="secondary-message">ব্র্যান্ডের সকল অরজিনাল পণ্য আমাদের থেকে কিনুন আকর্ষণীয় ডিস্কাউন্টে।</span><br/><br/>

       <div class="typed-element"></div>
     </div>
      
  
    </div>

  </div>
</section>




  <div class="row each-section animated fadeIn">
    <div class="col-md-12 text-left">
        <h3 class="top-space"><span class="title-pad">সাম্প্রতিক পণ্যসমূহ</span></h3>
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
        <del><small>&#2547;{{\App\Http\Controllers\HomeController::bfn($item->orginal_price)}}</small></del> <b>&#2547;{{\App\Http\Controllers\HomeController::bfn($item->price)}}</b> <span class="tag">&#2547;{{\App\Http\Controllers\HomeController::bfn($item->orginal_price-$item->price)}} ছাড়</span>
        @else
        <b>&#2547;{{\App\Http\Controllers\HomeController::bfn($item->orginal_price)}}</b>
        @endif
      </div>


      <div class="product-catalog-add-cart">
        <button type="button" class="btn btn-default bg-brand add-cart buy-now" data-id="{{$item->id}}" data-quantity="1">অর্ডার করুন</button>
      </div>
    </div>            
    @endforeach

</div>


<div class="row each-section animated fadeIn">
  <div class="col-md-12 text-left">
      <h3 class="top-space"><span class="title-pad">জনপ্রিয় পণ্যসমূহ</span></h3>
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
      <del><small>&#2547;{{\App\Http\Controllers\HomeController::bfn($item->orginal_price)}}</small></del> <b>&#2547;{{\App\Http\Controllers\HomeController::bfn($item->price)}}</b> <span class="tag">&#2547;{{\App\Http\Controllers\HomeController::bfn($item->orginal_price-$item->price)}} ছাড়</span>
      @else
      <b>&#2547;{{\App\Http\Controllers\HomeController::bfn($item->orginal_price)}}</b>
      @endif
    </div>


    <div class="product-catalog-add-cart">
      <button type="button" class="btn btn-default bg-brand add-cart buy-now" data-id="{{$item->id}}" data-quantity="1">অর্ডার করুন</button>
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
    'আপনার একাউন্টে লগিন করে আপনার কেনাকাটা অব্যাহত রাখুন,<br/>আপনার একাউন্টে লগিন করতে <a href="{{url('login')}}"><u>এখানে ক্লিক করুন।</u></a><br/>', 
  'আপনার যদি কোন একাউন্ট না থাকে তাহলে সহজেই একাউন্ট করে নিতে পারেন,<br/>নতুন একাউন্ট করতে <a href="{{url('register')}}"><u>এখানে ক্লিক করুন।</u></a>'
  ],
  @else
  strings: [
    'আপনি জানেন কি আপনি যেকোন.কম এর মাধ্যমে আয় করতে পারেন?<br/>আমাদের <a href="{{url('affiliate-program')}}"><u>রেভিনিউ শেয়ারিং প্রোগ্রামে</u></a> জয়েন করুন এখনি।', 
    'আপনি আপনার নিজস্ব পণ্য আমাদের ওয়েবসাইটে স্টোর খুলে বিক্রয় করতে পারবেন<br/> <a href="{{url('open-store')}}"><u>স্টোর খুলুন</u></a> এখনই অনলাইনে আপনার পণ্য বিক্রয় শুরু করুন।'],

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