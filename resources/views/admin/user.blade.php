@extends('admin.layouts.admin_app')

@section('content')

    <div class="container">
        <h3>Заказы клиента </h3>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Заявка</th>
                <th scope="col">Клиент</th>
                <th scope="col">Статус</th>
                <th scope="col">Время создания</th>
            </tr>
            </thead>
            @forelse($orderslist as $order)
                <tbody>
                <tr>
                    <td><a href="{{ route('admin.orders.show', $order->getKey()) }}">{{ $order->title }}</a></td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ ($order->order_status==1) ? 'Обработан' : 'Необработан' }}</td>
                    <td>{{ $order->created_at }}</td>
                </tr>
                </tbody>
            @empty
                <div class="col">
                    <p>Заказов нет</p>
                </div>
            @endforelse
        </table>
        {{ $orderslist->appends(request()->except('page'))->links() }}
    </div>
@endsection