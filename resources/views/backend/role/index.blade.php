@extends('backend.layout')

@section('content')
    <div class="container-fluid">
        <h1 class="d-flex justify-content-center">Role Management</h1>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <a class="btn btn-success" href="{{route('roles.create')}}">Add New</a>
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
               <th>Role Name</th>
               <th>Role Description</th>
               <th>Status</th>
               <th id="created_at">Date</th>

               <th class="text-center" >Action</th>
           </tr>
           </thead>

            <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$role->role_name}}</td>
                    <td>{{$role->role_description}}</td>
                    <td>{{$role->status}}</td>
                    <td>{{$role->created_at->format('F d Y')}}</td>
                    <td class="text-center">
                        <a class="btn btn-primary" href="{{route('roles.edit', $role->id)}}">Edit</a>
                        <form action="{{route('roles.destroy',$role->id)}}" method="POST">
                            @if($role->deleted_at == null || $role->deleted_at == '')
                                @csrf
                                @method('DELETE')
                                <button type="submit"  class="btn btn-danger">Delete</button>
                            @endif
                        </form>
                        <form action="{{route('roles.restore',$role->id)}}" method="POST">
                            @if($role->deleted_at != null || $role->deleted_at != '')
                                @csrf
                                @method('POST')
                                <button type="submit"  class="btn btn-success">Restore</button>
                            @endif
                        </form>
                        <form action="{{route('roles.force_delete',$role->id)}}" method="POST">
                            @if($role->deleted_at != null || $role->deleted_at != '')
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
