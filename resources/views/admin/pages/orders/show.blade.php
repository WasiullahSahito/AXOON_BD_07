<!-- resources/views/admin/pages/orders/show.blade.php -->
@extends('admin.layouts.app')

@section('title', 'Order Details')

@section('content')
    <div class="admin-order-detail">
        <h1>Order #{{ $order->id }}</h1>

        <div class="order-info">
            <div>
                <h3>Customer Information</h3>
                <p>{{ $order->user->name }}</p>
                <p>{{ $order->user->email }}</p>
            </div>

            <div>
                <h3>Order Summary</h3>
                <p>Status:
                <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST">
                    @csrf
                    <select name="status" onchange="this.form.submit()">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </form>
                </p>
                <p>Total: ${{ number_format($order->total, 2) }}</p>
                <p>Payment Method: {{ $order->payment_method }}</p>
            </div>
        </div>

        <h3>Order Items</h3>
        <table class="order-items">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>${{ number_format($item->price, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection