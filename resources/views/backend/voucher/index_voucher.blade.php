@extends('backend.layout')

@section('content')
    <div class="container-fluid">
        <h1 class="d-flex justify-content-center">Voucher Management</h1>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <a class="btn btn-success" href="{{route('voucher.create_voucher')}}">Add New</a>
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
                <th>Customer</th>
                <th>Total Bill</th>
                <th>Extra Charge</th>
                <th>Discount</th>
                <th id="created_at">Date</th>
                <th class="text-center" >Action</th>
            </tr>
            </thead>

            <tbody>
            @foreach($vouchers as $voucher)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$voucher->customer_id}}</td>
                    <td>{{$voucher->billing_amount}}</td>
                    <td>{{$voucher->discount}}</td>
                    <td>{{$voucher->extra_charge}}</td>
                    <td>{{$voucher->created_at->format('F d Y')}}</td>
                    <td class="text-center">
                        <form action="{{route('voucher.destroy',$voucher->id)}}" method="POST">
                            <a class="btn btn-primary" href="{{route('voucher.print_voucher',$voucher->id)}}">Print</a>
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
