@extends('layouts.dashboard')

@section('page-title', 'Create Category')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            Create Category
          </div>
          @include('errors')
          <div class="card-body">
            <form action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" class="form-control" name="name" value="{{old('name')}}" id="name" placeholder="Enter category name" required>
              </div>
              <div class="form-group">
                <label for="image" class="form-label">Category Image</label>
                <input type="file" class="form-control-file" name="category_picture" id="image" required accept="image/*">
              </div>
              <select class="form-control mb-3" name="category_status" aria-label="Default select example">
                <option value="active">Active</option>
                <option value="disabled">Disabled</option>
              </select>
              <select class="form-control mb-3" name="product_of_category_status" aria-label="Default select example">
                <option value="featured">Featured</option>
                <option value="popular">Popular</option>
                <option value="best-seller">Best Seller</option>
              </select>
                <button type="submit" class="btn btn-success">Create</button>
              </form>
            </div>
          </div>
        </div>
    </div>
  </div>
@endsection