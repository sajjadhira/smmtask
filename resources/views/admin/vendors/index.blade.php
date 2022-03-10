@extends('layouts.dashboard')
@section('title')
Vendors
@endsection

@section('stylesheet')


@endsection

@section('content')


<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5>Vendors</h5>

            <div class="pull-right">
                
            </div>
        </div>
        <div class="card-body">
            <div class="row product-adding">
                <div class="col-xl-12">

                    <table class="table">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Balance</th>
                            <th>Total Paid</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['vendors'] as $vendor)
                            <tr>
                                <td>{{$vendor->name}}</td>
                                <td><a href="tel:{{$vendor->phone}}">{{$vendor->phone}}</a></td>
                                <td>&#2547;{{ $vendor->balance}}</td>
                                <td>&#2547;{{ $vendor->paid}}</td>
                                <td><a href="{{ url('dashboard/vendors/edit/'.$vendor->id) }}">Edit</a></td>
                              </tr>          
                            @endforeach

        
                        </tbody>
                      </table>
                      
                      <div class="text-center">
                      {{$data['vendors']->links()}}
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection



