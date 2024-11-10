@extends('layouts.dashboard')
@section('page-title', 'Codes')

@section('content')
  <div class="container">
    @foreach ($koponCodes as $item)
      <div class="callout callout-success">
        <h5>{{$item->code}}</h5>
        <p class="fw-2">Descount: <span class="text-bold">{{$item->descount_price}}</span>$</p>
      </div>
    @endforeach
  </div>
@endsection;