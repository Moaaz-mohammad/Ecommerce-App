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
                <h4 class="card-title">#{{$order->id}} Order Details</h4>
                @if ($order->order_status != 'prcessing')
                  <div class="text-dark">This order {{$order->order_status}} to <span class="fw-bold text-success">- {{$order->address->address}}</span> address</div>
                @endif
              </div>
              <div class="col-lg-6">
                <h4 class="card-title text-end text-primary">Order Status</h4>
                <h4 class="card-title text-end text-info">{{$order->order_status}}</h4>
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
                  {{-- <th scope="col"></th> --}}
                </tr>
              </thead>
              <tbody>
                @foreach ($orderDetails as $detail)
                <tr>
                  <td id="order-id">{{$detail->order_id}}</td>
                  <td>{{$detail->product->name}}</td>
                  <td>{{$detail->product->price}}</td>
                  <td>{{$detail->quantity}}</td>
                  <td>{{$detail->product->price * $detail->quantity}}</td>
                  <td class="d-flex justify-content-around align-items-center">
                    {{-- <a href="#" class="btn btn-warning btn-sm">Details</a> --}}
                    @if ($order->order_status == 'shipped')
                      {{-- <form action="#" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">Done</button>
                      </form> --}}
                    @endif
                    
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="d-flex justify-content-between">
          <button id="sendBtn" {{$order->order_status == 'prcessing' ? '' : 'disabled'}} class="btn btn-primary">Cancel Order</button>
          <form action="{{route('order.destroy', $order->id)}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-success" {{$order->order_status == 'delivered' ? '' : 'disabled'}}>Done</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script>
    var sendBtn = document.getElementById('sendBtn');
    var alert = document.querySelector('alert alert-success');
      sendBtn.addEventListener('click', function () {
        const orderId = document.getElementById('order-id').textContent.trim();

        fetch("{{route('sendNotificatoin')}}", {
          method : 'POST',
          headers : {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({
            order_id: orderId
          })
        })
        .then(response => response.json())
        .then(data => {sendBtn.innerHTML = data.message})
        .catch(error => console.error("Error:", error));
      });
  </script>
@endsection