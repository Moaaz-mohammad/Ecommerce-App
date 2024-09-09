@extends('layouts.dashboard')

@section('page-title', 'All Products')

@section('content')
  @include('alert')
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h3>All Products</h3>
            </div>
            <div class="card-body">
              <table id="categories-table" class="table">
                <thead>
                  <th>ID</th>
                  <th>Name</th>
                  <th>category</th>
                  {{-- <th>Description</th> --}}
                  <th>price</th>
                  <th>stock</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Actions</th>
                </thead>
                <tbody>
                  @foreach ($products as $product)
                      <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->category->name}}</td>
                        {{-- <td>{{$product->description}}</td> --}}
                        <td>{{$product->price}}</td>
                        <td>{{$product->stock}}</td>
                        <td>{{$product->created_at}}</td>
                        <td>{{$product->updated_at}}</td> 
                        <td>
                          <a href="{{route('products.edit', $product->id )}}" class="btn btn-primary">Edit</a>
                          <form action="{{route('products.destroy', $product->id)}}" method="POST" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                          </form>
                        </td>
                      </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <th>ID</th>
                  <th>Name</th>
                  <th>category</th>
                  {{-- <th>Description</th> --}}
                  <th>price</th>
                  <th>stock</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Actions</th>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div> 
    </div>
@endsection

@section('script')
    <script>
      $(document).ready(function () {
        $('#categories-table').dataTable();
      })
    </script>
@endsection