@extends('backend.layout')

@section('content')
    <div class="row">
        <div class="col-lg-6 margin-tb">
            <div class="pull-left">
                <h2>Add New Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{route('products.index')}}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Modal to Add Unit -->

    <!-- Modal -->
    <div class="modal fade" id="add_unit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_unitLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Unit Name:</strong>
                                <input type="text" name="unit_name" class="form-control" placeholder="Unit Name" id="unit_name" required>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Unit Description:</strong>
                                <input class="form-control" type="text" name="unit_des" placeholder="Unit Description" id="unit_des">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="add_new_unit()">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal to Add Unit -->

    <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Product Name:</strong>
                    <input type="text" name="product_name" class="form-control" placeholder="Product Name" required>
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Unit Name:</strong>
                    <div class="row">
                        <div class="col-10">
                            <select name="unit_id" id="unit_id" class="form-control">
                                <option value=''>Please choose one...</option>
                                @foreach($units??'' as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->unit_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_unit">+</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Quantity Name:</strong>
                    <input type="number" name="quantity" class="form-control" placeholder="Quantity" required>
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Purchase Price:</strong>
                    <input type="number" name="purchase_price" class="form-control" placeholder="Purchase Price" required>
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Selling Price:</strong>
                    <input type="number" name="selling_price" class="form-control" placeholder="Selling Price">
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Product Description:</strong>
                    <input class="form-control" type="text" name="product_des" placeholder="Product Description">
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>SubCategories:</strong>
                    <select name="subcategory_id" id="" class="form-control" required>
                        <option value=''>Please choose one...</option>
                        @foreach($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Status:</strong>
                    <select name="status" id="" class="form-control" >
                        <option value="1">Enabled</option>
                        <option value="0">Disabled</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <br>
                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
            </div>
        </div>
    </form>

    <script>
        function add_new_unit(){
            $.ajax({
                url: "{{route('units.store')}}",
                type: "POST",
                data:{
                    _token:'{{ csrf_token() }}',
                        unit_name: $('#unit_name').val(),
                        unit_des: $('#unit_des').val(),

                },

                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    console.log(dataResult);
                }
            });
            get_ajax_unit();
        }

        function get_ajax_unit(){
            $.ajax({
                url: "{{route('products.get_unit_ajax')}}",
                type: "POST",
                cache: false,
                dataType: 'json',
                data:{
                    _token:'{{ csrf_token() }}',
                    id: "pass",
                },
                success: function(dataResult){
                    console.log(dataResult);
                    var data = dataResult.unit_data_ajax
                    var formoption = "";
                    $.each(data, function(v) {
                        var val = data[v]
                        formoption += "<option value='" + val.id + "'>" + val.unit_name + "</option>";
                    });
                    $('#unit_id').html(formoption);
                }
            });
        }
    </script>


@endsection

