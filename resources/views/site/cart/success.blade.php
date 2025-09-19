@extends('layouts.app')

@section('content')
    <div class="container text-center mt-5">
        <div class="alert alert-success p-5 rounded shadow">
            <h2 class="mb-3">✅ The purchase was successful!</h2>
            <p class="lead">Thank you for your order. You will be redirected to the list of books in <span id="countdown">5</span> seconds...</p>
            <a href="{{ url('cabinet/orders') }}" class="btn btn-primary mt-3">Go Now</a>
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
                window.location.href = "{{ url('cabinet/orders') }}";
            }
        }, 1000);
    </script>
@endsection
