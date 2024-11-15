@extends('layouts.theme')

@section('page-title', 'checkout')

@section('content')
<!-- Modal Search Start -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
      <div class="modal-content rounded-0">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body d-flex align-items-center">
              <div class="input-group w-75 mx-auto d-flex">
                  <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                  <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
              </div>
          </div>
      </div>
  </div>
</div>
<!-- Modal Search End -->


<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
  <h1 class="text-center text-white display-6">Checkout</h1>
  <ol class="breadcrumb justify-content-center mb-0">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item"><a href="#">Pages</a></li>
      <li class="breadcrumb-item active text-white">Checkout</li>
  </ol>
</div>
<!-- Single Page Header End -->

<!-- Checkout Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <h1 class="mb-4">Billing details</h1>
        {{-- <form action="{{route('place.order', [$product->id, $qty])}}" method="POST"> --}}
            @csrf
            <div class="row g-5">
                <div class="col-md-12 col-lg-6 col-xl-7">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="form-item w-100">
                                <label class="form-label my-3">Full Name<sup>*</sup></label>
                                {{-- <input type="text" value="{{auth()->user()->name}}" readonly class="form-control"> --}}
                            </div>
                        </div>
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Address <sup>*</sup></label>
                        <select required class="form-select" name="address_id" aria-label="Default select example">
                            @foreach($addresses as $address)
                                <option value="{{$address->id}}">{{$address->address}}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="form-item">
                        <label class="form-label my-3">Postcode/Zip<sup>*</sup></label>
                        <input type="text" class="form-control" name="zip_code" readonly value="{{$address->zip_code}}">
                    </div> --}}
                    <div class="form-item">
                        <label class="form-label my-3">Email Address<sup>*</sup></label>
                        <input type="email" class="form-control" name="email_address" value="{{Auth::user()->email}}" required readonly >
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-5">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Products</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($imagesPath as $path)
                                    <th scope="row">
                                        <div class="d-flex align-items-center mt-2">
                                            <img src="{{asset('storage/products/' . $path['path'])}}" class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt="">
                                        </div>
                                    </th>
                                @endforeach --}}
                                    @foreach ($cart as $item)
                                    <tr>
                                        <th scope="row">
                                            <div class="d-flex align-items-center mt-2 ">
                                                <img src="{{asset('storage/products/' . $item['image']['path'])}}" class="img-fluid rounded-circle" style="width: 70px; height: 70px;" alt="">
                                            </div>
                                        </th>
                                        <td class="py-5">{{$item['name']}}</td>
                                        @if ($item['descount_price'] != 0)
                                            <td class="py-5"><span class="text-decoration-line-through text-danger">{{$item['price']}}</span> / {{$item['descount_price']}}</td>
                                        @else
                                            <td class="py-5">{{$item['price']}}</td>
                                        @endif
                                        <td class="py-5">{{$item['quantity']}}</td>
                                        <td class="py-5">{{$item['descount_price'] == 0 ? $item['price'] * $item['quantity'] : $item['descount_price'] * $item['quantity']}}</td>
                                    </tr>
                                    @endforeach
                                    <td class="py-5">
                                        <p class="mb-0 text-dark text-uppercase py-3">TOTAL</p>
                                    </td>
                                    <td class="py-5"></td>
                                    <td class="py-5"></td>
                                    <td class="py-5">
                                        <div class="py-3 border-bottom border-top">
                                            <p class="mb-0 text-dark">{{$total}}</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                        <div class="col-12">
                            <div class="form-check text-start my-3">
                                <input type="checkbox" class="form-check-input bg-primary border-0" id="Transfer-1" name="Transfer" value="Transfer">
                                <label class="form-check-label" for="Transfer-1">Direct Bank Transfer</label>
                            </div>
                            <p class="text-start text-dark">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.</p>
                        </div>
                    </div>
                    <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                        <div class="col-12">
                            <div class="form-check text-start my-3">
                                <input type="checkbox" class="form-check-input bg-primary border-0" id="Payments-1" name="Payments" value="Payments">
                                <label class="form-check-label" for="Payments-1">Check Payments</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                        <div class="col-12">
                            <div class="form-check text-start my-3">
                                <input type="checkbox" class="form-check-input bg-primary border-0" id="Delivery-1" name="Delivery" value="Delivery">
                                <label class="form-check-label" for="Delivery-1">Cash On Delivery</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                        <div class="col-12">
                            <div class="form-check text-start my-3">
                                <input type="checkbox" class="form-check-input bg-primary border-0" id="Paypal-1" name="Paypal" value="Paypal">
                                <label class="form-check-label" for="Paypal-1">Paypal</label>
                            </div>
                        </div>
                    </div> --}}
                    <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                        <a href="{{route('place.order')}}" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Place Order</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Checkout Page End -->
@endsection