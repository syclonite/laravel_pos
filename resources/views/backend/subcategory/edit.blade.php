@extends('backend.layout')

@section('content')
    <div class="row">
        <div class="col-lg-6 margin-tb">
            <div class="pull-left">
                <h2>Update SubCategory</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{route('subcategories.index')}}"> Back</a>
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

    <form action="{{route('subcategories.update',$subcategory->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>SubCategory Name:</strong>
                    <input type="text" name="subcategory_name" class="form-control" placeholder="SubCategory Name" value="{{$subcategory->subcategory_name}}" >
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>SubCategory Description:</strong>
                    <input class="form-control" type="text" name="subcategory_des" placeholder="SubCategory Description" value="{{$subcategory->subcategory_description}}">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>SubCategory Description:</strong>
                    <input class="form-control" type="text" name="subcategory_des" placeholder="SubCategory Description" value="{{$subcategory->subcategory_description}}">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Category Name:</strong>
                    <select name="category_id" id="" class="form-control" >
{{--                        <option value=''>Please choose one...</option>--}}
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"{{ $subcategory->category_id == $category->id ? 'selected' : '' }}>{{ $category->category_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Status:</strong>
                    <select name="status" id="" class="form-control" >
                        <option value='0' {{ $subcategory->status == '0' ? 'selected':'' }}>Disabled</option>
                        <option value='1' {{ $subcategory->status == '1' ? 'selected':'' }}>Enabled</option>
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
