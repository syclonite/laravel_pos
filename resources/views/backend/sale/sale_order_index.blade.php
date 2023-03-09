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
        <table class="table table-bordered" id="example">
            <thead>
            <tr>
                <th>No </th>
                <th>Bill No</th>
                <th>Customer</th>
                <th>Billing</th>
                <th>Paid</th>
                <th>Billed By</th>
                <th>Status</th>
                <th id="created_at">Date</th>

                <th class="text-center" >Action</th>
            </tr>
            </thead>

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
                    <td>{{$sale_order->created_at->format('F d Y')}}</td>
                    <td class="text-center d-flex d-inline-flex">
                        <form action="{{route('sales.destroy',$sale_order->id)}}" method="POST">
                            <a class="btn btn-primary" href="{{route('sales.edit',$sale_order->id)}}">Edit</a>
                            <a class="btn btn-warning" href="{{route('sales.print_sale_invoice',$sale_order->id)}}">Print</a>
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
