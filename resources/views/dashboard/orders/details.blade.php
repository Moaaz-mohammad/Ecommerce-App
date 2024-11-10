@extends('layouts.dashboard')

@section('page-title', 'Order Details')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <h3 class="alert alert-warning p-2 text-center">{{$order->order_status}}</h3>
        <div class="card-header">
          @include('alert')
          <h3>Shipping Address</h3>
        </div>
        <div class="card-body">
          <p>
            {{$order->address->address}}
          </p>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h3>Order Details</h3>
        </div>
        <div class="card-body">
          <table id="order-details-table" class="table">
            <thead>
              <th>Order ID</th>
              <th>User Name</th>
              <th>Product Name</th>
              <th>Qty</th>
              <th>Total</th>
              <th>Actions</th>
            </thead>
            <tbody>
              @foreach ($details as $detail)
              {{-- @dd($order) --}}
                  <tr>
                    <td>{{$detail->order->id}}</td>
                    <td>{{$detail->order->user->name}}</td>
                    <td>{{$detail->product->name}}</td>
                    <td>{{$detail->quantity}}</td>
                    <td>{{$detail->quantity * $detail->product->price}}</td>
                    <td>
                      <div class="btn-group">
                        <button type="button" disabled class="btn btn-danger">{{$order->order_status}}</button>
                        <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                          <form action="{{route('detail.status.update', $order->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            @if ($order->order_status == 'shipped')
                              <button class="dropdown-item" href="submit">Delivored</button>
                            @elseif($order->order_status == 'prcessing')
                              <button class="dropdown-item" href="submit">shipped</button>
                            @elseif($order->order_status == 'delivered')
                              <button class="dropdown-item" href="submit">Done</button>
                            @endif
                          </form>
                        </div>
                      </div>
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary">Action</button>
                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                          <form name="order_status" action="{{route('status.update', $order->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <button class="dropdown-item" href="submit" name="order_status" value="prcessing" {{$order->order_status == 'prcessing' ? 'disabled': ''}}>processing</button>
                            <button class="dropdown-item" href="submit" name="order_status" value="shipped" {{$order->order_status == 'shipped' ? 'disabled': ''}}>shipped</button>
                            <button class="dropdown-item" href="submit" name="order_status" value="delivered" {{$order->order_status == 'delivered' ? 'disabled': ''}} dis>Delivered</button>
                          </form>
                          {{-- <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#">Separated link</a> --}}
                        </div>
                      </div>
                    </td>
                  </tr>
              @endforeach
            </tbody>
            <tfoot>
              <th>User ID</th>
              <th>User Name</th>
              <th>Product Name</th>
              <th>Qty</th>
              <th>Total</th>
              <th>Actions</th>
            </tfoot>
          </table>
        </div>
        <a href="{{route('orders.index')}}" class="btn btn-primary">Back</a>
      </div>
    </div>
  </div> 
</div>
@endsection


@section('script')
    <script>
      $(document).ready(function () {
        $('#order-details-table').dataTable();
      })
    </script>
@endsection