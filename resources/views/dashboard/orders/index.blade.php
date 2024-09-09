@extends('layouts.dashboard')

@section('page-title', 'Orders')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h3>All Orders</h3>
        </div>
        <div class="card-body">
          <table id="orders-table" class="table">
            <thead>
              <th>User ID</th>
              <th>User Name</th>
              <th>Total Qty</th>
              <th>Total</th>
              <th>Created At</th>
              <th>Updated At</th>
              <th>Actions</th>
            </thead>
            <tbody>
              @foreach ($orders as $order)
                  <tr>
                    <td>{{$order->id}}</td>
                    {{-- <td>{{$order->user->name}}</td> --}}
                    <td>{{$order->total_quantity}}</td>
                    <td>{{$order->total}}</td>
                    <td>{{$order->created_at->diffForHumans()}}</td>
                    <td>{{$order->updated_at->diffForHumans()}}</td> 
                    <td>
                      <a href="{{route('orders.show', $order )}}" class="btn btn-primary">Show</a>
                    </td>
                  </tr>
              @endforeach
            </tbody>
            <tfoot>
              <th>User ID</th>
              <th>User Name</th>
              <th>Total Qty</th>
              <th>Total</th>
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
        $('#orders-table').dataTable();
      })
    </script>
@endsection