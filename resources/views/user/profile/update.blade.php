@extends('user.layouts.user_app')

@section('content')

    <h4><span class="badge badge-primary">Редактирование профиля</span></h4>

    @if($user->avatar)
        <img src="{{ asset($user->avatar) }}" class="rounded-circle" width="100">
    @else
        <img src="{{ asset('/storage/profile/nofoto.png') }}" class="rounded-circle" width="60">
    @endif

    <form action="{{ route('user.profile.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="form-group">
            <label for="name">Имя</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="text" class="form-control" id="email" name="email" value=" {{ $user->email }}" readonly>
        </div>




        <div class="form-group">
            <label>Фото профиля</label>
            <input type="file" class="form-control" id="avatar" name="avatar">
        </div>

        <div class="mt-4">
            <button class="btn btn-primary">Обновить</button>
        </div>
    </form>

@endsection
