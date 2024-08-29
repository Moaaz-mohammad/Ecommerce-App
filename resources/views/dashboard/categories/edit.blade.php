@extends('layouts.dashboard')

@section('page-title', 'Edit Category')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-8">
        <div class="card">
          <div class="card-header">
            Edit Category
          </div>
          @include('errors')
          <div class="card-body">
            <form action="{{route('categories.update', $category->id)}}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{$category->name}}" placeholder="Enter category name" required>
              </div>
              <div class="form-group">
                <label for="image" class="form-label">Category Image</label>
                <input type="file" class="form-control-file" name="category_picture" id="image" accept="image/*">
              </div>
              <button type="submit" class="btn btn-success">Save</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card">
          <div class="card-header">
            Category Image
          </div>
          <div class="card-body w-100 text-center">
            <img src="{{asset('storage/categories/'. $category->image->path)}}" alt="" class="img-fluid">
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection