@extends('layouts.dashboard')
@section('title')
Create Category
@endsection

@section('stylesheet')


@endsection

@section('content')


<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5>Add Category</h5>
        </div>
        <div class="card-body">
            <div class="row product-adding">
                <div class="col-xl-12">
                    <form action="{{ url('dashboard/categories/store') }}" class="needs-validation add-product-form" novalidate="" method="POST" enctype="multipart/form-data">
                        @method('PATCH')
                        <div class="form">
                            <div class="form-group mb-3 row">
                                <label for="name" class="col-xl-3 col-sm-4 mb-0">Name :</label>
                                <input class="form-control col-xl-8 col-sm-7" id="name" type="text" name="name" required="" placeholder="Category Name" autofocus>
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                        <div class="form">
                            <div class="form-group mb-3 row">
                                <label for="image" class="col-xl-3 col-sm-4 mb-0">Image :</label>
                                <ul class="file-upload-product">
                                    <li><div class="box-input-file"><input class="upload" name="image" type="file"></div></li>
                                </ul>
                                <div class="valid-feedback">Looks good!</div>
                            </div>

                        </div>
 
             
                        </div>
                        <div class="offset-xl-3 offset-sm-4">
                            <button type="submit" class="btn btn-primary">Add</button>
                            <button type="reset" class="btn btn-light">Discard</button>
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
$(document).ready(function () {

    $(document).on('change','#category',function( e ) {

        var category = $(this).val();
        var url = "{{ url('dashboard/subcates') }}/" + category;

        $.ajax({   
        type : 'GET',
        url  : url,
        success : function(data)
            {
                // alert(data);return false;

                $('#subcategory').empty();
                var opts = $.parseJSON(data);
                // Use jQuery's each to iterate over the opts value
                $.each(opts, function(i, d) {
                    // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
                    $('#subcategory').append('<option value="' + d.id + '">' + d.name + '</option>');
                });

            }
        });

    });

    $(document).on('keyup','#name',function( e ) {
        var name = $("#name").val();
        var subcate = $('#subcategory').val();
        var price = $('#price').val();
        
        var nameF  = name.replace(/\s/g, '').toLowerCase();
        var subcatF  = subcate.replace(/\s/g, '').toLowerCase();
        var priceF  = price.replace(/\./g, '').toLowerCase();
        var code  = nameF + subcatF + priceF;

        $('#code').val(code);

    });

    $(document).on('keyup','#price',function( e ) {
        var name = $("#name").val();
        var subcate = $('#subcategory').val();
        var price = $('#price').val();
        
        var nameF  = name.replace(/\s/g, '').toLowerCase();
        var subcatF  = subcate.replace(/\s/g, '').toLowerCase();
        var priceF  = price.replace(/\./g, '').toLowerCase();
        var code  = nameF + subcatF + priceF;

        $('#code').val(code);

    });

    $(document).on('change','#subcategory',function( e ) {
        var name = $("#name").val();
        var subcate = $('#subcategory').val();
        var price = $('#price').val();
        
        var nameF  = name.replace(/\s/g, '').toLowerCase();
        var subcatF  = subcate.replace(/\s/g, '').toLowerCase();
        var priceF  = price.replace(/\./g, '').toLowerCase();
        var code  = nameF + subcatF + priceF;

        $('#code').val(code);

    });

});

</script>

@endsection