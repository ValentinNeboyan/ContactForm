
@extends('admin.layouts.admin_app')

@section('content')
    <div class="container" role="alert">

        <h4><span class="badge badge-secondary">{{ $order->title }}</span>
            <span class="badge badge-primary">{{ ($order->order_status==1) ? 'Обработан' : 'Необработан' }}</span></h4>

    @if($order->file_path)

        <div class="mt-4">
            <button class="btn btn-primary" href="{{ route('admin.orders.download') }}" >Скачать файл</button>
        </div>
    @endif
    </div>
    <br>
    <div class="container">
        <div class="w-100 p-3" style=" height: 200px; background-color: white; overflow-y:scroll;">

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
            <textarea class="form-control" id="message" name="message" required></textarea>

            <div class="mt-4">
                <button class="btn btn-primary">Отправить сообщение</button>
            </div>

        </form>
    </div>
    <div class="container">

        <form action="{{ route('admin.orders.update', $order) }}" method="post">
            @csrf
            @method('patch')

            <div class="mt-4">
                <button class="btn btn-primary">Обработать заказ</button>
            </div>

        </form>

    </div>

@endsection