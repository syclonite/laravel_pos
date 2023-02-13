@extends('backend.layout')

@section('content')
    <div class="container-fluid">
        <h1 class="d-flex justify-content-center">Category Management</h1>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <a class="btn btn-success" href="{{route('categories.create')}}">Add New</a>
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
                <th>Category Name</th>
                <th>Category Description</th>
                <th>Status</th>

                <th colspan="2" class="text-center" >Action</th>
            </tr>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$category->category_name}}</td>
                    <td>{{$category->category_description}}</td>
                    <td>{{$category->status}}</td>
                    <td class="text-center">
                        <form action="{{route('categories.destroy',$category->id)}}" method="POST">
                            <a class="btn btn-primary" href="{{route('categories.edit', $category->id)}}">Edit</a>
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
