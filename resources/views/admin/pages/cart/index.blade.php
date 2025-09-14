@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">Корзина</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($cart && count($cart) > 0)
            @php $total = 0; @endphp

            <div class="row">
                <div class="col-lg-8">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body p-4">

                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                <tr>
                                    <th>Книга</th>
                                    <th>Название</th>
                                    <th>Цена</th>
                                    <th>Количество</th>
                                    <th>Сумма</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cart as $id => $book)
                                    @php $total += $book['price'] * $book['quantity']; @endphp
                                    <tr>
                                        <td>
                                            @php
                                                $customCovers = [
                                                    '1984' => '1984.jpg',
                                                    'Harry Potter' => 'harry_potter.jpg',
                                                    'The Shining' => 'the_shining.jpg',
                                                    'I, Robot' => 'i_robot.jpg',
                                                    'Pride and Prejudice' => 'pride_prejudice.jpg',
                                                ];
                                                $cover = $customCovers[$book['title']] ?? null;
                                            @endphp

                                            @if($cover)
                                                <img src="{{ asset('storage/books/' . $cover) }}"
                                                     width="50" class="me-2 rounded"
                                                     alt="{{ $book['title'] }}">
                                            @else
                                                <img src="{{ asset('storage/' . $book['image']) }}"
                                                     width="50" class="me-2 rounded"
                                                     alt="No Image">
                                            @endif

                                        </td>
                                        <td>{{ $book['title'] }}</td>
                                        <td>${{ $book['price'] }}</td>
                                        <td>{{ $book['quantity'] }}</td>
                                        <td>${{ $book['price'] * $book['quantity'] }}</td>
                                        <td>
                                            <a href="{{ route('cart.remove', $id) }}" class="btn btn-danger btn-sm">❌</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>


                            <form  action="{{ route('cart.checkout') }}" method="POST">
                                @csrf
                                <h5 class="mb-3 fw-semibold">Способ оплаты</h5>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="payment_method" value="card" id="pay1" checked>
                                    <label class="form-check-label" for="pay1">Банковская карта</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="payment_method" value="credit" id="pay2">
                                    <label class="form-check-label" for="pay2">Кредитная / Дебетовая карта</label>
                                </div>


                                <div class="row align-items-center mb-4 mt-3">
                                    <div class="col-md-4">
                                        <label for="cvv" class="form-label">CVV</label>
                                        <input type="password" name="cvv" id="cvv" class="form-control" maxlength="3" required>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary w-100">Купить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-primary">
                        <div class="card-header bg-primary text-white fw-bold text-center">Детали оплаты</div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Количество товаров</span>
                                    <strong>{{ collect($cart)->sum('quantity') }}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Общая сумма</span>
                                    <strong id="totalAmount">{{ $total }} $</strong>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <a href="{{ route('cart.clear') }}" class="btn btn-warning w-100 mt-3"> Очистить корзину</a>
                </div>
            </div>
        @else
            <p class="text-muted">Ваша корзина пуста.</p>
        @endif
    </div>
    @if(session('success'))
        <script>
            setTimeout(() => {
                window.location.href = "{{ route('books.all') }}";
            }, 5000);
        </script>
    @endif

@endsection
