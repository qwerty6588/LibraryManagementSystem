@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Мои заказы</h2>

        @if(empty($orders))
            <div class="alert alert-info">У вас пока нет заказов.</div>
        @else
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Дата</th>
                    <th>Кол-во</th>
                    <th>Сумма</th>
                    <th>Статус</th>
                    <th>Подробнее</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $index => $order)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $order['date'] }}</td>
                        <td>{{ $order['quantity'] }}</td>
                        <td>${{ $order['total'] }}</td>
                        <td>
                            <span class="badge bg-info">{{ ucfirst($order['status']) }}</span>
                        </td>
                        <td>
                            <a href="{{ route('user.orders.show', $order['id']) }}" class="btn btn-sm btn-primary">
                                Открыть
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
