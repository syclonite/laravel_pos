@extends('backend.layout')

@section('content')
    <div class="container-fluid">
        <h1 class="d-flex justify-content-center">Unit Management</h1>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <a class="btn btn-success" href="{{route('units.create')}}">Add New</a>
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
                <th>Unit Name</th>
                <th>Unit Description</th>
                <th>Status</th>
                <th colspan="2" class="text-center" >Action</th>
            </tr>
            <tbody>
            @foreach($units as $unit)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$unit->unit_name}}</td>
                    <td>{{$unit->unit_description}}</td>
                    <td>{{$unit->status}}</td>
                    <td class="text-center">
                        <form action="{{route('units.destroy',$unit->id)}}" method="POST">
                            <a class="btn btn-primary" href="{{route('units.edit', $unit->id)}}">Edit</a>
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
