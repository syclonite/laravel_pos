@extends('backend.layout')

@section('content')
    <div class="container-fluid">
        <h1 class="d-flex justify-content-center">POS Management</h1>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <a class="btn btn-success" href="{{route('sales.create')}}">Add New</a>
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
                <th>Bill No</th>
                <th>Customer</th>
                <th>Billing Amount</th>
                <th>Paid Amount</th>
                <th>Bill By</th>
                <th>Status</th>

                <th colspan="2" class="text-center" >Action</th>
            </tr>
            <tbody>
            @foreach($sale_orders as $sale_order)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$sale_order->id}}</td>
                    <td>{{$sale_order->customer_id}}</td>
                    <td>{{$sale_order->billing_amount}}</td>
                    <td>{{$sale_order->paid_amount}}</td>
                    <td>{{$sale_order->user_id}}</td>
                    <td>{{$sale_order->status}}</td>
                    <td class="text-center">
                        <form action="{{route('sales.destroy',$sale_order->id)}}" method="POST">
                            <a class="btn btn-primary" href="{{route('sales.edit',$sale_order->id)}}">Edit</a>
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
