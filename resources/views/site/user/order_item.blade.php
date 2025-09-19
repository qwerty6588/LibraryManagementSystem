@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Заказ № {{ $order['id'] }}</h2>
        <p><strong>Дата:</strong> {{ \Carbon\Carbon::parse($order['date'])->format('d.m.Y ') }}</p>

        <p><strong>Статус:</strong>
            <span class="badge bg-info">{{ ucfirst($order['status']) }}</span>
        </p>
        <p><strong>Метод оплаты:</strong> {{ $order['payment_method'] }}</p>
        <p><strong>Общая сумма:</strong> ${{ $order['total'] }}</p>

        <h4>Книги:</h4>
        <ul>
            @foreach($order['items'] as $item)
                <li>{{ $item['title'] }} — {{ $item['quantity'] }} шт. × ${{ $item['price'] }}</li>
            @endforeach
        </ul>

        <a href="{{ route('user.orders') }}" class="btn btn-secondary">Назад к списку</a>

        <a href="{{ route('books.all') }}" class="btn btn-success">Назад к покупкам</a>
    </div>
@endsection
