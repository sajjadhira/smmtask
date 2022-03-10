@extends('layouts.'.$data['language'].'.printable')

@section('title')
    buy_list_{{date('Y_m_d')}}
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
            <img src="{{url('images/logo-black.png')}}">
        </div>
        <br/><br/>
        <div class="row">
            <div class="col-md-12">

            <div class="col-md-12 col-12">
                <div class="product-order">
                    <h4 class="text-center">Product Buy List - {{date("d F Y")}}</h4>

                    <table class="table">
        
                        <tr class="table-head">
                            <th>Invoice</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                        </tr>
    
                    @php
                        $total = 0;
                        $invoice_count = 0;
                    @endphp

                    @foreach ($data['invoices'] as $invoice)


                    @php
                    $orders = \App\Orders::where('invoice','=',$invoice->id)->get();
                    $invoice_count++;
                    @endphp

                    @foreach ($orders as $item)
                        
                        @php
                        $product = \App\Products::findOrFail($item->product);
                        @endphp
                        <tr>
                            <td>{{$item->invoice}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>@if(isset($data['show_price'])){{$product->buy_price}}@endif</td>
                            <td>@if(isset($data['show_price'])){{$item->quantity*$product->buy_price}}@endif</td>
                        </tr>
                        @php
                            $total+= ($item->quantity*$product->buy_price);
                        @endphp
                        @endforeach

                        @endforeach
                    <tr>
                        <td colspan="5"></td>
                    </tr>
                    @if(isset($data['show_price']))
                    <tr>
                        <td colspan="3" class="text-right">Subtotal</td>
                        <td></td>
                        <td>{{$total}}</td>
                    </tr>

                    <tr>
                        <td colspan="3" class="text-right">Packageing</td>
                        <td class="text-right">{{$invoice_count}}x9</td>
                        <td>{{$invoice_count*9}}</td>
                    </tr>
                    <td colspan="3" class="text-right">Total</td>
                    <td></td>
                    <td>{{$total + ($invoice_count*3)}}</td>
                    <tr>

                    </tr>

                    @endif
                    </table>
                </div>
            </div>
  
        </div>

    </div>
    

</div>

</section>
<!-- Section ends -->
@endsection

@section('javascript')
<script>
    // window.print();
</script>
    
@endsection