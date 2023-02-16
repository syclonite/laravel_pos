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
                    <th>Category Name</th>
                    <th>Category Description</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th class="text-center" >Action</th>
                </tr>
            </thead>

            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$category->category_name}}</td>
                    <td>{{$category->category_description}}</td>
                    <td>{{$category->status}}</td>
                    <td>{{$category->created_at->format('F d Y')}}</td>
                    <td class="text-center">
                        <a class="btn btn-primary" href="{{route('categories.edit', $category->id)}}">Edit</a>
                        <form action="{{route('categories.destroy',$category->id)}}" method="POST">
                            @if($category->deleted_at == null || $category->deleted_at == '')
                                @csrf
                                @method('DELETE')
                                <button type="submit"  class="btn btn-danger">Delete</button>
                            @endif
                        </form>
                        <form action="{{route('categories.restore',$category->id)}}" method="POST">
                            @if($category->deleted_at != null || $category->deleted_at != '')
                                @csrf
                                @method('POST')
                                <button type="submit"  class="btn btn-success">Restore</button>
                            @endif
                        </form>
                        <form action="{{route('categories.force_delete',$category->id)}}" method="POST">
                            @if($category->deleted_at != null || $category->deleted_at != '')
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
