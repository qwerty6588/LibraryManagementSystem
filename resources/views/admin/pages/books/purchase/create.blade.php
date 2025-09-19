@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">Покупка книги: <strong>{{ $book->title }}</strong></h2>

        <form action="{{ route('purchase.store', $book->id) }}" method="POST">
            @csrf
            <div class="row">

                <div class="col-lg-8">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body p-4">


                            <div class="mb-3">
                                <label class="form-label">Количество книг</label>
                                <input type="number" name="quantity" value="1" min="1" class="form-control" style="max-width: 120px;">
                            </div>


                            <h5 class="mb-3 fw-semibold">Способ оплаты</h5>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" value="card" id="pay1" checked>
                                <label class="form-check-label" for="pay1">Банковская карта</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" value="credit" id="pay2">
                                <label class="form-check-label" for="pay2">Кредитная / Дебетовая карта</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" value="netbanking" id="pay3">
                                <label class="form-check-label" for="pay3">Интернет-банкинг</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" value="cod" id="pay4">
                                <label class="form-check-label" for="pay4">Оплата при получении</label>
                            </div>


                            <div class="mt-3">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="card_choice" id="method1" value="card" checked>
                                    <label class="form-check-label" for="method1">Карта 12XX XXXX XXXX 0000</label>
                                </div>

                                <div class="row align-items-center mb-4">
                                    <div class="col-md-4">
                                        <label for="cvv" class="form-label">CVV</label>
                                        <input type="password" name="cvv" id="cvv" class="form-control" maxlength="3" required>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary w-100">Оплатить</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4">
                    <div class="card border-primary">
                        <div class="card-header bg-primary text-white fw-bold text-center">Детали оплаты</div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Цена за книгу</span>
                                    <strong>{{ number_format($book->price) }} $</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Количество</span>
                                    <strong id="quantityDisplay">1</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Итого</span>
                                    <strong id="totalAmount">{{ number_format($book->price) }} $</strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        const quantityInput = document.querySelector('[name="quantity"]');
        const quantityDisplay = document.getElementById('quantityDisplay');
        const totalAmount = document.getElementById('totalAmount');
        const price = {{ $book->price }};

        quantityInput.addEventListener('input', () => {
            const q = parseInt(quantityInput.value) || 1;
            quantityDisplay.textContent = q;
            totalAmount.textContent = (price * q) + ' $';
        });
    </script>
@endsection
