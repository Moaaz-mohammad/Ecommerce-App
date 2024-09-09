@extends('layouts.theme')

@section('page-title', 'My Orders')

@section('content')
  <!-- Single Page Header start -->
  <div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">My Orders</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active text-white">My Orders</li>
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
                <h4 class="card-title">My Orders</h4>
              </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-border table-striped">
              <thead>
                <tr>
                  <th scope="col">Order ID</th>
                  <th scope="col">Address</th>
                  <th scope="col">Total Quantity</th>
                  <th scope="col">Total</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($orders as $order)
                <tr>
                  <td>{{$order->id}}</td>
                  <td>{{$order->address->address}}</td>
                  <td>{{$order->total}}</td>
                  <td>
                    <a href="{{route('my.order', $order->id)}}" class="btn btn-warning btn-sm">Details</a>
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