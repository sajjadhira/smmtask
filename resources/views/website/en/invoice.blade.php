@extends('layouts.'.$data['language'].'.printable')

@section('title')
    Invoice #{{$data['invoice']->id}}
@endsection
@section('css')
<style>
    @media print { @page { margin: 0; } 
     body { margin: 1.6cm; } }
  </style>   
@endsection

@section('content')
 

<!-- order-detail section start -->
<section class="section-big-py-space mt--5 bg-light">

    <div class="card order-container">
        <div >
            <img src="{{url('images/logo.png')}}">
        </div>
        <br/><br/>
        <div class="row">
            <div class="col-md-12">
                <div class="row order-success-sec">
                    <div class="col-sm-6">
                        
                        <h4>Order Summary</h4>
                        <ul class="order-detail">
                            <li>Invoice # {{$data['invoice']->id}}</li>
                            <li>Order Date: {{date('d F, Y',strtotime($data['invoice']->created_at))}}</li>
                            <li>Order Total: &#2547;{{$data['invoice']->total}}</li>
                            <li>Payment Method:  @if ($data['invoice']->payment_type=='cod')
                                Cash On Delivery
                                @elseif ($data['invoice']->payment_type=='bkash')
                                bKash
                                @elseif ($data['invoice']->payment_type=='nagad')
                                Nagad
                                @elseif ($data['invoice']->payment_type=='cash')
                                Cash
                                @endif</li>
                        </ul>
                    </div>

                    @php
                        if($data['invoice']->delivery_option == 'inside-dhaka'){
                            $add_time  = 1*24*3600;
                        }else {
                            $add_time = 2*24*3600;
                        }
                    @endphp

                    <div class="col-sm-6">

                        <ul class="order-detail">
                            <li>Customer Name: <b>{{\App\Users::findOrFail($data['invoice']->user)->name}}</b></li>
                            <li>Contact No: <b>{{$data['invoice']->phone}}</b></li>
                            <li>Shipping Address: {{$data['invoice']->address}}</li>
                            @if ($data['invoice']->status==0)
                            <li>Expected Delivery: {{date('d F, Y',strtotime($data['invoice']->created_at) + $add_time)}}</li>
                            @endif

                        </ul>
                    </div>

            </div>
            <div class="col-md-12 col-12">
                <div class="product-order">
                    <h4 class="text-center">Order Details</h4>

                    <table class="table">
        
                        <tr class="table-head">
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
    

                    @foreach ($data['orders'] as $order)

                    @php
                        $product = \App\Products::findOrFail($order->product);
                    @endphp
                        <tr>
                            <td>{{$product->name}}</td>
                            <td> @if($order->orginal_price>$order->price)<small><del>&#2547;{{$order->orginal_price}}</del></small> @endif&#2547;{{$order->price}}</td>
                            <td>{{$order->quantity}}</td>
                            <td>&#2547;{{$order->total_price}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4"></td>
                    </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td>Subtotal</td>
                            <td>&#2547;{{$data['invoice']->subtotal}}</td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td>Shipping Charge</td>
                            <td>&#2547;{{$data['invoice']->delivery_charge}}</td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td>Discount @if($data['invoice']->discount>0)( - )@endif</td>
                            <td>&#2547;{{$data['invoice']->discount}}</td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td>&#2547;{{$data['invoice']->total}}</td>
                        </tr>
            
                    </table>
                </div>
            </div>
  
        </div>

    </div>
    
    <div class="text-center">
        <i class="fa fa-globe"></i> www.jekuno.com<br/>
        <i class="fa fa-facebook-square"></i>  www.facebook.com/jekunobd<br/>
        <img src="data:image/png;base64, {{DNS1D::getBarcodePNG($data['invoice']->id, 'C39',3,33)}} " alt="barcode"   />
    </div>
</div>

</section>
<!-- Section ends -->
@endsection

@section('javascript')
<script>
    window.print();
</script>
    
@endsection