@extends('layouts.dashboard')

@section('content')
  <div class="container">
    <div class="row">
      @foreach($users as $user)
      <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
        <div class="card bg-light d-flex flex-fill">
          <div class="card-header text-muted border-bottom-0">
            {{$user->created_at}}
          </div>
          <div class="card-body pt-0">
            <div class="row">
              <div class="col-7">
                <h2 class="lead mb-3"><b>{{$user->name}}</b></h2>
                {{-- <p class="text-muted text-sm"><b>About: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p> --}}
                <ul class="ml-4 mb-0 fa-ul text-muted">
                  <li class="small mb-3"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span>{{$user->addresses->first()->address}}</li>
                  <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>Email: {{$user->email}}</li>
                </ul>
              </div>
              {{-- <div class="col-5 text-center">
                <img src="../../dist/img/user2-160x160.jpg" alt="user-avatar" class="img-circle img-fluid">
              </div> --}}
            </div>
          </div>
          <div class="card-footer">
            <div class="text-right">
              <a href="#" class="btn btn-sm bg-teal">
                <i class="fas fa-comments"></i>
              </a>
              <a href="#" class="btn btn-sm btn-primary">
                <i class="fas fa-user"></i> Send Email
              </a>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
@endsection;