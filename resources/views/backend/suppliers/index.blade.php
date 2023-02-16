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
        <table class="table table-bordered" id="example">
           <thead>
           <tr>
               <th>No</th>
               <th>Supplier Name</th>
               <th>Supplier Phone</th>
               <th>Address</th>
               <th>Remarks</th>
               <th>Status</th>
               <th id="created_at">Date</th>

               <th class="text-center" >Action</th>
           </tr>
           </thead>

            <tbody>
            @foreach($suppliers as $supplier)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$supplier->supplier_name}}</td>
                    <td>{{$supplier->phone_1}}</td>
                    <td>{{$supplier->address}}</td>
                    <td>{{$supplier->remarks}}</td>
                    <td>{{$supplier->status}}</td>
                    <td>{{$supplier->created_at->format('F d Y')}}</td>
                    <td class="text-center">
                        <a class="btn btn-primary" href="{{route('suppliers.edit', $supplier->id)}}">Edit</a>
                        <form action="{{route('suppliers.destroy',$supplier->id)}}" method="POST">
                            @if($supplier->deleted_at == null || $supplier->deleted_at == '')
                                @csrf
                                @method('DELETE')
                                <button type="submit"  class="btn btn-danger">Delete</button>
                            @endif
                        </form>
                        <form action="{{route('suppliers.restore',$supplier->id)}}" method="POST">
                            @if($supplier->deleted_at != null || $supplier->deleted_at != '')
                                @csrf
                                @method('POST')
                                <button type="submit"  class="btn btn-success">Restore</button>
                            @endif
                        </form>
                        <form action="{{route('suppliers.force_delete',$supplier->id)}}" method="POST">
                            @if($supplier->deleted_at != null || $supplier->deleted_at != '')
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
