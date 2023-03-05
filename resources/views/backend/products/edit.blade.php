@extends('backend.layout')

@section('content')
    <div class="row">
        <div class="col-lg-6 margin-tb">
            <div class="pull-left">
                <h2>Update Product</h2>
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

    <form action="{{route('products.update',$product->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Product Name:</strong>
                    <input type="text" name="product_name" class="form-control" placeholder="Product Name" value="{{$product->product_name}}" >
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>SubCategory Name:</strong>
                    <select name="subcategory_id" id="" class="form-control" >
                        {{--                        <option value=''>Please choose one...</option>--}}
                        @foreach($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}"{{ $product->subcategory_id == $subcategory->id ? 'selected' : '' }}>{{ $subcategory->subcategory_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Unit Name:</strong>
                    <select name="unit_id" id="" class="form-control" >
                        <option value=''>Please choose one...</option>
                        @foreach($units as $unit)
                            <option value="{{ $unit->id }}"{{ $product->unit_id == $unit->id ? 'selected' : '' }}>{{ $unit->unit_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Quantity:</strong>
                    <input type="number" name="quantity" class="form-control" placeholder="Quantity" value="{{$product->quantity}}" >
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Purchase Price:</strong>
                    <input type="number" name="purchase_price" class="form-control" placeholder="Purchase Price" value="{{$product->purchase_price}}" >
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Selling Price:</strong>
                    <input type="number" name="selling_price" class="form-control" placeholder="Selling Price" value="{{$product->selling_price}}" >
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Product Description:</strong>
                    <input class="form-control" type="text" name="product_des" placeholder="Product Description" value="{{$product->product_description}}">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Status:</strong>
                    <select name="status" id="" class="form-control" >
                        <option value='0' {{ $product->status == '0' ? 'selected':'' }}>Disabled</option>
                        <option value='1' {{ $product->status == '1' ? 'selected':'' }}>Enabled</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <br>
                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
            </div>
        </div>

    </form>
@endsection
