@extends('layouts.dashboard')

@section('page-title', 'All Categories')

@section('content')
  @include('alert')
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h3>All Categories</h3>
            </div>
            <div class="card-body">
              <table id="categories-table" class="table">
                <thead>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Actions</th>
                </thead>
                <tbody>
                  @foreach ($categories as $category)
                      <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>{{$category->created_at}}</td>
                        <td>{{$category->updated_at}}</td> 
                        <td>
                          <a href="{{route('categories.edit', $category->id )}}" class="btn btn-primary">Edit</a>
                          <form action="{{route('categories.destroy', $category->id)}}" method="POST" style="display: inline-block">
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