@extends('layouts.dashboard')
@section('title')
Add Vendor
@endsection

@section('stylesheet')


@endsection

@section('content')


<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5>Add Vendor</h5>
        </div>
        <div class="card-body">
            <div class="row product-adding">
                <div class="col-xl-12">
                    <form action="{{ url('dashboard/vendors/store') }}" class="needs-validation add-product-form" novalidate="" method="POST" enctype="multipart/form-data">
                        @method('PATCH')
                        <div class="form">
                            <div class="form-group mb-3 row">
                                <label for="name" class="col-xl-3 col-sm-4 mb-0">Name :</label>
                                <input class="form-control col-xl-8 col-sm-7" id="name" type="text" name="name" required="" placeholder="Vendor Name">
                                <div class="valid-feedback">Looks good!</div>
                            </div>
 
                            <div class="form-group mb-3 row">
                                <label for="name" class="col-xl-3 col-sm-4 mb-0">Phone :</label>
                                <input class="form-control col-xl-8 col-sm-7" id="phone" type="text" name="phone" maxlength="11" required="" placeholder="017xxxxxxxx">
                                <div class="valid-feedback">Looks good!</div>
                            </div>

                            <div class="form-group mb-3 row">
                                <label for="name" class="col-xl-3 col-sm-4 mb-0">Address :</label>
                                <input class="form-control col-xl-8 col-sm-7" id="address" type="text" name="address" required="" placeholder="Address">
                                <div class="valid-feedback">Looks good!</div>
                            </div>
             

                            <div class="form-group mb-3 row">
                                <label for="name" class="col-xl-3 col-sm-4 mb-0">Payment Information :</label>
                                <input class="form-control col-xl-8 col-sm-7" id="payment_info" type="text" name="payment_info" required="" placeholder="Nagad - 018xxxxxxxx">
                                <div class="valid-feedback">Looks good!</div>
                            </div>

         
                        </div>
                        <div class="offset-xl-3 offset-sm-4">
                            <button type="submit" class="btn btn-primary">Add</button>
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