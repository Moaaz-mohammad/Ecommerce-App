@extends('layouts.theme')

@section('page-title', 'Card')

@section('content')
    

        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Cart</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">Cart</li>
            </ol>
        </div>
        <!-- Single Page Header End -->


        <!-- Cart Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                @include('alert')
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Products</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($cart as $key=>$item)
                                    <th scope="row">
                                        <div class="d-flex align-items-center">
                                            <img src="{{asset('storage/products/' . $item['image']['path'])}}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                        </div>
                                    </th>
                                    <td>
                                        <p class="mb-0 mt-4">{{$item['name']}}</p>
                                    </td>
                                    <td>
                                        @if ($item['descount_price'] != '0')
                                            <h5 class="mb-0 mt-4">${{$item['descount_price']}}</h5>
                                            <h5 class="mb-0 text-danger text-decoration-line-through">${{$item['price']}}</h5>
                                        @else 
                                            <h5 class="mb-0">${{$item['price']}}</h5>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="input-group-btn">
                                            <form action="{{route('cart.update.minus', $item['id'])}}" class="mb-2" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-minus rounded-circle bg-light border"><i class="fa fa-minus"></i></button>
                                            </form>
                                        </div>
                                        <div class="input-group quantity" style="width: 100px;">
                                            <input type="text" class="form-control form-control-sm text-center border-0 qty" readonly value="{{$item['quantity']}}">
                                        </div>
                                        <div class="input-group-btn">
                                            <form action="{{route('cart.update.plus', $item['id'])}}" method="POST" class="mt-2">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-plus rounded-circle bg-light border"><i class="fa fa-plus"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4 total">{{$item['price']}}</p>
                                    </td>
                                    <td>
                                        <form action="{{route('cart.remove', $item['id'])}}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-md rounded-circle bg-light border mt-4" >
                                                <a class="fa fa-times text-danger"></a>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>  
                    <div class="row g-4 justify-content-end">
                        <div class="col-8"></div>
                        <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                            
                            <div class="bg-light rounded">
                                <div class="p-4">
                                    <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                                    <div class="d-flex justify-content-between mb-4">
                                        <h5 class="mb-0 me-4">Subtotal:</h5>
                                        <p class="mb-0 subtotal"></p>
                                    </div>
                                </div>
                                <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                                    <h5 class="mb-0 ps-4 me-4">Total</h5>
                                    <p class="mb-0 pe-4 final_total" id="final_total">{{$total}}</p>
                                </div>
                                @if ($cart != null)
                                    {{-- <a href="{{route('place.order', ['id' => implode(',', array_keys($cart))])}}" class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4 checkout" type="button">Proceed Checkout</a> --}}
                                    <a href="{{route('checkout')}}" class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4 checkout">Proceed Checkout</a>
                                @else
                                    {{-- <a class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4 checkout" type="button">Proceed Checkout</a> --}}
                                    <a class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4 checkout">Proceed Checkout</a>
                                @endif
                            </div>
                            <div class="mt-5">
                                @if ($total > '50')
                                    <input type="text" class="border-0 border-bottom rounded me- py-3 mb-4" id="koponCode" placeholder="Coupon Code">
                                    <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" id="koponBtn" type="button">Apply Coupon</button>
                                @endif
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <!-- Cart Page End -->

@endsection

@section('js')
    {{-- <script>
        var url = "{{env('APP_URL')}}";

        $('.subtotal').text(parseInt($('.qty').val()) * parseInt({{$product->price}}) + "$");
        $('.final_total').text(parseInt($('.qty').val()) * parseInt({{$product->price}}) + "$");
        $('.checkout').attr('href', url + {{$product->id}} + '/' + $('.qty').val() + '/' + 'checkout' );

        $(document).ready(function () {
            $('.btn-plus').click(function () {
                $('.total').text(parseInt($('.qty').val()) * parseInt({{$product->price}}) + "$");
                $('.subtotal').text(parseInt($('.qty').val()) * parseInt({{$product->price}}) + "$");
                $('.final_total').text(parseInt($('.qty').val()) * parseInt({{$product->price}}) + "$");
                $('.checkout').attr('href', url + {{$product->id}} + '/' + $('.qty').val() + '/' + 'checkout' );
            })
            $('.btn-minus').click(function () {
                $('.total').text(parseInt($('.qty').val()) * parseInt({{$product->price}}) + "$");
                $('.checkout').attr('href', url + {{$product->id}} + '/' + $('.qty').val() + '/' + 'checkout' );  
            })
        })
    </script> --}}
    <script>
        var input = document.querySelector('#koponCode');
        var buttonCode = document.querySelector('#koponBtn');
        var final_total = document.querySelector('#final_total');

        buttonCode.addEventListener('click', function () {
            buttonCode.disabled = true;
            fetch("{{ route('check.kopon') }}", {
                method : 'POST',
                headers : {
                    'Content-Type' : 'application/json',
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },
                body : JSON.stringify({
                    koponCode : input.value,
                })
            })
            .then(response => response.json())
            .then(data => final_total.innerHTML = final_total.innerHTML - data.data)
            .catch(error => console.error('Error', error))
        });
    </script>
@endsection