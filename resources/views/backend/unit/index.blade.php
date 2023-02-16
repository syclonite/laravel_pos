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
                <th>Unit Name</th>
                <th>Unit Description</th>
                <th>Status</th>
                <th id="created_at">Date</th>
                <th class="text-center" >Action</th>
            </tr>
            </thead>

            <tbody>
            @foreach($units as $unit)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$unit->unit_name}}</td>
                    <td>{{$unit->unit_description}}</td>
                    <td>{{$unit->status}}</td>
                    <td>{{$unit->created_at->format('F d Y')}}</td>
                    <td class="text-center">
                        <a class="btn btn-primary" href="{{route('units.edit', $unit->id)}}">Edit</a>
                        <form action="{{route('units.destroy',$unit->id)}}" method="POST">
                            @if($unit->deleted_at == null || $unit->deleted_at == '')
                                @csrf
                                @method('DELETE')
                                <button type="submit"  class="btn btn-danger">Delete</button>
                            @endif
                        </form>
                        <form action="{{route('units.restore',$unit->id)}}" method="POST">
                            @if($unit->deleted_at != null || $unit->deleted_at != '')
                                @csrf
                                @method('POST')
                                <button type="submit"  class="btn btn-success">Restore</button>
                            @endif
                        </form>
                        <form action="{{route('units.force_delete',$unit->id)}}" method="POST">
                            @if($unit->deleted_at != null || $unit->deleted_at != '')
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
