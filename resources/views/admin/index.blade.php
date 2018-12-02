@extends('admin.layouts.admin_app')

@section('content')

<div class="container">
        <h3><span class="badge badge-primary">Заказы клиентов </span>  <span class="badge badge-secondary">Количество необработанных заказов: {{ $orderscount }}</span></h3>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Заявка</th>
            <th scope="col">Клиент</th>
            <th scope="col">Статус</th>
            <th scope="col">Время создания</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        @forelse($orderslist as $order)
            <tbody>
            <tr>
                <td><a href="{{ route('admin.orders.show', $order->getKey()) }}">{{ $order->title }}</a></td>
                <td><a href="{{ route('admin.user.show', $order->user_id) }}">{{ $order->user->name }}</a></td>
                <td>{{ ($order->order_status==1) ? 'Обработан' : 'Необработан' }}</td>
                <td>{{ $order->created_at }}</td>
                <td>
                    <form action="{{ route('orders.delete', $order->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn-danger">Удалить</button>
                    </form>
                </td>
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