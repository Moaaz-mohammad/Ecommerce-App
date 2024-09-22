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
                  <th>Descount Price</th>
                  <th>stock</th>
                  <th>Category Of Product Status</th>
                  <th>Product Status</th>
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
                        <td>{{$product->descount_price}}</td>
                        <td>{{$product->stock}}</td>
                        <td>{{$product->category->category_status}}</td>
                        <td>{{$product->product_show_status}}</td>
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
                        @if ($product->stock < '10' && $product->stock != '0')
                          <div class="alert alert-warning font-weight-bold col-lg-4">
                            #{{$product->id}}
                            #{{$product->name}}, The product is about to run out
                          </div>
                        @endif
                        @if ($product->stock == '0' && $product->product_show_status == 'active')
                          <div class="alert alert-danger font-weight-bold col-lg-4">
                            #{{$product->name}}, This product has run out of stock and is active !!
                          </div>
                        @endif
                        {{-- <div class="alert alert-warning font-weight-bold" {{$product->stock > '10' && $product->stock != '0'? 'hidden' : ''}}>
                          #{{$product->name}},  The product is about to run out
                        </div> --}}
                        <div class="alert alert-warning font-weight-bold col-lg-4" {{$product->stock != '0' ? 'hidden' : ''}}>
                          #{{$product->name}}, This product has run out of stock
                        </div>
                      </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <th>ID</th>
                  <th>Name</th>
                  <th>category</th>
                  {{-- <th>Description</th> --}}
                  <th>price</th>
                  <th>Descount Price</th>
                  <th>stock</th>
                  <th>Category Of Product Status</th>
                  <th>Product Status</th>
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