@extends('layouts.dashboard')
@section('title')
Categories
@endsection

@section('stylesheet')


@endsection

@section('content')


<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5>All Categories</h5>

            <div class="pull-right">
                <a href="{{url('dashboard/categories/create')}}">Add New</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row product-adding">
                <div class="col-xl-12">

                    <table class="table">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Total Subcategories</th>
                            <th>Total Products</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['categories'] as $category)
                            <tr>
                                <td>{{$category->name}}</td>
                                <td>{{$data['subcatcount_'.$category->id]}}</td>
                                <td>{{$data['productcount_'.$category->id]}}</td>
                                <td><a href="{{ url('dashboard/categories/edit/'.$category->id) }}">Edit</a></td>
                              </tr>          
                            @endforeach

        
                        </tbody>
                      </table>
                      
                      <div class="text-center">
                      {{$data['categories']->links()}}
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection



