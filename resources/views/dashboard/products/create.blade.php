@extends('layouts.dashboard')

@section('page-title', 'CreateCategory')
@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            Create Product
          </div>
          @include('errors')
          <div class="card-body">
            <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
              @csrf
                  <div class="form-group">
                    <label for="category_id">Product Category</label>
                    <select id="category_id" name="category_id" required class="form-control">
                      @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                      @endforeach
                    </select>
                  </div>
              <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" name="name" value="{{old('name')}}" id="name" placeholder="Enter product name" required>
              </div>
              <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="text" class="form-control" name="stock" value="{{old('stock')}}" id="stock" placeholder="Enter product stock" required>
              </div>
              <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" name="price" value="{{old('price')}}" id="price" placeholder="Enter product price" required>
              </div>
              <div class="mb-3">
                <label for="descount_price" class="form-label">Descount Price</label>
                <input type="number" class="form-control" name="descount_price" value="{{old('descount_price')}}" id="descount_price" placeholder="Enter Descount Price" required>
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" placeholder="Enter product description" required>{{old('name')}}</textarea>
              </div>
              <select required class="form-control mb-3" name="product_show_status" aria-label="Default select example">
                <option value="active">Active</option>
                <option value="disabled">Disabled</option>
              </select>
              <select class="form-control mb-3" required name="product_status" aria-label="Default select example">
                <option value="none">none</option>
                <option value="featured">Featured</option>
                <option value="popular">Popular</option>
                <option value="best-seller">Best Seller</option>
              </select>
              <div class="form-group">
                <label for="image" class="form-label">Product Image</label>
                <input type="file" class="form-control-file" name="product_picture[]" id="image" multiple required accept="image/*">
              </div>
              <button type="submit" class="btn btn-success">Create</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection 