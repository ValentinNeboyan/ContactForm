@extends('user.layouts.user_app')

@section('content')

    <div >
        <h3>Форма заказа</h3>
    </div>
    <form action="{{ route('orders.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        </div>
        <div class="form-group">
            <label for="body">Сообщение</label>
            <textarea name="body" id="body"  class="form-control">{{ old('body') }}</textarea>
        </div>
        <div class="form-group">
            <label>Прикрепить файл</label>
            <input type="file" class="form-control" id="file" name="image">
        </div>
        <div class="mt-4">
            <button class="btn btn-primary" >Отправить</button>
        </div>
    </form>
@endsection
