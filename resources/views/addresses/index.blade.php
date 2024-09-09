@extends('layouts.theme')

@section('page-title', 'Addreeses')

@section('content')
  <!-- Single Page Header start -->
  <div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Addresses</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active text-white">Addresses</li>
    </ol>
  </div>
  <!-- Single Page Header End -->
  <div class="container my-5">
    @include('alert')
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-lg-6">
                <h4 class="card-title">Addresses</h4>
              </div>
                <div class="col-lg-6 text-end">
                  <a class="btn btn-primary" href="{{route('addresses.create')}}" data-bs-toggle="modal" data-bs-target="#createAddressModel">Add Address</a>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="createAddressModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create New Address</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="{{route('addresses.store')}}" method="POST">
                        @csrf
                        <div class="modal-body">
                          <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" required placeholder="Address">
                          </div>
                          <div class="mb-3">
                            <label for="zip_code" class="form-label">Zip Code</label>
                            <input type="text" class="form-control" id="zip_code" name="zip_code" required placeholder="Zip Code">
                          </div>
                          <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required placeholder="Title">
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- Modal -->
                <!-- Edit Modal -->
                <div class="modal fade" id="EditAddressModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit New Address</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="#" method="POST" id="editForm">
                        @method('PUT')
                        @csrf
                        <div class="modal-body">
                          <div class="mb-3">
                            <label for="edit_address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="edit_address" name="address" required placeholder="Address">
                          </div>
                          <div class="mb-3">
                            <label for="edit_zip_code" class="form-label">Zip Code</label>
                            <input type="text" class="form-control" id="edit_zip_code" name="zip_code" required placeholder="Zip Code">
                          </div>
                          <div class="mb-3">
                            <label for="edit_title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="edit_title" name="title" required placeholder="Title">
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- Edit Modal -->
              </div>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-border table-striped">
              <thead>
                <tr>
                  <th scope="col">Address</th>
                  <th scope="col">Zip Code</th>
                  <th scope="col">Title</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($addresses as $address)
                <tr>
                  <td>{{$address->address}}</td>
                  <td>{{$address->zip_code}}</td>
                  <td>{{$address->title}}</td>
                  <td>
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#EditAddressModel" id="editBtn" data-address="{{$address}}">Edit</button>
                    {{-- href="{{route('addresses.edit', $address->id)}}" --}}
                    <form action="{{route('addresses.destroy', $address->id)}}" method="POST" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script>
    $(document).ready(
      function () {
      $('.alert').fadeOut(6000);
      var url = "{{env('APP_URL')}}";
      $('#editBtn').click(function () {
        var address = $(this).data('address');
        $('#edit_address').val(address.address);
        $('#edit_zip_code').val(address.zip_code);
        $('#edit_title').val(address.title);
        $('#editForm').attr('action', url + 'addresses/' + address.id);
      });
    }
  )
  </script>
@endsection