@extends('backend.layout')

@section('content')
    <div class="container-fluid">
        <h1 class="d-flex justify-content-center">SubCategory Management</h1>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <a class="btn btn-success" href="{{route('subcategories.create')}}">Add New</a>
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
                <th>SubCategory Name</th>
                <th>SubCategory Description</th>
                <th>Category Name</th>
                <th>Status</th>

                <th colspan="2" class="text-center" >Action</th>
            </tr>
            <tbody>
            @foreach($subcategories as $subcategory)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$subcategory->subcategory_name}}</td>
                    <td>{{$subcategory->subcategory_description}}</td>
                    <td>{{$subcategory->category->category_name}}</td>
                    <td>{{$subcategory->status}}</td>
                    <td class="text-center">
                        <a class="btn btn-primary" href="{{route('subcategories.edit', $subcategory->id)}}">Edit</a>
                        <form action="{{route('subcategories.destroy',$subcategory->id)}}" method="POST">
                            @if($subcategory->deleted_at == null || $subcategory->deleted_at == '')
                                @csrf
                                @method('DELETE')
                                <button type="submit"  class="btn btn-danger">Delete</button>
                            @endif
                        </form>
                        <form action="{{route('subcategories.restore',$subcategory->id)}}" method="POST">
                            @if($subcategory->deleted_at != null || $subcategory->deleted_at != '')
                                @csrf
                                @method('POST')
                                <button type="submit"  class="btn btn-success">Restore</button>
                            @endif
                        </form>
                        <form action="{{route('subcategories.force_delete',$subcategory->id)}}" method="POST">
                            @if($subcategory->deleted_at != null || $subcategory->deleted_at != '')
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
