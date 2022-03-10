@extends('layouts.'.$data['language'].'.printable')

@section('title')
   Bulk Invoice
@endsection
@section('css')
<style>
    @media print { @page {  
    margin-top: 50px;
  } 
    
     body { margin: 1.6cm; } 
     .page-break {page-break-after: always;}
     
     }
  </style>   
@endsection

@section('content')
 
@foreach ($data['invoices'] as $invoice)
    

<!-- order-detail section start -->
<section class="section-big-py-space mt--5 bg-light">

    <div class="card order-container">
        <div >
            <img src="{{url('images/logo-black.png')}}"  style="filter: grayscale(100%);">
        </div>
        <br/><br/>
        <div class="row">
            <div class="col-md-12">
                <div class="row order-success-sec">
                    <div class="col-sm-6">
                        
                        <h4>Order Summary</h4>
                        <ul class="order-detail">
                            <li>Invoice # {{$invoice->id}}</li>
                            <li>Order Date: {{date('d F, Y',strtotime($invoice->created_at))}}</li>
                            <li>Order Total: &#2547;{{$invoice->total}}</li>
                            <li>Payment Method:  @if ($invoice->payment_type=='cod')
                                Cash On Delivery
                                @elseif ($invoice->payment_type=='bkash')
                                bKash
                                @elseif ($invoice->payment_type=='nagad')
                                Nagad
                                @elseif ($invoice->payment_type=='cash')
                                Cash
                                @endif</li>
                        </ul>
                    </div>

                    @php
                        if($invoice->delivery_option == 'inside-dhaka'){
                            $add_time  = 1*24*3600;
                        }else {
                            $add_time = 2*24*3600;
                        }
                    @endphp

                    <div class="col-sm-6">

                        <ul class="order-detail">
                            <li>Customer Name: {{\App\Users::findOrFail($invoice->user)->name}}</li>
                            <li>Mobile No: {{$invoice->phone}}</li>
                            <li>Delivery Address: {{$invoice->address}}</li>
                            @php
                                $da = \App\Deliveryagents::find($invoice->delivery_agent);
                            @endphp
                            <li>Delivery Partner:
                                @if(file_exists('images/'.$da->logo))    
                                <img src="{{url('images/'.$da->logo)}}" alt="{{$da->name}}" style="filter: grayscale(100%);height:30px;">
                                @else
                                {{$da->name}}
                                @endif
                            
                            </li>

                            @if($invoice->delivery_tracking != "")
                            <li>Delivery Tracking: <b>{{$invoice->delivery_tracking}}</b></li>
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
    
                    @php
                        
                        $orders = \App\Orders::where(['invoice'=>$invoice->id])->get();

                    @endphp

                    @foreach ($orders as $order)

                    @php
                        $product = \App\Products::findOrFail($order->product);
                    @endphp
                        <tr>
                            <td>{{$product->name}}</td>
                            
                            <td> @if($order->orginal_price>$order->price)<small><del>&#2547;{{$order->orginal_price}}</del></small> @endif&#2547;{{$order->price,2}}</td>
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
                            <td>&#2547;{{$invoice->subtotal}}</td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td>Delivery Charge</td>
                            <td>&#2547;{{number_format($invoice->delivery_charge,2)}}</td>
                        </tr>
                        @if($invoice->discount>0)
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Discount @if($invoice->discount>0)( - )@endif</td>
                            <td>&#2547;{{number_format($invoice->discount,2)}}</td>
                        </tr>
                        @endif
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td>&#2547;{{number_format($invoice->total,2)}}</td>
                        </tr>

                        @if($invoice->paid>0)
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Paid @if($invoice->paid>0)( - )@endif</td>
                            <td>&#2547;{{number_format($invoice->paid,2)}}</td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td>Due</td>
                            <td>&#2547;{{number_format($invoice->due,2)}}</td>
                        </tr>
                        @endif
            
                    </table>
                </div>
            </div>
  
        </div>

    </div>
    
    <div class="text-center">
        <i class="fa fa-globe"></i> www.jekuno.com<br/>
        <i class="fa fa-facebook-square"></i>  www.facebook.com/jekunobd
        <br/>
        <br/>
        <img src="data:image/png;base64, {{DNS1D::getBarcodePNG($invoice->id, 'C39',3,33)}} " alt="barcode"   />
        <br/>
        <br/>
        Thanks for shopping with jekuno.com
    </div>
</div>

</section>
<!-- Section ends -->
<div class="page-break"></div>
@endforeach

@endsection

@section('javascript')
<script>
    window.print();
</script>
    
@endsection