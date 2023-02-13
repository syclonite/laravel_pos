@extends('backend.layout')

@section('content')
    <div class="row">
        <div class="col-lg-6 margin-tb">
            <div class="pull-left">
                <h2>Add New Role</h2>
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

    <form action="{{route('roles.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Role Name:</strong>
                    <input type="text" name="role_name" class="form-control" placeholder="Role Name">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Role Description:</strong>
                    <input class="form-control" type="text" name="role_des" placeholder="Role Description">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Status:</strong>
                    <select name="status" id="" class="form-control" >
                        <option value="0">Disabled</option>
                        <option value="1">Enabled</option>
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
