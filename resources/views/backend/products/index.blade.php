@extends('backend.layout')

@section('content')
    <div class="container-fluid">
        <h1 class="d-flex justify-content-center">Product Management</h1>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <a class="btn btn-success" href="{{route('products.create')}}">Add New</a>
                </div>
            </div>
        </div>
        <br>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <br>
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Product Name</th>
                <th>Product Description</th>
                <th>Subcategory Name</th>
                <th>Status</th>

                <th colspan="2" class="text-center" >Action</th>
            </tr>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$product->product_name}}</td>
                    <td>{{$product->product_description}}</td>
                    <td>{{$product->subcategory->subcategory_name}}</td>
                    <td>{{$product->status}}</td>
                    <td class="text-center">
                        <form action="{{route('products.destroy',$product->id)}}" method="POST">
                            <a class="btn btn-primary" href="{{route('products.edit', $product->id)}}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
