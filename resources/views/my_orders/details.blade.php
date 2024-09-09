@extends('layouts.theme')

@section('page-title', 'Order Details')

@section('content')
  <!-- Single Page Header start -->
  <div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">{{$order->id}} Order Details</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active text-white">Order Detalis</li>
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
                <h4 class="card-title">{{$order->id}} Order Details</h4>
              </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-border table-striped">
              <thead>
                <tr>
                  <th scope="col">Order ID</th>
                  <th scope="col">Product Name</th>
                  <th scope="col">Total Price</th>
                  <th scope="col">Total Quantity</th>
                  <th scope="col">Total</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($orderDetails as $detail)
                <tr>
                  <td>{{$detail->order_id}}</td>
                  <td>{{$detail->product->name}}</td>
                  <td>{{$detail->product->price}}</td>
                  <td>{{$detail->quantity}}</td>
                  <td>{{$detail->product->price * $detail->quantity}}</td>
                  <td>
                    <a href="#" class="btn btn-warning btn-sm">Details</a>
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