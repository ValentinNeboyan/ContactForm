@extends('user.layouts.user_app')

@section('content')

<div class="container">
    <h3>Мои заказы</h3>
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Заявка</th>
                    <th scope="col">Статус</th>
                    <th scope="col">Время создания</th>
                </tr>
                </thead>
                @forelse($orderslist as $order)
                <tbody>
                <tr>
                    <td><a href="{{ route('user.orders.show', $order->getKey()) }}">{{ $order->title }}</a></td>
                    <td>{{ ($order->order_status==1) ? 'Обработан' : 'Необработан' }}</td>
                    <td>{{ $order->created_at }}</td>
                </tr>
                </tbody>
        @empty
            <div class="col">
                <p>Заказов нет</p>
            </div>
        @endforelse
    </div>

    {{ $orderslist->appends(request()->except('page'))->links() }}



@endsection