@extends('backend.layout')

@section('content')
    <div class="container-fluid">
        <h1 class="d-flex justify-content-center">Expense Management</h1>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <a class="btn btn-success" href="{{route('expense_record.create')}}">Add New</a>
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
                <th>Expense Type</th>
                <th>Expense Amount</th>
                <th>Remarks</th>
                <th>Status</th>

                <th colspan="2" class="text-center" >Action</th>
            </tr>
            <tbody>
            @foreach($expense_records as $expense_record)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$expense_record->id}}</td>
                    <td>{{$expense_record->type}}</td>
                    <td>{{$expense_record->amount}}</td>
                    <td>{{$expense_record->remarks}}</td>
                    <td>{{$expense_record->status}}</td>
                    <td class="text-center">
                        <form action="{{route('expense_record.destroy',$expense_record->id)}}" method="POST">
                            <a class="btn btn-primary" href="{{route('expense_record.edit',$expense_record->id)}}">Edit</a>
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
