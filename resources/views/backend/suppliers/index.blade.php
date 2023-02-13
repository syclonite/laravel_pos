@extends('backend.layout')

@section('content')
    <div class="container-fluid">
        <h1 class="d-flex justify-content-center">Supplier Management</h1>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <a class="btn btn-success" href="{{route('suppliers.create')}}">Add New</a>
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
                <th>Supplier Name</th>
                <th>Supplier Phone</th>
                <th>Address</th>
                <th>Remarks</th>
                <th>Status</th>

                <th colspan="2" class="text-center" >Action</th>
            </tr>
            <tbody>
            @foreach($suppliers as $supplier)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$supplier->supplier_name}}</td>
                    <td>{{$supplier->phone_1}}</td>
                    <td>{{$supplier->address}}</td>
                    <td>{{$supplier->remarks}}</td>
                    <td>{{$supplier->status}}</td>
                    <td class="text-center">
                        <form action="{{route('suppliers.destroy',$supplier->id)}}" method="POST">
                            <a class="btn btn-primary" href="{{route('suppliers.edit', $supplier->id)}}">Edit</a>
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
