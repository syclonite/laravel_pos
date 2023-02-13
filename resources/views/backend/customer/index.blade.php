@extends('backend.layout')

@section('content')
    <div class="container-fluid">
        <h1 class="d-flex justify-content-center">Customer Management</h1>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <a class="btn btn-success" href="{{route('customers.create')}}">Add New</a>
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
                <th>Customer Name</th>
                <th>Customer Phone</th>
                <th>Customer Email</th>
                <th>Status</th>
                <th>Address</th>
                <th>Remarks</th>

                <th colspan="2" class="text-center" >Action</th>
            </tr>
            <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$customer->name}}</td>
                    <td>{{$customer->phone}}</td>
                    <td>{{$customer->email}}</td>
                    <td>{{$customer->status}}</td>
                    <td>{{$customer->address}}</td>
                    <td>{{$customer->remarks}}</td>
                    <td class="text-center">
                        <form action="{{route('customers.destroy',$customer->id)}}" method="POST">
                            <a class="btn btn-primary" href="{{route('customers.edit', $customer->id)}}">Edit</a>
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
