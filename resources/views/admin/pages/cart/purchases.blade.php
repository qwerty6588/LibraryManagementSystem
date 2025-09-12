@extends('layouts.admin')
@section('content')

    <h1 class="mb-4 text-center fw-bold" style="font-family: 'Poppins', sans-serif;">
        📚 Purchases
    </h1>

    @if(empty($purchases))
        <div class="alert alert-info text-center">Покупок пока нет.</div>
    @else
        <div class="card shadow-lg border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center">
                        <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Books</th>
                            <th>Total Quantity</th>
                            <th>Total Price</th>
                            <th>Payment</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($purchases as $index => $purchase)
                            <tr>
                                <td class="fw-bold">{{ $index + 1 }}</td>
                                <td>
                                    <span class="badge bg-primary p-2">
                                        {{ $purchase['user'] }}
                                    </span>
                                </td>
                                <td class="text-start">
                                    <ul class="list-unstyled mb-0">
                                        @foreach($purchase['items'] as $item)
                                            <li>
                                                📖 <span class="fw-semibold">{{ $item['title'] }}</span>
                                                <span class="text-muted">(x{{ $item['quantity'] }})</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td><span class="badge bg-info">{{ $purchase['quantity'] }}</span></td>
                                <td><strong class="text-success">${{ $purchase['total'] }}</strong></td>
                                <td>
                                    <span class="badge bg-warning text-dark">
                                        {{ ucfirst($purchase['payment_method']) }}
                                    </span>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
@endsection
