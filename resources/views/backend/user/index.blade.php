@extends('backend.layout')

@section('content')
    <div class="container-fluid">
        <h1 class="d-flex justify-content-center">User Management</h1>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <a class="btn btn-success" href="{{route('users.create')}}">Add New</a>
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
        <table id="example" class="table table-bordered" >
            <thead>
                <tr>
                    <th>No</th>
                    <th>User Name</th>
                    <th>User Phone</th>
                    <th>User Email</th>
                    <th>Status</th>
                    <th>Category Address</th>
                    <th id="created_at">Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->status}}</td>
                    <td>{{$user->address}}</td>
                    <td>{{$user->created_at->format('F d Y')}}</td>
                    <td class="text-center">
                        <a class="btn btn-primary" href="{{route('users.edit', $user->id)}}">Edit</a>
                        <form action="{{route('users.destroy',$user->id)}}" method="POST">
                            @if($user->deleted_at == null || $user->deleted_at == '')
                                @csrf
                                @method('DELETE')
                                <button type="submit"  class="btn btn-danger">Delete</button>
                            @endif
                        </form>
                        <form action="{{route('users.restore',$user->id)}}" method="POST">
                            @if($user->deleted_at != null || $user->deleted_at != '')
                                @csrf
                                @method('POST')
                                <button type="submit"  class="btn btn-success">Restore</button>
                            @endif
                        </form>
                        <form action="{{route('users.force_delete',$user->id)}}" method="POST">
                            @if($user->deleted_at != null || $user->deleted_at != '')
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
