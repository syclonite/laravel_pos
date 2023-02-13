@extends('backend.layout')

@section('content')
    <div class="row">
        <div class="col-lg-6 margin-tb">
            <div class="pull-left">
                <h2>Update Role</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{route('roles.index')}}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('roles.update',$role->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Role Name:</strong>
                    <input type="text" name="role_name" class="form-control" placeholder="Role Name" value="{{$role->role_name}}" >
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Role Description:</strong>
                    <input class="form-control" type="text" name="role_des" placeholder="Role Description" value="{{$role->role_description}}">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Status:</strong>
                    <select name="status" id="" class="form-control" >
                        <option value='0' {{ $role->status == '0' ? 'selected':'' }}>Disabled</option>
                        <option value='1' {{ $role->status == '1' ? 'selected':'' }}>Enabled</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <br>
                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
            </div>
        </div>

    </form>
@endsection
