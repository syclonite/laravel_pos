@extends('backend.layout')

@section('content')
    <div class="container-fluid">
        <h1 class="d-flex justify-content-center">Purchase Management</h1>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <a class="btn btn-success" href="{{route('purchase.create')}}">Add New</a>
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
               <th>No</th>
               <th>Bill No</th>
               <th>Supplier Name</th>
               <th>Billing Amount</th>
               <th>Paid Amount</th>
               <th>Discount</th>
               <th>Extra Charge</th>
               <th>Due Amount</th>
               <th>Purchased By</th>
               <th>Status</th>
               <th id="created_at">Date</th>
               <th class="text-center" >Action</th>
           </tr>
           </thead>

            <tbody>
            @foreach($purchaseOrders as $purchaseOrder)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$purchaseOrder->id}}</td>
                    <td>{{$purchaseOrder->supplier_id}}</td>
                    <td>{{$purchaseOrder->billing_amount}}</td>
                    <td>{{$purchaseOrder->paid_amount}}</td>
                    <td>{{$purchaseOrder->discount}}</td>
                    <td>{{$purchaseOrder->extra_charge}}</td>
                    <td>{{'Due Amount'}}</td>
                    <td>{{$purchaseOrder->user_id}}</td>
                    <td>{{$purchaseOrder->status}}</td>
                    <td>{{$purchaseOrder->created_at->format('F d Y')}}</td>
                    <td class="text-center">
                        <form action="{{route('purchase.destroy',$purchaseOrder->id)}}" method="POST">
                            <a class="btn btn-primary" href="{{route('purchase.edit', $purchaseOrder->id)}}">Edit</a>
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
