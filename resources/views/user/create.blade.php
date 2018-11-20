@extends('user.layouts.user_app')

@section('content')

    @php
        $route = route('orders.store');
        $method = 'post';
    @endphp


    <div >
        <h3>Форма заказа</h3>
    </div>
    <form action="{{ $route }}" method="post" enctype="multipart/form-data">
        @csrf
        @method($method)

        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
        </div>



        <div class="form-group">
            <label for="body">Сообщение</label>
            <textarea name="body" id="body"  class="form-control">{{ old('body') }}</textarea>
        </div>

        <div class="form-group">
            <label>Прикрепить файл</label>
            <input type="file" class="form-control" id="file" name="file">
        </div>

        <div class="mt-4">
            <button class="btn btn-primary">Отправить</button>
        </div>
    </form>
@endsection