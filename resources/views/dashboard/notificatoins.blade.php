@extends('layouts.dashboard')

@section('page-title', 'notificatoins');

@section('content')
<a href={{route('orders.index')}} class="btn btn-primary ml-2 my-3 mt-1">Show Orders</a>
  @foreach ($usersNotification as $user)
    @foreach ($user->unreadNotifications as $not)
      <div class="row">
        <div class="col-lg-8">
          <div class="alert alert-info text-bold d-flex justify-content-between" role="alert">
            <div>
              {{$not->data['message']}}
              <span id="orderID" class="text-dark">{{$not->data['order_id']}}</span>
            </div>
            <div>
              <span class="text-dark text-end">{{$not->created_at->diffForHumans()}}</span>
              <button id="readeBtn" class="readeBtn btn btn-primary ml-2" data-id="{{$not->id}}" data-orderID="{{$not->data['order_id']}}">Reade</button>
            </div>
          </div>
        </div>
      </div> 
    @endforeach
  @endforeach
@endsection
@section('script')
  <script>
    document.addEventListener('DOMContentLoaded', function () {

      var readeBtns = document.querySelectorAll('.readeBtn');

      readeBtns.forEach(function(button) {
        button.addEventListener('click', function () {

          var notificationId = this.getAttribute('data-id');
          var OrderID = this.getAttribute('data-orderID');
          // const orderId = document.getElementById('orderID').textContent.trim();

          fetch("{{route('readMessage')}}", {
            method: 'POST',
            headers: {'Content-Type': 'application/json','X-CSRF-TOKEN': '{{ csrf_token() }}'},
            body : JSON.stringify({ notId : notificationId, orderId : OrderID})
          })
          .then(response => response.json())
          .then(data => console.log(data.message))
          .catch(error => console.error("Error", error));

        });
      });
    });
  </script> 
@endsection