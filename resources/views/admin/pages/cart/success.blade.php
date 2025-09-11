@extends('layouts.app')

@section('content')
    <div class="container text-center mt-5">
        <div class="alert alert-success p-5 rounded shadow">
            <h2 class="mb-3">✅ Покупка успешна!</h2>
            <p class="lead">Спасибо за заказ. Вас перенаправит на список книг через <span id="countdown">5</span> секунд...</p>
            <a href="{{ route('books.all') }}" class="btn btn-primary mt-3">Перейти сейчас</a>
        </div>
    </div>

    <script>
        let seconds = 5;
        const countdown = document.getElementById("countdown");

        const interval = setInterval(() => {
            seconds--;
            countdown.textContent = seconds;
            if (seconds <= 0) {
                clearInterval(interval);
                window.location.href = "{{ route('books.all') }}";
            }
        }, 1000);
    </script>
@endsection
