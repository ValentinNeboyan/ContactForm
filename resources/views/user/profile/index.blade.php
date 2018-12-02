@extends('user.layouts.user_app')

@section('content')

   <h4><span class="badge badge-primary">Мой профиль</span></h4>
   @if($user->avatar)
       <img src="{{ asset($user->avatar) }}" class="rounded-circle" width="100">
   @else
       <img src="{{ asset('/storage/profile/nofoto.png') }}" class="rounded-circle" width="60">
   @endif

    <div class="form-group">
        <label for="name">Имя</label>
        <span type="text" class="form-control"> {{  $user->name }}</span>
    </div>

    <div class="form-group">
        <label for="email">E-mail</label>
        <span type="text" class="form-control"> {{  $user->email }}</span>
    </div>

   <div class="mt-4">
       <a href="{{ route('user.profile.edit') }}"><button class="btn btn-primary" >Редактировать</button></a>
   </div>

@endsection