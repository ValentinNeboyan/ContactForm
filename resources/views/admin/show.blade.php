
@extends('admin.layouts.admin_app')

@section('content')
       <div class="container" role="alert">
        <h4>
            @if($order->user->avatar)
            <img src="{{ asset($order->user->avatar) }}" class="rounded-circle" width="100">
        @else
                <img src="{{ asset('/storage/profile/nofoto.png') }}" class="rounded" width="60">
            @endif
            <span class="badge badge-secondary">{{ $order->title }}</span>
            <span class="badge badge-primary">{{ ($order->order_status==1) ? 'Обработан' : 'Необработан' }}</span>
                <a href="{{ route('admin.user.show', $order->user_id )}}"><span class="badge badge-secondary">Вернуться к заказам клиента: {{ $order->user->name }}</span></a>
        </h4>

    </div>
    <br>
    <div class="container">
        <div class="m-100 p-3" style=" height: 200px; background-color: white; overflow-y:scroll;">
                @foreach($messages as $message)
                <p class="text-primary">{{ $message }}</p>
                @endforeach
        </div>
    </div>
    <div class="container">
        <form action="{{ route('admin.orders.message', $order) }}" method="post">
            @csrf
            @method('patch')
            <label for="message">Ваше сообщение</label>
            <textarea class="form-control" id="message" name="message" ></textarea>
            <div class="mt-4">
                <button class="btn btn-primary">Отправить сообщение</button>
            </div>
        </form>
    </div>
    <div class="container">
        <form action="{{ route('orders.update', $order) }}" method="post">
            @csrf
            @method('patch')
            <div class="mt-4">
                <button class="btn btn-primary">Обработать заказ</button>
            </div>
        </form>
        @isset($order->file_path)
            <div>
                <img class="img-thumbnail" src="{{ asset($order->file_path) }}" height="200px" width="200px">
            </div>
        @endisset
    </div>


@endsection