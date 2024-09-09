@extends('layouts.dashboard')

@section('page-title', 'Order Details')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
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
              <th>User ID</th>
              <th>User Name</th>
              <th>Product Name</th>
              <th>Qty</th>
              <th>Total</th>
            </thead>
            <tbody>
              @foreach ($details as $detail)
              {{-- @dd($order) --}}
                  <tr>
                    <td>{{$detail->order->id}}</td>
                    {{-- <td>{{$detail->order->user->name}}</td> --}}
                    <td>{{$detail->product->name}}</td>
                    <td>{{$detail->quantity}}</td>
                    <td>{{$detail->quantity * $detail->product->price}}</td>
                  </tr>
              @endforeach
            </tbody>
            <tfoot>
              <th>User ID</th>
              <th>User Name</th>
              <th>Product Name</th>
              <th>Qty</th>
              <th>Total</th>
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
        $('#order-details-table').dataTable();
      })
    </script>
@endsection