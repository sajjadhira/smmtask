@extends('layouts.dashboard')
@section('title')
Edit Cupon
@endsection

@section('stylesheet')


@endsection

@section('content')


<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5>Add Cupon</h5>
        </div>
        <div class="card-body">
            <div class="row product-adding">
                <div class="col-xl-12">
                    <form action="{{ url('dashboard/cupons/update/'.$data['cupon']->id) }}" class="needs-validation add-product-form" novalidate="" method="POST" enctype="multipart/form-data">
                        @method('PATCH')
                        <div class="form">
                            <div class="form-group mb-3 row">
                                <label for="name" class="col-xl-3 col-sm-4 mb-0">Code :</label>
                                <input class="form-control col-xl-8 col-sm-7" id="code" type="text" name="code" required="" placeholder="Cupon Code" value="{{$data['cupon']->code}}">
                                <div class="valid-feedback">Looks good!</div>
                            </div>
 
                            <div class="form-group mb-3 row">
                                <label for="name" class="col-xl-3 col-sm-4 mb-0">Discount Type :</label>
                                @php
                                    $types = ['flat'=>'Flat Discount','parcent'=>'Parcent Discount'];
                                @endphp
                                <select class="form-control col-xl-8 col-sm-7" id="discount_type" name="discount_type" required="">
                                @foreach ($types as $key=>$type)
                                    <option value="{{$key}}"  @if($key==$data['cupon']->discount_type) selected @endif>{{$type}}</option>
                                @endforeach
                                </select>
                                <div class="valid-feedback">Looks good!</div>
                            </div>

                            <div class="form-group mb-3 row">
                                <label for="name" class="col-xl-3 col-sm-4 mb-0">Discount :</label>
                                <input class="form-control col-xl-8 col-sm-7" id="discount" type="number" name="discount" required="" placeholder="Example - 15/20/21" value="{{$data['cupon']->discount}}">
                                <div class="valid-feedback">Looks good!</div>
                            </div>
             

                            <div class="form-group mb-3 row">
                                <label for="name" class="col-xl-3 col-sm-4 mb-0">Starting At :</label>
                                <input class="form-control col-xl-8 col-sm-7" id="starting_at" type="date" name="starting_at" required=""  value="{{date("Y-m-d",strtotime($data['cupon']->starting_at))}}">
                                <div class="valid-feedback">Looks good!</div>
                            </div>

                            <div class="form-group mb-3 row">
                                <label for="name" class="col-xl-3 col-sm-4 mb-0">Ending At :</label>
                                <input class="form-control col-xl-8 col-sm-7" id="ending_at" type="date" name="ending_at" required="" value="{{date("Y-m-d",strtotime($data['cupon']->ending_at))}}">
                                <div class="valid-feedback">Looks good!</div>
                            </div>

         
                        </div>
                        <div class="offset-xl-3 offset-sm-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" onclick="window.history.go(-1)" class="btn btn-light">Discard</button>
                        </div>

                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('javascript')

<!-- touchspin js-->
<script src="{!! url('assets/js/touchspin/vendors.min.js') !!}"></script>
<script src="{!! url('assets/js/touchspin/touchspin.js') !!}"></script>
<script src="{!! url('assets/js/touchspin/input-groups.min.js') !!}"></script>

<!-- form validation js-->
<script src="{!! url('assets/js/dashboard/form-validation-custom.js') !!}"></script>

<!-- ckeditor js-->
<script src="{!! url('assets/js/editor/ckeditor/ckeditor.js') !!}"></script>
<script src="{!! url('assets/js/editor/ckeditor/styles.js') !!}"></script>
<script src="{!! url('assets/js/editor/ckeditor/adapters/jquery.js') !!}"></script>
<script src="{!! url('assets/js/editor/ckeditor/ckeditor.custom.js') !!}"></script>

<!-- Zoom js-->
<script src="{!! url('assets/js/jquery.elevatezoom.js') !!}"></script>
<script src="{!! url('assets/js/zoom-scripts.js') !!}"></script>


<!-- lazyload js-->
<script src="{!! url('assets/js/lazysizes.min.js') !!}"></script>

<!--right sidebar js-->
<script src="{!! url('assets/js/chat-menu.js') !!}"></script>

<!--script admin-->
<script src="{!! url('assets/js/admin-script.js') !!}"></script>

<script type="text/javascript">


</script>

@endsection