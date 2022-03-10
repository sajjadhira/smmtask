@extends('layouts.'.$data['language'].'.main')
@section('title')
{{$data['category']->name}}
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

            @if (count($data['products'])>0)
          <div class="col-md-12">

            <h3 class="title">{{$data['category']->name}}</h3>
           <hr/>

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


          @else
          <div class="col-md-12">
          <div class="text-center d-block">
            No product found in this category.<br/>
            <a href="{{url('request-for-product/'.$data['category']->slug)}}"><button class="btn btn-primary">Request for Product</button></a>
            </div>
          </div>
        @endif
      
          
        </div>
        <br>
        <div class="text-center">
        {{$data['products']->links()}}
        </div>

        
        
        
    </div>

      </div>


    </div>
  </section>

@endsection