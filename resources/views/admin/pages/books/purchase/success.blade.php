@extends('layouts.app')

@section('content')
    <div class="container text-center py-5">
        <h2 class="text-success mb-4">✅ Покупка завершена!</h2>

        <p>Вы купили <strong>{{ $book }}</strong> в количестве <strong>{{ $quantity }}</strong>.</p>
        <p>Сумма: <strong>{{ $total }} $</strong></p>
        <p>Метод оплаты: <strong>{{ $payment_method }}</strong></p>

        <a href="{{ route('admin.books.index') }}" class="btn btn-primary mt-3">Вернуться к книгам</a>
    </div>
@endsection
