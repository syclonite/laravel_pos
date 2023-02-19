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
        <table border="0" cellspacing="5" cellpadding="5">
            <tbody><tr>
                <td>Minimum date:</td>
                <td><input type="text" id="min" name="min"></td>
            </tr>
            <tr>
                <td>Maximum date:</td>
                <td><input type="text" id="max" name="max"></td>
            </tr>
            </tbody></table>
        <br>
        <table id="example" class="table table-bordered" >
            <thead>
                <tr>
                    <th>No</th>
                    <th>Customer Name</th>
                    <th>Customer Phone</th>
                    <th>Customer Email</th>
                    <th>Status</th>
                    <th>Address</th>
                    <th>Remarks</th>
                    <th id="created_at">Date</th>
                    <th>Action</th>
                </tr>
            </thead>

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
                    <td>{{$customer->created_at->format('F d Y')}}</td>
                    <td class="text-center">
                        <a class="btn btn-primary" href="{{route('customers.edit', $customer->id)}}">Edit</a>
                        <form action="{{route('customers.destroy',$customer->id)}}" method="POST">
                            @if($customer->deleted_at == null || $customer->deleted_at == '')
                                @csrf
                                @method('DELETE')
                                <button type="submit"  class="btn btn-danger">Delete</button>
                            @endif
                        </form>
                        <form action="{{route('customers.restore',$customer->id)}}" method="POST">
                            @if($customer->deleted_at != null || $customer->deleted_at != '')
                                @csrf
                                @method('POST')
                                <button type="submit"  class="btn btn-success">Restore</button>
                            @endif
                        </form>
                        <form action="{{route('customers.force_delete',$customer->id)}}" method="POST">
                            @if($customer->deleted_at != null || $customer->deleted_at != '')
                                @csrf
                                @method('DELETE')
                                <button type="submit"  class="btn btn-warning">Force Delete</button>
                            @endif
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
